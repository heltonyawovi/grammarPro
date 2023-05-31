<?php
// echo $requestManuscriptText;
?>
<section id="proofreading" class="ud-about pt-0">
    <div class="container">
        <div class="ud-about-wrapper d-block wow fadeInUp" data-wow-delay=".2s">
            <div class="ud-about-content-wrapper">

                <div class="ud-about-content max-w-fit">
                    <span class="tag bg-success">Reference Checking</span>
                    <h2>Your corrected references list is here</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-testimonial-content">
                                    <h3 class="text-danger pb-5">Original</h3>
                                    <p class="">
                                        {!! nl2br(trim($requestManuscriptText)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-testimonial-content">
                                    <h3 class="text-success pb-5">Checked</h3>
                                    <p>
                                        {!! nl2br(trim($data)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>