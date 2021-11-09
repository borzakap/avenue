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
                <?php if($layout->price > 0) : ?>
                <div class="pannel-price">
                    <span><?= $layout->price ?> $/м<sup>2</sup></span>
                </div>
                <?php endif; ?>
                <div class="pannel-area">
                    <span><?= lang('Site.Layouts.Texts.Rooms', ['count' => $layout->rooms]) ?>,</span>
                    <span><?= $layout->all_area ?> м<sup>2</sup></span>
                </div>
                <div class="pannel-location">
                    <span><?= $layout->withSection()->section->title ?></span>
                    <span><?= lang('Site.Layouts.Texts.Floors') ?> <?= $layout->withFloorImage()->floor_image->image_code ?></span>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
