<?php
$page_title = 'Watch';
require_once 'includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Watch Services & Messages</h2>
            <p>Join us online or watch past services anytime</p>
        </div>
        
        <!-- Live Stream Section -->
        <div style="background-color: var(--light-gray); padding: 40px; border-radius: 8px; margin-bottom: 60px; text-align: center;">
            <h3><i class="fas fa-broadcast-tower"></i> Live Stream</h3>
            <p style="margin-bottom: 20px;">Join our live service every Sunday at 9:00 AM and 11:00 AM (EST)</p>
            
            <!-- Live Stream Player -->
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="video-thumbnail" style="height: 400px; position: relative;">
                    <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Live Stream">
                    <div style="position: absolute; top: 20px; left: 20px; background-color: #ff4757; color: white; padding: 5px 15px; border-radius: 4px; font-weight: bold;">
                        <i class="fas fa-circle"></i> LIVE NOW
                    </div>
                    <a href="#" class="play-button" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div style="background-color: var(--pure-white); padding: 20px; border-radius: 0 0 8px 8px;">
                    <h4>Sunday Morning Service - November 12, 2023</h4>
                    <p>Worship led by Grace Worship Team | Message by Pastor John Wilson</p>
                    <a href="#" class="btn" style="margin-top: 15px;">Join Live Stream</a>
                </div>
            </div>
            
            <!-- Service Countdown -->
            <div style="margin-top: 30px;">
                <h4>Next Service Starts In:</h4>
                <div id="countdown" style="display: flex; justify-content: center; gap: 15px; margin-top: 15px;">
                    <div style="background-color: var(--primary-green); color: white; padding: 15px; border-radius: 8px; min-width: 80px;">
                        <div id="days" style="font-size: 2rem; font-weight: bold;">00</div>
                        <div>Days</div>
                    </div>
                    <div style="background-color: var(--primary-green); color: white; padding: 15px; border-radius: 8px; min-width: 80px;">
                        <div id="hours" style="font-size: 2rem; font-weight: bold;">00</div>
                        <div>Hours</div>
                    </div>
                    <div style="background-color: var(--primary-green); color: white; padding: 15px; border-radius: 8px; min-width: 80px;">
                        <div id="minutes" style="font-size: 2rem; font-weight: bold;">00</div>
                        <div>Minutes</div>
                    </div>
                    <div style="background-color: var(--primary-green); color: white; padding: 15px; border-radius: 8px; min-width: 80px;">
                        <div id="seconds" style="font-size: 2rem; font-weight: bold;">00</div>
                        <div>Seconds</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Messages -->
        <div class="section-title">
            <h2>Recent Messages</h2>
            <p>Watch or listen to our latest sermons</p>
        </div>
        
        <div class="video-grid">
            <!-- Video 1 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Sermon Thumbnail">
                    <a href="#" class="play-button">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="video-info">
                    <h3>Faith in the Storm</h3>
                    <div class="video-meta">
                        <span><i class="far fa-calendar"></i> Nov 5, 2023</span>
                        <span><i class="fas fa-user"></i> Pastor John</span>
                    </div>
                    <p>Exploring how to maintain faith during life's challenges, based on Matthew 8:23-27.</p>
                    <div style="margin-top: 15px; display: flex; gap: 10px;">
                        <a href="#" class="btn">Watch</a>
                        <a href="download-messages.php" class="btn btn-secondary">Download</a>
                    </div>
                </div>
            </div>
            
            <!-- Video 2 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="https://images.unsplash.com/photo-1563642421748-5048da27fd2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Sermon Thumbnail">
                    <a href="#" class="play-button">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="video-info">
                    <h3>The Heart of Forgiveness</h3>
                    <div class="video-meta">
                        <span><i class="far fa-calendar"></i> Oct 29, 2023</span>
                        <span><i class="fas fa-user"></i> Rev. Sarah</span>
                    </div>
                    <p>Learning to extend forgiveness as we have been forgiven, based on Matthew 18:21-35.</p>
                    <div style="margin-top: 15px; display: flex; gap: 10px;">
                        <a href="#" class="btn">Watch</a>
                        <a href="download-messages.php" class="btn btn-secondary">Download</a>
                    </div>
                </div>
            </div>
            
            <!-- Video 3 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="https://images.unsplash.com/photo-1544919982-b61976a0d7ed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Sermon Thumbnail">
                    <a href="#" class="play-button">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="video-info">
                    <h3>Living with Purpose</h3>
                    <div class="video-meta">
                        <span><i class="far fa-calendar"></i> Oct 22, 2023</span>
                        <span><i class="fas fa-user"></i> Pastor John</span>
                    </div>
                    <p>Discovering God's unique purpose for your life, based on Ephesians 2:10.</p>
                    <div style="margin-top: 15px; display: flex; gap: 10px;">
                        <a href="#" class="btn">Watch</a>
                        <a href="download-messages.php" class="btn btn-secondary">Download</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Video Series -->
        <div class="section-title" style="margin-top: 80px;">
            <h2>Teaching Series</h2>
            <p>Explore our current and past sermon series</p>
        </div>
        
        <div class="feature-grid">
            <!-- Series 1 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Journey Through Ephesians</h3>
                <p>An in-depth study of Paul's letter to the Ephesians, exploring our identity in Christ and living out our faith.</p>
                <a href="#" class="btn" style="margin-top: 15px;">Watch Series</a>
            </div>
            
            <!-- Series 2 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-pray"></i>
                </div>
                <h3>The Lord's Prayer</h3>
                <p>A 6-part series exploring each line of the Lord's Prayer and how it shapes our relationship with God.</p>
                <a href="#" class="btn" style="margin-top: 15px;">Watch Series</a>
            </div>
            
            <!-- Series 3 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Fruit of the Spirit</h3>
                <p>Learning to cultivate love, joy, peace, patience, kindness, goodness, faithfulness, gentleness, and self-control.</p>
                <a href="#" class="btn" style="margin-top: 15px;">Watch Series</a>
            </div>
        </div>
        
        <!-- How to Watch -->
        <div style="background-color: var(--light-gray); padding: 40px; border-radius: 8px; margin-top: 60px;">
            <h3 style="text-align: center; margin-bottom: 30px;">How to Watch</h3>
            <div class="feature-grid">
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-desktop"></i> Website</h4>
                    <p>Watch directly on our website during live services or anytime for archived messages.</p>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fab fa-youtube"></i> YouTube</h4>
                    <p>Subscribe to our YouTube channel for notifications when new messages are posted.</p>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-podcast"></i> Podcast</h4>
                    <p>Listen to audio messages on your favorite podcast platform (Apple Podcasts, Spotify, etc.).</p>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-tv"></i> TV Broadcast</h4>
                    <p>Watch on local channel 12.3 every Sunday at 10:00 AM and Wednesday at 7:00 PM.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Countdown timer for next service
