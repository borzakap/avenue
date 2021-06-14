<div class="rspn-hdr">
    <div class="rspn-mdbr">
        <div class="rspn-scil">
            <?php foreach($socials as $name => $link) : ?>
            <a href="<?= $link ?>" title="<?= $name ?>" target="_blank"><i class="fab fa-<?= strtolower($name) ?>"></i></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="lg-mn">
        <div class="logo"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img src="/site/images/logo-60.png" alt="Logo"></a></div>
        <div class="rspn-cnt">
            <span><i class="thm-clr far fa-envelope-open"></i><a href="javascript:void(0);" title="">bioxin0011@gmail.com</a></span>
            <span><i class="thm-clr fas fa-map-marker-alt"></i>27 Division, mirpur-12, pallbi.</span>
        </div>
        <span class="rspn-mnu-btn"><i class="fa fa-list-ul"></i></span>
    </div>
    <div class="rsnp-mnu">
        <span class="rspn-mnu-cls"><i class="fa fa-times"></i></span>
        <ul class="mb-0 list-unstyled w-100">
            <li><a href="<?= route_to('App\Controllers\Pages::index') ?>" title=""><?= lang('Menu.Home') ?></a></li>
            <li><a href="<?= route_to('App\Controllers\Pages::index') ?>" title=""><?= lang('Menu.About') ?></a></li>
            <li><a href="<?= route_to('App\Controllers\Pages::contact') ?>" title=""><?= lang('Menu.Contact') ?></a></li>
        </ul>
    </div><!-- Responsive Menu -->
</div><!-- Responsive Header -->
