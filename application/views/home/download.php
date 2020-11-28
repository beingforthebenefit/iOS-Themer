<form class="form" method="POST">
    <input type="hidden" name="a" value="download" />
    <fieldset class="form-fieldset">
        <ol class="list">
            <li class="list-item">
                <div class="form-button-wrap">
                    <input class="form-field-button" type="submit" name="submit" value="Download Theme" onclick="thankYou()" <?= empty($model) ? 'disabled' : '' ?>/>
                </div>
            </li>
            <?php for ($i = 1; $i <= 3; $i++) { ?>
                <li class="list-item">
                    <div class="step-wrap">
                        <img class="step-image" src="/images/steps/<?= $i ?>.png" title="Step <?= $i + 1 ?>" />
                    </div>
                </li>
            <?php } ?>
        </ol>
    </fieldset>
</form>