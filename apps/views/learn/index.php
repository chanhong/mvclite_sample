  <?php
  $this->_view_data['header_title'] = 'Learn Page';
    $file=CString::FixBackSlash($this->cfg->path['view']).'/'.basename(__DIR__).'/css/static.css';

// Set user info (very important as per your comment)
CSecs::setUsersInfo();

// Check if we have a return view from session (after login redirect)
$retViewFile = CUtil::getReturnViewFileFromSess();

if (!empty($retViewFile)) {
    $vFile = $retViewFile;        // Return to the previous view
} else {
    $vFile = "_main.php";         // Default main layout/view
}

// Render the view file
require $vFile;

