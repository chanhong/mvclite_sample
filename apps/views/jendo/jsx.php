<?php
  $Layout = CUtil::GetLayout("_bootstrap_top");
  $file = CCore::MeViewPath() +"/"+AppState["_rp"]+"/jsx2j1.jsx";
  CMsg::_pdmsg($file, "file");
?>
    <h2>Add React in One Minute</h2>
    <p>This page demonstrates using React with no build tooling.</p>
    <p>React is loaded as a script tag.</p>
    <!-- We will put our React component inside this div. -->
    <div id="j1"></div>
    <!-- Load our React component. -->
        <?php echo CHtml::JsxSrc($file); ?>

<script>const comment = {
    date: new Date(),
    text: 'I hope you enjoy learning React!',
    author: {
      name: 'Hello Kitty',
      avatarUrl: 'https://placekitten.com/g/64/64',
    },
  };
  ReactDOM.render(
    <Comment
      date={comment.date}
      text={comment.text}
      author={comment.author}
    />,
    document.getElementById('j1')
  );</script>
 