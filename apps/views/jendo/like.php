<?php
  $Layout = CUtil::GetLayout("_bootstrap_top");
  $file = CCore::MeViewPath() + "/" + $AppState["_rp"] + "/like_button2j1.js";
  CMsg::_pdmsg($file, "file");
?>

<h2>Add React in One Minute</h2>
<p>This page demonstrates using React with no build tooling.</p>
<p>React is loaded as a script tag.</p>
<!-- We will put our React component inside this div. -->
<div id="j1"></div>
<!-- Load our React component. -->
<?php echo CHtml::JsSrc($file); ?>
<script>
  const domContainer = document.querySelector('#j1');
  ReactDOM.render(e(LikeButton), domContainer);
</script>