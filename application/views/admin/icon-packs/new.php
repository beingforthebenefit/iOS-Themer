<?php $pack = new PackModel('packs') ?>
<h1>Create Icon Pack</h1>

<form action="/" method="POST">
    <input type="hidden" name="p" value="admin" />
    <input type="hidden" name="c" value="IconPack" />
    <input type="hidden" name="a" value="createPack" />
    <div>
        <label>Title</label>
        <input type="text" name="title" />
    </div>
    <div>
        <label>Description</label><br />
        <textarea name="description" rows="5" cols="33"></textarea>
    </div>
    <div>
        <label>Background File</label>
        <select name="background">
            <?php 
                $files = array_diff(scandir(PUBLIC_PATH . 'images/icon-pack-previews'), ['..', '.']);
                foreach ($files as $file) { 
            ?>
                <option value="<?= $file ?>"><?= $file ?></option>
            <?php } ?>
        </select>
            Located in <code>/public/images/icon-pack-previews/</code>
    </div>
    <div>
        <label>Paid</label>
        <input type="radio" name="paid" value="1" />
        <label>Free</label>
        <input type="radio" name="paid" value="0" />
    </div>
    <div>
        <label>Link 1 Text</label>
        <input type="text" name="link1Text" />
    </div>
    <div>
        <label>Link 1 URL</label>
        <input type="text" name="link1Url" />
    </div>
    <div>
        <label>Link 2 Text</label>
        <input type="text" name="link2Text" />
    </div>
    <div>
        <label>Link 2 URL</label>
        <input type="text" name="link2Url" />
    </div>
    <div>
        <input type="submit" value="Create New Pack" />
    </div>
</form>