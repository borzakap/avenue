<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="/site/modules/slick/slick.css">

<?= $this->endSection() ?>


<?= $this->section('main') ?>
<?= view('App\Views\site\pages\home\_header') ?>

<?= view('App\Views\site\pages\home\_bullets') ?>
<a id="about"></a>
<?= view('App\Views\site\pages\home\_coworking') ?>

<?= view('App\Views\site\pages\home\_video') ?>

<?= view('App\Views\site\pages\home\_prefs') ?>

<?= view('App\Views\site\pages\home\_numbers') ?>

<?= view_cell('\App\Libraries\Layouts::carusel') ?>

<?= view('App\Views\site\pages\home\_complectacia') ?>

<?= view('App\Views\site\pages\home\_faq') ?>

<?= view('App\Views\site\pages\home\_promo') ?>

<?= view('App\Views\site\pages\home\_projects') ?>

<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/modules/slick/slick.min.js"></script>
<script src="/site/js/home.min.js"></script>
<?= $this->endSection() ?>
