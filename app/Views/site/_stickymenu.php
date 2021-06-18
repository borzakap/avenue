<div class="sticky-menu">
    <div class="container">
        <div class="sticky-menu-inner d-flex flex-wrap align-items-center justify-content-between w-100">
            <div class="logo"><h1 class="mb-0"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img class="img-fluid" src="/site/images/logo-60.png" alt="Logo" srcset="/site/images/logo-60.png"></a></h1></div><!-- Logo -->
            <nav class="d-inline-flex justify-content-between align-items-center">
                <div class="header-left">
                    <ul class="mb-0 list-unstyled d-inline-flex">
                        <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#home"><?= lang('Site.Menue.Main.Home') ?></a></li>
                        <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#about"><?= lang('Site.Menue.Main.About') ?></a></li>
                        <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#layouts"><?= lang('Site.Menue.Main.Layouts') ?></a></li>
                        <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#prefs"><?= lang('Site.Menue.Main.Prefs') ?></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div><!-- Sticky Menu -->
