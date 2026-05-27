<?php
$page_title = 'Download Messages';
require_once 'includes/header.php';
require_once 'includes/db_connect.php';

// Fetch messages from database
$sql = "SELECT * FROM messages ORDER BY message_date DESC";
$result = $conn->query($sql);
?>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Download Messages</h2>
            <p>Access our library of sermons and teachings</p>
        </div>
        
        <!-- Search and Filter -->
        <div style="background-color: var(--light-gray); padding: 25px; border-radius: 8px; margin-bottom: 40px;">
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div class="form-group" style="flex: 1; min-width: 250px;">
                    <input type="text" id="searchMessages" class="form-control" placeholder="Search messages by title or speaker...">
                </div>
                <div class="form-group" style="min-width: 200px;">
                    <select id="filterSpeaker" class="form-control">
                        <option value="">Filter by speaker</option>
                        <option value="Pastor John">Pastor John</option>
                        <option value="Reverend Sarah">Reverend Sarah</option>
                        <option value="Deacon Michael">Deacon Michael</option>
                        <option value="Guest Speaker">Guest Speaker</option>
                    </select>
                </div>
                <div class="form-group" style="min-width: 150px;">
                    <select id="filterType" class="form-control">
                        <option value="">Filter by type</option>
                        <option value="audio">Audio</option>
                        <option value="video">Video</option>
                        <option value="pdf">PDF/Notes</option>
                    </select>
                </div>
                <button class="btn" onclick="filterMessages()">Filter</button>
                <button class="btn btn-secondary" onclick="resetFilters()">Reset</button>
            </div>
        </div>
        
        <!-- Messages Table -->
        <div class="table-responsive">
            <table class="messages-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Speaker</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="messagesTableBody">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $date = date('F j, Y', strtotime($row['message_date']));
                            
                            // Determine file type and icon
                            $file_path = $row['file_path'];
                            $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                            
                            if (in_array($file_extension, ['mp3', 'wav', 'm4a'])) {
                                $file_type = 'Audio';
                                $file_icon = 'fas fa-volume-up';
                            } elseif (in_array($file_extension, ['mp4', 'mov', 'avi'])) {
                                $file_type = 'Video';
                                $file_icon = 'fas fa-video';
                            } elseif (in_array($file_extension, ['pdf', 'doc', 'docx', 'txt'])) {
                                $file_type = 'PDF/Notes';
                                $file_icon = 'fas fa-file-alt';
                            } else {
                                $file_type = 'File';
                                $file_icon = 'fas fa-file';
                            }
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                            <?php if ($row['description']): ?>
                            <br><small style="color: var(--medium-gray);"><?php echo htmlspecialchars($row['description']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['speaker']); ?></td>
                        <td><?php echo $date; ?></td>
                        <td><i class="<?php echo $file_icon; ?>"></i> <?php echo $file_type; ?></td>
                        <td><?php echo htmlspecialchars($row['file_size']); ?></td>
                        <td>
                            <?php if (file_exists($file_path)): ?>
                            <a href="<?php echo $file_path; ?>" class="download-btn" download>
                                <i class="fas fa-download"></i> Download
                            </a>
                            <?php else: ?>
                            <span style="color: var(--medium-gray);">File not available</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        // Default messages if database is empty
                        $default_messages = [
                            [
                                'title' => 'Sunday Morning Service',
                                'speaker' => 'Pastor John',
                                'date' => 'October 15, 2023',
                                'type' => 'Audio',
                                'size' => '45.2 MB',
                                'description' => 'Weekly worship and message from Pastor John'
                            ],
                            [
                                'title' => 'Bible Study: Ephesians Chapter 3',
                                'speaker' => 'Reverend Sarah',
                                'date' => 'October 10, 2023',
                                'type' => 'PDF/Notes',
                                'size' => '3.1 MB',
                                'description' => 'Deep dive into Paul\'s letter to the Ephesians'
                            ],
                            [
                                'title' => 'Wednesday Night Prayer Meeting',
                                'speaker' => 'Deacon Michael',
                                'date' => 'October 4, 2023',
                                'type' => 'Audio',
                                'size' => '32.7 MB',
                                'description' => 'Midweek prayer and teaching'
                            ],
                            [
                                'title' => 'Youth Group Summer Retreat Recap',
                                'speaker' => 'Youth Pastor Mark',
                                'date' => 'September 28, 2023',
                                'type' => 'Video',
                                'size' => '125.4 MB',
                                'description' => 'Highlights from our summer youth retreat'
                            ]
                        ];
                        
                        foreach ($default_messages as $message) {
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($message['title']); ?></strong>
                            <br><small style="color: var(--medium-gray);"><?php echo htmlspecialchars($message['description']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($message['speaker']); ?></td>
                        <td><?php echo $message['date']; ?></td>
                        <td><i class="fas fa-volume-up"></i> <?php echo $message['type']; ?></td>
                        <td><?php echo $message['size']; ?></td>
                        <td>
                            <a href="#" class="download-btn">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Download Instructions -->
        <div style="background-color: var(--light-gray); padding: 40px; border-radius: 8px; margin-top: 60px;">
            <h3 style="text-align: center; margin-bottom: 30px;">How to Download & Listen</h3>
            <div class="feature-grid">
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-mobile-alt"></i> Mobile Devices</h4>
                    <p>Download directly to your phone and listen using your favorite media player. Most smartphones have built-in music apps that can play MP3 files.</p>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-desktop"></i> Computers</h4>
                    <p>Save files to your computer and play with Windows Media Player, iTunes, VLC, or other media software. PDF files can be opened with Adobe Reader.</p>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-podcast"></i> Podcast Apps</h4>
                    <p>Subscribe to our podcast feed in apps like Apple Podcasts, Spotify, or Google Podcasts to automatically receive new messages.</p>
                </div>
                
                <div class="feature-card" style="background-color: transparent; box-shadow: none;">
                    <h4><i class="fas fa-compact-disc"></i> CDs</h4>
                    <p>Request a physical CD of any message from the church office. CDs are available for a small donation to cover materials and shipping.</p>
                </div>
            </div>
        </div>
        
        <!-- Podcast Subscription -->
        <div style="text-align: center; margin-top: 60px; padding: 40px; background: linear-gradient(to right, var(--primary-green), #2a9e3f); color: white; border-radius: 8px;">
            <h3 style="color: white;">Subscribe to Our Podcast</h3>
            <p style="margin: 20px 0; max-width: 600px; margin-left: auto; margin-right: auto;">
                Never miss a message! Subscribe to our podcast and new sermons will automatically download to your device.
            </p>
            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 30px;">
                <a href="#" class="btn" style="background-color: white; color: var(--primary-green);">
                    <i class="fab fa-apple"></i> Apple Podcasts
                </a>
                <a href="#" class="btn" style="background-color: white; color: var(--primary-green);">
                    <i class="fab fa-spotify"></i> Spotify
                </a>
                <a href="#" class="btn" style="background-color: white; color: var(--primary-green);">
                    <i class="fab fa-google"></i> Google Podcasts
                </a>
                <a href="#" class="btn" style="background-color: white; color: var(--primary-green);">
                    <i class="fas fa-rss"></i> RSS Feed
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function filterMessages() {
    const searchTerm = document.getElementById('searchMessages').value.toLowerCase();
    const speakerFilter = document.getElementById('filterSpeaker').value;
    const typeFilter = document.getElementById('filterType').value;
    const tableBody = document.getElementById('messagesTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const title = row.cells[0].textContent.toLowerCase();
        const speaker = row.cells[1].textContent;
        const type = row.cells[3].textContent;
        
        let showRow = true;
        
        // Apply search filter
        if (searchTerm && !title.includes(searchTerm)) {
            showRow = false;
        }
        
        // Apply speaker filter
        if (speakerFilter && speaker !== speakerFilter) {
            showRow = false;
        }
        
        // Apply type filter
        if (typeFilter) {
            if (typeFilter === 'audio' && !type.includes('Audio')) showRow = false;
            if (typeFilter === 'video' && !type.includes('Video')) showRow = false;
            if (typeFilter === 'pdf' && !type.includes('PDF')) showRow = false;
        }
        
        row.style.display = showRow ? '' : 'none';
    }
}

function resetFilters() {
    document.getElementById('searchMessages').value = '';
    document.getElementById('filterSpeaker').selectedIndex = 0;
    document.getElementById('filterType').selectedIndex = 0;
    
    const tableBody = document.getElementById('messagesTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = '';
    }
}
</script>

<?php
require_once 'includes/footer.php';
?>