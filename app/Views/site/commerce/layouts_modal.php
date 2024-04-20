<div class="modal fade bd-example-modal-lg" tabindex="-1" id="layout-modal" role="dialog" aria-labelledby="layoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4><?= $data->title?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="layout-modal">

                    <div class="row d-flex align-items-center">
                        <div class="col-12 col-lg-7">
                            <?= img(['src' => 'images/layouts/' . $data->image_2d, 'class' => 'img-fluid']) ?>
                        </div>
                        <div class="col-12 col-lg-5">
                            <dl class="row">
                                <!--<dd class="col-4"><?= $data->sold_out ?> м</dd>-->
                                <dt class="col-8"><?= lang('Site.Layouts.Dt.SeilHeight') ?></dt>
                                <dd class="col-4"><?= $data->ceil_height ?> м</dd>
                                <dt class="col-8"><?= lang('Site.Layouts.Dt.AllArea') ?></dt>
                                <dd class="col-4"><?= $data->all_area ?> м<sup>2</sup></dd>
                            </dl>
                            <a  class="thm-btn thm-bg" href="<?= route_to('App\Controllers\Commerce::view', $data->slug) ?>" title=""><?= lang('Site.Buttons.Details') ?></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

