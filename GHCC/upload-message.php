<?php
$page_title = 'Upload Message';
require_once 'includes/header.php';
require_once 'includes/db_connect.php';

// Handle file upload
$upload_success = false;
$upload_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['message_file'])) {
    $title = $db->escapeString($_POST['title']);
    $description = $db->escapeString($_POST['description']);
    $speaker = $db->escapeString($_POST['speaker']);
    $message_date = $db->escapeString($_POST['message_date']);
    
    $file = $_FILES['message_file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    
    // Check for upload errors
    if ($file_error === UPLOAD_ERR_OK) {
        // Check file size
        if ($file_size > MAX_UPLOAD_SIZE) {
            $upload_error = 'File size exceeds maximum limit of 50MB.';
        } else {
            // Get file extension
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            // Check allowed file types
            if (in_array($file_ext, ALLOWED_FILE_TYPES)) {
                // Generate unique file name
                $new_file_name = uniqid('message_', true) . '.' . $file_ext;
                $upload_path = UPLOAD_PATH . $new_file_name;
                
                // Create uploads directory if it doesn't exist
                if (!is_dir(UPLOAD_PATH)) {
                    mkdir(UPLOAD_PATH, 0755, true);
                }
                
                // Move uploaded file
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    // Format file size
                    $formatted_size = formatFileSize($file_size);
                    
                    // Save to database
                    $sql = "INSERT INTO messages (title, description, file_path, file_size, speaker, message_date) 
                            VALUES ('$title', '$description', '$upload_path', '$formatted_size', '$speaker', '$message_date')";
                    
                    if ($conn->query($sql)) {
                        $upload_success = true;
                    } else {
                        $upload_error = 'Database error: ' . $conn->error;
                        // Clean up uploaded file
                        unlink($upload_path);
                    }
                } else {
                    $upload_error = 'Error moving uploaded file.';
                }
            } else {
                $upload_error = 'File type not allowed. Allowed types: ' . implode(', ', ALLOWED_FILE_TYPES);
            }
        }
    } else {
        $upload_error = 'File upload error: ' . $file_error;
    }
}

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
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Upload Message</h2>
            <p>Share sermons, teachings, or announcements with the church community</p>
        </div>
        
        <!-- Upload Form -->
        <div class="upload-form">
            <?php if ($upload_success): ?>
            <div class="success-message" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i> Message uploaded successfully! It will be reviewed and made available for download soon.
            </div>
            <?php elseif ($upload_error): ?>
            <div class="error-message" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($upload_error); ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Message Title *</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="Brief description of the message..."></textarea>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="speaker">Speaker *</label>
                        <input type="text" id="speaker" name="speaker" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message_date">Message Date *</label>
                        <input type="date" id="message_date" name="message_date" class="form-control" required>
                    </div>
                </div>
                
                <!-- File Upload Area -->
                <div class="file-upload-area">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <h4>Select File to Upload</h4>
                    <p>Maximum file size: 50MB. Allowed file types: <?php echo implode(', ', ALLOWED_FILE_TYPES); ?></p>
                    
                    <input type="file" id="message_file" name="message_file" class="file-input" required 
                           accept=".mp3,.wav,.m4a,.mp4,.mov,.avi,.pdf,.doc,.docx,.txt">
                    <label for="message_file" class="file-input-label">
                        <i class="fas fa-folder-open"></i> Choose File
                    </label>
                    
                    <div class="file-info" id="fileInfo">
                        No file selected
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" class="form-control">
                        <option value="">Select category</option>
                        <option value="sermon">Sunday Sermon</option>
                        <option value="bible_study">Bible Study</option>
                        <option value="teaching">Teaching Series</option>
                        <option value="special">Special Event</option>
                        <option value="announcement">Announcement</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="agree_terms" value="1" style="margin-right: 10px;" required>
                        <span>I confirm that I have the right to share this content and that it aligns with our church's values and teachings.</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                        <i class="fas fa-upload"></i> Upload Message
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Upload Guidelines -->
        <div style="background-color: var(--light-gray); padding: 40px; border-radius: 8px; margin-top: 60px;">
            <h3 style="text-align: center; margin-bottom: 30px;">Upload Guidelines</h3>
            <div class="feature-grid">
                <div class="feature-card" style="background-color: transparent; box-shadow: none; text-align: left;">
                    <h4><i class="fas fa-check-circle" style="color: var(--primary-green);"></i> Acceptable Content</h4>
                    <ul style="margin-top: 15px; padding-left: 20px;">
                        <li>Sunday sermons and teachings</li>
                        <li>Bible study materials</li>
                        <li>Special event recordings</li>
                        <li>Church announcements</li>
                        <li>Worship music (with proper licensing)</li>
                    </ul>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none; text-align: left;">
                    <h4><i class="fas fa-times-circle" style="color: #ff4757;"></i> Prohibited Content</h4>
                    <ul style="margin-top: 15px; padding-left: 20px;">
                        <li>Copyrighted material without permission</li>
                        <li>Content not aligned with our beliefs</li>
                        <li>Personal or private information</li>
                        <li>Commercial advertisements</li>
                        <li>Content larger than 50MB</li>
                    </ul>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none; text-align: left;">
                    <h4><i class="fas fa-info-circle" style="color: var(--accent-yellow);"></i> Tips for Best Quality</h4>
                    <ul style="margin-top: 15px; padding-left: 20px;">
                        <li>Use MP3 format for audio (128kbps or higher)</li>
                        <li>Use MP4 format for video (720p or higher)</li>
                        <li>Include a clear title and description</li>
                        <li>Name files descriptively (e.g., "Sermon_20231015.mp3")</li>
                        <li>Test files before uploading</li>
                    </ul>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <p>Need help uploading or have questions about acceptable content? <a href="connect.php">Contact our media team</a>.</p>
            </div>
        </div>
        
        <!-- Recent Uploads -->
        <div class="section-title" style="margin-top: 80px;">
            <h2>Recently Uploaded</h2>
            <p>Messages uploaded by our community</p>
        </div>
        
        <div class="table-responsive">
            <table class="messages-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Uploaded By</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch recent uploads
                    $recent_sql = "SELECT * FROM messages ORDER BY upload_date DESC LIMIT 5";
                    $recent_result = $conn->query($recent_sql);
                    
                    if ($recent_result && $recent_result->num_rows > 0) {
                        while ($row = $recent_result->fetch_assoc()) {
                            $upload_date = date('F j, Y', strtotime($row['upload_date']));
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                            <?php if ($row['description']): ?>
                            <br><small style="color: var(--medium-gray);"><?php echo htmlspecialchars(substr($row['description'], 0, 100)); ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['speaker']); ?></td>
                        <td><?php echo $upload_date; ?></td>
                        <td>
                            <span style="background-color: #d4edda; color: #155724; padding: 5px 10px; border-radius: 4px; font-size: 0.85rem;">
                                <i class="fas fa-check"></i> Published
                            </span>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 30px;">
                            <p>No recent uploads. Be the first to share a message!</p>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
// File input change handler
document.getElementById('message_file').addEventListener('change', function(e) {
    const fileInfo = document.getElementById('fileInfo');
    
    if (this.files.length > 0) {
        const file = this.files[0];
        const fileSize = (file.size / (1024 * 1024)).toFixed(2);
        
        fileInfo.innerHTML = `
            <strong>Selected File:</strong> ${file.name}<br>
            <strong>Size:</strong> ${fileSize} MB<br>
            <strong>Type:</strong> ${file.type || 'Unknown'}
        `;
        
        // Validate file size
        const maxSize = 50; // 50MB
        if (file.size > maxSize * 1024 * 1024) {
            fileInfo.innerHTML += `<br><span style="color: #ff4757;">File exceeds ${maxSize}MB limit!</span>`;
        }
    } else {
        fileInfo.textContent = 'No file selected';
    }
});
</script>

<?php
require_once 'includes/footer.php';
?>