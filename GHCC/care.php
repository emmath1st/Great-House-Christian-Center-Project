<?php
$page_title = 'Care';
require_once 'includes/header.php';

// Handle prayer request form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_prayer'])) {
    // In a real application, this would save to a database
    $prayer_success = true;
}
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Care & Support</h2>
            <p>We're here for you in times of joy, challenge, and everything in between</p>
        </div>
        
        <!-- Care Ministries -->
        <div class="care-grid">
            <!-- Care Ministry 1 -->
            <div class="care-card">
                <div class="care-icon">
                    <i class="fas fa-pray"></i>
                </div>
                <h3>Prayer Ministry</h3>
                <p>Our prayer team is available to pray with you after services or by appointment. You can also submit prayer requests online.</p>
                <a href="#prayer-request" class="btn" style="margin-top: 15px;">Request Prayer</a>
            </div>
            
            <!-- Care Ministry 2 -->
            <div class="care-card">
                <div class="care-icon">
                    <i class="fas fa-hand-holding-medical"></i>
                </div>
                <h3>Hospital Visitation</h3>
                <p>Our pastoral team and trained volunteers visit those who are hospitalized or homebound. Let us know if you or a loved one needs a visit.</p>
                <a href="#contact-form" class="btn" style="margin-top: 15px;">Request a Visit</a>
            </div>
            
            <!-- Care Ministry 3 -->
            <div class="care-card">
                <div class="care-icon">
                    <i class="fas fa-people-carry"></i>
                </div>
                <h3>Benevolence Assistance</h3>
                <p>We provide practical help with food, clothing, and emergency financial assistance to those in need within our church and community.</p>
                <a href="#contact-form" class="btn" style="margin-top: 15px;">Get Assistance</a>
            </div>
            
            <!-- Care Ministry 4 -->
            <div class="care-card">
                <div class="care-icon">
                    <i class="fas fa-heart-circle-check"></i>
                </div>
                <h3>Counseling Referrals</h3>
                <p>We maintain a list of licensed Christian counselors in our area and can provide referrals for those seeking professional counseling.</p>
                <a href="#contact-form" class="btn" style="margin-top: 15px;">Get a Referral</a>
            </div>
            
            <!-- Care Ministry 5 -->
            <div class="care-card">
                <div class="care-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Meal Ministry</h3>
                <p>We provide meals for families during times of illness, hospitalization, or following the birth or adoption of a child.</p>
                <a href="#contact-form" class="btn" style="margin-top: 15px;">Request Meals</a>
            </div>
            
            <!-- Care Ministry 6 -->
            <div class="care-card">
                <div class="care-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3>Grief Support</h3>
                <p>Our GriefShare program offers support groups for those grieving the loss of a loved one. Groups meet weekly for 13 weeks.</p>
                <a href="#contact-form" class="btn" style="margin-top: 15px;">Join GriefShare</a>
            </div>
        </div>
        
        <!-- Prayer Request Form -->
        <div id="prayer-request" class="section-title" style="margin-top: 80px;">
            <h2>Prayer Requests</h2>
            <p>Share your prayer needs with our prayer team</p>
        </div>
        
        <div class="prayer-request-form">
            <?php if (isset($prayer_success) && $prayer_success): ?>
            <div class="success-message" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                Thank you for sharing your prayer request. Our prayer team will lift you up in prayer.
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="prayer_name">Your Name (Optional)</label>
                    <input type="text" id="prayer_name" name="prayer_name" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="prayer_email">Your Email (Optional)</label>
                    <input type="email" id="prayer_email" name="prayer_email" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="prayer_type">Type of Prayer Request</label>
                    <select id="prayer_type" name="prayer_type" class="form-control">
                        <option value="">Select a category</option>
                        <option value="Healing">Healing</option>
                        <option value="Family">Family</option>
                        <option value="Financial">Financial</option>
                        <option value="Guidance">Guidance/Direction</option>
                        <option value="Salvation">Salvation (for self or others)</option>
                        <option value="Thanksgiving">Thanksgiving/Praise</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="prayer_request">Prayer Request *</label>
                    <textarea id="prayer_request" name="prayer_request" class="form-control" rows="6" required placeholder="Please share your prayer need..."></textarea>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="share_publicly" value="1" style="margin-right: 10px;">
                        <span>Share this request anonymously with the church prayer chain</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="contact_me" value="1" style="margin-right: 10px;">
                        <span>A pastor or prayer team member may contact me</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="submit_prayer" class="btn">Submit Prayer Request</button>
                </div>
            </form>
            
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
                <h4>Prayer Team Commitment</h4>
                <p>Our prayer team is committed to praying for every request submitted. All prayer requests are kept confidential unless you specify that it can be shared with the prayer chain. For urgent pastoral care needs, please call the church office at <?php echo CHURCH_PHONE; ?>.</p>
            </div>
        </div>
        
        <!-- Support Groups -->
        <div class="section-title" style="margin-top: 80px;">
            <h2>Support Groups</h2>
            <p>Find community and healing through our support ministries</p>
        </div>
        
        <div class="feature-grid">
            <!-- Support Group 1 -->
            <div class="event-card">
                <div class="event-info">
                    <h3>GriefShare</h3>
                    <div class="event-meta">
                        <span><i class="far fa-clock"></i> Tuesdays, 6:30 PM</span>
                        <span><i class="fas fa-map-marker-alt"></i> Room 203</span>
                    </div>
                    <p>A 13-week support group for those grieving the death of a loved one. Each session includes a video seminar and group discussion.</p>
                    <a href="#contact-form" class="btn">Register</a>
                </div>
            </div>
            
            <!-- Support Group 2 -->
            <div class="event-card">
                <div class="event-info">
                    <h3>Celebrate Recovery</h3>
                    <div class="event-meta">
                        <span><i class="far fa-clock"></i> Fridays, 7:00 PM</span>
                        <span><i class="fas fa-map-marker-alt"></i> Fellowship Hall</span>
                    </div>
                    <p>A Christ-centered recovery program for anyone struggling with hurt, pain, or addiction of any kind.</p>
                    <a href="#contact-form" class="btn">Learn More</a>
                </div>
            </div>
            
            <!-- Support Group 3 -->
            <div class="event-card">
                <div class="event-info">
                    <h3>DivorceCare</h3>
                    <div class="event-meta">
                        <span><i class="far fa-clock"></i> Mondays, 7:00 PM</span>
                        <span><i class="fas fa-map-marker-alt"></i> Room 205</span>
                    </div>
                    <p>A friendly, caring group of people who will walk alongside you through one of life's most difficult experiences.</p>
                    <a href="#contact-form" class="btn">Join Group</a>
                </div>
            </div>
        </div>
        
        <!-- Emergency Resources -->
        <div style="background-color: #fff3cd; border-left: 5px solid #ffc107; padding: 25px; border-radius: 4px; margin-top: 60px;">
            <h3><i class="fas fa-exclamation-triangle"></i> Emergency Resources</h3>
            <p>If you are in crisis or experiencing an emergency, please contact one of these resources immediately:</p>
            <ul style="margin-top: 15px; padding-left: 20px;">
                <li><strong>National Suicide Prevention Lifeline:</strong> 988 or 1-800-273-8255</li>
                <li><strong>Crisis Text Line:</strong> Text HOME to 741741</li>
                <li><strong>Domestic Violence Hotline:</strong> 1-800-799-7233</li>
                <li><strong>Emergency Pastoral Care:</strong> (555) 123-4568 (available 24/7)</li>
            </ul>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>