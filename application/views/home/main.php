<div class="page-wrap">
    <div class="form-container">
        <h1 class="header">1. Add as Many Apps As You Want</h1>
        <?php include CURR_VIEW_PATH . 'upload.php' ?>
    </div>

    <div class="phone-container">
        <div class="iphone">
            <div class="iphone-top">
              <span class="camera"></span>
              <span class="sensor"></span>
              <span class="speaker"></span>
            </div>
            <div class="top-bar"></div>
            <div class="iphone-screen">
                <div class="app-wrap" id="inner">
                    <?php foreach ($model as $icon) { ?>
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
    </div>

    <div class="download-container">
        <h1 class="header">2. Install On Your Device</h1>
        <?php include CURR_VIEW_PATH . 'download.php' ?>
    </div>
</div>
