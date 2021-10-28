<div class="rspn-hdr">
    <div class="lg-mn">
        <div class="logo"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img class="img-fluid" src="/site/images/logo-white.png" alt="Logo" srcset="/site/images/logo-white.png" width="131" height="49"></a></div>
        <div class="rspn-cnt">
            <span class="call-us">
                <i class="thm-clr fas fa-phone-alt"></i>
                <strong><a href="tel:<?= $contact_phone ?>" class="binct-phone-number-1"><?= $contact_phone ?></a></strong>
            </span>
            <span class="social-links">
                <?php foreach ($socials as $name => $link) : ?>
                    <a href="<?= $link ?>" title="<?= $name ?>" target="_blank"><i class="fab fa-<?= strtolower($name) ?>"></i></a>
                <?php endforeach; ?>
            </span>
        </div>
        <span class="rspn-mnu-btn"><i class="fas fa-bars"></i></span>
    </div>
    <div class="rsnp-mnu">
        <span class="rspn-mnu-cls"><i class="fa fa-times"></i></span>
        <ul class="mb-0 list-unstyled w-100">
            <?= view('App\Views\site\_menu_list') ?>
        </ul>
    </div><!-- Responsive Menu -->
</div><!-- Responsive Header -->
