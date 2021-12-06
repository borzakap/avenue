<div class="site-modal fade" id="contact-form-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('Site.Popapform.Title') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- comment -->
            <div class="modal-body">
                <?= view('App\Views\site\_contact_form') ?>
            </div>
        </div>
    </div>
</div>