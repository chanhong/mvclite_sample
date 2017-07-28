<?php
$this->_view_data['header_title'] = 'Book List';
$this->ut->debug(BaseCore::$_userInfo,'_userinfo');
$usrQryUrl = $this->h->tap('/books/index');
if (empty($data['arr'])) return;
$recs = $data['arr'];
?>
<div>
    <div>
        <form action="<?php echo $usrQryUrl; ?>" method="post" class="form-inline" role="form">
            <input type="text" name="q" title="Search Books (By title)" value="<?PHP echo @$q; ?>" id="q">&nbsp;
            <input type="submit" name="btnSearch" id="btnSearch" class="btn btn-default btn-sm" value="Search">            
        </form>
    </div>
    <div>
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
                        <td><a href="<?php echo $this->h->tap('/books/edit/' . $r['id']); ?>">Edit</a>
                            <a href="<?php echo $this->h->tap('/books/delete/' . $r['id']); ?>"<?php echo $this->h->jsConfirm(); ?>>Delete</a>
                        </td>
                    </tr>
                <?PHP endforeach; ?>
            </tbody>
        </table>
    </div>
</div>