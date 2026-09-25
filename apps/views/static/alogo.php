<?php
    $file=CString::FixBackSlash($this->cfg->path['view']).'/'.basename(__DIR__).'/'. CSetting::get("_rp").'/static.css';
  // don't set layout in index for consistency and avoid double layout
  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
//  $ViewData["Title"] = "SPage";
$this->_view_data['header_title'] = 'Animated Logo';  
  CSecs::setUsersInfo(); // MUST set it before it is being used in the class

  ?>
<link rel="stylesheet" href="<?php echo $file;?>" />
<style>

</style>
<div id="logo">
<img src="public/img/logo.svg" height=200 width=600>
</div>
Animated Logo
