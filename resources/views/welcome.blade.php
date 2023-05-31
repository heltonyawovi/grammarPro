<?php

//use App\Http\Controllers\Request\BaseApiRequest;

use App\Helpers\Helpers;
use App\Http\Controllers\Request\BaseApiRequest;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GrammarPro</title>

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{asset('theme/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/assets/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/assets/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('theme/assets/css/ud-styles.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('theme/assets/css/filepond.css')}}">

    <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css">

    <link rel="stylesheet" href="{{asset('css/design.css')}}">


    @yield('page-css')


</head>

<body>
    <!-- ====== Header Start ====== -->
    <header class="ud-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand pt-2 pb-2" href="index.html">
                            <img src="{{asset('theme/assets/images/logo/logo-2.png')}}" alt="Logo" />
                        </a>
                        <button class="navbar-toggler">
                            <span class="toggler-icon"> </span>
                            <span class="toggler-icon"> </span>
                            <span class="toggler-icon"> </span>
                        </button>

                        <div class="navbar-collapse">
                            <ul id="nav" class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#home">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#features">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#proofreading">Proofreading</a>
                                </li>
                                <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#translation">Translation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#reference-check">Reference Checker</a>
                                </li>
                            </ul>
                        </div>

                        <!-- <div class="navbar-btn d-none d-sm-inline-block">
                <a href="login.html" class="ud-main-btn ud-login-btn">
                  Sign In
                </a>
                <a class="ud-main-btn ud-white-btn" href="javascript:void(0)">
                  Sign Up
                </a>
              </div> -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ====== Header End ====== -->

    <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
                        <h1 class="ud-hero-title">
                            Advanced Grammar Tool for Proofreading and Translation
                        </h1>
                        <p class="ud-hero-desc">
                            Use our advanced proofreading and translation tools for your writing. Built on top of ChatGPT to
                            give quality results
                        </p>
                        <ul class="ud-hero-buttons">
                            <li>
                                <a href="#proofreading" class="ud-main-btn ud-white-btn ud-menu-scroll">
                                    Proofread now
                                </a>
                            </li>
                            <li>
                                <a href="#translation" class="ud-main-btn ud-link-btn ud-menu-scroll">
                                    Translate a content <i class="lni lni-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== Features Start ====== -->
    <section id="features" class="ud-features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-section-title">
                        <span>Features</span>
                        <h2>Main Features</h2>
                        <p>
                            GrammarPro is a multi-functionality tool out of the box
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
                        <div class="ud-feature-icon">
                            <i class="lni lni-gift"></i>
                        </div>
                        <div class="ud-feature-content">
                            <h3 class="ud-feature-title">Proofreading</h3>
                            <p class="ud-feature-desc">
                                Reviewing written content to correct errors, improve clarity, grammar, and ensure accuracy and coherence.
                            </p>
                            <a href="#proofreading" class="ud-feature-link ud-menu-scroll">
                                Proofread Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
                        <div class="ud-feature-icon">
                            <i class="lni lni-move"></i>
                        </div>
                        <div class="ud-feature-content">
                            <h3 class="ud-feature-title">Translation</h3>
                            <p class="ud-feature-desc">
                                Converting written text from one language to another while maintaining accuracy, meaning, and cultural nuances.
                            </p>
                            <a href="#translation" class="ud-feature-link ud-menu-scroll">
                                Translate Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
                        <div class="ud-feature-icon">
                            <i class="lni lni-layout"></i>
                        </div>
                        <div class="ud-feature-content">
                            <h3 class="ud-feature-title">Reference Checking</h3>
                            <p class="ud-feature-desc">
                                Verifying the accuracy, reliability, and credibility of information by cross-referencing with trusted sources or citations.
                            </p>
                            <a href="#reference-check" class="ud-feature-link ud-menu-scroll">
                                Check Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-6">
                    <div class="ud-single-feature wow fadeInUp" data-wow-delay=".25s">
                        <div class="ud-feature-icon">
                            <i class="lni lni-layers"></i>
                        </div>
                        <div class="ud-feature-content">
                            <h3 class="ud-feature-title">All in one solution</h3>
                            <p class="ud-feature-desc">
                                A comprehensive solution that combines proofreading, translation, and reference checking for accurate and high-quality content.
                            </p>
                            <a href="#home" class="ud-feature-link ud-menu-scroll">
                                Start Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Features End ====== -->

    <!-- ====== Proofreading Start ====== -->
    <section id="proofreading" class="ud-about pb-0">
        <div class="container">
            <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                <div class="ud-about-content-wrapper">
                    <form class="form form-vertical form-grammarPro" data-target="proofreading" id="form-grammarPro" action="{{route('manuscript.support.from.text.file').'/'}}" method="GET" data-task="{{BaseApiRequest::API_LLM_STUDENT_TASK_PROOFREAD_VALUE}}" data-params="">
                        @csrf
                        <div class="ud-about-content">
                            <span class="tag">Proofreading</span>
                            <h2>Proofread your manuscript via text or document</h2>
                            <div class="row mb-3">
                                <div class="col-12">

                                    <div class="form-group mb-5">
                                        <div class="mb-2">Put your full text here</div>
                                        <!-- <label for="first-name-vertical">Your full manuscript content</label> -->
                                        <textarea id="manuscript-textarea" class="form-control manuscript-textarea" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_TEXT}}" rows="10" placeholder="Your full text here."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-2">Or drag your file here</div>
                                        <!-- Basic file uploader -->
                                        <input type="file" class="filepond manuscript-file" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_FILE}}" data-url="{{route('manuscript.support.file.upload').'/'}}">
                                    </div>
                                </div>
                            </div>
                            <button class="ud-main-btn" type="submit">Proofread now!</button>
                            <div class="d-none mt-5 align-items-center loading-components">
                                <strong>Loading...</strong>
                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ud-about-image">
                    <img src="{{asset('theme/assets/images/about/about-image.svg')}}" alt="about-image" />
                </div>
            </div>
        </div>

    </section>
    <div class="results-container pb-10" data-target="proofreading">
        <div class="result-list" data-target="proofreading">

            <!-- <section id="proofreading" class="ud-about pt-0">
            <div class="container">
                <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                    <div class="ud-about-image">
                        <img src="{{asset('theme/assets/images/about/about-image.svg')}}" alt="about-image" />
                    </div>
                    <div class="ud-about-content-wrapper">

                        <div class="ud-about-content">
                            <span class="tag bg-success">Proofreading</span>
                            <h2>Your proofread manuscript result is here</h2>
                            <div id="editor-wysiwyg" class="editor-wysiwyg result-list">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section> -->
        </div>
    </div>
    <!-- ====== Proofreading End ====== -->


    <!-- ====== Translation Start ====== -->
    <section id="translation" class="ud-about pb-0">
        <div class="container">
            <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                <div class="ud-about-image">
                    <img src="{{asset('theme/assets/images/about/about-image.svg')}}" alt="about-image" />
                </div>
                <div class="ud-about-content-wrapper">
                    <form class="form form-vertical form-grammarPro" id="form-grammarPro" data-target="translation" action="{{route('manuscript.support.from.text.file').'/'}}" method="GET" data-task="{{BaseApiRequest::API_LLM_STUDENT_TASK_TRANSLATION_VALUE}}" data-params="lang=en">
                        @csrf
                        <div class="ud-about-content">
                            <span class="tag bg-warning">Translation</span>
                            <h2>Translate from any language to English</h2>
                            <div class="row mb-3">
                                <div class="col-12">

                                    <div class="form-group mb-5">
                                        <div class="mb-2">Put your full text here</div>
                                        <!-- <label for="first-name-vertical">Your full manuscript content</label> -->
                                        <textarea id="manuscript-textarea" class="form-control manuscript-textarea" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_TEXT}}" rows="10" placeholder="Your full text here."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-2">Or drag your file here</div>
                                        <!-- Basic file uploader -->
                                        <input type="file" class="filepond manuscript-file" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_FILE}}" data-url="{{route('manuscript.support.file.upload').'/'}}">
                                    </div>
                                </div>
                            </div>
                            <button class="ud-main-btn bg-warning" type="submit">Translate now!</button>
                            <div class="d-none mt-5 align-items-center loading-components">
                                <strong>Loading...</strong>
                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <div class="results-container pb-10" data-target="translation">
        <div class="result-list" data-target="translation">
        </div>
    </div>
    <!-- ====== Translation End ====== -->


    <!-- ====== Reference Checking Start ====== -->
    <section id="reference-check" class="ud-about pb-0">
        <div class="container">
            <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                <div class="ud-about-content-wrapper">
                    <form class="form form-vertical form-grammarPro" id="form-grammarPro" data-target="reference-check" action="{{route('manuscript.support.from.text.file').'/'}}" method="GET" data-task="{{BaseApiRequest::API_LLM_STUDENT_TASK_REFERENCE_CHECKING_VALUE}}" data-params="">
                        @csrf
                        <div class="ud-about-content">
                            <span class="tag bg-dark">Reference Checking</span>
                            <h2>Check and fix manuscript references</h2>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group mb-5">
                                        <div class="mb-2">Put your references list here</div>
                                        <!-- <label for="first-name-vertical">Your full manuscript content</label> -->
                                        <textarea id="manuscript-textarea" class="form-control manuscript-textarea" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_TEXT}}" rows="10" placeholder="Your references list here."></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="ud-main-btn bg-dark" type="submit">Check now!</button>
                            <div class="d-none mt-5 align-items-center loading-components">
                                <strong>Loading...</strong>
                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="ud-about-image">
                    <img src="{{asset('theme/assets/images/about/about-image.svg')}}" alt="about-image" />
                </div>
            </div>
        </div>

    </section>
    <div class="results-container pb-10" data-target="reference-check">
        <div class="result-list" data-target="reference-check">
        </div>
    </div>
    <!-- ====== Reference Checking End ====== -->


    <div class="pb-5 pt-5" style="background: #f3f4fe;"></div>

    <!-- ====== Footer Start ====== -->
    <footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
        <div class="shape shape-1">
            <img src="{{asset('theme/assets/images/footer/shape-1.svg')}}" alt="shape" />
        </div>
        <div class="shape shape-2">
            <img src="{{asset('theme/assets/images/footer/shape-2.svg')}}" alt="shape" />
        </div>
        <div class="shape shape-3">
            <img src="{{asset('theme/assets/images/footer/shape-3.svg')}}" alt="shape" />
        </div>
        <div class="ud-footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="ud-widget">
                            <a href="index.html" class="ud-footer-logo">
                                <img src="{{asset('theme/assets/images/logo/logo.png')}}" alt="logo" />
                            </a>
                            <p class="ud-widget-desc">
                                A comprehensive solution that combines proofreading, translation, and reference checking for accurate and high-quality content.
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="ud-widget">
                            <h5 class="ud-widget-title">Proofreading</h5>

                            <p class="ud-widget-desc">
                                Reviewing written content to correct errors, improve clarity, grammar, and ensure accuracy and coherence.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="ud-widget">
                            <h5 class="ud-widget-title">Translation</h5>
                            <p class="ud-widget-desc">
                                Converting written text from one language to another while maintaining accuracy, meaning, and cultural nuances.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="ud-widget">
                            <h5 class="ud-widget-title">Reference Checking</h5>
                            <p class="ud-widget-desc">
                                Verifying the accuracy, reliability, and credibility of information by cross-referencing with trusted sources or citations.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ud-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="ud-footer-bottom-left">
                            <li>
                                <a href="javascript:void(0)">Privacy policy</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Support policy</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Terms of service</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <p class="ud-footer-bottom-right">
                            Designed and Developed by
                            <a href="https://uideck.com" rel="nofollow">Florence G.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
        <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->

    <script src="{{asset('js/vendor/jquery.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/main.js')}}"></script>
    <script>
        // ==== for menu scroll
        const pageLink = document.querySelectorAll(".ud-menu-scroll");

        pageLink.forEach((elem) => {
            elem.addEventListener("click", (e) => {
                e.preventDefault();
                document.querySelector(elem.getAttribute("href")).scrollIntoView({
                    behavior: "smooth",
                    offsetTop: 1 - 60,
                });
            });
        });

        // section menu active
        function onScroll(event) {
            const sections = document.querySelectorAll(".ud-menu-scroll");
            const scrollPos =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop;

            for (let i = 0; i < sections.length; i++) {
                const currLink = sections[i];
                const val = currLink.getAttribute("href");
                const refElement = document.querySelector(val);
                const scrollTopMinus = scrollPos + 73;
                if (
                    refElement.offsetTop <= scrollTopMinus &&
                    refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
                ) {
                    document
                        .querySelector(".ud-menu-scroll")
                        .classList.remove("active");
                    currLink.classList.add("active");
                } else {
                    currLink.classList.remove("active");
                }
            }
        }

        window.document.addEventListener("scroll", onScroll);
    </script>

    <!-- <script src="{{asset('theme/js/extensions/filepond.js')}}"></script> -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <!-- Markdown-it - modern pluggable markdown parser. -->
    <!-- <script src="  https://unpkg.com/showdown/dist/showdown.min.js"></script> -->


    <script src="{{asset('js/vendor/prettyTextDiff/diff_match_patch.js')}}"></script>
    <script src="{{asset('js/vendor/prettyTextDiff/jquery.pretty-text-diff.js')}}"></script>
    <!-- <script src="{{asset('theme/js/extensions/form-element-select.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script> -->

    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>


    <script src="{{asset('js/helpers.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>