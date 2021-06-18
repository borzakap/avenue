<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?= $meta_description ?>" />
        <link rel="icon" href="assets/images/favicon.png" sizes="35x35" type="image/png">
        <title><?= $meta_title ?></title>

        <link rel="stylesheet" href="/site/modules/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="/site/css/site.min.css">
        <?= $this->renderSection('pagecss') ?>
    </head>
    <body>
        <main>
            <header class="stick style1 w-100">
                <!-- top bar -->
                <?= view('App\Views\site\_topbar') ?>
                <!-- logo info bar -->
                <?= view('App\Views\site\_logoinfobar') ?>
                <!-- logo info bar -->
                <?= view('App\Views\site\_menu') ?>

            </header><!-- Header -->
            <!-- logo info bar -->
            <?= view('App\Views\site\_stickymenu') ?>
            <!-- responsive header -->
            <?= view('App\Views\site\_responsiveheader') ?>
            
            <?= $this->renderSection('main') ?>

            <!-- footer -->
            <?= view('App\Views\site\_footer') ?>
            
        <?= view('App\Views\site\_popup_form') ?>
        </main><!-- Main Wrapper -->

        <script src="/site/modules/jquery/jquery.min.js"></script>
        <script src="/site/modules/bootstrap/js/bootstrap.min.js"></script>
        <script src="/site/js/common.min.js"></script>
        <?= $this->renderSection('pagejs') ?>
    </body>	
    
</html>