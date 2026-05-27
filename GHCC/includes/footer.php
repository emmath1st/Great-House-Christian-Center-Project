    </main> <!-- End of main-content -->
    
    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- About Church -->
                <div class="footer-col">
                    <div class="footer-logo">
                        <i class="fas fa-church"></i>
                        <h3><?php echo SITE_NAME; ?></h3>
                    </div>
                    <p class="footer-description">
                        A welcoming community of faith dedicated to worship, fellowship, and service. 
                        We strive to grow together in Christ's love and share His message with the world.
                    </p>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-spotify"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="about.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                        <li><a href="watch.php"><i class="fas fa-video"></i> Watch Services</a></li>
                        <li><a href="blog.php"><i class="fas fa-blog"></i> Blog & News</a></li>
                        <li><a href="download-messages.php"><i class="fas fa-download"></i> Download Messages</a></li>
                    </ul>
                </div>
                
                <!-- Service Times -->
                <div class="footer-col">
                    <h4>Service Times</h4>
                    <ul class="service-times">
                        <li>
                            <span class="service-day">Sunday Morning</span>
                            <span class="service-time">9:00 AM & 11:00 AM</span>
                        </li>
                        <li>
                            <span class="service-day">Sunday Evening</span>
                            <span class="service-time">6:00 PM</span>
                        </li>
                        <li>
                            <span class="service-day">Wednesday Bible Study</span>
                            <span class="service-time">7:00 PM</span>
                        </li>
                        <li>
                            <span class="service-day">Friday Youth Night</span>
                            <span class="service-time">7:30 PM</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Info & Map -->
                <div class="footer-col">
                    <h4>Find Us</h4>
                    <div class="contact-info-footer">
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo CHURCH_ADDRESS; ?></p>
                        <p><i class="fas fa-phone"></i> <?php echo CHURCH_PHONE; ?></p>
                        <p><i class="fas fa-envelope"></i> <?php echo CHURCH_EMAIL; ?></p>
                    </div>
                    
                    <!-- Mini Map -->
                    <div class="mini-map" id="miniMap">
                        <!-- Map will be loaded via JavaScript -->
                    </div>
                    <a href="connect.php#mapSection" class="view-full-map">View Full Map <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All Rights Reserved. | Designed with <i class="fas fa-heart"></i> for the Church Community</p>
                <p><a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Use</a></p>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- JavaScript Files -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&callback=initMiniMap" async defer></script>
    <script src="js/map.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<?php
// Flush output buffer
ob_end_flush();
?>