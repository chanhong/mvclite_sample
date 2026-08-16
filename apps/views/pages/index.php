  <?php
  $this->_view_data['header_title'] = 'Static Page';
  $file=CString::FixBackSlash($this->cfg->path['view']).'/'.basename(__DIR__).'/_r_/static.css';
  echo $this->h->css($file);
  /*
  Layout = CUtils.GetLayout("_static_top");

  string file = CCore.MeViewPath() + "/" + AppState["_rp"] + "/static.css";
  CMsg._pdmsg(file, "file");

  // don't set layout in index for consistency and avoid double layout
  NameValueCollection _qsa = CCore.qs2nvWithDefaultValue();
  CUtils.setActiveCtrl(_qsa);
  $PageData["Title"] = "Static Page";
  CSecs.setUsersInfo(); // MUST set it before it is being used in the class

  NameValueCollection mnuLinks = (NameValueCollection)CCore._cfg["mnu_static"];
  string[] lnka = null;
*/
    /*
    @foreach (string s in mnuLinks.AllKeys)
    {
      if (CString.IsEmpty(s) == false)
      {
        lnka = CUtils.mnu_nv2a(mnuLinks, s);
        <div class="item">
          <?php echo htmlspecialchars(CUtils.a2ahref(lnka)); ?>
        </div>
      }
    }
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
<style>
    #logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #000511;
        perspective: 1800px;
        overflow: hidden;
    }

    #logo {
        height: 260px;
        width: auto;
        animation: starTrekApproach 8.5s linear infinite;
        filter: drop-shadow(0 0 45px #61dafb);
    }

    @keyframes starTrekApproach {
        0%   { transform: scale(0.28) translateZ(-650px) rotateY(0deg); }
        45%  { transform: scale(1.4)  translateZ(140px)  rotateY(170deg); }
        100% { transform: scale(0.28) translateZ(-650px) rotateY(360deg); }
    }
</style>

</head>
<body>  <link rel="stylesheet" href="$file" />
</body>
</html>
    */

// Put this in your view file
$pageTitle = "Static Page";
?>
<div id="logo-container">
    <img id="logo" src="/public/img/logo.svg" alt="Logo">
</div>
    <div style="text-align: center; color: #777; margin-top: -80px;">
        <h2>Static Page</h2>
    </div>

