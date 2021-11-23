<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>
<?= view('App\Views\site\_breadcrumb') ?>

<?= view('App\Views\site\pages\rooms\_header') ?>

<?= view('App\Views\site\pages\rooms\_description') ?>

<?= view_cell('\App\Libraries\Infrastructure::map') ?>

<section>
    <div class="w-100 pt-50 pb-50 position-relative pg-oneroom">
        <div class="container">
            <?= view('App\Views\site\layouts\_filters') ?>
            <div class="layouts-wrap w-100">
                <div class="row" id="layouts_filtered">
                    <?= view('App\Views\site\layouts\_layouts_greed_paged') ?>
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

<?= $this->section('pagejs') ?>
<script src="/site/js/map.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQoQ-cFvvsdyaRHshQczCA6W0NnLvxpU8&amp;"></script>
<?= $this->endSection() ?>
