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
                <a href="<?= $pack['link1Url'] ?>"><?= $pack['link1Text'] ?></a><br />
                <a href="<?= $pack['link2Url'] ?>" <?= $pack['paid'] ? 'class="gumroad-button"' : '' ?>><?= $pack['link2Text'] ?></a>
                <p><?= $pack['description'] ?></p>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

