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
                    <?= view('App\Views\site\layouts\_layouts_greed') ?>
                </div>
            </div><!-- Blog Wrap -->
            <div class="view-all w-100 text-center">
                <a data-toggle="modal" data-target="#contact-form-modal" data-type="news" class="thm-btn thm-bg" href="#" title=""><?= lang('Site.Buttons.MoreLayouts') ?></a>
            </div><!-- View All -->
        </div>
    </div>
</section>
