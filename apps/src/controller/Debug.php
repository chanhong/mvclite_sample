<?php
namespace MvcLite;
class Debug extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->layout = "bootstrap";
        $this->_view_data['submenu'] = $this->h->getLiMenu($this->cfg->get('menu.submenu.debug'));

    }

    public function start($args = false) {

        $ret = $this->doAction($args, static::class);  // static resolve to calling class name      

    }

    public function index($args = false) {
        $debug_data = array();
        
        // Get current debug log
        if (isset($_SESSION['dmsg'])) {
            $debug_data['current_log'] = $_SESSION['dmsg'];
            $debug_data['current_lines'] = count(explode("\n", $_SESSION['dmsg']));
            $debug_data['current_size'] = strlen($_SESSION['dmsg']);
        } else {
            $debug_data['current_log'] = 'No debug data';
            $debug_data['current_lines'] = 0;
            $debug_data['current_size'] = 0;
        }
        
        // Get debug sessions history
        if (isset($_SESSION['debug_logs'])) {
            $debug_data['debug_logs'] = $_SESSION['debug_logs'];
        } else {
            $debug_data['debug_logs'] = array();
        }
        
        // Get debug resets count
        $debug_data['debug_resets'] = isset($_SESSION['debug_resets']) ? $_SESSION['debug_resets'] : 0;
        
        // Get log file info
        $log_dir = DOCROOT . 'db/logs';
        $log_file = $log_dir . '/debug_' . date('Y-m-d') . '.log';
        
        if (file_exists($log_file)) {
            $debug_data['log_file'] = $log_file;
            $debug_data['log_file_size'] = filesize($log_file);
            $debug_data['log_file_lines'] = count(file($log_file));
            $debug_data['log_file_mtime'] = filemtime($log_file);
        } else {
            $debug_data['log_file'] = null;
            $debug_data['log_file_size'] = 0;
            $debug_data['log_file_lines'] = 0;
            $debug_data['log_file_mtime'] = 0;
        }
        
        // Get all log files
        $all_log_files = array();
        if (is_dir($log_dir)) {
            $files = glob($log_dir . '/debug_*.log');
            foreach ($files as $file) {
                $all_log_files[] = array(
                    'name' => basename($file),
                    'size' => filesize($file),
                    'lines' => count(file($file)),
                    'mtime' => filemtime($file),
                    'path' => $file
                );
            }
            // Sort by modification time (newest first)
            usort($all_log_files, function($a, $b) {
                return $b['mtime'] - $a['mtime'];
            });
        }
        $debug_data['all_log_files'] = $all_log_files;
        
        // Get search filter if provided
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $debug_data['search'] = $search;
        
        // Filter current log if search is provided
        if (!empty($search)) {
            $lines = explode("\n", $debug_data['current_log']);
            $filtered_lines = array();
            foreach ($lines as $line) {
                if (stripos($line, $search) !== false) {
                    $filtered_lines[] = $line;
                }
            }
            $debug_data['filtered_log'] = implode("\n", $filtered_lines);
            $debug_data['filtered_lines'] = count($filtered_lines);
        }
        
        // Set individual properties for the view
        $this->_view_data['header_title'] = 'Debug Dashboard';
        $this->_view_data['current_log'] = $debug_data['current_log'];
        $this->_view_data['current_lines'] = $debug_data['current_lines'];
        $this->_view_data['current_size'] = $debug_data['current_size'];
        $this->_view_data['debug_resets'] = $debug_data['debug_resets'];
        $this->_view_data['debug_logs'] = $debug_data['debug_logs'];
        $this->_view_data['log_file'] = $debug_data['log_file'];
        $this->_view_data['log_file_size'] = $debug_data['log_file_size'];
        $this->_view_data['log_file_lines'] = $debug_data['log_file_lines'];
        $this->_view_data['log_file_mtime'] = $debug_data['log_file_mtime'];
        $this->_view_data['all_log_files'] = $debug_data['all_log_files'];
        $this->_view_data['search'] = $search;
        $this->_view_data['filtered_log'] = isset($debug_data['filtered_log']) ? $debug_data['filtered_log'] : '';
        $this->_view_data['filtered_lines'] = isset($debug_data['filtered_lines']) ? $debug_data['filtered_lines'] : 0;
        
        echo $this->doView($this, 'index');
    }

    public function logfile($args = false) {
        // Try multiple possible paths
        $possible_paths = array(
            DOCROOT . 'db/logs',
            dirname(DOCROOT) . '/db/logs',
            str_replace('\\apps\\src\\controller', '', dirname(__FILE__)) . '/../../db/logs'
        );
        
        $log_dir = null;
        foreach ($possible_paths as $path) {
            if (is_dir($path)) {
                $log_dir = $path;
                break;
            }
        }
        
        // Get list of available log files
        $available_files = array();
        if ($log_dir && is_dir($log_dir)) {
            $files = scandir($log_dir, SCANDIR_SORT_DESCENDING);
            foreach ($files as $file) {
                if (strpos($file, 'debug_') === 0 && strpos($file, '.log') !== false) {
                    $file_path = $log_dir . DIRECTORY_SEPARATOR . $file;
                    if (file_exists($file_path)) {
                        $available_files[] = array(
                            'name' => $file,
                            'size' => filesize($file_path),
                            'modified' => filemtime($file_path)
                        );
                    }
                }
            }
        }
        
        $this->_view_data['available_files'] = $available_files;
        $this->_view_data['log_dir_status'] = $log_dir ? 'Found: ' . $log_dir : 'Not found';
        
        // If no file specified, show the list
        $file = isset($this->get['file']) ? basename($this->get['file']) : '';
        
        if (empty($file)) {
            // Show list of available files
            $this->_view_data['header_title'] = 'Debug Log Files';
            $this->_view_data['filename'] = '';
            $this->_view_data['total_lines'] = 0;
            $this->_view_data['file_size'] = 0;
            $this->_view_data['search'] = '';
            $this->_view_data['lines'] = array();
            $this->_view_data['filtered_lines'] = array();
            $this->_view_data['matched_count'] = 0;
            $this->_view_data['error'] = empty($available_files) ? 'No log files available' : '';
            echo $this->doView($this, 'logfile');
            return;
        }
        
        if (!$log_dir) {
            $this->_view_data['header_title'] = 'Debug Log File';
            $this->_view_data['error'] = 'Log directory not found';
            $this->_view_data['filename'] = '';
            $this->_view_data['total_lines'] = 0;
            $this->_view_data['file_size'] = 0;
            $this->_view_data['search'] = '';
            $this->_view_data['lines'] = array();
            $this->_view_data['filtered_lines'] = array();
            $this->_view_data['matched_count'] = 0;
            echo $this->doView($this, 'logfile');
            return;
        }
        
        $file_path = $log_dir . DIRECTORY_SEPARATOR . $file;
        
        // Security check - prevent directory traversal
        if (!file_exists($file_path) || strpos(realpath($file_path), realpath($log_dir)) !== 0) {
            $this->_view_data['header_title'] = 'Debug Log File';
            $this->_view_data['error'] = 'Log file not found or invalid';
            $this->_view_data['filename'] = '';
            $this->_view_data['total_lines'] = 0;
            $this->_view_data['file_size'] = 0;
            $this->_view_data['search'] = '';
            $this->_view_data['lines'] = array();
            $this->_view_data['filtered_lines'] = array();
            $this->_view_data['matched_count'] = 0;
            echo $this->doView($this, 'logfile');
            return;
        }
        
        $search = isset($this->get['search']) ? $this->get['search'] : '';
        $lines = file($file_path);
        
        $this->_view_data['header_title'] = 'Debug Log File';
        $this->_view_data['filename'] = basename($file_path);
        $this->_view_data['total_lines'] = count($lines);
        $this->_view_data['file_size'] = filesize($file_path);
        $this->_view_data['search'] = $search;
        $this->_view_data['lines'] = $lines;
        $this->_view_data['error'] = '';
        
        // Filter lines if search is provided
        if (!empty($search)) {
            $filtered_lines = array();
            foreach ($lines as $line) {
                if (stripos($line, $search) !== false) {
                    $filtered_lines[] = $line;
                }
            }
            $this->_view_data['filtered_lines'] = $filtered_lines;
            $this->_view_data['matched_count'] = count($filtered_lines);
        } else {
            $this->_view_data['filtered_lines'] = array();
            $this->_view_data['matched_count'] = 0;
        }
        
        echo $this->doView($this, 'logfile');
    }

    public function clear($args = false) {
        $_SESSION['dmsg'] = '';
        $_SESSION['debug_logs'] = array();
        $_SESSION['debug_resets'] = 0;
        
        header('Location: ?t=debug&a=index');
        exit;
    }
}
