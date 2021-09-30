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
            <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.CommerceTitle') ?></h6>
        </a>
        <?= view('App\Views\admin\_lang_changer') ?>
    </div>
    <div class="collapse show card-body" id="collapseText">
        <?= form_open() ?>
        <?= view('App\Views\admin\commerce\_form') ?>
        <?= form_submit('update', lang('Admin.Form.Buttons.Update'), ['class' => 'btn btn-primary']) ?>
        <?= form_close() ?>    
    </div>
</div>
<div class="card shadow mb-4">
    <a href="#collapseImages" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseImages">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.ImagesTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseImages">
        <?= form_open_multipart(route_to('commerce_images_upload'), ['id' => 'images_upload']) ?>
        <?= view('App\Views\admin\commerce\_images_form') ?>
        <?= form_submit('images_upload', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'upload-images-btn']) ?>
        <?= form_close() ?>    
        <div id="images_alert"></div>
    </div>
</div>

<?php if($data->floor_image) : ?>
<div class="card shadow mb-4">
    <a href="#collapseSection" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSection">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.SectionPoligonTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapseSection">
        <?= form_open_multipart(route_to('commerce_poligon_section'), ['id' => 'poligon_section']) ?>
        <?= view('App\Views\admin\commerce\_section_poligon_form') ?>
        <?= form_submit('section_poligon', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'section-poligon-btn']) ?>
        <?= form_close() ?>    
        <div id="section_alert"></div>
    </div>
</div>
<?php endif; ?>
<?php if($data->plan_image) : ?>
<div class="card shadow mb-4">
    <a href="#collapsePlan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapsePlan">
        <h6 class="m-0 font-weight-bold text-primary"><?= lang('Admin.Cards.Title.PlanPoligonTitle') ?></h6>
    </a>
    <div class="collapse card-body" id="collapsePlan">
        <?= form_open_multipart(route_to('commerce_poligon_plan'), ['id' => 'poligon_plan']) ?>
        <?= view('App\Views\admin\commerce\_genplan_poligon_form') ?>
        <?= form_submit('plan_poligon', lang('Admin.Form.Buttons.Save'), ['class' => 'btn btn-primary', 'id' => 'plan-poligon-btn']) ?>
        <?= form_close() ?>    
        <div id="plan_alert"></div>
    </div>
</div>
<?php endif; ?>

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
