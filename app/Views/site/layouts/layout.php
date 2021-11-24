<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="/site/modules/slick/slick.css">
<link rel="stylesheet" href="/site/modules/magnific-popup/magnific-popup.css">
<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-50 pb-50 position-relative">
        <div class="container">
            <h1 class="layout-bold-title mb-3"><?= $layout->title ?></h1>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <div class="layout-images">
                            <?= img(['src' => 'images/layouts/' . $layout->image_2d, 'class' => 'img-fluid']) ?>
                        </div>
                        <div class="functionals-pannel">
                            <a class="functionals" id="layout-popup" href="/images/layouts/<?= $layout->image_2d ?>">
                                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.28411 14.4854C8.15026 14.3516 7.96874 14.2764 7.77947 14.2764C7.5902 14.2764 7.40868 14.3516 7.27483 14.4854L1.42756 20.3327V16.3812C1.42756 16.1919 1.35236 16.0104 1.2185 15.8765C1.08464 15.7426 0.903084 15.6674 0.713778 15.6674C0.524473 15.6674 0.34292 15.7426 0.209061 15.8765C0.0752014 16.0104 0 16.1919 0 16.3812V22.0558C0 22.2451 0.0752014 22.4266 0.209061 22.5605C0.34292 22.6943 0.524473 22.7695 0.713778 22.7695H6.38832C6.57762 22.7695 6.75917 22.6943 6.89303 22.5605C7.02689 22.4266 7.10209 22.2451 7.10209 22.0558C7.10209 21.8664 7.02689 21.6849 6.89303 21.551C6.75917 21.4172 6.57762 21.342 6.38832 21.342H2.43684L8.28411 15.4947C8.41792 15.3608 8.4931 15.1793 8.4931 14.9901C8.4931 14.8008 8.41792 14.6193 8.28411 14.4854V14.4854ZM14.4854 14.4854C14.6193 14.3516 14.8008 14.2764 14.9901 14.2764C15.1793 14.2764 15.3608 14.3516 15.4947 14.4854L21.342 20.3327V16.3812C21.342 16.1919 21.4172 16.0104 21.551 15.8765C21.6849 15.7426 21.8664 15.6674 22.0558 15.6674C22.2451 15.6674 22.4266 15.7426 22.5605 15.8765C22.6943 16.0104 22.7695 16.1919 22.7695 16.3812V22.0558C22.7695 22.2451 22.6943 22.4266 22.5605 22.5605C22.4266 22.6943 22.2451 22.7695 22.0558 22.7695H16.3812C16.1919 22.7695 16.0104 22.6943 15.8765 22.5605C15.7426 22.4266 15.6674 22.2451 15.6674 22.0558C15.6674 21.8664 15.7426 21.6849 15.8765 21.551C16.0104 21.4172 16.1919 21.342 16.3812 21.342H20.3327L14.4854 15.4947C14.3516 15.3608 14.2764 15.1793 14.2764 14.9901C14.2764 14.8008 14.3516 14.6193 14.4854 14.4854V14.4854ZM14.4854 8.28411C14.6193 8.41792 14.8008 8.4931 14.9901 8.4931C15.1793 8.4931 15.3608 8.41792 15.4947 8.28411L21.342 2.43684V6.38832C21.342 6.57762 21.4172 6.75917 21.551 6.89303C21.6849 7.02689 21.8664 7.10209 22.0558 7.10209C22.2451 7.10209 22.4266 7.02689 22.5605 6.89303C22.6943 6.75917 22.7695 6.57762 22.7695 6.38832V0.713778C22.7695 0.524473 22.6943 0.34292 22.5605 0.209061C22.4266 0.0752014 22.2451 0 22.0558 0H16.3812C16.1919 2.82088e-09 16.0104 0.0752014 15.8765 0.209061C15.7426 0.34292 15.6674 0.524473 15.6674 0.713778C15.6674 0.903084 15.7426 1.08464 15.8765 1.2185C16.0104 1.35236 16.1919 1.42756 16.3812 1.42756H20.3327L14.4854 7.27483C14.3516 7.40868 14.2764 7.5902 14.2764 7.77947C14.2764 7.96874 14.3516 8.15026 14.4854 8.28411V8.28411ZM8.28411 8.28411C8.15026 8.41792 7.96874 8.4931 7.77947 8.4931C7.5902 8.4931 7.40868 8.41792 7.27483 8.28411L1.42756 2.43684V6.38832C1.42756 6.57762 1.35236 6.75917 1.2185 6.89303C1.08464 7.02689 0.903084 7.10209 0.713778 7.10209C0.524473 7.10209 0.34292 7.02689 0.209061 6.89303C0.0752014 6.75917 0 6.57762 0 6.38832V0.713778C0 0.524473 0.0752014 0.34292 0.209061 0.209061C0.34292 0.0752014 0.524473 0 0.713778 0H6.38832C6.57762 2.82088e-09 6.75917 0.0752014 6.89303 0.209061C7.02689 0.34292 7.10209 0.524473 7.10209 0.713778C7.10209 0.903084 7.02689 1.08464 6.89303 1.2185C6.75917 1.35236 6.57762 1.42756 6.38832 1.42756H2.43684L8.28411 7.27483C8.41792 7.40868 8.4931 7.5902 8.4931 7.77947C8.4931 7.96874 8.41792 8.15026 8.28411 8.28411V8.28411Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <p><?= number_to_roman(ceil($layout->section->section_build_end->getMonth() / 3)) ?> <?= lang('Site.Layouts.Dt.Quarter') ?> <?= $layout->section->section_build_end->getYear() ?> <?= lang('Site.Layouts.Dt.Year') ?></p>
                    <?php if($layout->price && $layout->price > 0): ?>
                    <div class="layout-price-wrap">
                        <span><?= round($layout->price); ?>$/м<sup>2</sup></span>
                        <span><?= round(($layout->price * $layout->all_area)) ?>$</span>
                    </div>
                    <?php endif; ?>
                    <div class="mt-20 w-100">
                        <a data-toggle="modal" data-target="#contact-form-modal" data-type="projects" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.Subscribe') ?></a>
                    </div><!-- View All -->
                    <div class="mt-20">
                        <h2 class="layout-normal-title"><?= lang('Site.Layouts.Titles.Technical'); ?></h2>
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
                <div class="col-lg-6 col-12">
                    <?php if($layout->description) : ?>
                    <div class="mt-30">
                        <h2 class="layout-bold-title"><?= lang('Site.Layouts.Titles.Description'); ?></h2>
                        <?= $layout->description ?>
                    </div>
                    <?php endif; ?>
                    <?php if($layout->plan->conditions) : ?>
                    <div class="mt-30">
                        <h2 class="layout-bold-title"><?= lang('Site.Layouts.Titles.Rules'); ?></h2>
                        <?= $layout->plan->conditions ?>
                    </div>
                    <?php endif; ?>
                    <div class="mt-20 w-100">
                        <a data-toggle="modal" data-target="#contact-form-modal" data-type="projects" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.Subscribe') ?></a>
                    </div><!-- View All -->
                </div>
                <div class="col-lg-6 col-12">
                    <p class="layout-normal-title mt-3 mt-lg-0"><a href="<?= route_to('App\Controllers\Layouts::genplan', $layout->plan->slug) ?>"><?= $layout->section->title ?></a> / <?= lang('Site.Layouts.Texts.Floors') ?> <?= $layout->floor_image->image_code ?></p>
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
</section>
<?= view_cell('\App\Libraries\Infrastructure::map') ?>

<?= view_cell('\App\Libraries\Layouts::carusel', ['rooms' => [$layout->rooms], 'limit' => 3]) ?>


<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQoQ-cFvvsdyaRHshQczCA6W0NnLvxpU8&amp;"></script>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/modules/slick/slick.min.js"></script>
<script src="/site/modules/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/site/js/layout.min.js"></script>
<script src="/site/js/home.min.js"></script>
<script src="/site/js/map.min.js"></script>
<?= $this->endSection() ?>
