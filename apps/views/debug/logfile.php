<style>
.debug-container {
    background: #f5f5f5;
    padding: 20px;
    font-family: monospace;
    font-size: 12px;
}

.debug-section {
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 15px;
}

.debug-header {
    background: #333;
    color: #0f0;
    padding: 10px;
    margin: -15px -15px 15px -15px;
    border-radius: 4px 4px 0 0;
    font-weight: bold;
}

.debug-content {
    background: #1e1e1e;
    color: #0f0;
    padding: 10px;
    border: 1px solid #555;
    border-radius: 4px;
    max-height: 600px;
    overflow-y: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
    line-height: 1.4;
}

.debug-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-bottom: 15px;
}

.stat-box {
    background: #e8f4f8;
    border: 1px solid #4CAF50;
    border-radius: 4px;
    padding: 10px;
    text-align: center;
}

.stat-label {
    font-size: 11px;
    color: #666;
    font-weight: bold;
}

.stat-value {
    font-size: 18px;
    color: #333;
    font-weight: bold;
    margin-top: 5px;
}

.search-box {
    margin-bottom: 15px;
}

.search-box form {
    display: flex;
    gap: 10px;
}

.search-box input {
    flex: 1;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.search-box button {
    padding: 8px 15px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-box button:hover {
    background: #45a049;
}

.button-group {
    margin-bottom: 15px;
}

.button-group a {
    display: inline-block;
    margin-right: 10px;
    padding: 8px 15px;
    background: #2196F3;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.button-group a:hover {
    background: #0b7dda;
}

.matched-count {
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 10px;
    color: #856404;
}

h2 {
    margin: 0 0 15px 0;
    color: #333;
    font-size: 18px;
}

.line-number {
    color: #666;
    margin-right: 10px;
}    
    </style>
<?php
$usrQryUrl = $this->h->tap('/debug/index');
?>
<div class="debug-container">
    <h2>📄 Debug Log File: <?php echo isset($pageData['filename']) && !empty($pageData['filename']) ? htmlspecialchars($pageData['filename']) : 'Available Log Files'; ?></h2>
    
    <div class="button-group">
        <a href="?t=debug&a=index">Back to Debug</a>
    </div>

    <!-- Available Log Files Section -->
    <?php if (isset($pageData['available_files']) && !empty($pageData['available_files'])): ?>
    <div class="debug-section">
        <div class="debug-header">Available Log Files</div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f0f0f0; border-bottom: 2px solid #ddd;">
                    <th style="padding: 8px; text-align: left; border-right: 1px solid #ddd;">Filename</th>
                    <th style="padding: 8px; text-align: right; width: 100px; border-right: 1px solid #ddd;">Size (KB)</th>
                    <th style="padding: 8px; text-align: left; width: 180px;">Modified</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pageData['available_files'] as $log_file): ?>
                <tr style="border-bottom: 1px solid #ddd; cursor: pointer; background: #fafafa;" onmouseover="this.style.background='#f0f0f0'" onmouseout="this.style.background='#fafafa'">
                    <td style="padding: 8px; border-right: 1px solid #ddd;">
                        <a href="?t=debug&a=logfile&file=<?php echo urlencode($log_file['name']); ?>" style="color: #2196F3; text-decoration: none; display: block;">
                            <?php echo htmlspecialchars($log_file['name']); ?>
                        </a>
                    </td>
                    <td style="padding: 8px; text-align: right; border-right: 1px solid #ddd;">
                        <?php echo number_format($log_file['size'] / 1024, 2); ?>
                    </td>
                    <td style="padding: 8px;">
                        <?php echo date('Y-m-d H:i:s', $log_file['modified']); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Stats Section -->
    <div class="debug-section">
        <div class="debug-header">File Statistics</div>
        <div class="debug-stats">
            <div class="stat-box">
                <div class="stat-label">Total Lines</div>
                <div class="stat-value"><?php 
                    $total_lines = isset($pageData['total_lines']) ? $pageData['total_lines'] : 0;
                    echo number_format($total_lines); 
                ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-label">File Size</div>
                <div class="stat-value"><?php 
                    $file_size = isset($pageData['file_size']) ? $pageData['file_size'] : 0;
                    echo number_format($file_size / 1024, 2); 
                ?> KB</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Filename</div>
                <div class="stat-value" style="font-size: 12px;"><?php echo isset($pageData['filename']) ? htmlspecialchars($pageData['filename']) : 'Unknown'; ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Avg Line Size</div>
                <div class="stat-value"><?php 
                    $total_lines = isset($pageData['total_lines']) ? $pageData['total_lines'] : 0;
                    $file_size = isset($pageData['file_size']) ? $pageData['file_size'] : 0;
                    if ($total_lines > 0) {
                        echo number_format($file_size / $total_lines, 0);
                    } else {
                        echo '0';
                    }
                ?> B</div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="debug-section">
        <div class="debug-header">Search Log File</div>
        
        <div class="search-box">
            <form method="get" action="<?php echo $usrQryUrl; ?>">
                <input type="hidden" name="t" value="debug" />
                <input type="hidden" name="a" value="logfile" />
                <input type="hidden" name="file" value="<?php echo isset($pageData['filename']) ? htmlspecialchars($pageData['filename']) : ''; ?>" />
                <input type="text" name="search" placeholder="Search log file..." value="<?php echo isset($pageData['search']) ? htmlspecialchars($pageData['search']) : ''; ?>" />
                <button type="submit">Search</button>
            </form>
        </div>

        <?php if (!empty($pageData['search']) && isset($pageData['matched_count'])): ?>
            <div class="matched-count">
                Found <?php echo $pageData['matched_count']; ?> matching lines out of <?php echo number_format($pageData['total_lines']); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Log Content -->
    <div class="debug-section">
        <div class="debug-header">Log Content<?php echo !empty($pageData['search']) ? ' (Filtered)' : ''; ?></div>
        
        <div class="debug-content">
            <?php 
            if (!empty($pageData['search']) && isset($pageData['filtered_lines']) && !empty($pageData['filtered_lines'])):
                $line_num = 0;
                foreach ($pageData['filtered_lines'] as $line):
                    $line_num++;
                    echo htmlspecialchars($line);
                endforeach;
            elseif (isset($pageData['lines']) && !empty($pageData['lines'])):
                $line_num = 0;
                foreach ($pageData['lines'] as $line):
                    $line_num++;
                    // Only show first 1000 lines if not filtered
                    if ($line_num > 1000 && empty($pageData['search'])):
                        echo "\n[... Log truncated. Search to view specific entries ...]\n";
                        break;
                    endif;
                    echo htmlspecialchars($line);
                endforeach;
            else:
                echo "No log content available.";
            endif;
            ?>
        </div>
    </div>
</div>
