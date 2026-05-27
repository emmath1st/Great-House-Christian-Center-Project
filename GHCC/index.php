<?php
$page_title = 'Home';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to Grace Community Church</h1>
        <p>A place where faith, hope, and love come together. Join us as we worship, grow, and serve our community in the name of Jesus Christ.</p>
        <div class="hero-buttons">
            <a href="watch.php" class="btn">Watch Service</a>
            <a href="connect.php" class="btn btn-secondary">Get Connected</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section features">
    <div class="container">
        <div class="section-title">
            <h2>Our Ministries</h2>
            <p>Explore the different ways you can get involved in our church community</p>
        </div>
        
        <div class="feature-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-hands-praying"></i>
                </div>
                <h3>Worship Services</h3>
                <p>Join us for inspiring worship services every Sunday at 9:00 AM and 11:00 AM. Experience God's presence through music, prayer, and biblical teaching.</p>
                <a href="watch.php" class="btn" style="margin-top: 15px;">Learn More</a>
            </div>
            
            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-people-group"></i>
                </div>
                <h3>Small Groups</h3>
                <p>Connect with others in our small group communities. Grow in faith through fellowship, Bible study, and mutual support in a smaller setting.</p>
                <a href="connect.php" class="btn" style="margin-top: 15px;">Find a Group</a>
            </div>
            
            <!-- Feature 3 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3>Community Care</h3>
                <p>We're here for you in times of need. From prayer support to practical help, our care ministry seeks to serve our church family and community.</p>
                <a href="care.php" class="btn" style="margin-top: 15px;">Get Support</a>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Upcoming Events</h2>
            <p>Join us for these special gatherings and community activities</p>
        </div>
        
        <div class="feature-grid">
            <!-- Event 1 -->
            <div class="event-card">
                <div class="event-date">
                    <div class="day">15</div>
                    <div class="month">November</div>
                </div>
                <div class="event-info">
                    <h3>Community Thanksgiving Dinner</h3>
                    <div class="event-meta">
                        <span><i class="far fa-clock"></i> 5:00 PM - 8:00 PM</span>
                        <span><i class="fas fa-map-marker-alt"></i> Church Fellowship Hall</span>
                    </div>
                    <p>Join us for our annual Thanksgiving dinner open to the entire community. Enjoy a delicious meal and fellowship with neighbors and friends.</p>
                    <a href="connect.php" class="btn">RSVP Now</a>
                </div>
            </div>
            
            <!-- Event 2 -->
            <div class="event-card">
                <div class="event-date">
                    <div class="day">22</div>
                    <div class="month">November</div>
                </div>
                <div class="event-info">
                    <h3>Youth Group Fall Retreat</h3>
                    <div class="event-meta">
                        <span><i class="far fa-clock"></i> All Day Event</span>
                        <span><i class="fas fa-map-marker-alt"></i> Pine Valley Camp</span>
                    </div>
                    <p>A weekend retreat for youth (ages 13-18) focused on spiritual growth, fun activities, and building Christ-centered relationships.</p>
                    <a href="connect.php" class="btn">Register</a>
                </div>
            </div>
            
            <!-- Event 3 -->
            <div class="event-card">
                <div class="event-date">
                    <div class="day">05</div>
                    <div class="month">December</div>
                </div>
                <div class="event-info">
                    <h3>Christmas Caroling & Cookie Exchange</h3>
                    <div class="event-meta">
                        <span><i class="far fa-clock"></i> 6:30 PM - 9:00 PM</span>
                        <span><i class="fas fa-map-marker-alt"></i> Meet at Church</span>
                    </div>
                    <p>Spread Christmas cheer through our neighborhood! We'll go caroling and then return for hot cocoa and a cookie exchange.</p>
                    <a href="connect.php" class="btn">Join Us</a>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="connect.php" class="btn">View All Events</a>
        </div>
    </div>
</section>

<!-- Latest Sermon Section -->
<section class="section" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="section-title">
            <h2>Latest Message</h2>
            <p>Watch or listen to our most recent sermon</p>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto;">
            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Sunday Sermon">
                    <a href="watch.php" class="play-button">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="video-info">
                    <h3>The Power of Persistent Prayer</h3>
                    <div class="video-meta">
                        <span><i class="far fa-calendar"></i> October 15, 2023</span>
                        <span><i class="fas fa-user"></i> Pastor John Wilson</span>
                    </div>
                    <p>In this message, we explore Jesus' teaching on prayer in Luke 18:1-8 and discover how persistent prayer transforms our relationship with God.</p>
                    <div style="margin-top: 20px; display: flex; gap: 10px;">
                        <a href="watch.php" class="btn">Watch Now</a>
                        <a href="download-messages.php" class="btn btn-secondary">Download Audio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>