function updateCountdown() {
    // Set the date for next Sunday at 9:00 AM
    const now = new Date();
    const dayOfWeek = now.getDay(); // 0 = Sunday, 1 = Monday, etc.
    const daysUntilSunday = dayOfWeek === 0 ? 7 : 7 - dayOfWeek;
    
    const nextSunday = new Date(now);
    nextSunday.setDate(now.getDate() + daysUntilSunday);
    nextSunday.setHours(9, 0, 0, 0);
    
    // If it's already past 9:00 AM on Sunday, show next week
    if (dayOfWeek === 0 && now.getHours() >= 9) {
        nextSunday.setDate(nextSunday.getDate() + 7);
    }
    
    const totalSeconds = Math.floor((nextSunday - now) / 1000);
    
    if (totalSeconds < 0) {
        // If the countdown is negative, show "Live Now"
        document.getElementById('days').textContent = '00';
        document.getElementById('hours').textContent = '00';
        document.getElementById('minutes').textContent = '00';
        document.getElementById('seconds').textContent = '00';
        return;
    }
    
    const days = Math.floor(totalSeconds / (3600 * 24));
    const hours = Math.floor((totalSeconds % (3600 * 24)) / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = Math.floor(totalSeconds % 60);
    
    document.getElementById('days').textContent = days.toString().padStart(2, '0');
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
}

// Update countdown every second
setInterval(updateCountdown, 1000);
updateCountdown(); // Initial call
</script>

<?php
require_once 'includes/footer.php';
?>