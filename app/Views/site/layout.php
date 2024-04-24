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
        <title><?= $meta_title ?></title>

        <link rel="stylesheet" href="/site/modules/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="/site/css/site.css">
        <?= $this->renderSection('pagecss') ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-FH5VW4BFCG"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-FH5VW4BFCG');
        </script>
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}
        (window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1092865188668898');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1092865188668898&ev=PageView&noscript=1"
                   /></noscript>
    <!-- End Meta Pixel Code -->
    <!--    adsquiz.io-->
    <link href="https://services.adsquiz.io/adsquiz_integration/adsquizstyle_integration.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://services.adsquiz.io/adsquiz_integration/adsquizscript_intpopup.js" data-vidget-popup></script>
    <script type="text/javascript"> 
        window.onload = function() {createAdsquizIframe("https://avenue.adsquiz.io?int_q=popup&utm_source=vidget_popup",10000,2);};
    </script>
    <!--    adsquiz.io-->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P56NB8V"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->        
    <main>
        <header class="stick style1 w-100">
            <!-- logo info bar -->
            <?= view('App\Views\site\_logoinfobar') ?>
        </header><!-- Header -->
        <!-- responsive header -->
        <?= view('App\Views\site\_stickymenu') ?>
        <!-- responsive header -->
        <?= view('App\Views\site\_responsiveheader') ?>

        <?= $this->renderSection('main') ?>

        <!-- footer -->
        <?= view('App\Views\site\_footer') ?>

        <?= view('App\Views\site\_popup_form') ?>
        <?= $this->renderSection('aftermain') ?>
    </main><!-- Main Wrapper -->
    <script src="/site/modules/jquery/jquery.min.js"></script>
    <script src="/site/modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/site/js/bootstrap-select.min.js"></script>
    <script src="/site/js/common.min.js"></script>
    <script src="/site/js/favorite.min.js"></script>
    <?= $this->renderSection('pagejs') ?>
<script type="text/javascript">
  (function(d, w, s) {
	var widgetHash = 'viqrt41o5n36nroq2ew9', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
	gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
	var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
  })(document, window, 'script');
</script> 
</script> 
    <script type="text/javascript">
    (function(d, w, s) {
        var widgetHash = 'buden7ow3m5on5il2ink', ctw = d.createElement(s); ctw.type = 'text/javascript'; ctw.async = true;
        ctw.src = '//widgets.binotel.com/calltracking/widgets/'+ widgetHash +'.js';
        var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(ctw, sn);
    })(document, window, 'script');
    </script> 
    <script type="text/javascript">
        (function(d, w, s) {
            var widgetHash = 'TNMDDWZMAVxdJXGdZ0dI', bch = d.createElement(s); bch.type = 'text/javascript'; bch.async = true;
            bch.src = '//widgets.binotel.com/chat/widgets/' + widgetHash + '.js';
            var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(bch, sn);
        })(document, window, 'script');
    </script>
</body>	

</html>