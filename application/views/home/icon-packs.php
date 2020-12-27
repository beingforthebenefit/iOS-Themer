<div class="main__img">
    <img src="/images/skin/spheres.png" alt="" data-speed="-2" class="move">
    <img src="/images/skin/cylinder boi.png" alt="" data-speed="2" class="move">
    <img src="/images/skin/icecream.png" alt="" data-speed="2" class="move">
    <img src="/images/skin/vanilla.png" alt="" data-speed="-2" class="move">
    <img src="/images/skin/wafer.png" alt="" data-speed="-2" class="move">
</div>

<link rel="stylesheet" href="/css/card-style.css<?= $u ?>">
<div class="main__data">
    <h1 class="main__description">Custom Crafted Icon Packs by Ubaid Dafedar</h1>
    <div class="container">
    <?php foreach ((new PackModel('packs'))->rows() as $pack) { ?>
        <div class="card" style="background:url(/images/icon-pack-previews/<?= $pack['background'] ?>)">
            <div class="content">
                <h3><?= $pack['title'] ?></h3>
                <?php if ($pack['link1Url']) { ?>
                    <a href="<?= $pack['link1Url'] ?>" <?= $pack['paid'] && strpos('gum.co', $pack['link1Url']) ? 'class="gumroad-button"' : '' ?>><?= $pack['link1Text'] ?></a><br />
                <?php } ?>
                <?php if ($pack['link2Url']) { ?>
                    <a href="<?= $pack['link2Url'] ?>" <?= $pack['paid'] && strpos('gum.co', $pack['link2Url']) ? 'class="gumroad-button"' : '' ?>><?= $pack['link2Text'] ?></a>
                <?php } ?>
                <p><?= $pack['description'] ?></p>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

