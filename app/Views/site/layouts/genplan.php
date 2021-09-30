<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<?= view('App\Views\site\layouts\_floors_genplan') ?>

<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<!-- Modal -->
<div id="layout-modal-body"></div>

<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/js/section.min.js"></script>
<?= $this->endSection() ?>
