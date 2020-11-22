<form class="form" method="POST" action="?a=download">
    <fieldset class="form-fieldset">
        <ol class="step-list">
            <li class="step-item">
                <div class="form-button-wrap">
                    <input class="form-field-button" type="submit" name="submit" value="Download Theme" onclick="thankYou()" <?= empty($model) ? 'disabled' : '' ?>/>
                </div>
            </li>
            <?php for ($i = 1; $i <= 3; $i++) { ?>
                <li class="step-item">
                    <div class="step-wrap">
                        <img class="step-image" src="/images/steps/<?= $i ?>.png" title="Step <?= $i + 1 ?>" />
                    </div>
                </li>
            <?php } ?>
        </ol>
    </fieldset>
</form>