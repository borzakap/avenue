<div class="menu-wrap">
    <div class="container">
        <nav class="d-inline-flex justify-content-between align-items-center w-100 bg-color1">
            <div class="header-left">
                <ul class="mb-0 list-unstyled d-inline-flex">
                    <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#home"><?= lang('Site.Menue.Main.Home') ?></a></li>
                    <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#about"><?= lang('Site.Menue.Main.About') ?></a></li>
                    <li><a href="<?= route_to('App\Controllers\Pages::index') ?>#prefs"><?= lang('Site.Menue.Main.Prefs') ?></a></li>
                    <li><a href="<?= route_to('App\Controllers\Layouts::genplan', 'default') ?>"><?= lang('Site.Menue.Main.LayoutsGenplan') ?></a></li>
                    <li><a href="<?= route_to('App\Controllers\Commerce::genplan', 'default') ?>"><?= lang('Site.Menue.Main.CommerceGenplan') ?></a></li>
                </ul>
            </div>
            <div class="header-right-btns">
                <a href="#" data-toggle="modal" data-target="#contact-form-modal" data-type="menue" class="get-quote" title=""><i class="far fa-comments"></i><?= lang('Site.Menue.Main.Qoute') ?><i class="flaticon-arrow-pointing-to-right"></i></a>
            </div>
        </nav>
    </div>
</div><!-- Menu Wrap -->
