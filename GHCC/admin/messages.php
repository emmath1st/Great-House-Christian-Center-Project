<?php
$page_title = 'Messages';
require_once 'includes/header.php';
require_once '../../includes/db_connect.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = '';
$error = '';

// Handle file upload/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $db->escapeString($_POST['title']);
    $description = $db->escapeString($_POST['description']);
    $speaker = $db->escapeString($_POST['speaker']);
    $message_date = $db->escapeString($_POST['message_date']);
    
    if (isset($_POST['message_id'])) {
        // Update existing message
        $message_id = intval($_POST['message_id']);
        
        // Handle file upload if provided
        if (isset($_FILES['message_file']) && $_FILES['message_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['message_file'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            // Check allowed file types
            $allowed_types = ['mp3', 'wav', 'pdf', 'doc', 'docx', 'txt', 'mp4', 'mov'];
            if (in_array($file_ext, $allowed_types)) {
                // Generate unique file name
                $new_file_name = uniqid('message_', true) . '.' . $file_ext;
                $upload_path = '../../uploads/' . $new_file_name;
                
                // Move uploaded file
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    // Delete old file
                    $old_file_result = $conn->query("SELECT file_path FROM messages WHERE id = $message_id");
                    if ($old_file_result && $old_file_row = $old_file_result->fetch_assoc()) {
                        if (file_exists($old_file_row['file_path'])) {
                            unlink($old_file_row['file_path']);
                        }
                    }
                    
                    $file_path = 'uploads/' . $new_file_name;
                    $formatted_size = formatFileSize($file_size);
                    
                    $sql = "UPDATE messages SET 
                            title = '$title',
                            description = '$description',
                            speaker = '$speaker',
                            message_date = '$message_date',
                            file_path = '$file_path',
                            file_size = '$formatted_size'
                            WHERE id = $message_id";
                } else {
                    $error = 'Error uploading file.';
                    $sql = "UPDATE messages SET 
                            title = '$title',
                            description = '$description',
                            speaker = '$speaker',
                            message_date = '$message_date'
                            WHERE id = $message_id";
                }
            } else {
                $error = 'Invalid file type. Allowed: ' . implode(', ', $allowed_types);
                $sql = "UPDATE messages SET 
                        title = '$title',
                        description = '$description',
                        speaker = '$speaker',
                        message_date = '$message_date'
                        WHERE id = $message_id";
            }
        } else {
            // No new file uploaded, just update other fields
            $sql = "UPDATE messages SET 
                    title = '$title',
                    description = '$description',
                    speaker = '$speaker',
                    message_date = '$message_date'
                    WHERE id = $message_id";
        }
        
        if ($conn->query($sql)) {
            $success = 'Message updated successfully!';
            $action = 'list';
        } else {
            $error = $error ?: 'Error updating message: ' . $conn->error;
        }
    } else {
        // Insert new message (requires file upload)
        if (isset($_FILES['message_file']) && $_FILES['message_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['message_file'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            // Check allowed file types
            $allowed_types = ['mp3', 'wav', 'pdf', 'doc', 'docx', 'txt', 'mp4', 'mov'];
            if (in_array($file_ext, $allowed_types)) {
                // Generate unique file name
                $new_file_name = uniqid('message_', true) . '.' . $file_ext;
                $upload_path = '../../uploads/' . $new_file_name;
                
                // Create uploads directory if it doesn't exist
                if (!is_dir('../../uploads')) {
                    mkdir('../../uploads', 0755, true);
                }
                
                // Move uploaded file
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    $file_path = 'uploads/' . $new_file_name;
                    $formatted_size = formatFileSize($file_size);
                    
                    $sql = "INSERT INTO messages (title, description, speaker, message_date, file_path, file_size, upload_date) 
                            VALUES ('$title', '$description', '$speaker', '$message_date', '$file_path', '$formatted_size', NOW())";
                    
                    if ($conn->query($sql)) {
                        $success = 'Message uploaded successfully!';
                        $action = 'list';
                    } else {
                        $error = 'Error saving to database: ' . $conn->error;
                        // Clean up uploaded file
                        unlink($upload_path);
                    }
                } else {
                    $error = 'Error uploading file.';
                }
            } else {
                $error = 'Invalid file type. Allowed: ' . implode(', ', $allowed_types);
            }
        } else {
            $error = 'Please select a file to upload.';
        }
    }
}

