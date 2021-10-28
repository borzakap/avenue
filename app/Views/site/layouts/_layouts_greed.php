<?php foreach ($layouts as $layout) : ?>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="layouts-box w-100">
            <div class="layout-img w-100 position-relative overflow-hidden">
                <div class="layout-img-wraper">
                    <img class="img-fluid w-100" src="/images/layouts/<?= $layout->image_2d ?>" alt="<?= $layout->title ?>">
                </div>
                <a href="<?= route_to('App\Controllers\Layouts::view', $layout->slug) ?>" title=""><i class="fas fa-search-plus"></i></i></a>
            </div>
            <div class="layout-info w-100">
                <h3 class="mb-2"><a href="<?= route_to('App\Controllers\Layouts::view', $layout->slug) ?>"><?= $layout->title ?></a></h3>
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
    </div>
<?php endforeach; ?>
