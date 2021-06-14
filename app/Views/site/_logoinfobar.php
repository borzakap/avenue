<div class="logo-info-bar-wrap w-100">
    <div class="container">
        <div class="logo-info-bar-inner w-100 d-flex flex-wrap justify-content-between align-items-center">
            <div class="logo-social d-inline-flex flex-wrap justify-content-between align-items-center">
                <div class="logo"><h1 class="mb-0"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img class="img-fluid" src="/site/images/logo-60.png" alt="Logo" srcset="/site/images/logo-60.png"></a></h1></div><!-- Logo -->
                <div class="social-links">
                    <?php foreach($socials as $name => $link) : ?>
                    <a href="<?= $link ?>" title="<?= $name ?>" target="_blank"><i class="fab fa-<?= strtolower($name) ?>"></i></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="top-info-wrap d-inline-flex flex-wrap justify-content-between align-items-center">
                <div class="call-us">
                    <i class="thm-clr flaticon-phone-call"></i>
                    <span>24/7 Phone Services</span>
                    <strong><?= $contact_phone ?></strong>
                </div>
                <div class="add-cart">
                    <a href="<?= route_to('App\Controllers\Pages::index') ?>" title="">
                        <i class="thm-bg fas fa-gem"></i>
                        Add to Cart
                        <span class="d-block">(Item: 02)</span>
                    </a>
                </div>
            </div>                            
        </div>
    </div>
</div><!-- Logo Info Bar Wrap -->