// Handle delete action
if ($action === 'delete' && $id > 0) {
    // Get file path before deleting
    $result = $conn->query("SELECT file_path FROM messages WHERE id = $id");
    if ($result && $row = $result->fetch_assoc()) {
        // Delete the file
        if (file_exists('../../' . $row['file_path'])) {
            unlink('../../' . $row['file_path']);
        }
    }
    
    // Delete from database
    $sql = "DELETE FROM messages WHERE id = $id";
    if ($conn->query($sql)) {
        $success = 'Message deleted successfully!';
    } else {
        $error = 'Error deleting message: ' . $conn->error;
    }
    $action = 'list';
}

// Helper function to format file size
function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

// Display success/error messages
if ($success): ?>
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div class="alert alert-error">
    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
</div>
<?php endif; ?>

<?php
// Show appropriate content based on action
switch ($action) {
    case 'new':
    case 'edit':
        $message = null;
        if ($action === 'edit' && $id > 0) {
            $result = $conn->query("SELECT * FROM messages WHERE id = $id");
            $message = $result->fetch_assoc();
        }
        ?>
        <div class="admin-card">
            <div class="card-header">
                <h3><?php echo $action === 'edit' ? 'Edit Message' : 'Upload New Message'; ?></h3>
                <a href="messages.php" class="btn">Back to List</a>
            </div>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <?php if ($action === 'edit'): ?>
                <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="title">Message Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?php echo $message ? htmlspecialchars($message['title']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?php echo $message ? htmlspecialchars($message['description']) : ''; ?></textarea>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="speaker">Speaker *</label>
                        <input type="text" id="speaker" name="speaker" class="form-control" 
                               value="<?php echo $message ? htmlspecialchars($message['speaker']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message_date">Message Date *</label>
                        <input type="date" id="message_date" name="message_date" class="form-control" 
                               value="<?php echo $message ? $message['message_date'] : date('Y-m-d'); ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message_file">
                        <?php echo $action === 'edit' ? 'Replace File (Optional)' : 'File *'; ?>
                    </label>
                    <input type="file" id="message_file" name="message_file" class="form-control" 
                           <?php echo $action === 'new' ? 'required' : ''; ?>
                           accept=".mp3,.wav,.m4a,.mp4,.mov,.avi,.pdf,.doc,.docx,.txt">
                    <small>Maximum file size: 50MB. Allowed types: MP3, WAV, MP4, PDF, DOC, TXT</small>
                    
                    <?php if ($action === 'edit' && $message): ?>
                    <p style="margin-top: 10px;">
                        <strong>Current file:</strong> <?php echo basename($message['file_path']); ?> 
                        (<?php echo $message['file_size']; ?>)
                    </p>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> <?php echo $action === 'edit' ? 'Update Message' : 'Upload Message'; ?>
                    </button>
                    <a href="messages.php" class="btn" style="background-color: var(--medium-gray);">Cancel</a>
                </div>
            </form>
        </div>
        <?php
        break;
    
    case 'list':
    default:
        // List all messages
        $result = $conn->query("SELECT * FROM messages ORDER BY message_date DESC");
        ?>
        <div class="admin-card">
            <div class="card-header">
                <h3>All Messages</h3>
                <a href="messages.php?action=new" class="btn">Upload New</a>
            </div>
            
            <?php if ($result && $result->num_rows > 0): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Speaker</th>
                        <th>Date</th>
                        <th>File Type</th>
                        <th>Size</th>
                        <th>Upload Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): 
                        $file_ext = strtoupper(pathinfo($row['file_path'], PATHINFO_EXTENSION));
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['speaker']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($row['message_date'])); ?></td>
                        <td><?php echo $file_ext; ?></td>
                        <td><?php echo $row['file_size']; ?></td>
                        <td><?php echo date('M j, Y', strtotime($row['upload_date'])); ?></td>
                        <td>
                            <a href="messages.php?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm">Edit</a>
                            <a href="messages.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                            <a href="../../<?php echo $row['file_path']; ?>" class="btn btn-sm" target="_blank" download>Download</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No messages found. <a href="messages.php?action=new">Upload your first message</a>.</p>
            <?php endif; ?>
        </div>
        <?php
        break;
}
?>

<?php
require_once 'includes/footer.php';
?>