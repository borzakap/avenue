<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\pages\mall\_header') ?>

<?= view('App\Views\site\pages\mall\_description') ?>

<?= view('App\Views\site\pages\mall\_prefs') ?>

<?= view('App\Views\site\pages\mall\_faq') ?>

<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/js/map.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('aftermain') ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQoQ-cFvvsdyaRHshQczCA6W0NnLvxpU8&amp;"></script>
<?= $this->endSection() ?>
