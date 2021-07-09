<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start':
                            new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-P56NB8V');</script>
        <!-- End Google Tag Manager -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?= $meta_description ?>" />
        <link rel="icon" href="assets/images/favicon.png" sizes="35x35" type="image/png">
        <title><?= $meta_title ?></title>

        <link rel="stylesheet" href="/site/modules/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="/site/css/site.min.css">
        <?= $this->renderSection('pagecss') ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-68275464-10"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-68275464-10');
        </script>
        <script src="//code.jivosite.com/widget/KlsLfikVEM" async></script>

    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P56NB8V"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->        
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
        <script type="text/javascript">
            (function (d, w, s) {
                var widgetHash = 'uqx4ugylsllgfwcf5fi7', gcw = d.createElement(s);
                gcw.type = 'text/javascript';
                gcw.async = true;
                gcw.src = '//widgets.binotel.com/getcall/widgets/' + widgetHash + '.js';
                var sn = d.getElementsByTagName(s)[0];
                sn.parentNode.insertBefore(gcw, sn);
            })(document, window, 'script');
        </script> 
        <script type="text/javascript">
            (function (d, w, s) {
                var widgetHash = 'zwvfo6dcfbdcoh6htaf6', ctw = d.createElement(s);
                ctw.type = 'text/javascript';
                ctw.async = true;
                ctw.src = '//widgets.binotel.com/calltracking/widgets/' + widgetHash + '.js';
                var sn = d.getElementsByTagName(s)[0];
                sn.parentNode.insertBefore(ctw, sn);
            })(document, window, 'script');
        </script> 
    </body>	

</html>