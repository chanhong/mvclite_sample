<?php
  /**/
  $Layout = CUtils.GetLayout("_bootstrap_2c");
    $commfile = CCore::MeViewPath() +"/"+AppState["_rp"]+"/comments.js";
CMsg::_pdmsg($commfile, "file"); 
  $carfile = CCore::MeViewPath() +"/"+AppState["_rp"]+"/ford.js";
CMsg::_pdmsg($carfile, "file"); 
?>
    <div id="j1"></div>
    <div id="ford"></div>
       <script type="text/babel" src="<?php echo $commfile ?>"></script>
    <script type="text/babel" src="<?php echo $carfile ?>"></script>
  <script type="text/babel" >
      const comment = {
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
      );

      const myelement = <CarFord brand="Ford" />;

      ReactDOM.render(myelement, document.getElementById('ford'));  
    </script>