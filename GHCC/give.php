<?php
$page_title = 'Give';
require_once 'includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Generosity Changes Lives</h2>
            <p>Your giving supports the ministry and mission of our church</p>
        </div>
        
        <!-- Giving Options -->
        <div class="give-options">
            <!-- Option 1 -->
            <div class="give-option">
                <h3><i class="fas fa-hand-holding-heart"></i> Tithes & Offerings</h3>
                <p>Regular giving supports our weekly ministries, staff, and facility operations. We encourage members to practice regular giving as an act of worship.</p>
                <p style="margin-top: 20px;"><strong>Scripture Reference:</strong> Malachi 3:10</p>
                <a href="#give-form" class="btn" style="margin-top: 20px;">Give Now</a>
            </div>
            
            <!-- Option 2 -->
            <div class="give-option">
                <h3><i class="fas fa-globe-americas"></i> Missions & Outreach</h3>
                <p>Support our local and global mission partners who are sharing the Gospel and meeting practical needs in our community and around the world.</p>
                <p style="margin-top: 20px;"><strong>Current Focus:</strong> Clean water projects in Africa</p>
                <a href="#give-form" class="btn" style="margin-top: 20px;">Give to Missions</a>
            </div>
            
            <!-- Option 3 -->
            <div class="give-option">
                <h3><i class="fas fa-building"></i> Building Fund</h3>
                <p>Help us maintain and improve our facilities to better serve our church family and community. Current projects include parking lot expansion and youth room renovation.</p>
                <p style="margin-top: 20px;"><strong>Goal:</strong> $50,000 (65% reached)</p>
                <a href="#give-form" class="btn" style="margin-top: 20px;">Give to Building Fund</a>
            </div>
        </div>
        
        <!-- Giving Impact -->
        <div class="section-title" style="margin-top: 80px;">
            <h2>Your Giving Makes a Difference</h2>
        </div>
        
        <div class="feature-grid">
            <div class="feature-card">
                <h3><i class="fas fa-utensils"></i> 1,200 Meals Served</h3>
                <p>Through our community kitchen each month to those facing food insecurity.</p>
            </div>
            
            <div class="feature-card">
                <h3><i class="fas fa-graduation-cap"></i> 45 Students Supported</h3>
                <p>Through scholarships for Christian education and summer camp programs.</p>
            </div>
            
            <div class="feature-card">
                <h3><i class="fas fa-home"></i> 8 Families Housed</h3>
                <p>Through emergency shelter and transitional housing assistance this year.</p>
            </div>
            
            <div class="feature-card">
                <h3><i class="fas fa-handshake"></i> 12 Missionaries</h3>
                <p>Supported in 8 countries around the world sharing the Gospel.</p>
            </div>
        </div>
        
        <!-- Giving Form -->
        <div id="give-form" class="section-title" style="margin-top: 80px;">
            <h2>Give Online</h2>
            <p>Secure online giving</p>
        </div>
        
        <div class="give-form">
            <form id="donationForm">
                <div class="form-group">
                    <label for="donation_amount">Donation Amount *</label>
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <button type="button" class="btn btn-secondary" onclick="setAmount(25)">$25</button>
                        <button type="button" class="btn btn-secondary" onclick="setAmount(50)">$50</button>
                        <button type="button" class="btn btn-secondary" onclick="setAmount(100)">$100</button>
                        <button type="button" class="btn btn-secondary" onclick="setAmount(250)">$250</button>
                        <button type="button" class="btn btn-secondary" onclick="setAmount('other')">Other</button>
                    </div>
                    <div id="customAmountContainer" style="display: none; margin-top: 15px;">
                        <input type="number" id="custom_amount" class="form-control" placeholder="Enter custom amount" min="1" step="0.01">
                    </div>
                    <input type="hidden" id="donation_amount" name="donation_amount" required>
                </div>
                
                <div class="form-group">
                    <label for="donation_fund">Designate To *</label>
                    <select id="donation_fund" name="donation_fund" class="form-control" required>
                        <option value="">Select a fund</option>
                        <option value="general">General Fund (Tithes & Offerings)</option>
                        <option value="missions">Missions & Outreach</option>
                        <option value="building">Building Fund</option>
                        <option value="benevolence">Benevolence Fund</option>
                        <option value="youth">Youth Ministry</option>
                        <option value="children">Children's Ministry</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="frequency">Frequency *</label>
                    <select id="frequency" name="frequency" class="form-control" required>
                        <option value="one-time">One-Time Gift</option>
                        <option value="weekly">Weekly</option>
                        <option value="bi-weekly">Every Two Weeks</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="donor_name">Your Name *</label>
                    <input type="text" id="donor_name" name="donor_name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="donor_email">Your Email *</label>
                    <input type="email" id="donor_email" name="donor_email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <h4>Payment Information</h4>
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 4px; margin-top: 15px;">
                        <div class="form-group">
                            <label for="card_number">Card Number *</label>
                            <input type="text" id="card_number" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date *</label>
                                <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="cvv">CVV *</label>
                                <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="cover_fees" value="1" style="margin-right: 10px;">
                        <span>Add 2.9% to cover processing fees</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="save_info" value="1" style="margin-right: 10px;">
                        <span>Save my information for future giving</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <button type="button" class="btn" onclick="processDonation()" style="width: 100%; padding: 15px; font-size: 1.1rem;">Give Securely</button>
                </div>
                
                <div style="text-align: center; margin-top: 20px;">
                    <p style="font-size: 0.9rem; color: var(--medium-gray);">
                        <i class="fas fa-lock"></i> Your donation is secure and encrypted. 
                        We never store full credit card numbers on our servers.
                    </p>
                </div>
            </form>
        </div>
        
        <!-- Other Ways to Give -->
        <div class="section-title" style="margin-top: 80px;">
            <h2>Other Ways to Give</h2>
        </div>
        
        <div class="feature-grid">
            <div class="feature-card">
                <h3><i class="fas fa-envelope"></i> Mail a Check</h3>
                <p>Make checks payable to "Grace Community Church" and mail to:</p>
                <p style="margin-top: 10px;"><?php echo SITE_NAME; ?><br>
                123 Faith Avenue<br>
                Springfield, ST 12345</p>
            </div>
            
            <div class="feature-card">
                <h3><i class="fas fa-building-columns"></i> Bank Transfer</h3>
                <p>Set up recurring transfers through your bank's bill pay service. Contact the church office for account information.</p>
            </div>
            
            <div class="feature-card">
                <h3><i class="fas fa-mobile-alt"></i> Text to Give</h3>
                <p>Text "GIVE" to (555) 987-6543 to receive a secure link to give via your mobile device.</p>
            </div>
            
            <div class="feature-card">
                <h3><i class="fas fa-box"></i> In Person</h3>
                <p>Place your gift in the offering basket during any worship service or drop it off at the church office during business hours.</p>
            </div>
        </div>
        
        <!-- Financial Transparency -->
        <div style="background-color: var(--light-gray); padding: 40px; border-radius: 8px; margin-top: 60px;">
            <h3 style="text-align: center; margin-bottom: 30px;">Financial Transparency</h3>
            <p style="text-align: center; max-width: 800px; margin: 0 auto;">We are committed to financial integrity and transparency. Our annual budget is reviewed and approved by our church council, and our finances are audited annually by an independent CPA firm. To request a copy of our most recent financial report, please contact the church office.</p>
            
            <div class="payment-methods">
                <i class="fab fa-cc-visa" title="Visa"></i>
                <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                <i class="fab fa-cc-amex" title="American Express"></i>
                <i class="fab fa-cc-discover" title="Discover"></i>
                <i class="fab fa-cc-paypal" title="PayPal"></i>
                <i class="fab fa-apple-pay" title="Apple Pay"></i>
            </div>
        </div>
    </div>
</section>

<script>
function setAmount(amount) {
    const customContainer = document.getElementById('customAmountContainer');
    const amountField = document.getElementById('donation_amount');
    
    if (amount === 'other') {
        customContainer.style.display = 'block';
        amountField.value = '';
    } else {
        customContainer.style.display = 'none';
        amountField.value = amount;
    }
}

function processDonation() {
    // In a real application, this would connect to a payment processor
    // For this demo, we'll just show a success message
    
    const amountField = document.getElementById('donation_amount');
    const customAmount = document.getElementById('custom_amount');
    
    // Use custom amount if entered
    if (customAmount && customAmount.value) {
        amountField.value = customAmount.value;
    }
    
    if (!amountField.value || amountField.value <= 0) {
        alert('Please enter a donation amount');
        return;
    }
    
    // Validate form
    const form = document.getElementById('donationForm');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = '#ff4757';
        } else {
            field.style.borderColor = '';
        }
    });
    
    if (!isValid) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Show success message (in a real app, this would be a secure payment processing)
    alert(`Thank you for your donation of $${amountField.value}! Your contribution supports the ministry of our church.`);
    form.reset();
    document.getElementById('customAmountContainer').style.display = 'none';
}
</script>

<?php
require_once 'includes/footer.php';
?>