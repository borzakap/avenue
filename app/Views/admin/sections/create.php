<?= $this->extend('admin/layout') ?>

<?= $this->section('pagecss') ?>
    <!-- Custom css for sceditor-->
    <link href="/admin/modules/sceditor/minified/themes/default.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <?= view('App\Views\admin\_messages') ?>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <?= $breadcrumb ?>
        <?= view('App\Views\admin\_lang_changer') ?>
    </div>
    <div class="card-body">
        <?= form_open() ?>
        <?= view('App\Views\admin\sections\_text_form') ?>
        <?= form_submit('residential_create', lang('Residentials.Form.Buttons.Create'), ['class' => 'btn btn-primary']) ?>
        <?= form_close() ?>    
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Sections.Headers.ImagesUploadArea') ?></h6>
    </div>
    <div class="card-body">
        <p class="text-align-center"><?= lang('Sections.Text.CeateSectionFirst') ?></p>
    </div>
</div>
<!-- Content Row -->
<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
        <!-- Custom scripts for sceditor-->
        <script src="/admin/modules/sceditor/minified/sceditor.min.js"></script>
        <script src="/admin/modules/sceditor/minified/formats/xhtml.js"></script>

<?= $this->endSection() ?>
