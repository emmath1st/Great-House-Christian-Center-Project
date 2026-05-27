<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Under Maintenance | Verification in Progress</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #0c1a2d 0%, #1a2b3c 100%);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        .security-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(220, 53, 69, 0.9);
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        
        .container {
            max-width: 1100px;
            width: 100%;
            text-align: center;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .container:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #dc3545, #f0ad4e, #5cb85c);
        }
        
        .warning-icon {
            font-size: 80px;
            color: #f0ad4e;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 800;
            background: linear-gradient(90deg, #ff6b6b, #feca57);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-transform: uppercase;
            letter-spacing: 2px;
            line-height: 1.2;
        }
        
        .subtitle {
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #a0c8ff;
            font-weight: 600;
        }
        
        .critical-warning {
            background: rgba(220, 53, 69, 0.25);
            border: 3px solid #dc3545;
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
            text-align: center;
            font-size: 1.4rem;
            line-height: 1.8;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .critical-warning:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #dc3545, #ff6b6b, #dc3545);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }
        
        .critical-warning strong {
            color: #ffcc00;
            font-size: 1.5rem;
            display: block;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .warning-highlight {
            color: #ff6b6b;
            font-weight: 800;
            font-size: 1.5rem;
            text-transform: uppercase;
            background: rgba(255, 107, 107, 0.1);
            padding: 5px 15px;
            border-radius: 6px;
            display: inline-block;
            margin: 10px 0;
            border: 2px solid #ff6b6b;
        }
        
        .notification-banner {
            background: linear-gradient(90deg, rgba(13, 110, 253, 0.2), rgba(32, 201, 151, 0.2));
            border: 2px solid #0d6efd;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            text-align: center;
            font-size: 1.3rem;
            line-height: 1.7;
            position: relative;
            overflow: hidden;
        }
        
        .notification-banner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #0d6efd, #20c997, #0d6efd);
        }
        
        .notification-icon {
            color: #0d6efd;
            font-size: 2rem;
            margin-bottom: 15px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .email-highlight {
            color: #20c997;
            font-weight: 700;
            background: rgba(32, 201, 151, 0.1);
            padding: 3px 10px;
            border-radius: 4px;
            border: 1px solid #20c997;
        }
        
        .message {
            background: rgba(32, 201, 151, 0.15);
            border-left: 5px solid #20c997;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            text-align: left;
            font-size: 1.2rem;
            line-height: 1.6;
        }
        
        .message p {
            margin-bottom: 15px;
        }
        
        .message strong {
            color: #20c997;
        }
        
        .details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 40px;
            gap: 20px;
        }
        
        .detail-box {
            flex: 1;
            min-width: 250px;
            background: rgba(255, 255, 255, 0.08);
            padding: 20px;
            border-radius: 10px;
            border-top: 3px solid #5cb85c;
        }
        
        .detail-box h3 {
            color: #5cb85c;
            margin-bottom: 15px;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .countdown-container {
            margin-top: 40px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .countdown-title {
            font-size: 1.5rem;
            color: #a0c8ff;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        
        .countdown-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px 15px;
            border-radius: 10px;
            min-width: 120px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .countdown-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #f0ad4e;
            display: block;
            line-height: 1;
            margin-bottom: 5px;
        }
        
        .countdown-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .countdown-note {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            margin-top: 10px;
        }
        
        .email-countdown {
            background: rgba(13, 110, 253, 0.15);
            border: 2px solid #0d6efd;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: center;
        }
        
        .email-countdown h4 {
            color: #a0c8ff;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .email-timer {
            font-size: 2rem;
            color: #20c997;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .email-note {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            margin-top: 10px;
        }
        
        footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            max-width: 800px;
            line-height: 1.6;
        }
        
        .legal-notice {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 0.95rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.4rem;
            }
            
            .container {
                padding: 30px 20px;
            }
            
            .warning-icon {
                font-size: 60px;
            }
            
            .critical-warning {
                padding: 20px;
                font-size: 1.2rem;
            }
            
            .warning-highlight {
                font-size: 1.2rem;
                padding: 4px 10px;
            }
            
            .notification-banner {
                padding: 20px;
                font-size: 1.1rem;
            }
            
            .email-timer {
                font-size: 1.8rem;
            }
            
            .details {
                flex-direction: column;
            }
            
            .detail-box {
                min-width: 100%;
            }
            
            .countdown-item {
                min-width: 100px;
                padding: 15px 10px;
            }
            
            .countdown-value {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
                letter-spacing: 1px;
            }
            
            .subtitle {
                font-size: 1.2rem;
            }
            
            .critical-warning {
                padding: 15px;
                font-size: 1.1rem;
            }
            
            .critical-warning strong {
                font-size: 1.2rem;
            }
            
            .warning-highlight {
                font-size: 1.1rem;
            }
            
            .notification-banner {
                padding: 15px;
                font-size: 1rem;
            }
            
            .message {
                padding: 15px;
                font-size: 1rem;
            }
            
            .security-badge {
                position: relative;
                top: 0;
                right: 0;
                margin-bottom: 20px;
            }
            
            .email-timer {
                font-size: 1.6rem;
            }
            
            .countdown {
                gap: 10px;
            }
            
            .countdown-item {
                min-width: 80px;
                padding: 12px 8px;
            }
            
            .countdown-value {
                font-size: 1.8rem;
            }
            
            .countdown-label {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="security-badge">
        <i class="fas fa-shield-alt"></i> VERIFICATION NOTICE
    </div>
    
    <div class="container">
        <div class="warning-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <h1>Site Under Verification</h1>
        
        <div class="subtitle">
            Verification Process in Progress
        </div>
        
        <div class="critical-warning">
            <strong>CRITICAL WARNING</strong>
            <p>This website is currently under Verification to verify if content is <span class="warning-highlight">FAKE</span> and if there is <span class="warning-highlight">IMPERSONATION</span> of legitimate entities.</p>
            
            <p style="margin-top: 20px; font-weight: 700;">
                <i class="fas fa-ban" style="color: #ff6b6b; margin-right: 10px;"></i>
                NO FINANCIAL TRANSACTION SHOULD BE MADE WITH ANY MEMBER OF 
                <span class="warning-highlight">THE ULTRA OFFSHORE ENGINEERING</span>
            </p>
            
            <p style="margin-top: 20px;">
                All communications, offers, or requests from anyone claiming association with this website should be treated as suspicious until verification is complete.
            </p>
        </div>
        
        <div class="notification-banner">
            <div class="notification-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <strong>USER NOTIFICATION UPDATE</strong>
            <p style="margin-top: 15px;">
                Previous website users will receive an update email within the next 
                <span class="email-highlight">48 HOURS</span> 
                regarding account status and verification progress.
            </p>
            <p style="margin-top: 10px; font-size: 1.1rem;">
                Please check your registered email address (including spam folder) for official communication.
            </p>
        </div>
        
        <div class="message">
            <p><strong>VERIFICATION PROCESS:</strong> Our security team is conducting a comprehensive review of all website content, user accounts, and communications to identify potential fake information and impersonation attempts.</p>
            
            <p><strong>IMMEDIATE ACTIONS TAKEN:</strong> All financial transaction capabilities have been temporarily disabled. User account activities are being monitored and logged for security analysis.</p>
            
            <p><strong>USER PROTECTION:</strong> We recommend that users do not engage in any financial discussions or transactions related to this website until the verification process is complete and an official announcement is made.</p>
        </div>
        
        <div class="details">
            <div class="detail-box">
                <h3><i class="fas fa-search"></i> Verification Focus</h3>
                <p>• Identifying Fake Content</p>
                <p>• Detecting Impersonation</p>
                <p>• Validating User Identities</p>
                <p>• Reviewing Communications</p>
            </div>
            
            <div class="detail-box">
                <h3><i class="fas fa-user-shield"></i> Security Team</h3>
                <p>Lead Investigator: Alex Morgan</p>
                <p>Forensic Analyst: Jordan Chen</p>
                <p>Legal Compliance: Samantha Reed</p>
                <p>Digital Forensics: Marcus Johnson</p>
            </div>
            
            <div class="detail-box">
                <h3><i class="fas fa-exclamation-circle"></i> Entities Under Review</h3>
                <p>• The Ultra Offshore Engineering</p>
                <p>• All associated accounts</p>
                <p>• Financial transaction records</p>
                <p>• User communication logs</p>
            </div>
        </div>
        
        <div class="countdown-container">
            <div class="countdown-title">
                Next Verification Update In:
            </div>
            <div class="countdown">
                <div class="countdown-item">
                    <span class="countdown-value" id="days">7</span>
                    <span class="countdown-label">Days</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-value" id="hours">0</span>
                    <span class="countdown-label">Hours</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-value" id="minutes">0</span>
                    <span class="countdown-label">Minutes</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-value" id="seconds">0</span>
                    <span class="countdown-label">Seconds</span>
                </div>
            </div>
            <div class="countdown-note">
                Full verification report will be published after the countdown completes.
            </div>
        </div>
        
        <div class="email-countdown">
            <h4><i class="fas fa-clock"></i> Email Notification Countdown</h4>
            <p>Previous website users will receive update emails within:</p>
            <div class="email-timer" id="email-hours">48</div>
            <div>Hours</div>
            <div class="email-note">
                Emails will be sent to all registered user accounts with updates on account status and verification progress.
            </div>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2023-2026 Your Company Name. All rights reserved. | Verification Case ID: VER-2026-0115</p>
        <p>This website is temporarily disabled for security verification purposes.</p>
        
        <div class="legal-notice">
            <p><strong>LEGAL NOTICE:</strong> This maintenance notice serves as official documentation that all financial transactions with any member of The Ultra Offshore Engineering are prohibited during this verification period. Users engaging in transactions do so at their own risk and against explicit warnings.</p>
        </div>
    </footer>

    <script>
        // Function to format date as Month Day, Year
        function formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }
        
        // Set dates for January 2026
        const today = new Date();
        const startDate = new Date(2026, 0, 15); // January 15, 2026 (month is 0-indexed)
        const endDate = new Date(2026, 0, 30); // January 30, 2026
        
        // Set countdown to 1 week from now
        const countdownDate = new Date();
        countdownDate.setDate(countdownDate.getDate() + 7);
        
        // Set email countdown to 48 hours from now
        const emailCountdownDate = new Date();
        emailCountdownDate.setHours(emailCountdownDate.getHours() + 48);
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countdownDate - now;
            
            // Calculate days, hours, minutes, seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Update display
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            
            // If countdown is finished
            if (distance < 0) {
                clearInterval(countdownInterval);
                document.querySelector('.countdown-title').textContent = "Verification Update Available";
                document.querySelector('.countdown').innerHTML = '<div style="font-size: 1.5rem; color: #5cb85c;">Verification report is now available. Review in progress.</div>';
                document.querySelector('.countdown-note').textContent = "Please check back soon for website restoration status.";
                
                // Reset countdown for another week
                setTimeout(() => {
                    countdownDate.setDate(countdownDate.getDate() + 7);
                    document.querySelector('.countdown-title').textContent = "Next Verification Update In:";
                    document.querySelector('.countdown').innerHTML = `
                        <div class="countdown-item">
                            <span class="countdown-value" id="days">7</span>
                            <span class="countdown-label">Days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-value" id="hours">0</span>
                            <span class="countdown-label">Hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-value" id="minutes">0</span>
                            <span class="countdown-label">Minutes</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-value" id="seconds">0</span>
                            <span class="countdown-label">Seconds</span>
                        </div>
                    `;
                    countdownInterval = setInterval(updateCountdown, 1000);
                }, 10000); // Reset after 10 seconds
            }
        }
        
        function updateEmailCountdown() {
            const now = new Date().getTime();
            const distance = emailCountdownDate - now;
            
            // Calculate hours, minutes, seconds
            const hours = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Update display
            if (hours > 0) {
                document.getElementById('email-hours').textContent = hours;
            } else if (distance > 0) {
                // Show minutes when less than 1 hour remains
                document.getElementById('email-hours').textContent = `${minutes}m ${seconds}s`;
            } else {
                // Countdown completed
                document.getElementById('email-hours').textContent = "0";
                document.querySelector('.email-countdown h4').innerHTML = '<i class="fas fa-check-circle" style="color: #20c997;"></i> Emails Sent';
                document.querySelector('.email-countdown p').textContent = 'Update emails have been sent to all registered users.';
                document.querySelector('.email-note').textContent = 'Please check your email inbox (including spam folder) for official communication.';
                clearInterval(emailCountdownInterval);
            }
        }
        
        // Initial call to display countdown immediately
        updateCountdown();
        updateEmailCountdown();
        
        // Update countdown every second
        let countdownInterval = setInterval(updateCountdown, 1000);
        let emailCountdownInterval = setInterval(updateEmailCountdown, 1000);
        
        // Add subtle background animation
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.querySelector('body');
            let angle = 0;
            
            function updateBackground() {
                angle = (angle + 0.05) % 360;
                const gradient = `linear-gradient(${angle}deg, #0c1a2d 0%, #1a2b3c 100%)`;
                body.style.background = gradient;
                requestAnimationFrame(updateBackground);
            }
            
            updateBackground();
            
            // Add warning text animation
            const warningHighlight = document.querySelectorAll('.warning-highlight');
            warningHighlight.forEach(element => {
                setInterval(() => {
                    element.style.boxShadow = '0 0 15px rgba(255, 107, 107, 0.7)';
                    setTimeout(() => {
                        element.style.boxShadow = 'none';
                    }, 1000);
                }, 3000);
            });
            
            // Add email highlight animation
            const emailHighlight = document.querySelector('.email-highlight');
            setInterval(() => {
                emailHighlight.style.boxShadow = '0 0 15px rgba(32, 201, 151, 0.7)';
                setTimeout(() => {
                    emailHighlight.style.boxShadow = 'none';
                }, 1500);
            }, 4000);
        });
    </script>
</body>
</html>