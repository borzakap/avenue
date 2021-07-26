<div class="layout-modal">
    <div class="row d-flex align-items-center">
        <div class="col-12 col-lg-7">
            <?= img(['src' => 'images/layouts/' . $data->image_2d, 'class' => 'img-fluid']) ?>
        </div>
        <div class="col-12 col-lg-5">
            <dl class="row">
                <dt class="col-8"><?= lang('Site.Layouts.Dt.SeilHeight') ?></dt>
                <dd class="col-4"><?= $data->ceil_height ?> м</dd>
                <dt class="col-8"><?= lang('Site.Layouts.Dt.Rooms') ?></dt>
                <dd class="col-4"><?= $data->rooms ?></dd>
                <dt class="col-8"><?= lang('Site.Layouts.Dt.AllArea') ?></dt>
                <dd class="col-4"><?= $data->all_area ?> м<sup>2</sup></dd>
                <dt class="col-8"><?= lang('Site.Layouts.Dt.LiveArea') ?></dt>
                <dd class="col-4"><?= $data->live_area ?> м<sup>2</sup></dd>
                <dt class="col-8"><?= lang('Site.Layouts.Dt.KitArea') ?></dt>
                <dd class="col-4"><?= $data->kit_area ?> м<sup>2</sup></dd>
            </dl>
        </div>
    </div>
</div>

