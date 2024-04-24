<?php foreach($items as $item) : ?>
<div class="col-lg-6 col-md-12">
    <div class="discounts-box readmore-box row m-0">
        <div class="image-box col-md-6 col-sm-12">
            <figure class="image-wraper">
                <img class="img-fluid w-100" src="/images/discounts/<?= $item->image ?>" alt="<?= $item->title ?>">
            </figure>
            <a href="<?= route_to('App\Controllers\Discounts::view', $item->slug) ?>" title=""><i class="fas fa-search-plus"></i></i></a>
        </div>
        <div class="progress-info col-md-6 col-sm-12 p-2 d-flex flex-wrap align-content-between">
            <span class="info-pannel mb-2"><?= $item->date_to_string ?></span>
            <h3 class="mb-0"><a href="<?= route_to('App\Controllers\Discounts::view', $item->slug) ?>" title=""><?= $item->title ?></a></h3>
            <a class="thm-btn" href="<?= route_to('App\Controllers\Discounts::view', $item->slug) ?>" title=""><?= lang('Site.Buttons.LearnMore') ?></a>
        </div>
    </div>
</div>
<?php endforeach; ?>


