@using System.Collections.Specialized;
@using Co;

@{
  Layout = CUtils.GetLayout("_bootstrap_top");
  string file = CCore.MeViewPath() + "/" + AppState["_rp"] + "/listdnd2j1.jsx";
  CMsg._pdmsg(file, "file");
}


<h2>Add React JSX in One Minute</h2>
<p>This page demonstrates using React with no build tooling.</p>
<p>React is loaded as a script tag.</p>
<div id="j1"></div>
@Html.Raw(CHtml.JsxSrc(file))
<script type="text/babel">
  ReactDOM.render(React.createElement(App), document.getElementById('j1'));
</script>

