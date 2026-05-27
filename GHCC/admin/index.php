<?php
$page_title = 'Dashboard';
require_once 'includes/header.php';
require_once '../../includes/db_connect.php';

// Get statistics
$stats = [];

// Total blog posts
$result = $conn->query("SELECT COUNT(*) as count FROM blog_posts");
$stats['blog_posts'] = $result->fetch_assoc()['count'];

// Total messages
$result = $conn->query("SELECT COUNT(*) as count FROM messages");
$stats['messages'] = $result->fetch_assoc()['count'];

// Total contact submissions
$result = $conn->query("SELECT COUNT(*) as count FROM contact_submissions");
$stats['contact_submissions'] = $result->fetch_assoc()['count'];
$result = $conn->query("SELECT COUNT(*) as count FROM contact_submissions WHERE status = 'new'");
$stats['new_contacts'] = $result->fetch_assoc()['count'];

// Recent blog posts
$recent_posts = [];
$result = $conn->query("SELECT * FROM blog_posts ORDER BY date_published DESC LIMIT 5");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recent_posts[] = $row;
    }
}

// Recent contact submissions
$recent_contacts = [];
$result = $conn->query("SELECT * FROM contact_submissions ORDER BY submission_date DESC LIMIT 5");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recent_contacts[] = $row;
    }
}

// Recent messages
$recent_messages = [];
$result = $conn->query("SELECT * FROM messages ORDER BY upload_date DESC LIMIT 5");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recent_messages[] = $row;
    }
}
?>

<div class="stats-grid">
    <!-- Stat Card 1 -->
    <div class="stat-card">
        <div class="stat-icon posts">
            <i class="fas fa-blog"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $stats['blog_posts']; ?></h3>
            <p>Blog Posts</p>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="stat-card">
        <div class="stat-icon messages">
            <i class="fas fa-volume-up"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $stats['messages']; ?></h3>
            <p>Messages</p>
        </div>
    </div>
    
    <!-- Stat Card 3 -->
    <div class="stat-card">
        <div class="stat-icon users">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $stats['contact_submissions']; ?></h3>
            <p>Contact Submissions</p>
        </div>
    </div>
    
    <!-- Stat Card 4 -->
    <div class="stat-card">
        <div class="stat-icon donations">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="stat-info">
            <h3><?php echo $stats['new_contacts']; ?></h3>
            <p>New Messages</p>
        </div>
    </div>
</div>

<!-- Recent Blog Posts -->
<div class="admin-card">
    <div class="card-header">
        <h3>Recent Blog Posts</h3>
        <a href="blog-posts.php?action=new" class="btn">New Post</a>
    </div>
    
    <?php if (!empty($recent_posts)): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recent_posts as $post): ?>
            <tr>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['author']); ?></td>
                <td><?php echo date('M j, Y', strtotime($post['date_published'])); ?></td>
                <td><?php echo htmlspecialchars($post['category']); ?></td>
                <td>
                    <a href="blog-posts.php?action=edit&id=<?php echo $post['id']; ?>" class="btn btn-sm">Edit</a>
                    <a href="blog-posts.php?action=delete&id=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No blog posts found. <a href="blog-posts.php?action=new">Create your first post</a>.</p>
    <?php endif; ?>
</div>

<!-- Recent Contact Submissions -->
<div class="admin-card">
    <div class="card-header">
        <h3>Recent Contact Submissions</h3>
        <a href="contact-submissions.php" class="btn">View All</a>
    </div>
    
    <?php if (!empty($recent_contacts)): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recent_contacts as $contact): ?>
            <tr>
                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                <td><?php echo date('M j, Y', strtotime($contact['submission_date'])); ?></td>
                <td>
                    <?php
                    $status_class = '';
                    if ($contact['status'] == 'new') $status_class = 'btn-warning';
                    if ($contact['status'] == 'read') $status_class = 'btn-success';
                    if ($contact['status'] == 'replied') $status_class = 'btn';
                    ?>
                    <span class="btn btn-sm <?php echo $status_class; ?>"><?php echo ucfirst($contact['status']); ?></span>
                </td>
                <td>
                    <a href="contact-submissions.php?action=view&id=<?php echo $contact['id']; ?>" class="btn btn-sm">View</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No contact submissions yet.</p>
    <?php endif; ?>
</div>

<!-- Recent Messages -->
<div class="admin-card">
    <div class="card-header">
        <h3>Recent Messages</h3>
        <a href="messages.php?action=new" class="btn">Upload New</a>
    </div>
    
    <?php if (!empty($recent_messages)): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Speaker</th>
                <th>Date</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recent_messages as $message): ?>
            <tr>
                <td><?php echo htmlspecialchars($message['title']); ?></td>
                <td><?php echo htmlspecialchars($message['speaker']); ?></td>
                <td><?php echo date('M j, Y', strtotime($message['message_date'])); ?></td>
                <td>
                    <?php
                    $file_ext = pathinfo($message['file_path'], PATHINFO_EXTENSION);
                    echo strtoupper($file_ext) . ' (' . $message['file_size'] . ')';
                    ?>
                </td>
                <td>
                    <a href="messages.php?action=edit&id=<?php echo $message['id']; ?>" class="btn btn-sm">Edit</a>
                    <a href="messages.php?action=delete&id=<?php echo $message['id']; ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No messages uploaded yet. <a href="messages.php?action=new">Upload your first message</a>.</p>
    <?php endif; ?>
</div>

<!-- Quick Actions -->
<div class="admin-card">
    <div class="card-header">
        <h3>Quick Actions</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
        <a href="blog-posts.php?action=new" class="btn" style="text-align: center; padding: 15px;">
            <i class="fas fa-plus-circle" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
            New Blog Post
        </a>
        
        <a href="messages.php?action=new" class="btn" style="text-align: center; padding: 15px;">
            <i class="fas fa-upload" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
            Upload Message
        </a>
        
        <a href="events.php?action=new" class="btn" style="text-align: center; padding: 15px;">
            <i class="fas fa-calendar-plus" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
            Add Event
        </a>
        
        <a href="settings.php" class="btn" style="text-align: center; padding: 15px;">
            <i class="fas fa-cog" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
            Settings
        </a>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>