<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>
        <link rel="stylesheet" href="/site/modules/slick/slick.css">

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\pages\home\_slider') ?>

<?= view('App\Views\site\pages\home\_aboutus') ?>

<?= view('App\Views\site\pages\home\_prefs') ?>

<?= view('App\Views\site\pages\home\_news') ?>

<?= view('App\Views\site\pages\home\_subscribe') ?>

<?= view('App\Views\site\pages\home\_faq') ?>
        
<?= view('App\Views\site\pages\home\_promo') ?>
        
<?= view('App\Views\site\pages\home\_projects') ?>
        
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
        <script src="/site/modules/slick/slick.min.js"></script>
        <script src="/site/js/home.min.js"></script>
<?= $this->endSection() ?>
