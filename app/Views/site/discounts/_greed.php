<?php foreach($items as $item) : ?>
<div class="col-4">
    <div class="progress-box readmore-box">
        <div class="image-box">
            <figure class="image-wraper">
                <img class="img-fluid w-100" src="/images/discounts/<?= $item->image ?>" alt="<?= $item->title ?>">
            </figure>
            <a href="<?= route_to('App\Controllers\Discounts::view', $item->slug) ?>" title=""><i class="fas fa-search-plus"></i></i></a>
        </div>
        <div class="progress-info">
            <h3 class="mb-0"><a href="<?= route_to('App\Controllers\Progress::view', $item->slug) ?>" title=""><?= $item->title ?></a></h3>
        </div>
    </div>
</div>
<?php endforeach; ?>


