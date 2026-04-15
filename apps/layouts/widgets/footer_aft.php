<?php
$buff = <<<code
<footer>      
    <p class="pull-right">Questions, comments and suggestions for this site are welcome.</p>
</footer>
code;
echo $buff;

// Display debug messages if they exist
if (!empty($_SESSION['dmsg']) || !empty($_SESSION['debug_logs'])) {
    echo '<hr style="margin-top: 30px; border-top: 2px solid #ccc;">';
    echo '<div style="background-color: #f5f5f5; padding: 15px; margin-top: 20px; font-size: 11px; font-family: monospace; border: 1px solid #ddd;">';
    
    // Current Debug Messages
    echo '<div style="margin-bottom: 20px;">';
    echo '<strong style="font-size: 13px; color: #333;">📋 CURRENT DEBUG LOG (On-Screen):</strong><br>';
    if (!empty($_SESSION['dmsg'])) {
        echo '<div style="max-height: 250px; overflow-y: auto; background-color: white; padding: 10px; border: 1px solid #ccc; margin-top: 5px;">';
        echo nl2br(htmlspecialchars($_SESSION['dmsg'], ENT_QUOTES, 'UTF-8'));
        echo '</div>';
        echo '<br><small style="color: #666;">Lines: ' . count(explode("\n", $_SESSION['dmsg'])) . ' | Size: ' . round(strlen($_SESSION['dmsg']) / 1024, 2) . ' KB</small>';
    } else {
        echo '<em style="color: #999;">No debug messages yet</em>';
    }
    echo '</div>';
    
    // Session Memory Info
    echo '<div style="margin-bottom: 20px;">';
    echo '<strong style="font-size: 13px; color: #333;">💾 SESSION MEMORY:</strong><br>';
    echo 'Debug Resets: <strong>' . (isset($_SESSION['debug_resets']) ? $_SESSION['debug_resets'] : 0) . '</strong> | ';
    echo 'Session Size: <strong>' . round(strlen(serialize($_SESSION)) / 1024, 2) . ' KB</strong><br>';
    echo '</div>';
    
    // Debug Sessions History
    if (!empty($_SESSION['debug_logs'])) {
        echo '<div style="margin-bottom: 20px;">';
        echo '<strong style="font-size: 13px; color: #333;">📊 DEBUG SESSIONS HISTORY:</strong><br>';
        echo '<table style="width: 100%; border-collapse: collapse; margin-top: 5px; font-size: 11px;">';
        echo '<tr style="background-color: #e8e8e8; border-bottom: 1px solid #ccc;">';
        echo '<th style="padding: 5px; text-align: left; border-right: 1px solid #ccc;">Session #</th>';
        echo '<th style="padding: 5px; text-align: left; border-right: 1px solid #ccc;">Lines</th>';
        echo '<th style="padding: 5px; text-align: left; border-right: 1px solid #ccc;">Size</th>';
        echo '<th style="padding: 5px; text-align: left;">Timestamp</th>';
        echo '</tr>';
        foreach (array_reverse($_SESSION['debug_logs']) as $index => $log) {
            $bgColor = ($index % 2 === 0) ? 'white' : '#f9f9f9';
            echo "<tr style=\"background-color: {$bgColor}; border-bottom: 1px solid #ddd;\">";
            echo "<td style=\"padding: 5px; border-right: 1px solid #ccc;\">#{$log['reset_num']}</td>";
            echo "<td style=\"padding: 5px; border-right: 1px solid #ccc;\">{$log['line_count']}</td>";
            echo "<td style=\"padding: 5px; border-right: 1px solid #ccc;\">{$log['size_kb']} KB</td>";
            echo "<td style=\"padding: 5px;\">{$log['timestamp']}</td>";
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }
    
    // Log File Info
    echo '<div style="margin-bottom: 10px;">';
    echo '<strong style="font-size: 13px; color: #333;">📁 DEBUG LOG FILE:</strong><br>';
    $logDir = dirname(dirname(dirname(__DIR__))) . '/db/logs';
    $logFile = $logDir . '/debug_' . date('Y-m-d') . '.log';
    if (file_exists($logFile)) {
        $size = filesize($logFile);
        $sizeKb = round($size / 1024, 2);
        $lines = count(file($logFile, FILE_SKIP_EMPTY_LINES));
        echo 'Location: <code style="background: white; padding: 2px 5px; border: 1px solid #ccc;">' . htmlspecialchars($logFile, ENT_QUOTES, 'UTF-8') . '</code><br>';
        echo 'Size: <strong>' . $sizeKb . ' KB</strong> | Lines: <strong>' . $lines . '</strong> | ';
        echo 'Last Modified: <strong>' . date('Y-m-d H:i:s', filemtime($logFile)) . '</strong><br>';
    } else {
        echo 'Log file will be created at: <code style="background: white; padding: 2px 5px; border: 1px solid #ccc;">' . htmlspecialchars($logFile, ENT_QUOTES, 'UTF-8') . '</code>';
    }
    echo '</div>';
    
    echo '</div>';
}