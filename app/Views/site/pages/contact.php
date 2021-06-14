<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>
<link rel="stylesheet" href="/site/modules/slick/slick.css">

<?= $this->endSection() ?>
<?= $this->section('main') ?>
<section>
    <div class="w-100 pt-170 pb-150 dark-layer3 opc7 position-relative">
        <div class="fixed-bg" style="background-image: url(assets/images/pagetop-bg.jpg);"></div>
        <div class="container">
            <div class="page-top-wrap w-100">
                <h1 class="mb-0">Contact Us</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html" title="">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div><!-- Page Top Wrap -->
        </div>
    </div>
</section>
<section>
    <div class="w-100 pt-100 pb-100 position-relative">
        <div class="container">
            <div class="contact-wrap position-relative w-100">
                <div class="contact-map w-100" id="contact-map"></div>
                <div class="contact-info-wrap text-center position-absolute">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="contact-info-box w-100">
                                <i class="thm-clr flaticon-headset"></i>
                                <strong>Our Phone</strong>
                                <span class="d-block">(+555) 666 777 999 00</span>
                                <span class="d-block">(+88) 666 555 222 00</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="contact-info-box w-100">
                                <i class="thm-clr flaticon-mail"></i>
                                <strong>Our Mail Box</strong>
                                <a class="d-block" href="javascript:void(0);" title="">phantom.info@gmail.com</a>
                                <a class="d-block" href="javascript:void(0);" title="">etchenetomi.info@gmail.com</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="contact-info-box w-100">
                                <i class="thm-clr flaticon-placeholder"></i>
                                <strong>Our Location</strong>
                                <p class="mb-0">121 King Street, Melbourne Victoria 3000, Australia</p>
                            </div>
                        </div>
                    </div>
                </div><!-- Contact Info Wrap -->
            </div><!-- Contact Wrap -->
        </div>
    </div>
</section>
<section>
    <div class="w-100 pb-100 position-relative">
        <div class="container">                        
            <div class="sec-title v2 text-center w-100">
                <div class="sec-title-inner d-inline-block">
                    <span class="thm-clr d-block">Contact Us</span>
                    <h2 class="mb-0">Al is no longer a futuristic notion, it's here right now</h2>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <form class="contact-form text-center w-100" action="#" method="post" id="email-form">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="form-group w-100">
                            <div class="response w-100"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label class="d-block">Nick name :</label>
                        <input class="fname" type="text" name="fname">
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <label class="d-block">Email Address :</label>
                        <input class="email" type="email" name="email">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <label class="d-block">Write a message :</label>
                        <textarea class="contact_message" name="contact_message"></textarea>
                        <button class="thm-btn thm-bg" id="submit" type="button">Submit Now Next<i class="flaticon-arrow-pointing-to-right"></i></button>
                    </div>
                </div>
            </form><!-- Contact Form -->
        </div>
    </div>
</section>
<section>
    <div class="w-100 pb-50 position-relative">
        <div class="container">
            <div class="clients-wrap w-100">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <div class="client-box w-100">
                            <a href="javascript:void(0);" title=""><img class="img-fluid" src="assets/images/resources/client-img1-1.png" alt="Client Image 1"></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <div class="client-box w-100">
                            <a href="javascript:void(0);" title=""><img class="img-fluid" src="assets/images/resources/client-img1-2.png" alt="Client Image 2"></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <div class="client-box w-100">
                            <a href="javascript:void(0);" title=""><img class="img-fluid" src="assets/images/resources/client-img1-3.png" alt="Client Image 3"></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <div class="client-box w-100">
                            <a href="javascript:void(0);" title=""><img class="img-fluid" src="assets/images/resources/client-img1-4.png" alt="Client Image 4"></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <div class="client-box w-100">
                            <a href="javascript:void(0);" title=""><img class="img-fluid" src="assets/images/resources/client-img1-5.png" alt="Client Image 5"></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-lg-2">
                        <div class="client-box w-100">
                            <a href="javascript:void(0);" title=""><img class="img-fluid" src="assets/images/resources/client-img1-6.png" alt="Client Image 6"></a>
                        </div>
                    </div>
                </div>
            </div><!-- Clients Wrap -->
        </div>
    </div>
</section>
<section>
    <div class="w-100 position-relative">
        <div class="container">
            <div class="getin-touch-wrap overlap-99 brd-rd5 style2 thm-layer opc8 w-100 overflow-hidden position-relative">
                <div class="fixed-bg" style="background-image: url(assets/images/parallax2.jpg);"></div>
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-7 col-sm-12 col-lg-5">
                        <div class="getin-touch-title w-100">
                            <span class="text-color1 d-block">Ready to get started?</span>
                            <h2 class="mb-0">Get in touch, or create an account</h2>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-lg-4">
                        <div class="getin-touch-btn text-right">
                            <a class="thm-btn bg-color1" href="contact.html" title="">Subscribe Now<i class="flaticon-arrow-pointing-to-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/modules/slick/slick.min.js"></script>
<script src="/site/js/home.min.js"></script>
<?= $this->endSection() ?>
