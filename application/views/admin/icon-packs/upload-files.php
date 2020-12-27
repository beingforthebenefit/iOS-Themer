<?php ini_set('max_file_uploads', '200') ?>
<h1>Uploads</h1>

<h2>Icon pack uploads</h2>

<h4>Note: You can only upload 200 icons at a time. <a href="mailto:gerald@gtodd.dev">Let me know</a> if that's a problem.</h4>

<form action="/" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="p" value="admin" />
    <input type="hidden" name="c" value="IconPack" />
    <input type="hidden" name="a" value="uploadPack" />
    <div>
        <label>Icon Pack Directory (will be placed in <code>/application/icon-packs/</code></label><br />
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