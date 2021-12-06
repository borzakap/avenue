<form class="contact-form text-center w-100" action="<?= route_to('App\Controllers\Api\ClientsRequestsController::send') ?>" method="post" id="contact-form">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group w-100">
                <div class="response w-100"></div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12">
            <input class="email" type="text" name="phone" placeholder="<?= lang('Site.Popapform.YourPhone') ?>">
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12">
            <textarea class="contact_message" name="text" rows="4" placeholder="<?= lang('Site.Popapform.YourMessage') ?>"></textarea>
            <button class="thm-btn thm-bg" id="submit" type="submit"><?= lang('Site.Popapform.Submit') ?><i class="flaticon-arrow-pointing-to-right"></i></button>
        </div>
    </div>
    <input type="hidden" name="type" id="form-type" value="<?= $form_type ?? ''?>" />
</form><!-- Contact Form -->
