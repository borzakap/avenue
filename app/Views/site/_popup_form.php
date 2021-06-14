<div class="modal fade" id="contact-form-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- comment -->
            <div class="modal-body">
                <form class="contact-form text-center w-100" action="<?= route_to('App\Controllers\Api\ClientsRequestsController::send') ?>" method="post" id="contact-form">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group w-100">
                                <div class="response w-100"></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <input class="fname" type="text" name="name" placeholder="Nick name">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <input class="email" type="text" name="phone" placeholder="Phone">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <input class="email" type="email" name="email" placeholder="Email">
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <textarea class="contact_message" name="text" placeholder="Your message"></textarea>
                            <button class="thm-btn thm-bg" id="submit" type="submit">Submit Now Next<i class="flaticon-arrow-pointing-to-right"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="type" id="form-type" value="" />
                </form><!-- Contact Form -->
            </div>
        </div>
    </div>
</div>