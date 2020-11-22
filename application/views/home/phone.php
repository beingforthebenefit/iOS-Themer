        <div class="form-iphone-switch">
            <label class="form-switch edit">
                <input type="checkbox" name="ios14.3" onchange="toggleEditMode()" <?= $_SESSION['editMode'] ? checked : '' ?>>
                Edit mode
                <i></i>
            </label>
            <form method="post">
                <input type="hidden" name="a" value="deleteAll" />
                <div class="form-button-wrap clear">
                    <input type="submit" class="form-field-button" value="Clear All Icons" />
                </div>
            </form>
        </div>
        <div class="iphone">
            <div class="iphone-top">
              <span class="camera"></span>
              <span class="sensor"></span>
              <span class="speaker"></span>
            </div>
            <div class="top-bar"></div>
            <div class="iphone-screen">
                <div class="app-wrap" id="inner">
                    <?php foreach ($model as $icon) {
                        $icon = unserialize($icon);
                    ?>
                        <?php include CURR_VIEW_PATH . 'icon.php' ?>
                    <?php } ?>
                </div>
            </div>
            <div class="buttons">
              <span class="on-off"></span>
              <span class="sleep"></span>
              <span class="up"></span>
              <span class="down"></span>
            </div>
            <div class="bottom-bar"></div>
            <div class="iphone-bottom">
              <span></span>
            </div>
        </div>