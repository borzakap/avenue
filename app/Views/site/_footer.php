<footer>
    <div class="w-100 dark-bg pt-100 position-relative">
        <div class="container">
            <div class="footer-data w-100">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="widget w-100">
                            <div class="logo w-100"><h1 class="mb-0"><a href="<?= route_to('App\Controllers\Pages::index') ?>" title="Home"><img class="img-fluid" src="/site/images/logo-white.png" alt="Logo" srcset="/site/images/logo-white.png"></a></h1></div><!-- Logo -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-9">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="widget w-100">
                                    <h3><?= lang('Site.Footer.TimeOfWorkTitle') ?></h3>
                                    <p class="mb-0"><?= lang('Site.Footer.TimeOfWorkLineOne') ?></p>
                                    <p class="mb-0"><?= lang('Site.Footer.TimeOfWorkLineTwo') ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="widget w-100">
                                    <h3><?= lang('Site.Footer.AddressTitle') ?></h3>
                                    <p class="mb-0"><?= lang('Site.Footer.AddressLineOne') ?></p>
                                    <p class="mb-0"><a href="tel:<?= $contact_phone ?>" class="binct-phone-number-1"><?= $contact_phone ?></a></p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <div class="widget w-100">
<!--                                    <h3>Quick Links</h3>
                                    <ul class="mb-0 list-unstyled w-100">
                                        <li><a href="projects.html" title="">Our Work</a></li>
                                        <li><a href="team.html" title="">Our Workers</a></li>
                                        <li><a href="shop.html" title="">Our Shop</a></li>
                                        <li><a href="services.html" title="">Services We Offers</a></li>
                                    </ul>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Footer Data -->
        </div>
        <div class="footer-mdbr">
            <div class="footer-scil">
                <?php foreach ($socials as $name => $link) : ?>
                    <a href="<?= $link ?>" title="<?= $name ?>" target="_blank"><i class="fab fa-<?= strtolower($name) ?>"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>    
</footer>
