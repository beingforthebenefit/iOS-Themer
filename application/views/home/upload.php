<div class="app-type-wrap">
    <div class="app-type-label">App Type:</div>
    <div class="app-types">
        <a class="app-type active" id="tab1" onclick="switchTab('app-store')">App Store</a>
        <a class="app-type" id="tab2" onclick="switchTab('system-app')">System App</a>
        <a class="app-type" id="tab3" onclick="switchTab('custom-app')">Custom App</a>
        <a class="app-type" id="tab4" onclick="switchTab('batch')">Batch Upload</a>
    </div>
</div>

<div class="forms-wrap">
    <!-- App store -->
    <form id="app-store" class="form" method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="a" value="upload" />
        <input type="hidden" name="page" value="installer" />
        <input type="hidden" name="tab" value="app-store" />
        <input type="hidden" name="ios14.3" value="true" />
        <fieldset class="form-fieldset">
            <div class="form-field-group">
                <label class="form-field-label" for="country">Select country</label>
                <select class="form-field-select" id="country" name="country">
                    <?php foreach (json_decode(file_get_contents(CONFIG_PATH . 'countries.json'), true) as $code => $country) { ?>
                        <option value="<?= $code ?>" <?= $code == 'US' ? 'selected' : '' ?>><?= $country ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-field-group">
                <label class="form-field-label" for="text">Search for an app</label>
                <input class="form-field-input" type="text" id="text" oninput="fetchApps()" />
            </div>
            <div class="form-field-group">
                <label class="form-field-label" for="apps">Select one</label>
                <select class="form-field-select" id="apps" name="bundleId" onclick="insertSelection('apps', 'label')" disabled>
                    <option>Please search above...</option>
                </select>
            </div>
            <div class="form-field-group">
                <label class="form-field-label" for="label">New Label</label>
                <input class="form-field-input" type="text" id="label" name="label" />
            </div>
            <div class="form-file">
                <input class="form-field-file" type="file" id="icon" name="icon" onchange="updateText('icon-text', 'icon')" />
                <p class="form-file-text" id="icon-text">Drag a new icon here or click to browse!</p>
            </div>
            <div class="form-button-wrap">
                <input class="form-field-button" type="submit" name="submit" value="Add Icon" />
            </div>
        </fieldset>
    </form>

    <!-- System app -->
    <form id="system-app" class="form hidden" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="a" value="upload" />
        <input type="hidden" name="page" value="installer" />
        <input type="hidden" name="tab" value="system-app" />
        <fieldset class="form-fieldset">
            <div class="form-iphone-switch">
                <label class="form-switch">
                    <input type="checkbox" name="ios14.3">
                    iOS 14.3+?
                    <i></i>
                </label>
            </div>
            <div class="form-field-group">
                <label class="form-field-label" for="apps2">Select an App</label>
                <select class="form-field-select" id="apps2" name="bundleId" onclick="insertSelection('apps2', 'label2')">
                    <?php foreach (json_decode(file_get_contents(CONFIG_PATH . 'default-apps.json'), true) as $name => $bundleId) { ?>
                        <option value="<?= $bundleId ?>"><?= $name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-field-group">
                <label class="form-field-label" for="label2">New Label</label>
                <input class="form-field-input" type="text" id="label2" name="label" />
            </div>
            <div class="form-file">
                <input class="form-field-file" type="file" id="icon2" name="icon" onchange="updateText('icon-text2', 'icon2')" />
                <p class="form-file-text" id="icon-text2">Drag a new icon here or click to browse!</p>
            </div>
            <div class="form-button-wrap">
                <input class="form-field-button" type="submit" name="submit" value="Add Icon" />
            </div>
        </fieldset>
    </form>

    <!-- Custom -->
    <form id="custom-app" class="form hidden" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="a" value="upload" />
        <input type="hidden" name="page" value="installer" />
        <input type="hidden" name="tab" value="custom-app" />
        <input type="hidden" name="ios14.3" value="true" />
        <fieldset class="form-fieldset">
            <div class="form-field-group">
                <label class="form-field-label" for="bundleId" >Bundle Id</label>
                <input class="form-field-input" type="text" id="bundleId" name="bundleId" />
            </div>
            <div class="form-field-group">
                <label class="form-field-label" for="label3">Label</label>
                <input class="form-field-input" type="text" id="label3" name="label" />
            </div>
            <div class="form-file">
                <input class="form-field-file" type="file" id="icon3" name="icon" onchange="updateText('icon-text3', 'icon3')" />
                <p class="form-file-text" id="icon-text3">Drag a new icon here or click to browse!</p>
            </div>
            <div class="form-button-wrap">
                <input class="form-field-button" type="submit" name="submit" value="Add Icon" />
            </div>
        </fieldset>
    </form>

    <!-- Batch upload -->
    <form id="batch" class="form hidden" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="a" value="batchUpload" />
        <input type="hidden" name="page" value="installer" />
        <input type="hidden" name="tab" value="batch" />
        <input type="hidden" name="ios14.3" value="true" />
        <input type="hidden" name="bundleId" value="" />
        <fieldset class="form-fieldset">
            <span class="batch-description">Max of 20 icons per batch upload. File names must be
                in the format <code class="code">bundleId-anytext.ext</code>, for example, <code class="code" >com.facebook.Facebook-large.png</code>. This is how typical jailbreak icon collections are named, although only non-jailbreak apps can be added here.</span> 
            <div class="form-file">
                <input class="form-field-file" type="file" id="icon4" name="icon[]" onchange="updateText2('icon-text4', 'icon4')" multiple />
                <p class="form-file-text" id="icon-text4">Drag a new icons here or click to browse!</p>
            </div>
            <div class="form-button-wrap">
                <input class="form-field-button" type="submit" name="submit" value="Add Icons" />
            </div>
        </fieldset>
    </form>
</div>