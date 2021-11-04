<?= $this->extend('admin/layout') ?>

<?= $this->section('pagecss') ?>
<!-- Custom css for sceditor-->
<link href="/admin/modules/sceditor/minified/themes/default.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<?= view('App\Views\admin\_messages') ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <a href="#collapseText" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseText">
            <h6 class="m-0 font-weight-bold text-primary"><?= lang('Sections.Cards.Title.TextTitle') ?></h6>
        </a>
        <?= view('App\Views\admin\_lang_changer') ?>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <?= form_open() ?>
        <?= view('App\Views\admin\infrastructure\_form') ?>
        <?= form_submit('layout_update', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary']) ?>
        <?= form_close() ?>    
    </div>
</div>

<div class="card shadow mb-4">
    <a href="#collapseImages" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseImages">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.ImagesTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseImages">
        <?= form_open_multipart(route_to('infrastructure_upload'), ['id' => 'images_upload']) ?>
        <?= view('App\Views\admin\infrastructure\_images_form') ?>
        <?= form_submit('images_upload', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'upload-images-btn']) ?>
        <?= form_close() ?>    
        <div id="images_alert"></div>
    </div>
</div>

<!-- Content Row -->
<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- Custom scripts for sceditor-->
<script src="/admin/modules/sceditor/minified/sceditor.min.js"></script>
<script src="/admin/modules/sceditor/minified/formats/xhtml.js"></script>
<script src="/admin/js/jquery.canvasAreaDraw.min.js"></script>
<script src="/admin/js/jquery.chained.js"></script>
<script src="/admin/js/layouts.min.js"></script>

<?= $this->endSection() ?>
