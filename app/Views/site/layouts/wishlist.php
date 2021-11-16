<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-50 pb-50 position-relative">
        <div class="container">
            <div class="layouts-wrap w-100">
                <div class="w-100 layout-title-wrap text-center">
                    <h1><?= lang('Site.Layouts.Titles.Wishlist') ?></h1>
                </div>
                <div class="row" id="layouts_filtered">
                    <?php if(!$layouts) : ?>
                    <div class="col-12">
                        <p class="text-center"><?= lang('Site.Layouts.Texts.Wishlist') ?></p>
                        <div class="view-all w-100 text-center mt-5">
                            <a class="thm-btn thm-bg" href="<?= route_to('App\Controllers\Layouts::filter', 'default') ?>" title=""><?= lang('Site.Buttons.FindWishedLayouts') ?></a>
                        </div><!-- View All -->
                    </div>
                    <?php else : ?>
                        <?= view('App\Views\site\layouts\_layouts_greed_paged') ?>
                    <?php endif; ?>
                </div>
                <div class="loader">
                    <div class="windows8">
                        <div class="wBall" id="wBall_1">
                            <div class="wInnerBall"></div>
                        </div>
                        <div class="wBall" id="wBall_2">
                            <div class="wInnerBall"></div>
                        </div>
                        <div class="wBall" id="wBall_3">
                            <div class="wInnerBall"></div>
                        </div>
                        <div class="wBall" id="wBall_4">
                            <div class="wInnerBall"></div>
                        </div>
                        <div class="wBall" id="wBall_5">
                            <div class="wInnerBall"></div>
                        </div>
                    </div>
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
