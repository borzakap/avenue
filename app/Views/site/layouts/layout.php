<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            
        </div>
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<?= $this->endSection() ?>
