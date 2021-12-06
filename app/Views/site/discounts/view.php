<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="/site/modules/slick/slick.css">
<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-lg-50 pb-lg-50 position-relative">
        <div class="container">
            <div class="row with-shadow mb-lg-5 mb-0">
                <div class="col-12 col-lg-4 order-1 order-lg-0 p-4">
                    <span class="info-pannel"><?= lang('Site.Discounts.DateTo', ['date' => $item->date_to->toLocalizedString('d MMMM yyyy')]) ?></span>
                    <p class="layout-normal-title mt-3"><?= $item->slogan ?></p>
                    <div>
                        <?= view('App\Views\site\_contact_form') ?>
                    </div>
                </div>
                <div class="col-12 col-lg-8 image-box-container-discounts order-0 order-lg-1">
                    <div class="image-box">
                        <img src="/images/discounts/<?= $item->image ?>" alt="<?= $item->title ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 mb-3 progress-description order-1 order-lg-0">
                    <h1 class="layout-bold-title"><?= $item->title ?></h1>
                    <?= $item->description ?>
                </div>
                <div class="col-12 col-lg-4 mb-3 p-3 with-border p-3 order-0 order-lg-1">
                    <div class="counter" data-dateto="<?= $item->date_to->timestamp ?>">
                        <ul>
                            <li>
                                <span id="days">0</span>
                                <span class="time-title">days</span>
                            </li>
                            <li id="point">:</li>
                            <li>
                                <span id="hours">0</span>
                                <span class="time-title">hours</span>
                            </li>
                            <li id="point">:</li>
                            <li>
                                <span id="minutes">0</span>
                                <span class="time-title">minutes</span>
                            </li>
                            <li id="point">:</li>
                            <li>
                                <span id="seconds">0</span>
                                <span class="time-title">seconds</span>
                            </li>
                        </ul>
                    </div>
                    <span class="info-message"><?= $item->info?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
    <script src="/site/js/timecounter.min.js"></script>
<?= $this->endSection() ?>
