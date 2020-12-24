<link rel="stylesheet" href="/css/card-style.css<?= $u ?>">
<div class="container">
    <div class="card">
        <div class="content">
            <h3>Demo Icon Pack</h3>
            <p>Free Demo Icon Pack.  Download the Full Version in the Store!
            </p>
          <a href="/?a=loadIcons&pack=demo">Install Now</a><br />
          <a href="/?a=loadIcons&pack=demo&customize&page=installer">Edit first</a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h3>Minimal Red</h3>
            <p>Minimal Red Themed Icon Pack for iOS14.3+ 
            </p>
            <a class="gumroad-button" href="https://gum.co/RtqjQ" target="_blank">$12 - Buy Now</a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h3>Minimal Red</h3>
            <p>Minimal Red Themed Icon Pack for iOS14.3+ 
            </p>
            <div class="gumroad-product-embed" data-gumroad-product-id="RtqjQ"><a href="https://gumroad.com/l/RtqjQ">Loading...</a></div>
        </div>
    </div>
</div><?= $dev = explode('.', $_SERVER[HTTP_HOST])[1] == "live" ? false : true ?>