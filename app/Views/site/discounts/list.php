<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-50 pb-50 position-relative">
        <div class="container">
            <div class="row">
                <?= view('App\Views\site\progress\_greed') ?>
            </div>
            <div class="pagination-wrap d-flex flex-wrap justify-content-center w-100" id="layouts_pagination">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<?= $this->endSection() ?>
