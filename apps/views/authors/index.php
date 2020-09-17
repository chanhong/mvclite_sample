<?PHP
permDbg(MvcCore::$_userInfo,'_userinfo');
permDbg($pageData["profile"],'profile');

$usrQryUrl = $this->h->tap('/authors/index');
if (empty($pageData['arr'])) return;
$recs = $pageData['arr'];
?>
<div>
    <div>
        <form action="<?php echo $usrQryUrl; ?>" method="post" class="form-inline" role="form">
            <input type="text" name="q" title="Search Author (By name)" value="<?PHP echo @$q; ?>" id="q">&nbsp;
            <input type="submit" name="btnSearch" id="btnSearch" class="btn btn-default btn-sm" value="Search">            
        </form>
    </div>
    <div>
        <table class="table table-hover table-condensed">
            <thead>
            <td>Name</td>
            <td>Biography</td>
            </tr>
            </thead>
            <tbody>
                <?PHP foreach ($recs as $r) : ?>
                    <tr>
                        <td><?PHP echo $r['name']; ?></td>
                        <td><?PHP echo $r['biography']; ?></td>
                        <td>
                        <?php 
                        $eUrl = $dUrl = "";
                        $uPath = '/authors/edit/'. $r['id']; 
                        if ($this->isAllow($uPath)==true) {
                            $eUrl = $this->h->alink(['title'=>'Edit','path'=>$uPath]); 
                        }
                        $uPath = '/authors/delete/'. $r['id']; 
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