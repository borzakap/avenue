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
            <h1 class="layout-bold-title"><?= $item->title ?></h1>
            <div class="row">
                <div class="col-9">
                    <div class="w-100 progress-slider">
                        <?php foreach($item->images as $image) : ?>
                        <a href="/images/progress/<?= $image->image_name ?>" >
                            <img src="/images/progress/<?= $image->image_name ?>" alt="<?= $item->title ?>" />
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="w-100 mt-20 progress-description">
                        <?= $item->description ?>
                    </div>
                </div>
                <div class="col-3">
                    <nav class="progress-nav">
                        <ul>
                            <?php foreach($navigation as $nav) : ?>
                            <li>
                                <a class="progress-nav<?= ($nav->slug == $item->slug) ? ' active' : ''?>" href="<?= route_to('App\Controllers\Progress::view', $nav->slug) ?>"><?= $nav->progressed_at->toLocalizedString('LLLL yyyy') ?></a>
                            </li>
                            <?php endforeach; ?>
                            <li>
                                <a class="progress-readmore" href="<?= route_to('App\Controllers\Progress::list', 'default') ?>"><?= lang('ddd') ?></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/modules/slick/slick.min.js"></script>
<script src="/site/modules/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/site/js/progress.min.js"></script>
<?= $this->endSection() ?>
