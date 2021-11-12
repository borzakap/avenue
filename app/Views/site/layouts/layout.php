<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="/site/modules/slick/slick.css">
<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-50 pb-50 position-relative">
        <div class="container">
            <div class="w-100 layout-title-wrap">
                <h1><?= $layout->title ?></h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <?= img(['src' => 'images/layouts/' . $layout->image_2d, 'class' => 'img-fluid']) ?>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <p><?= number_to_roman(ceil($layout->section->section_build_end->getMonth() / 3)) ?> <?= lang('Site.Layouts.Dt.Quarter') ?> <?= $layout->section->section_build_end->getYear() ?> <?= lang('Site.Layouts.Dt.Year') ?></p>
                    <?php if($layout->price || $layout->price == 0): ?>
                    <div class="layout-price-wrap">
                        <span><?= round($layout->price); ?>$/м<sup>2</sup></span>
                        <span><?= round(($layout->price * $layout->all_area)) ?>$</span>
                    </div>
                    <?php endif; ?>
                    <div class="mt-20 w-100">
                        <a data-toggle="modal" data-target="#contact-form-modal" data-type="projects" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.Subscribe') ?></a>
                    </div><!-- View All -->
                    <?php if($layout->description) : ?>
                    <div class="layout-description-wrap">
                        <h2><?= lang('Site.Layouts.Titles.Description'); ?></h2>
                        <?= $layout->description ?>
                    </div>
                    <?php endif; ?>
                    <div class="layout-technical-wrap">
                        <h2><?= lang('Site.Layouts.Titles.Technical'); ?></h2>
                        <table class="layot-technical-table">
                            <tr>
                                <th><?= lang('Site.Layouts.Dt.Rooms') ?></th>
                                <td><?= $layout->rooms ?></td>
                            </tr>
                            <tr>
                                <th><?= lang('Site.Layouts.Dt.AllArea') ?></th>
                                <td><?= $layout->all_area ?> м<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th><?= lang('Site.Layouts.Dt.LiveArea') ?></th>
                                <td><?= $layout->live_area ?> м<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th><?= lang('Site.Layouts.Dt.KitArea') ?></th>
                                <td><?= $layout->kit_area ?> м<sup>2</sup></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <p class="layout-section-title mt-lg-0 mt-md-0 mt-sm-2"><a href="<?= route_to('App\Controllers\Layouts::genplan', $layout->plan->slug) ?>"><?= $layout->section->title ?></a> / <?= lang('Site.Layouts.Texts.Floors') ?> <?= $layout->floor_image->image_code ?></p>
                    <div class="sections-schema layout-schema">
                        <?= img(['src' => 'images/sections/' . ($layout->floor_image->image_name ?? '') , 'class' => 'img-fluid', 'width' => $layout->floor_image->image_width, 'height' => $layout->floor_image->image_height]) ?>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $layout->floor_image->image_width ?> <?= $layout->floor_image->image_height ?>">
                            <polygon points="<?= $layout->poligon ?>"></polygon>                        
                        </svg>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <h2 class="layout-rules-title"><?= lang('Site.Layouts.Titles.Rules'); ?></h2>
                    <div class="layout-rule-text">
                        <?= $layout->plan->conditions ?>
                    </div>
                    <div class="mt-20 w-100">
                        <a data-toggle="modal" data-target="#contact-form-modal" data-type="projects" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.Subscribe') ?></a>
                    </div><!-- View All -->
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="w-100 position-relative">
        <div class="genplan-wrap">
            <div class="genplan-img">
                <img src="/site/images/complex/plan-for-genplan.jpg" />
                <div class="rotation-wrapper-outer">
                    <div class="rotation-wrapper-inner">
                        <div class="sections-schema layout-schema">
                            <?= img(['src' => 'images/plans/' . ($layout->plan_image->image_name ?? ''), 'class' => 'img-fluid', 'width' => ($layout->plan_image->image_width ?? ''), 'height' => ($layout->plan_image->image_height ?? '')]) ?>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= ($layout->plan_image->image_width ?? '') ?> <?= ($layout->plan_image->image_height ?? '') ?>">
                                <polygon points="<?= $layout->plan_poligon ?>"></polygon>                        
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= view_cell('\App\Libraries\Layouts::carusel', ['rooms' => [$layout->rooms], 'limit' => 3]) ?>


<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/modules/slick/slick.min.js"></script>
<script src="/site/js/home.min.js"></script>
<?= $this->endSection() ?>
