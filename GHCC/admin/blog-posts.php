<?php
$page_title = 'Blog Posts';
require_once 'includes/header.php';
require_once '../../includes/db_connect.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = '';
$error = '';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $db->escapeString($_POST['title']);
    $content = $db->escapeString($_POST['content']);
    $author = $db->escapeString($_POST['author']);
    $category = $db->escapeString($_POST['category']);
    $image_url = $db->escapeString($_POST['image_url']);
    
    if (isset($_POST['post_id'])) {
        // Update existing post
        $post_id = intval($_POST['post_id']);
        $sql = "UPDATE blog_posts SET 
                title = '$title',
                content = '$content',
                author = '$author',
                category = '$category',
                image_url = '$image_url'
                WHERE id = $post_id";
        
        if ($conn->query($sql)) {
            $success = 'Blog post updated successfully!';
            $action = 'list';
        } else {
            $error = 'Error updating post: ' . $conn->error;
        }
    } else {
        // Insert new post
        $sql = "INSERT INTO blog_posts (title, content, author, category, image_url, date_published) 
                VALUES ('$title', '$content', '$author', '$category', '$image_url', NOW())";
        
        if ($conn->query($sql)) {
            $success = 'Blog post created successfully!';
            $action = 'list';
        } else {
            $error = 'Error creating post: ' . $conn->error;
        }
    }
}

// Handle delete action
if ($action === 'delete' && $id > 0) {
    $sql = "DELETE FROM blog_posts WHERE id = $id";
    if ($conn->query($sql)) {
        $success = 'Blog post deleted successfully!';
    } else {
        $error = 'Error deleting post: ' . $conn->error;
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
    case 'new':
    case 'edit':
        $post = null;
        if ($action === 'edit' && $id > 0) {
            $result = $conn->query("SELECT * FROM blog_posts WHERE id = $id");
            $post = $result->fetch_assoc();
        }
        ?>
        <div class="admin-card">
            <div class="card-header">
                <h3><?php echo $action === 'edit' ? 'Edit Blog Post' : 'Create New Blog Post'; ?></h3>
                <a href="blog-posts.php" class="btn">Back to List</a>
            </div>
            
            <form method="POST" action="">
                <?php if ($action === 'edit'): ?>
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="title">Post Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?php echo $post ? htmlspecialchars($post['title']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="content">Content *</label>
                    <textarea id="content" name="content" class="form-control" rows="10" required><?php echo $post ? htmlspecialchars($post['content']) : ''; ?></textarea>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="author">Author *</label>
                        <input type="text" id="author" name="author" class="form-control" 
                               value="<?php echo $post ? htmlspecialchars($post['author']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select Category</option>
                            <option value="Announcements" <?php echo ($post && $post['category'] == 'Announcements') ? 'selected' : ''; ?>>Announcements</option>
                            <option value="Teaching" <?php echo ($post && $post['category'] == 'Teaching') ? 'selected' : ''; ?>>Teaching</option>
                            <option value="Events" <?php echo ($post && $post['category'] == 'Events') ? 'selected' : ''; ?>>Events</option>
                            <option value="Testimonies" <?php echo ($post && $post['category'] == 'Testimonies') ? 'selected' : ''; ?>>Testimonies</option>
                            <option value="News" <?php echo ($post && $post['category'] == 'News') ? 'selected' : ''; ?>>News</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="image_url">Image URL (Optional)</label>
                    <input type="url" id="image_url" name="image_url" class="form-control" 
                           value="<?php echo $post ? htmlspecialchars($post['image_url']) : ''; ?>" 
                           placeholder="https://example.com/image.jpg">
                    <small>Recommended size: 1200x630 pixels</small>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> <?php echo $action === 'edit' ? 'Update Post' : 'Create Post'; ?>
                    </button>
                    <a href="blog-posts.php" class="btn" style="background-color: var(--medium-gray);">Cancel</a>
                </div>
            </form>
        </div>
        <?php
        break;
    
    case 'list':
    default:
        // List all blog posts
        $result = $conn->query("SELECT * FROM blog_posts ORDER BY date_published DESC");
        ?>
        <div class="admin-card">
            <div class="card-header">
                <h3>All Blog Posts</h3>
                <a href="blog-posts.php?action=new" class="btn">New Post</a>
            </div>
            
            <?php if ($result && $result->num_rows > 0): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Date Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo date('M j, Y', strtotime($row['date_published'])); ?></td>
                        <td>
                            <a href="blog-posts.php?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm">Edit</a>
                            <a href="blog-posts.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger delete-btn">Delete</a>
                            <a href="../../blog.php#post-<?php echo $row['id']; ?>" class="btn btn-sm" target="_blank">View</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No blog posts found. <a href="blog-posts.php?action=new">Create your first post</a>.</p>
            <?php endif; ?>
        </div>
        <?php
        break;
}
?>

<?php
require_once 'includes/footer.php';
?>