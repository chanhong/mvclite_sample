<?PHP

$usrQryUrl = $this->h->tap('/users/index');
//$this->requireAdmin($usrQryUrl); // if not admin redirect to login and return here
if (empty($pageData['arr'])) return;
$users = $pageData['arr'];
?>
<div>
    <div>
        <form action="<?php echo $usrQryUrl; ?>" method="post" class="form-inline" role="form">
            <input type="text" name="q" title="Search Users (By Username)" value="<?PHP echo @$q; ?>" id="q">&nbsp;
            <input type="submit" name="btnSearch" id="btnSearch" class="btn btn-default btn-sm" value="Search">            
        </form>
    </div>
    <div>
        <table class="table table-hover table-condensed">
            <thead>
            <td>Username</td>
            <td>Level</td>
            <td>Actions</td>
            </tr>
            </thead>
            <tbody>
                <?PHP foreach ($users as $u) : ?>
                    <tr>
                        <td><?PHP echo $u['username']; ?></td>
                        <td><?PHP echo $u['level']; ?></td>
                        <td>
                        <?php 
                        $eUrl = $dUrl = "";
                        $uPath = '/users/edit/'. $u['id']; 
                        if ($this->isAllow($uPath)==true) {
                            $eUrl = $this->h->alink(['title'=>'Edit','path'=>$uPath]); 
                        }
                        $uPath = '/users/delete/'. $u['id']; 
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