  <?php
  $this->_view_data['header_title'] = 'Static Page';
    $file=CString::FixBackSlash($this->cfg->path['view']).'/'.basename(__DIR__).'/css/static.css';

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
          @Html.Raw(CUtils.a2ahref(lnka))
        </div>
      }
    }
    */

?>
<link rel="stylesheet" href="$file" />
<style>

</style>
<div id="logo">
<img src="/public/img/logo.svg" height=200 width=600>
</div>
  <div class="grid-layout">
    Static Page
    <!-- code here -->
  </div>
