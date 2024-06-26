<li><a href="<?= route_to('App\Controllers\Pages::index') ?>#home"><?= lang('Site.Menue.Main.Home') ?></a></li>
<li class="menu-item-has-children">
    <a href="<?= route_to('App\Controllers\Pages::index') ?>#about"><?= lang('Site.Menue.Main.About') ?></a>
    <ul class="mb-0 list-unstyled">
        <li><a href="<?= route_to('App\Controllers\Progress::list', 'default') ?>" title=""><?= lang('Site.Menue.Main.Progress') ?></a></li>
    </ul>
</li>
<li class="menu-item-has-children">
    <a href="javascript:void(0);"><?= lang('Site.Menue.Main.LayoutsMenuSet') ?></a>
    <ul class="mb-0 list-unstyled">
        <li><a href="<?= route_to('App\Controllers\Layouts::genplan', 'default') ?>" title=""><?= lang('Site.Menue.Main.LayoutsGenplan') ?></a></li>
        <li><a href="<?= route_to('App\Controllers\Layouts::filter', 'default') ?>" title=""><?= lang('Site.Menue.Main.LayoutsFilter') ?></a></li>
        <li><a href="<?= route_to('App\Controllers\Layouts::wishlist', 'default') ?>" title=""><?= lang('Site.Menue.Main.LayoutsWishlist') ?></a></li>
    </ul>
</li>
<li class="menu-item-has-children">
    <a href="<?= route_to('App\Controllers\Commerce::genplan', 'default') ?>"><?= lang('Site.Menue.Main.CommerceGenplan') ?></a>
    <ul class="mb-0 list-unstyled">
        <li><a href="<?= route_to('App\Controllers\Commerce::genplan', 'default') ?>"><?= lang('Site.Menue.Main.CommerceGenplan') ?></a></li>
        <li><a href="<?= route_to('App\Controllers\Pages::mall') ?>" title="">Avenue Mall</a></li>
    </ul>
</li>
<li><a href="<?= route_to('App\Controllers\Discounts::list', 'default') ?>"><?= lang('Site.Menue.Main.Discounts') ?></a></li>
