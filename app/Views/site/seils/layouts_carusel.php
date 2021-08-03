<section>
    <a id="layouts"></a>
    <div class="w-100 pt-210 pb-100 position-relative">
        <div class="container">
            <div class="sec-title w-100">
                <div class="sec-title-inner d-inline-block">
                    <span class="d-block thm-clr"><?= lang('Site.Sections.News.BeforeTitle') ?></span>
                    <h3 class="mb-0"><?= lang('Site.Sections.News.Title') ?></h3>
                </div>
            </div>
            <div class="blog-wrap w-100">
                <div class="row layouts-caro">
                    <?php foreach($layouts as $layout) : ?>
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="layouts-box w-100">
                            <div class="layout-img overflow-hidden w-100 mb-20">
                                <a href="<?= route_to('App\Controllers\Layouts::view', $layout->slug) ?>" title=""><img class="img-fluid w-100" src="/images/layouts/<?= $layout->image_2d ?>" alt="Post Image 1"></a>
                            </div>
                            <dl class="row">
                                <dt class="col-8"><?= lang('Site.Layouts.Dt.AllArea') ?></dt>
                                <dd class="col-4"><?= $layout->all_area ?> м<sup>2</sup></dd>
                                <dt class="col-8"><?= lang('Site.Layouts.Dt.LiveArea') ?></dt>
                                <dd class="col-4"><?= $layout->live_area ?> м<sup>2</sup></dd>
                                <dt class="col-8"><?= lang('Site.Layouts.Dt.KitArea') ?></dt>
                                <dd class="col-4"><?= $layout->kit_area ?> м<sup>2</sup></dd>
                            </dl>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- Blog Wrap -->
            <div class="view-all w-100 text-center">
                <a data-toggle="modal" data-target="#contact-form-modal" data-type="news" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.MoreLayouts') ?></a>
            </div><!-- View All -->
        </div>
    </div>
</section>
