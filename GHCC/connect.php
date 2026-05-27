<?php
$page_title = 'Connect';
require_once 'includes/header.php';
require_once 'includes/db_connect.php';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
    $name = $db->escapeString($_POST['name']);
    $email = $db->escapeString($_POST['email']);
    $phone = $db->escapeString($_POST['phone']);
    $subject = $db->escapeString($_POST['subject']);
    $message = $db->escapeString($_POST['message']);
    
    $sql = "INSERT INTO contact_submissions (name, email, phone, subject, message) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    
    if ($conn->query($sql)) {
        $success_message = "Thank you for your message! We'll get back to you soon.";
    } else {
        $error_message = "Sorry, there was an error submitting your message. Please try again.";
    }
}
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Get Connected</h2>
            <p>We're glad you're interested in connecting with our church family. Here are several ways to get involved.</p>
        </div>
        
        <div class="feature-grid">
            <!-- Connection Option 1 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Visit a Service</h3>
                <p>Join us for worship this Sunday! We have services at 9:00 AM and 11:00 AM. Come as you are and experience our welcoming community.</p>
                <a href="watch.php" class="btn" style="margin-top: 15px;">Service Times</a>
            </div>
            
            <!-- Connection Option 2 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-people-arrows"></i>
                </div>
                <h3>Join a Small Group</h3>
                <p>Small groups meet throughout the week for Bible study, prayer, and fellowship. Find one that fits your schedule and location.</p>
                <a href="#small-groups" class="btn" style="margin-top: 15px;">Find a Group</a>
            </div>
            
            <!-- Connection Option 3 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3>Serve with Us</h3>
                <p>Use your gifts to serve others. We have volunteer opportunities in worship, children's ministry, hospitality, outreach, and more.</p>
                <a href="#serve" class="btn" style="margin-top: 15px;">Volunteer</a>
            </div>
        </div>
        
        <!-- Small Groups Section -->
        <div id="small-groups" class="section-title" style="margin-top: 80px;">
            <h2>Small Groups</h2>
            <p>Find community and grow in faith with a small group</p>
        </div>
        
        <div class="feature-grid">
            <?php
            // Sample small groups data - in a real application, this would come from a database
            $small_groups = [
                [
                    'name' => 'Young Adults Group',
                    'leader' => 'Mark & Sarah',
                    'time' => 'Tuesdays, 7:00 PM',
                    'location' => 'Church Cafe',
                    'description' => 'For singles and couples in their 20s and 30s'
                ],
                [
                    'name' => 'Women\'s Bible Study',
                    'leader' => 'Linda Thompson',
                    'time' => 'Wednesdays, 10:00 AM',
                    'location' => 'Fellowship Hall',
                    'description' => 'All women welcome for study and prayer'
                ],
                [
                    'name' => 'Men\'s Breakfast Group',
                    'leader' => 'Robert Johnson',
                    'time' => 'Saturdays, 8:00 AM',
                    'location' => 'Local Diner',
                    'description' => 'Men of all ages for fellowship and discussion'
                ],
                [
                    'name' => 'Family Group',
                    'leader' => 'The Parkers',
                    'time' => 'Sundays, 5:00 PM',
                    'location' => 'Various Homes',
                    'description' => 'For families with children of all ages'
                ]
            ];
            
            foreach ($small_groups as $group): ?>
            <div class="event-card">
                <div class="event-info">
                    <h3><?php echo $group['name']; ?></h3>
                    <div class="event-meta">
                        <span><i class="fas fa-user"></i> <?php echo $group['leader']; ?></span>
                        <span><i class="far fa-clock"></i> <?php echo $group['time']; ?></span>
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo $group['location']; ?></span>
                    </div>
                    <p><?php echo $group['description']; ?></p>
                    <a href="#contact-form" class="btn">Join This Group</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Contact Form Section -->
        <div id="contact-form" class="section-title" style="margin-top: 80px;">
            <h2>Contact Us</h2>
            <p>Have questions or want to get involved? Send us a message!</p>
        </div>
        
        <div class="connect-form">
            <?php if (isset($success_message)): ?>
            <div class="success-message" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <?php echo $success_message; ?>
            </div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
            <div class="error-message" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <select id="subject" name="subject" class="form-control" required>
                        <option value="">Select a subject</option>
                        <option value="General Inquiry">General Inquiry</option>
                        <option value="Small Groups">Small Groups</option>
                        <option value="Volunteering">Volunteering</option>
                        <option value="Pastoral Care">Pastoral Care</option>
                        <option value="Facility Rental">Facility Rental</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="submit_contact" class="btn">Send Message</button>
                </div>
            </form>
        </div>
        
        <!-- Map Section -->
        <div id="mapSection" class="map-section">
            <div class="section-title">
                <h2>Find Us</h2>
                <p>Visit our church campus</p>
            </div>
            
            <!-- Map Container -->
            <div id="map" class="map-container"></div>
            
            <!-- Directions Form -->
            <div style="background-color: var(--light-gray); padding: 30px; border-radius: 8px; margin-top: 30px;">
                <h3>Get Directions</h3>
                <div class="form-group" style="display: flex; gap: 10px; margin-top: 20px;">
                    <input type="text" id="userLocation" class="form-control" placeholder="Enter your address or zip code">
                    <button type="button" class="btn" onclick="getDirections()">Get Directions</button>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="feature-grid" style="margin-top: 40px;">
                <div class="feature-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Address</h3>
                    <p><?php echo CHURCH_ADDRESS; ?></p>
                </div>
                
                <div class="feature-card">
                    <h3><i class="fas fa-clock"></i> Office Hours</h3>
                    <p>Monday - Thursday: 9:00 AM - 5:00 PM</p>
                    <p>Friday: 9:00 AM - 1:00 PM</p>
                    <p>Sunday: 8:00 AM - 1:00 PM</p>
                </div>
                
                <div class="feature-card">
                    <h3><i class="fas fa-phone"></i> Contact Info</h3>
                    <p>Phone: <?php echo CHURCH_PHONE; ?></p>
                    <p>Email: <?php echo CHURCH_EMAIL; ?></p>
                    <p>Emergency Pastoral Care: (555) 123-4568</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>