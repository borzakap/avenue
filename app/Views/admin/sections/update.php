<?= $this->extend('admin/layout') ?>

<?= $this->section('pagecss') ?>
<!-- Custom css for sceditor-->
<link href="/admin/modules/sceditor/minified/themes/default.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<!-- Text card -->
<div class="card shadow mb-4">
    <?= view('App\Views\admin\_messages') ?>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <a href="#collapseText" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseText">
            <h6 class="m-0 font-weight-bold text-primary"><?= lang('Sections.Cards.Title.TextTitle') ?></h6>
        </a>
        <?= view('App\Views\admin\_lang_changer') ?>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <?= form_open() ?>
        <?= view('App\Views\admin\sections\_text_form') ?>
        <?= form_submit('section_update', lang('Sections.Form.Buttons.Update'), ['class' => 'btn btn-primary']) ?>
        <?= form_close() ?>    
    </div>
</div>
<!-- Images card -->
<div class="card shadow mb-4">
    <a href="#collapseImages" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseImages">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Sections.Cards.Title.ImagesTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseImages">
        <?= form_open_multipart('console/ajax/floors-upload', ['id' => 'floors-upload']) ?>
        <?= view('App\Views\admin\sections\_images_form') ?>
        <?= form_submit('floors_upload', lang('Sections.Form.Buttons.Upload'), ['class' => 'btn btn-primary', 'id' => 'floors-upload-btn']) ?>
        <?= form_close() ?>    
        <div id="images-greed" class="row" data-action="<?= route_to('floors-load') ?>" data-section="<?= $section_id ?>"></div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- Custom scripts for sceditor-->
<script src="/admin/modules/sceditor/minified/sceditor.min.js"></script>
<script src="/admin/modules/sceditor/minified/formats/xhtml.js"></script>
<script src="/admin/js/floors-images.min.js"></script>
<script type="text/template" data-template="images">
    <div class="col-12 col-md-6">
        <?= form_open('console/ajax/floors-update', ['class' => 'floors-update']) ?>
            <img class="img-fluid img-thumbnail" src="/images/sections/${image_name}" />
            <input type="text" value="${image_code}" name="image_code" />
            <input type="hidden" name="id" value="${id}" />
            <input type="checkbox" name="delete_img" id="delete_img_${id}"> <label for="delete_img_${id}">Delete</label>
            <input type="submit" name="update_img" value="Submit" />
        <?= form_close() ?>    
    </div>
</script>

<?= $this->endSection() ?>
