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
        <?= view('App\Views\admin\_lang_changer') ?>
    </div>
    <div class="card-body">
        <?= form_open() ?>
        <?= view('App\Views\admin\residentials\_form') ?>
        <?= form_submit('residential_update', lang('Admin.Form.Buttons.Update'), ['class' => 'btn btn-primary']) ?>
        <?= form_close() ?>    
    </div>
</div>
<!-- Content Row -->
<!-- Images card -->
<div class="card shadow mb-4">
    <a href="#collapseImages" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseImages">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.ImagesTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseImages">
        <?= form_open_multipart(route_to('plans-upload'), ['id' => 'upload-images']) ?>
        <?= view('App\Views\admin\residentials\_images_form') ?>
        <?= form_close() ?>    
        <div id="images-greed" class="row mt-5" data-action="<?= route_to('plans-load') ?>" data-id="<?= $residential_id ?>"></div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- Custom scripts for sceditor-->
<script src="/admin/modules/sceditor/minified/sceditor.min.js"></script>
<script src="/admin/modules/sceditor/minified/formats/xhtml.js"></script>
<script src="/admin/js/upload-images.min.js"></script>
<script src="/admin/js/jquery.datepicker.min.js"></script>

<script type="text/template" data-template="images">
    <div class="col-12 col-md-6">
        <div class="image-container">
            <img class="img-fluid img-thumbnail" src="/images/plans/${image_name}" />
            <i class="image-edit fas fa-edit"></i>
            <?= form_open(route_to('plans-update'), ['class' => 'update-image']) ?>
            <input type="hidden" name="id" value="${id}" />
            <div class="form-row">
                <div class="form-group col">
                    <?= form_label(lang('Admin.Form.Labels.ImageUpload'), 'image_file') ?>
                    <?= form_upload(['name' => 'image_file', 'class' => 'form-control-file', 'id' => 'image_file', 'value' => '']) ?>
                </div>
                <div class="form-group col">
                    <?= form_label(lang('Admin.Form.Labels.ImageTitle'), 'image_code') ?>
                    <?= form_input(['name' => 'image_code', 'type' => 'text', 'class' => 'form-control', 'id' => 'image_code', 'value' => '${image_code}']) ?>
                </div>
                <div class="form-group col">
                    <?= form_submit('update_img', lang('Admin.Form.Buttons.Upload'), ['class' => 'btn btn-primary', 'id' => 'upload-images-btn']) ?>
                    <input type="checkbox" name="delete_img" id="delete_img_${id}" /> <label for="delete_img_${id}">Delete</label>
                </div>
            </div>
            <?= form_close() ?>    
        </div>
    </div>
</script>

<?= $this->endSection() ?>
