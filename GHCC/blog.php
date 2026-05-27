<?php
$page_title = 'Blog';
require_once 'includes/header.php';
require_once 'includes/db_connect.php';

// Fetch blog posts from database
$sql = "SELECT * FROM blog_posts ORDER BY date_published DESC LIMIT 9";
$result = $conn->query($sql);
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Church Blog & News</h2>
            <p>Stay updated with the latest news, teachings, and events from our church</p>
        </div>
        
        <!-- Blog Grid -->
        <div class="blog-grid">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $date = date('F j, Y', strtotime($row['date_published']));
                    $excerpt = strlen($row['content']) > 150 ? substr($row['content'], 0, 150) . '...' : $row['content'];
                    
                    // Determine icon based on category
                    $icon = 'fas fa-newspaper'; // default
                    if ($row['category'] === 'Teaching') $icon = 'fas fa-book-open';
                    if ($row['category'] === 'Events') $icon = 'fas fa-calendar-alt';
                    if ($row['category'] === 'Announcements') $icon = 'fas fa-bullhorn';
            ?>
            <div class="blog-post">
                <?php if ($row['image_url']): ?>
                <div class="blog-image">
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                </div>
                <?php else: ?>
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="<?php echo htmlspecialchars($row['title']); ?>">
                </div>
                <?php endif; ?>
                
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> <?php echo $date; ?></span>
                        <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['author']); ?></span>
                        <span><i class="<?php echo $icon; ?>"></i> <?php echo htmlspecialchars($row['category']); ?></span>
                    </div>
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($excerpt); ?></p>
                    <a href="#" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php
                }
            } else {
                // Default posts if database is empty
                $default_posts = [
                    [
                        'title' => 'Welcome to Our Church Family',
                        'content' => 'We are excited to welcome new members to our growing community. Join us this Sunday for a special newcomers lunch after the 11:00 AM service.',
                        'author' => 'Pastor John',
                        'category' => 'Announcements',
                        'date' => 'October 15, 2023'
                    ],
                    [
                        'title' => 'The Power of Faith in Difficult Times',
                        'content' => 'In this message, we explore how faith can guide us through challenges and help us find hope even in the darkest moments.',
                        'author' => 'Reverend Sarah',
                        'category' => 'Teaching',
                        'date' => 'October 10, 2023'
                    ],
                    [
                        'title' => 'Upcoming Community Outreach Events',
                        'content' => 'Join us for our monthly community service day on Saturday. We\'ll be cleaning up the local park and distributing food to families in need.',
                        'author' => 'Deacon Michael',
                        'category' => 'Events',
                        'date' => 'October 5, 2023'
                    ]
                ];
                
                foreach ($default_posts as $post) {
            ?>
            <div class="blog-post">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="<?php echo htmlspecialchars($post['title']); ?>">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> <?php echo $post['date']; ?></span>
                        <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($post['author']); ?></span>
                        <span><i class="fas fa-newspaper"></i> <?php echo htmlspecialchars($post['category']); ?></span>
                    </div>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <a href="#" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        
        <!-- Blog Categories -->
        <div class="section-title" style="margin-top: 80px;">
            <h2>Browse by Category</h2>
        </div>
        
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Teachings</h3>
                <p>Biblical insights, sermon notes, and spiritual growth resources from our pastors and teachers.</p>
                <a href="#" class="btn" style="margin-top: 15px;">Read Teachings</a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Church Events</h3>
                <p>Updates on upcoming services, special events, and ministry activities throughout the year.</p>
                <a href="#" class="btn" style="margin-top: 15px;">View Events</a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3>Announcements</h3>
                <p>Important news, updates, and information about our church community and ministries.</p>
                <a href="#" class="btn" style="margin-top: 15px;">See Announcements</a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Testimonies</h3>
                <p>Stories of faith, transformation, and God's work in the lives of our church members.</p>
                <a href="#" class="btn" style="margin-top: 15px;">Read Stories</a>
            </div>
        </div>
        
        <!-- Newsletter Signup -->
        <div style="background-color: var(--light-gray); padding: 60px 40px; border-radius: 8px; margin-top: 80px; text-align: center;">
            <h3>Stay Connected</h3>
            <p style="max-width: 600px; margin: 20px auto;">Subscribe to our weekly newsletter for the latest updates, sermon notes, and church news delivered to your inbox.</p>
            
            <div style="max-width: 500px; margin: 30px auto;">
                <div class="form-group" style="display: flex; gap: 10px;">
                    <input type="email" id="newsletter_email" class="form-control" placeholder="Enter your email address">
                    <button type="button" class="btn" onclick="subscribeNewsletter()">Subscribe</button>
                </div>
                <p style="font-size: 0.9rem; color: var(--medium-gray); margin-top: 10px;">
                    We respect your privacy. Unsubscribe at any time.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
function subscribeNewsletter() {
    const email = document.getElementById('newsletter_email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!email || !emailRegex.test(email)) {
        alert('Please enter a valid email address');
        return;
    }
    
    // In a real application, this would send the email to a server
    alert(`Thank you for subscribing with ${email}! You'll receive our next newsletter.`);
    document.getElementById('newsletter_email').value = '';
}
</script>

<?php
require_once 'includes/footer.php';
?>