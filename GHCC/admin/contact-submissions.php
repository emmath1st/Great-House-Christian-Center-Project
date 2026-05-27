<?php
$page_title = 'Contact Submissions';
require_once 'includes/header.php';
require_once '../../includes/db_connect.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = '';
$error = '';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $submission_id = intval($_POST['submission_id']);
    $status = $db->escapeString($_POST['status']);
    $admin_notes = $db->escapeString($_POST['admin_notes']);
    
    $sql = "UPDATE contact_submissions SET 
            status = '$status',
            admin_notes = '$admin_notes'
            WHERE id = $submission_id";
    
    if ($conn->query($sql)) {
        $success = 'Submission status updated successfully!';
        $action = 'list';
    } else {
        $error = 'Error updating status: ' . $conn->error;
    }
}

// Handle delete action
if ($action === 'delete' && $id > 0) {
    $sql = "DELETE FROM contact_submissions WHERE id = $id";
    if ($conn->query($sql)) {
        $success = 'Submission deleted successfully!';
    } else {
        $error = 'Error deleting submission: ' . $conn->error;
    }
    $action = 'list';
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
    case 'view':
        if ($id > 0) {
            $result = $conn->query("SELECT * FROM contact_submissions WHERE id = $id");
            $submission = $result->fetch_assoc();
            
            if ($submission):
            ?>
            <div class="admin-card">
                <div class="card-header">
                    <h3>View Contact Submission</h3>
                    <a href="contact-submissions.php" class="btn">Back to List</a>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                    <div>
                        <h4>Contact Information</h4>
                        <table style="width: 100%;">
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold;">Name:</td>
                                <td style="padding: 8px 0;"><?php echo htmlspecialchars($submission['name']); ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold;">Email:</td>
                                <td style="padding: 8px 0;">
                                    <a href="mailto:<?php echo htmlspecialchars($submission['email']); ?>">
                                        <?php echo htmlspecialchars($submission['email']); ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold;">Phone:</td>
                                <td style="padding: 8px 0;"><?php echo htmlspecialchars($submission['phone'] ?: 'Not provided'); ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold;">Submitted:</td>
                                <td style="padding: 8px 0;"><?php echo date('F j, Y g:i A', strtotime($submission['submission_date'])); ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold;">Status:</td>
                                <td style="padding: 8px 0;">
                                    <?php
                                    $status_class = '';
                                    if ($submission['status'] == 'new') $status_class = 'btn-warning';
                                    if ($submission['status'] == 'read') $status_class = 'btn-success';
                                    if ($submission['status'] == 'replied') $status_class = 'btn';
                                    ?>
                                    <span class="btn btn-sm <?php echo $status_class; ?>"><?php echo ucfirst($submission['status']); ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div>
                        <h4>Message Details</h4>
                        <table style="width: 100%;">
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold;">Subject:</td>
                                <td style="padding: 8px 0;"><?php echo htmlspecialchars($submission['subject']); ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Message:</td>
                                <td style="padding: 8px 0;"><?php echo nl2br(htmlspecialchars($submission['message'])); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <h4>Update Status</h4>
                <form method="POST" action="" style="margin-top: 20px;">
                    <input type="hidden" name="submission_id" value="<?php echo $submission['id']; ?>">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="new" <?php echo $submission['status'] == 'new' ? 'selected' : ''; ?>>New</option>
                                <option value="read" <?php echo $submission['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                <option value="replied" <?php echo $submission['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="admin_notes">Admin Notes (Optional)</label>
                        <textarea id="admin_notes" name="admin_notes" class="form-control" rows="4"><?php echo htmlspecialchars($submission['admin_notes'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="update_status" class="btn">Update Status</button>
                        <a href="contact-submissions.php" class="btn" style="background-color: var(--medium-gray);">Cancel</a>
                    </div>
                </form>
            </div>
            <?php
            else:
                echo '<p>Submission not found.</p>';
            endif;
        }
        break;
    
    case 'list':
    default:
        // List all contact submissions
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
        $where = '';
        
        if ($filter === 'new') {
            $where = "WHERE status = 'new'";
        } elseif ($filter === 'read') {
            $where = "WHERE status = 'read'";
        } elseif ($filter === 'replied') {
            $where = "WHERE status = 'replied'";
        }
        
        $result = $conn->query("SELECT * FROM contact_submissions $where ORDER BY submission_date DESC");
        ?>
        <div class="admin-card">
            <div class="card-header">
                <h3>Contact Submissions</h3>
                <div style="display: flex; gap: 10px;">
                    <a href="contact-submissions.php?filter=all" class="btn <?php echo $filter === 'all' ? '' : 'btn-secondary'; ?>">All</a>
                    <a href="contact-submissions.php?filter=new" class="btn <?php echo $filter === 'new' ? '' : 'btn-secondary'; ?>">New</a>
                    <a href="contact-submissions.php?filter=read" class="btn <?php echo $filter === 'read' ? '' : 'btn-secondary'; ?>">Read</a>
                    <a href="contact-submissions.php?filter=replied" class="btn <?php echo $filter === 'replied' ? '' : 'btn-secondary'; ?>">Replied</a>
                </div>
            </div>
            
            <?php if ($result && $result->num_rows > 0): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($row['submission_date'])); ?></td>
                        <td>
                            <?php
                            $status_class = '';
                            if ($row['status'] == 'new') $status_class = 'btn-warning';
                            if ($row['status'] == 'read') $status_class = 'btn-success';
                            if ($row['status'] == 'replied') $status_class = 'btn';
                            ?>
                            <span class="btn btn-sm <?php echo $status_class; ?>"><?php echo ucfirst($row['status']); ?></span>
                        </td>
                        <td>
                            <a href="contact-submissions.php?action=view&id=<?php echo $row['id']; ?>" class="btn btn-sm">View</a>
                            <a href="contact-submissions.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No contact submissions found.</p>
            <?php endif; ?>
        </div>
        <?php
        break;
}
?>

<?php
require_once 'includes/footer.php';
?>