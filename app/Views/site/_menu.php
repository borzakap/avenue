<div class="menu-wrap">
    <div class="container">
        <nav class="d-inline-flex justify-content-between align-items-center w-100 bg-color1">
            <div class="header-left">
                <ul class="mb-0 list-unstyled d-inline-flex">
                    <li><a href="<?= route_to('App\Controllers\Pages::index') ?>" title=""><?= lang('Menu.Home') ?></a></li>
                    <li><a href="<?= route_to('App\Controllers\Pages::index') ?>" title=""><?= lang('Menu.About') ?></a></li>
                    <li><a href="<?= route_to('App\Controllers\Pages::contact') ?>" title=""><?= lang('Menu.Contact') ?></a></li>
                </ul>
            </div>
            <div class="header-right-btns">
                <a href="#" data-toggle="modal" data-target="#contact-form-modal" data-type="menue" class="get-quote" title=""><i class="far fa-comments"></i><?= lang('Menu.Qoute') ?><i class="flaticon-arrow-pointing-to-right"></i></a>
            </div>
        </nav>
    </div>
</div><!-- Menu Wrap -->
