<?php ini_set('max_file_uploads', '300') ?>
<h1>Uploads</h1>

<?php if (!empty($_SESSION['errors'])) { ?>
    <?php foreach ($_SESSION['errors'] as $error) { ?>
        <div class="error-wrap">
            Error: <?= $error ?>
        </div>
    <?php }
} ?>

<h2>Icon pack uploads</h2>

<h4>Note: You can only upload 300 icons at a time. <a href="mailto:gerald@gtodd.dev">Let me know</a> if that's a problem.</h4>

<form action="/" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="p" value="admin" />
    <input type="hidden" name="c" value="IconPack" />
    <input type="hidden" name="a" value="uploadPack" />
    <div>
        <label>Icon Pack Directory Name (will be placed in <code>/application/icon-packs/</code>. This will be used in the installation URL, so use conventions like <a href="https://www.theserverside.com/definition/Kebab-case">kebab-case</a> (e.g. <code>this-is-a-great-example-of-kebab-case</code>)</label><br />
        <input type="text" name="directory" />
    </div>
    <div>
        <label>Select Icons to be Uploaded (Make sure they have the correct naming convention: <code>bundleId - Icon Label.png</code></label><br />
        <input type="file" name="icons[]" multiple />
    </div>
    <div>
        <label>Icon Pack Card Background (This will be placed in <code>/public/images/icon-pack-previews/</code>)<br />(Must be 280x400px exactly. Can be <code>png</code> or <code>jpg</code>.)</label><br />
        <input type="file" name="background">
    </div>
    <div>
        <input type="submit" value="Upload Files">
    </div>
</form>