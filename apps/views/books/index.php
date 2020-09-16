<?php
$this->ut->debug(MvcCore::$_userInfo,'_userinfo');
$usrQryUrl = $this->h->tap('/books/index');
if (empty($pageData['arr'])) return;
$recs = $pageData['arr'];
?>
  <script type="text/javascript">
  $( function() {
    $( "#resizable" ).resizable();
  } ); 
 </script>   
<div>
    <div>
        <form action="<?php echo $usrQryUrl; ?>" method="post" class="form-inline" role="form">
            <input type="text" name="q" title="Search Books (By title)" value="<?PHP echo @$q; ?>" id="q">&nbsp;
            <input type="submit" name="btnSearch" id="btnSearch" class="btn btn-default btn-sm" value="Search">            
        </form>
    </div>

    <div id="pagination">
        <table class="table table-hover table-condensed">
            <thead>
            <td>Author ID</td>
            <td>Title</td>
            <td>ISBN</td>
            </tr>
            </thead>
            <tbody>
                <?PHP foreach ($recs as $r) : ?>
                    <tr>
                        <td><?PHP echo $r['author_id']; ?></td>
                        <td><?PHP echo $r['title']; ?></td>
                        <td><?PHP echo $r['isbn']; ?></td>
                        <td>
                        <?php 
                        $eUrl = $dUrl = "";
                        $uPath = '/books/edit/'. $r['id']; 
                        if ($this->isAllow($uPath)==true) {
                            $eUrl = $this->h->alink(['title'=>'Edit','path'=>$uPath]); 
                        }
                        $uPath = '/books/delete/'. $r['id']; 
                        if ($this->isAllow($uPath)==true) {
                            $dUrl = $this->h->alink(['title'=>'Delete','path'=>$uPath,'confirm'=>"Y"]); 
                        }
                        echo "$eUrl $dUrl";
                        ?>
                        </td>
                    </tr>
                <?PHP endforeach; ?>
            </tbody>
        </table>
    </div>
</div>