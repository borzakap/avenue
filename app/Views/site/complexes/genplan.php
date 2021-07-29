<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<?= view('App\Views\site\complexes\_genplan') ?>

<?= $this->endSection() ?>

<?= $this->section('artermain') ?>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>

<?= $this->endSection() ?>
