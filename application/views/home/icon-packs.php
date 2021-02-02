<?php
$packs = new PackModel('packs');
$allPacks = $packs->getAllIconPacks();
$categories = array_reduce(
    $allPacks,
    function ($keep, $pack) {
        if (isset($pack['details'][2][1]) && !in_array($pack['details'][2][1], $keep)) {
            $keep[] = $pack['details'][2][1];
        }
        return $keep;
    },
    [ ]
);

foreach ($categories as $category) {
    $$category = array_filter(
        $allPacks,
        function ($pack) use ($category) {
            return $pack['details'][2][1] == $category;
        }
    );
}
$otherPacks = array_filter(
    $allPacks,
    function ($pack) {
        return !array_key_exists('2', $pack['details']);
    }
);
?>
<link rel="stylesheet" href="/css/card-style.css<?= $u ?>">
<!-- TODO: Make this into a loop -->

<!-- Mini Icon Packs -->
<div style="text-align:center"><h1>Mini Icon Packs</h1></div>
<div class="container">
    <?php foreach ($miniIconPacks as $pack) { ?>
        <div class="card" style="background:url('<?= $pack['cover_image'] ?>')">
            <div class="content">
                <h3><?= $pack['name'] ?></h3>
                <a href="<?= $pack['url'] ?>" <?= $pack['price'] && strpos('gum.co', $pack['url']) ? 'class="gumroad-button"' : '' ?>>
                    <?= '$' . $pack['price'] . ' ' . strtoupper($pack['currency']) ?></a><br />
            </div>
        </div>
    <?php } ?>
</div>

<!-- Third-party icon packs -->
<div style="text-align:center"><h1>Third-Party Icon Packs</h1></div>
<div class="container">
    <?php foreach ($thirdParty as $pack) { ?>
        <div class="card" style="background:url('<?= $pack['cover_image'] ?>')">
            <div class="content">
                <h3><?= $pack['name'] ?></h3>
                <a href="<?= $pack['url'] ?>" <?= $pack['price'] && strpos('gum.co', $pack['url']) ? 'class="gumroad-button"' : '' ?>>
                    <?= '$' . $pack['price'] . ' ' . strtoupper($pack['currency']) ?></a><br />
            </div>
        </div>
    <?php } ?>
</div>

<!-- Mini icon packs -->
<div style="text-align:center"><h1>Minimal Sets</h1></div>
<div class="container">
    <?php foreach ($minimalSet as $pack) { ?>
        <div class="card" style="background:url('<?= $pack['cover_image'] ?>')">
            <div class="content">
                <h3><?= $pack['name'] ?></h3>
                <a href="<?= $pack['url'] ?>" <?= $pack['price'] && strpos('gum.co', $pack['url']) ? 'class="gumroad-button"' : '' ?>>
                    <?= '$' . $pack['price'] . ' ' . strtoupper($pack['currency']) ?></a><br />
            </div>
        </div>
    <?php } ?>
</div>

<!-- Others (Ones without descriptors) -->
<div style="text-align:center"><h1>Other Icon Packs</h1></div>
<div class="container">
    <?php foreach ($otherPacks as $pack) { ?>
        <div class="card" style="background:url('<?= $pack['cover_image'] ?>')">
            <div class="content">
                <h3><?= $pack['name'] ?></h3>
                <a href="<?= $pack['url'] ?>" <?= $pack['price'] && strpos('gum.co', $pack['url']) ? 'class="gumroad-button"' : '' ?>>
                    <?= '$' . $pack['price'] . ' ' . strtoupper($pack['currency']) ?></a><br />
            </div>
        </div>
    <?php } ?>
</div>
