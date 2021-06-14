<div class="dropdown no-arrow">
    <select name="lang_changer" id="lang_changer" class="form-control">
        <?php foreach($languages as $language) : ?>
        <option value="<?= $language ?>"><?= $language ?></option>
        <?php endforeach; ?>
    </select>
</div>

