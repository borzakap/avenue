<div class="sticky-menu">
    <div class="container">
        <div class="sticky-menu-inner d-flex flex-wrap align-items-center justify-content-between w-100">
            <div class="logo"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img class="img-fluid" src="/site/images/logo-white.png" alt="Logo" srcset="/site/images/logo-white.png" width="131" height="49"></a></div><!-- Logo -->
            <div class="d-inline-flex justify-content-between align-items-center bg-white">
                <div class="social-links">
                    <?php foreach ($socials as $name => $link) : ?>
                        <a href="<?= $link ?>" title="<?= $name ?>" target="_blank"><i class="fab fa-<?= strtolower($name) ?>"></i></a>
                    <?php endforeach; ?>
                </div>
                <nav class="d-inline-flex justify-content-between align-items-center">
                    <div class="header-left">
                        <ul class="mb-0 list-unstyled d-inline-flex">
                            <?= view('App\Views\site\_menu_list') ?>
                        </ul>
                    </div>
                </nav>
                <div class="header-right-btns">
                    <a href="#" data-toggle="modal" data-target="#contact-form-modal" data-type="menue" class="get-quote" title=""><i class="far fa-comments"></i><?= lang('Site.Menue.Main.Qoute') ?><i class="flaticon-arrow-pointing-to-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div><!-- Sticky Menu -->
