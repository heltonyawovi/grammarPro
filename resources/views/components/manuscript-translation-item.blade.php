
<?php
// echo $requestManuscriptText;
?>
<section id="proofreading" class="ud-about pt-0">
    <div class="container">
        <div class="ud-about-wrapper d-block wow fadeInUp" data-wow-delay=".2s">
            <div class="ud-about-content-wrapper">

                <div class="ud-about-content max-w-fit">
                    <span class="tag bg-success">Translation</span>
                    <h2>Your translated manuscript result is here</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-testimonial-content">
                                    <h3 class="text-danger pb-5">Original</h3>
                                    <p class="">
                                        {{trim($requestManuscriptText)}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-testimonial-content">
                                <h3 class="text-success pb-5">Translated</h3>
                                    <p>
                                        {{trim($data)}}
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