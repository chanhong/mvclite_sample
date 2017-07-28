<?PHP
$usrQryUrl = $this->h->tap('/authors/index');
if (empty($data['arr'])) return;
$recs = $data['arr'];
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
                        <td><a href="<?php echo $this->h->tap('/authors/edit/' . $r['id']); ?>">Edit</a>
                            <a href="<?php echo $this->h->tap('/authors/delete/' . $r['id']); ?>"<?php echo $this->h->jsConfirm(); ?>>Delete</a>
                        </td>
                    </tr>
                <?PHP endforeach; ?>
            </tbody>
        </table>
    </div>
</div>