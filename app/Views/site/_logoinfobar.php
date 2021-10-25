<div class="logo-info-bar-wrap">
    <div class="logo-info-bar-inner">
        <div class="logo-info-bar">
            <div class="logo"><h1 class="mb-0"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img class="img-fluid" src="/site/images/logo-white.png" alt="Logo" srcset="/site/images/logo-white.png" width="190" height="72"></a></h1></div><!-- Logo -->
            <div class="afterlogo-wrap">
                <div class="logo-social">
                    <div class="social-links">
                        <?php foreach ($socials as $name => $link) : ?>
                            <a href="<?= $link ?>" title="<?= $name ?>" target="_blank"><i class="fab fa-<?= strtolower($name) ?>"></i></a>
                            <?php endforeach; ?>
                    </div>
                </div>
                <div class="aftersocials-wrap">
                    <div class="call-us">
                        <i class="thm-clr flaticon-phone-call"></i>
                        <strong><a href="tel:<?= $contact_phone ?>" class="binct-phone-number-1"><?= $contact_phone ?></a></strong>
                    </div>
                    <div class="lang-changer-wrap">
                        <?= view_cell('\App\Libraries\LangChanger::langesLinks') ?>
                    </div>
                </div>
           </div>
        </div>
        <?= view('App\Views\site\_menu') ?>
    </div>
</div><!-- Logo Info Bar Wrap -->
