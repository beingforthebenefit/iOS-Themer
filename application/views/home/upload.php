<form class="form" method="POST" action="?a=upload" enctype="multipart/form-data">
    <fieldset class="form-fieldset">
        <div class="form-field-group">
            <label class="form-field-label" for="text">Search for an app</label>
            <input class="form-field-input" type="text" id="text" oninput="fetchApps()" />
        </div>
        <div class="form-field-group">
            <label class="form-field-label" for="apps">Select one</label>
            <select class="form-field-select" id="apps" name="bundleId" onclick="insertSelection()" disabled>
                <option>Please search above...</option>
            </select>
        </div>
        <div class="form-field-group">
            <label class="form-field-label" for="label">New Label</label>
            <input class="form-field-input" type="text" id="label" name="label" />
        </div>
        <div class="form-file">
            <input class="form-field-file" type="file" id="icon" name="icon" onchange="updateText()" />
            <p class="form-file-text" id="icon-text">Drag a new icon here or click to browse!</p>
        </div>
        <div class="form-button-wrap">
            <input class="form-field-button" type="submit" name="submit" value="Add Icon" />
        </div>
    </fieldset>
</form>