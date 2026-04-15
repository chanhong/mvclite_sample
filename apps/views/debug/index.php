<?php
$this->_view_data['header_title'] = 'Debug Dashboard';
?>
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
    max-height: 400px;
    overflow-y: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
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

.search-box input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.search-box button {
    margin-top: 5px;
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

.button-group a, .button-group button {
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

.button-group a:hover, .button-group button:hover {
    background: #0b7dda;
}

.button-group .btn-danger {
    background: #f44336;
}

.button-group .btn-danger:hover {
    background: #da190b;
}

.debug-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.debug-table th {
    background: #333;
    color: white;
    padding: 8px;
    text-align: left;
}

.debug-table td {
    border-bottom: 1px solid #ddd;
    padding: 8px;
}

.debug-table tr:hover {
    background: #f0f0f0;
}

.debug-table a {
    color: #2196F3;
    text-decoration: none;
}

.debug-table a:hover {
    text-decoration: underline;
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


</style>
<?php
$usrQryUrl = $this->h->tap('/debug/index');
?>
<div class="debug-container">
    <h2>🔍 Debug Dashboard</h2>
            <div class="search-box">
            <form method="get" action=""</form>
    <input type="hidden" name="t" value="debug" />
    <input type="hidden" name="a" value="index" />
                <input type="text" name="search" placeholder="Search current log..." value="<?php echo htmlspecialchars($pageData['search']); ?>" />
                <button type="submit">Search</button>
            </form>
        </div>
    <div class="button-group">
        <a href="?t=debug&a=index">Refresh</a>
        <a href="?t=debug&a=clear" class="btn-danger" onclick="return confirm('Clear all debug data?');">Clear All</a>
    </div>

    <!-- Stats Section -->
    <div class="debug-section">
        <div class="debug-header">Session Statistics</div>
        <div class="debug-stats">
            <div class="stat-box">
                <div class="stat-label">Current Log Lines</div>
                <div class="stat-value"><?php echo $pageData['current_lines']; ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Current Log Size</div>
                <div class="stat-value"><?php echo number_format($pageData['current_size'] / 1024, 2); ?> KB</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Debug Resets</div>
                <div class="stat-value"><?php echo $pageData['debug_resets']; ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Sessions Logged</div>
                <div class="stat-value"><?php echo count($pageData['debug_logs']); ?></div>
            </div>
        </div>
    </div>


                <!-- input type="hidden" name="t" value="<?php echo $usrQryUrl; ?>" / -->
    <!-- Current Debug Log -->
    <div class="debug-section">
        <div class="debug-header">Current Debug Log (In Memory)</div>
        




        <?php if (!empty($pageData['search']) && isset($pageData['filtered_log'])): ?>
            <div class="matched-count">
                Found <?php echo $pageData['filtered_lines']; ?> matching lines
            </div>
            <div class="debug-content"><?php echo htmlspecialchars($pageData['filtered_log']); ?></div>
        <?php else: ?>
            <div class="debug-content"><?php echo htmlspecialchars($pageData['current_log']); ?></div>
        <?php endif; ?>
    </div>

    <!-- Log File Info -->
    <?php if ($pageData['log_file']): ?>
    <div class="debug-section">
        <div class="debug-header">Today's Log File</div>
        <table class="debug-table">
            <tr>
                <td><strong>File:</strong></td>
                <td><?php echo basename($pageData['log_file']); ?></td>
            </tr>
            <tr>
                <td><strong>Path:</strong></td>
                <td><?php echo $pageData['log_file']; ?></td>
            </tr>
            <tr>
                <td><strong>Size:</strong></td>
                <td><?php echo number_format($pageData['log_file_size'] / 1024, 2); ?> KB</td>
            </tr>
            <tr>
                <td><strong>Lines:</strong></td>
                <td><?php echo number_format($pageData['log_file_lines']); ?></td>
            </tr>
            <tr>
                <td><strong>Last Modified:</strong></td>
                <td><?php echo date('Y-m-d H:i:s', $pageData['log_file_mtime']); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="?t=debug&a=logfile">View Full Log File</a>
                </td>
            </tr>
        </table>
    </div>
    <?php endif; ?>

    <!-- All Log Files -->
    <?php if (!empty($pageData['all_log_files'])): ?>
    <div class="debug-section">
        <div class="debug-header">All Debug Log Files</div>
        <table class="debug-table">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Size</th>
                    <th>Lines</th>
                    <th>Last Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pageData['all_log_files'] as $log): ?>
                <tr>
                    <td><?php echo $log['name']; ?></td>
                    <td><?php echo number_format($log['size'] / 1024, 2); ?> KB</td>
                    <td><?php echo number_format($log['lines']); ?></td>
                    <td><?php echo date('Y-m-d H:i:s', $log['mtime']); ?></td>
                    <td>
                        <a href="?t=debug&a=logfile&file=<?php echo urlencode($log['name']); ?>">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Debug Sessions History -->
    <?php if (!empty($pageData['debug_logs'])): ?>
    <div class="debug-section">
        <div class="debug-header">Debug Sessions History</div>
        <table class="debug-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Lines</th>
                    <th>Size</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = count($pageData['debug_logs']); foreach ($pageData['debug_logs'] as $i => $session): ?>
                <tr>
                    <td><?php echo $count - $i; ?></td>
                    <td><?php echo isset($session['lines']) ? $session['lines'] : 'N/A'; ?></td>
                    <td><?php echo isset($session['size']) ? number_format($session['size'] / 1024, 2) . ' KB' : 'N/A'; ?></td>
                    <td><?php echo isset($session['timestamp']) ? date('Y-m-d H:i:s', strtotime($session['timestamp'])) : 'N/A'; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
