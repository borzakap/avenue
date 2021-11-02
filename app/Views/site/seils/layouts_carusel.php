<section>
    <a id="layouts"></a>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <div class="sec-title w-100">
                <div class="sec-title-inner d-inline-block">
                    <span class="d-block theme-pre-heading"><?= lang('Site.Sections.News.BeforeTitle') ?></span>
                    <h3 class="mb-0 theme-heading"><?= lang('Site.Sections.News.Title') ?></h3>
                </div>
            </div>
            <div class="blog-wrap w-100">
                <div class="row layouts-caro">
                    <?= view('App\Views\site\layouts\_layouts_greed') ?>
                </div>
            </div><!-- Blog Wrap -->
            <div class="view-all w-100 text-center mt-5">
                <a class="thm-btn thm-bg" href="<?= route_to('App\Controllers\Layouts::filter', 'default') ?>" title=""><?= lang('Site.Buttons.MoreLayouts') ?></a>
            </div><!-- View All -->
        </div>
    </div>
</section>
