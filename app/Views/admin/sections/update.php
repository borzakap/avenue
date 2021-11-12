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
        <?= form_submit('section_update', lang('Admin.Form.Buttons.Update'), ['class' => 'btn btn-primary']) ?>
        <?= form_close() ?>    
    </div>
</div>
<!-- Images card -->
<div class="card shadow mb-4">
    <a href="#collapseImages" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseImages">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.ImagesTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseImages">
        <?= form_open_multipart(route_to('floors-upload'), ['id' => 'upload-images']) ?>
        <?= view('App\Views\admin\sections\_images_form') ?>
        <?= form_submit('floors_upload', lang('Admin.Form.Buttons.Upload'), ['class' => 'btn btn-primary', 'id' => 'upload-images-btn']) ?>
        <?= form_close() ?>    
        <div id="images-greed" class="row mt-5" data-action="<?= route_to('floors-load') ?>" data-id="<?= $section_id ?>"></div>
    </div>
</div>
<?php if($data->leaving_plan) : ?>
<div class="card shadow mb-4">
    <a href="#collapseLeavingPoligon" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseLeavingPoligon">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.PoligonLeaving') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseLeavingPoligon">
        <?= form_open_multipart(route_to('section_poligon_leaving'), ['id' => 'section_poligon_leaving']) ?>
        <?= view('App\Views\admin\sections\_poligon_leaving_form') ?>
        <?= form_submit('poligon_send', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'section_poligon_leaving_btn']) ?>
        <?= form_close() ?>    
    </div>
</div>
<?php endif; ?>
<?php if($data->commerce_plan) : ?>
<div class="card shadow mb-4">
    <a href="#collapseCommercePoligon" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCommercePoligon">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.PoligonCommerce') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseCommercePoligon">
        <?= form_open_multipart(route_to('section_poligon_commerce'), ['id' => 'section_poligon_commerce']) ?>
        <?= view('App\Views\admin\sections\_poligon_commerce_form') ?>
        <?= form_submit('poligon_send', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'section_poligon_commerce_btn']) ?>
        <?= form_close() ?>    
    </div>
</div>
<?php endif; ?>
<?php if($data->pantry_plan) : ?>
<div class="card shadow mb-4">
    <a href="#collapsePantryPoligon" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapsePantryPoligon">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.PoligonPantry') ?></h6>
    </a>
    <div class="collapse card-body" id="collapsePantryPoligon">
        <?= form_open_multipart(route_to('section_poligon_pantry'), ['id' => 'section_poligon_pantry']) ?>
        <?= view('App\Views\admin\sections\_poligon_pantry_form') ?>
        <?= form_submit('poligon_send', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'section_poligon_pantry_btn']) ?>
        <?= form_close() ?>    
    </div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- Custom scripts for sceditor-->
<script src="/admin/modules/sceditor/minified/sceditor.min.js"></script>
<script src="/admin/modules/sceditor/minified/formats/xhtml.js"></script>
<script src="/admin/js/jquery.canvasAreaDraw.min.js"></script>
<script src="/admin/js/upload-images.min.js"></script>
<script src="/admin/js/sections.min.js"></script>
<script type="text/template" data-template="images">
    <div class="col-12 col-md-6">
        <div class="image-container">
            <img class="img-fluid img-thumbnail" src="/images/sections/${image_name}" />
            <i class="image-edit fas fa-edit"></i>
            <?= form_open(route_to('floors-update'), ['class' => 'update-image']) ?>
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
