<?php
$page_title = 'Settings';
require_once 'includes/header.php';
require_once '../../includes/db_connect.php';

$success = '';
$error = '';

// Handle settings update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // In a real application, you would save these to a settings table
    // For this demo, we'll simulate saving
    $success = 'Settings updated successfully!';
}
?>

<div class="admin-card">
    <div class="card-header">
        <h3>Website Settings</h3>
    </div>
    
    <?php if ($success): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success; ?>
    </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
    </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <h4 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">General Settings</h4>
        
        <div class="form-group">
            <label for="site_name">Site Name</label>
            <input type="text" id="site_name" name="site_name" class="form-control" value="<?php echo SITE_NAME; ?>">
        </div>
        
        <div class="form-group">
            <label for="site_url">Site URL</label>
            <input type="url" id="site_url" name="site_url" class="form-control" value="<?php echo SITE_URL; ?>">
        </div>
        
        <div class="form-group">
            <label for="church_email">Church Email</label>
            <input type="email" id="church_email" name="church_email" class="form-control" value="<?php echo CHURCH_EMAIL; ?>">
        </div>
        
        <div class="form-group">
            <label for="church_phone">Church Phone</label>
            <input type="text" id="church_phone" name="church_phone" class="form-control" value="<?php echo CHURCH_PHONE; ?>">
        </div>
        
        <div class="form-group">
            <label for="church_address">Church Address</label>
            <textarea id="church_address" name="church_address" class="form-control" rows="3"><?php echo CHURCH_ADDRESS; ?></textarea>
        </div>
        
        <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Service Times</h4>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="sunday_morning">Sunday Morning</label>
                <input type="text" id="sunday_morning" name="sunday_morning" class="form-control" value="9:00 AM & 11:00 AM">
            </div>
            
            <div class="form-group">
                <label for="sunday_evening">Sunday Evening</label>
                <input type="text" id="sunday_evening" name="sunday_evening" class="form-control" value="6:00 PM">
            </div>
            
            <div class="form-group">
                <label for="wednesday_bible">Wednesday Bible Study</label>
                <input type="text" id="wednesday_bible" name="wednesday_bible" class="form-control" value="7:00 PM">
            </div>
            
            <div class="form-group">
                <label for="friday_youth">Friday Youth Night</label>
                <input type="text" id="friday_youth" name="friday_youth" class="form-control" value="7:30 PM">
            </div>
        </div>
        
        <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Social Media</h4>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="facebook_url">Facebook URL</label>
                <input type="url" id="facebook_url" name="facebook_url" class="form-control" placeholder="https://facebook.com/yourchurch">
            </div>
            
            <div class="form-group">
                <label for="twitter_url">Twitter URL</label>
                <input type="url" id="twitter_url" name="twitter_url" class="form-control" placeholder="https://twitter.com/yourchurch">
            </div>
            
            <div class="form-group">
                <label for="instagram_url">Instagram URL</label>
                <input type="url" id="instagram_url" name="instagram_url" class="form-control" placeholder="https://instagram.com/yourchurch">
            </div>
            
            <div class="form-group">
                <label for="youtube_url">YouTube URL</label>
                <input type="url" id="youtube_url" name="youtube_url" class="form-control" placeholder="https://youtube.com/yourchurch">
            </div>
        </div>
        
        <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">File Upload Settings</h4>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="max_upload_size">Max Upload Size (MB)</label>
                <input type="number" id="max_upload_size" name="max_upload_size" class="form-control" value="50">
            </div>
            
            <div class="form-group">
                <label for="allowed_file_types">Allowed File Types</label>
                <input type="text" id="allowed_file_types" name="allowed_file_types" class="form-control" value="mp3, wav, pdf, doc, docx, txt">
            </div>
        </div>
        
        <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">Google Maps</h4>
        
        <div class="form-group">
            <label for="google_maps_api">Google Maps API Key</label>
            <input type="text" id="google_maps_api" name="google_maps_api" class="form-control" value="<?php echo GOOGLE_MAPS_API_KEY; ?>">
        </div>
        
        <div class="form-group">
            <label for="map_location">Map Location (Latitude, Longitude)</label>
            <input type="text" id="map_location" name="map_location" class="form-control" value="37.7749, -122.4194">
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>
    </form>
</div>

<!-- Database Backup -->
<div class="admin-card">
    <div class="card-header">
        <h3>Database Backup</h3>
    </div>
    
    <p>Create a backup of your database. This will generate a SQL file that you can download and restore if needed.</p>
    
    <div style="display: flex; gap: 15px; margin-top: 20px;">
        <a href="backup.php?action=create" class="btn btn-success">
            <i class="fas fa-database"></i> Create Backup
        </a>
        
        <a href="backup.php?action=restore" class="btn btn-warning">
            <i class="fas fa-upload"></i> Restore Backup
        </a>
    </div>
    
    <div style="margin-top: 30px;">
        <h4>Recent Backups</h4>
        <table class="data-table" style="margin-top: 15px;">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Date</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">
                        No backups found. Create your first backup.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Admin Account -->
<div class="admin-card">
    <div class="card-header">
        <h3>Admin Account</h3>
    </div>
    
    <form method="POST" action="change-password.php">
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn">
                <i class="fas fa-key"></i> Change Password
            </button>
        </div>
    </form>
</div>

<?php
require_once 'includes/footer.php';
?>