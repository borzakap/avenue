<?= $this->extend('admin/layout') ?>
<?= $this->section('main') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= lang('FacebookExport.PageTitle') ?></h1>
    <!-- Topbar Search -->
    <a href="<?= route_to('commerce_create') ?>" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-flag"></i>
        </span>
        <span class="text"><?= lang('Admin.Buttons.Create') ?></span>
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="row row-cols-2">
        <?php foreach($items as $item) : ?>
            <div class="col">
                <h6><?= $item->title?></h6><!-- section title -->
                <?php if($item->withCommerces()) : ?>
                    <?php foreach($item->commerces as $f => $floor) : ?>
                        <div class="row">
                            <div class="col"><?= $f; ?></div>
                            <?php foreach($floor as $commerce) : ?>
                            <div class="col" data-sold="<?= $commerce->sold_out; ?>">
                                <?= $commerce->code; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php /* print_r($item->withCommerces()) */ ?>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Content Row -->


<!-- Content Row -->

<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>

<?= $this->endSection() ?>

<?= $this->section('pagecss') ?>
<?= $this->endSection() ?>

