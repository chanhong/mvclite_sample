<?php
  /**/
  $Layout = CUtil::GetLayout("_bootstrap_2c");
    $logo = CUtil::imgPath()+"/logo.svg";
    $file1 = CCore::MeViewPath() +"/"+AppState["_rp"]+"/App.js";
CMsg::_pdmsg($file1, "file"); 
  $file2 = CCore::MeViewPath() +"/"+AppState["_rp"]+"/comments.js";
CMsg::_pdmsg($file2, "file"); 
?>
    <link rel="stylesheet" href="~/Shared/css/index.css" />
    <link rel="stylesheet" href="~/Shared/css/App.css" />
   <script type="text/babel" src="<?php echo $file1 ?>"></script> 
  <script type="text/babel" src="<?php echo $file2 ?>"></script> 
    Hi, index
    <div id="comm"></div>
    <div id="app"></div>

    <script type="text/babel">
     const comm = {
        date: new Date(),
        text: 'I hope you enjoy learning React!',
        author: {
          name: 'Hello Kitty',
          avatarUrl: 'https://placekitten.com/g/64/64',
        },
      };
      ReactDOM.render(
        <Comment
          date={comm.date}
          text={comm.text}
          author={comm.author}
        />,
        document.getElementById('comm')
      );

      ReactDOM.render(<App logo='@logo' />, document.getElementById('app'));
    </script>