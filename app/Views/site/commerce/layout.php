<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="mb-3">
                        <?= img(['src' => 'images/layouts/' . $layout->image_2d, 'class' => 'img-fluid']) ?>
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <p><a href="<?= route_to('App\Controllers\Commerce::section', $layout->section->slug) ?>"><?= $layout->section->title ?></a></p>
                    <h2><?= $layout->title ?></h2>
                    <p><?= number_to_roman(ceil($layout->section->section_build_end->getMonth() / 3)) ?> <?= lang('Site.Layouts.Dt.Quarter') ?> <?= $layout->section->section_build_end->getYear() ?> <?= lang('Site.Layouts.Dt.Year') ?></p>
                    <div class="mt-20 w-100">
                        <a data-toggle="modal" data-target="#contact-form-modal" data-type="projects" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.Subscribe') ?></a>
                    </div><!-- View All -->
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<?= $this->endSection() ?>
