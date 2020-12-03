<div class="body-header__wrap">
    <h1 class="body__header">Details for <?= $model['name'] ?></h1>
</div>

<div class="nav-link__wrap">
    <a class="base__link" href="/"><- back</a>
</div>

<div class="body-table__wrap">
    <table class="body__table">
        <?php foreach ($model as $key => $value) { ?>
            <tr class="body-table-body__row">
                <td class="body-table-body__cell"><?= $key ?></td>
                <td class="body-table-body__cell"><?= $value ?></td>
            </tr>
        <?php } ?>
    </table>
</div>