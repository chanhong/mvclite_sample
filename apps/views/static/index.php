<?php
    $file=CString::FixBackSlash($this->cfg->path['view']).'/'.basename(__DIR__).'/'. CSetting::get("_rp").'/static.css';
    /*
  //Layout = CUtil::GetLayout("_static_top");

//  string file = CCore::MeViewPath() + "/" + CSetting::get("_rp") + "/static.css";
  //CMsg::_pdmsg(file, "file");
  //CMsg::_cwl($"static: f={file}");

  string pfile = "/Shared" + "/css/" + "static.css";
  //CMsg::_cwl($"static: f={pfile}");
*/
  // don't set layout in index for consistency and avoid double layout
  $_qsa = CCore::qs2nvWithDefaultValue();
  CUtil::setActiveCtrl($_qsa);
//  $ViewData["Title"] = "SPage";
$this->_view_data['header_title'] = 'Static';  
  CSecs::setUsersInfo(); // MUST set it before it is being used in the class

//  $mnuLinks = CCore::$_cfg["mnu_static"];
//  $mnuLinks = CConfig::get('menus.spage') ?? [];
  $mnuLinks = CConfig::get('mnu_static') ?? [];
  pln($mnuLinks, "mnuLinks");
  $lnka = null;

  ?>
<link rel="stylesheet" href="<?php echo $file;?>" />
<style>

</style>
  <div class="grid-layout">
    <?php
   foreach ($mnuLinks as $title => $path) {
    
//        pln($title, "title");
//        pln($path, "path");
        
      if (CString::IsEmpty($title) == false)
      {
        $lnka = CUtil::mnu_nv2a($mnuLinks, $title);
        ?>
        <div class="item">
          <?php echo CUtil::a2ahref($lnka); ?>
        </div>
        <?php
      }
    }
?>
  </div>
Static
