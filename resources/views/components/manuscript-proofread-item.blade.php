<?php
// echo $requestManuscriptText;
?>
<section id="proofreading" class="ud-about pt-0 diff-container">
    <div class="container">
        <div class="ud-about-wrapper d-block wow fadeInUp" data-wow-delay=".2s">
            <!-- <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s"> -->
            <!-- <div class="ud-about-image">
                <img src="{{asset('theme/assets/images/about/about-image.svg')}}" alt="about-image" />
            </div> -->
            <div class="ud-about-content-wrapper">

                <div class="ud-about-content max-w-fit">
                    <span class="tag bg-success">Proofreading</span>
                    <h2>Your proofread manuscript result is here</h2>
                    <div class="row">
                        <div class="original d-none">{!! nl2br(trim($requestManuscriptText)) !!}</div>
                        <div class="changed  d-none">{!! nl2br(trim($data)) !!}</div>
                        <div class="col-lg-6">
                            <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-testimonial-content">
                                    <h3 class="text-danger pb-5">Changes</h3>
                                    <p class="diff">
                                        {!! nl2br(trim($data)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-testimonial-content">
                                    <h3 class="text-success pb-5">Proofread</h3>
                                    <p>
                                        {!! nl2br(trim($data)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="editor-wysiwyg" class="editor-wysiwyg diff">

                    </div> -->
                </div>

            </div>
        </div>
    </div>
</section>