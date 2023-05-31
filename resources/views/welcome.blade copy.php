@extends('layouts.horizontal')
@section('main-content')
<?php

//use App\Http\Controllers\Request\BaseApiRequest;

use App\Helpers\Helpers;
use App\Http\Controllers\Request\BaseApiRequest;



?>
<div class="page-heading">
    <h3>Welcome to GrammarPro</h3>
</div>
<div class="card-body">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="manuscript-support-tab" data-bs-toggle="tab" href="#manuscript-support" role="tab" aria-controls="manuscript-support" aria-selected="true">
                Manuscript Support
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="research-guidance-tab" data-bs-toggle="tab" href="#research-guidance" role="tab" aria-controls="research-guidance" aria-selected="false">
                Research Guidance
            </a>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li> -->
    </ul>
    <div class="tab-content mt-10" id="myTabContent">
        <div class="tab-pane fade show active" id="manuscript-support" role="tabpanel" aria-labelledby="manuscript-support-tab">
            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <form class="form form-vertical form-grammarPro" id="form-grammarPro" action="{{route('manuscript.support.from.text.file').'/'}}" method="GET" data-task="" data-params="">
                    @csrf
                    <div class="row match-height">
                        <p class="card-title mb-3">Let's support your manuscript writing!</p>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Text support</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <!-- <label for="first-name-vertical">Your full manuscript content</label> -->
                                                        <textarea id="manuscript-textarea" class="form-control manuscript-textarea" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_TEXT}}" rows="10" placeholder="Your full manuscript content. Paste your full manuscript's content here. Ex: Car crashes, known also as vehicle collisions, are recurrent events that occur every day..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                                        <span class="spinner-border spinner-border-sm d-none loading-spinner loading-components" role="status" aria-hidden="true"></span>
                                                        <i class="bi bi-search pr-2"></i>
                                                        Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Recommended keywords</label>
                                                        <div class="keywords-list">
                                                            <p class="text-muted">
                                                                Submit your abstract or title to see our recommended keywords
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">File support (Latex, Word, PDF, Txt)</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">

                                            <!-- Basic file uploader -->
                                            <input type="file" class="filepond manuscript-file" name="{{App\Http\Controllers\Request\BaseApiRequest::PARAM_MANUSCRIPT_FILE}}" data-url="{{route('manuscript.support.file.upload').'/'}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">How to use?</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <p class="">Let's support your manuscript writing!</p>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                <span class="spinner-border spinner-border-sm d-none loading-spinner loading-components" role="status" aria-hidden="true"></span>
                                                <i class="bi bi-search pr-2"></i>
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </form>
            </section>

        </div>
        <div class="tab-pane fade" id="research-guidance" role="tabpanel" aria-labelledby="research-guidance-tab">


        </div>

    </div>
</div>


<!-- TO DO

Pricing Page
iframe for URL within card like here https://zuramai.github.io/mazer/demo/component-card.html

MS Word plugin

TO DO later
terminal commande "grammarPro -a "<ABSTARCT>" -->



<!-- // Basic Vertical form layout section end -->
<div class="page-heading email-application results-container">
    <!-- <div class="page-heading email-application results-container d-none"> -->
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Results</h3>
                <!-- <p class="text-subtitle text-muted">A full view on what we have found for you!</p> -->
            </div>
            <!-- <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Email Application</li>
                    </ol>
                </nav>
            </div> -->
        </div>
    </div>
    <section class="section content-area-wrapper">
        <div class="app-content-overlay d-none loading-components">
            <!-- <div class="app-content-overlay show loading-components"> -->
            <div class="overlay">
                <img src="{{asset('theme/images/svg-loaders/ball-triangle.svg')}}" class="me-4" style="width: 3rem" alt="audio">
            </div>
        </div>
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content email-app-sidebar d-flex">
                    <!-- sidebar close icon -->
                    <span class="sidebar-close-icon">
                        <i class="bi bi-x"></i>
                    </span>
                    <!-- sidebar close icon -->
                    <div class="email-app-menu">
                        <div class="form-group form-group-compose">
                            <!-- export to button  -->
                            <div class="btn-group dropdown me-1 mb-1 my-4 btn-block">

                                <!-- <button class="btn btn-primary btn-citation-modal" type="button" id="btn-citation-modal" data-bs-toggle="modal" data-bs-target="#citation-modal"> -->

                                <button class="btn btn-primary btn-citation-modal" type="button" id="btn-citation-modal">
                                    <i class="bi bi-quote"></i>
                                    GrammarPro
                                </button>

                                <!-- <button class="btn btn-primary dropdown-toggle " type="button" id="dropdownMenuButtonExport" data-bs-toggle="dropdown">
                                        <i class="bi bi-quote"></i>
                                        GrammarPro
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonExport">
                                        <h6 class="dropdown-header">Citation only</h6>
                                        <a class="dropdown-item" href="#">BibTeX</a>
                                        <a class="dropdown-item" href="#">RIS</a>
                                        <a class="dropdown-item" href="#">Plain Text</a>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Citation and abstract</h6>
                                        <a class="dropdown-item" href="#">BibTeX</a>
                                        <a class="dropdown-item" href="#">RIS</a>
                                        <a class="dropdown-item" href="#">Plain Text</a>
                                    </div> -->
                            </div>
                        </div>
                        <div class="sidebar-menu-list ps">
                            <!-- sidebar menu  -->
                            <label class="sidebar-label text-warning">Writing Tools</label>

                            <div class="list-group list-group-messages">

                                <a class="list-group-item pb-5 link-execute-task  active cursor-pointer" data-task="{{BaseApiRequest::API_LLM_STUDENT_TASK_SUMMARIZATION_VALUE}}" data-params="" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Summarization
                                    <!-- <span class="badge bg-light-primary badge-pill badge-round float-right mt-50">5</span> -->
                                </a>

                                <a class="list-group-item pb-5 link-execute-task cursor-pointer" data-task="{{BaseApiRequest::API_LLM_STUDENT_TASK_PROOFREAD_VALUE}}" data-params="" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Proofreading
                                </a>

                                <a class="list-group-item pb-5 link-execute-task cursor-pointer link-execute-task-manuscript-translation" data-task="{{BaseApiRequest::API_LLM_STUDENT_TASK_TRANSLATION_VALUE}}" data-params="lang=ja" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Translation
                                </a>

                                <a class="list-group-item pb-5 link-execute-task cursor-pointer" data-task="" data-params="" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Conversion
                                </a>

                            </div>
                            <label class="sidebar-label  text-warning">Submission Tools</label>

                            <div class="list-group list-group-messages">

                                <a class="list-group-item pb-5 link-execute-task cursor-pointer" data-task="" data-params="" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Review simulation
                                </a>
                                <a class="list-group-item pb-5 link-execute-task cursor-pointer" data-task="" data-params="" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Submission
                                </a>

                                <a class="list-group-item pb-5 link-execute-task cursor-pointer" data-task="" data-params="" title="">
                                    <div class="fonticon-wrap d-inline me-3">
                                        <!-- <i class="bi bi-plus"></i> -->
                                    </div>
                                    Presentation
                                </a>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-right">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- email app overlay -->
                    <!-- <div class="app-content-overlay">
                            <img src="{{asset('theme/images/svg-loaders/ball-triangle.svg')}}" class="me-4" style="width: 3rem" alt="audio">
                        </div> -->
                    <div class="email-app-area">
                        <!-- Email list Area -->
                        <div class="email-app-list-wrapper">
                            <div class="email-app-list">

                                <!-- / action right -->

                                <!-- email user list start -->
                                <div class="email-user-list list-group ps ps--active-y">
                                    <div class="result-list">
                                        <!-- RESULT LIST HERE DISPLAYED BY AJAX -->



                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Suggested Abstract</h5>
                                            </div>
                                            <div class="card-body">
                                                <pre>
                                                    <code>
                                                        Hello How are you?
                                                    </code>
                                                    </pre>
                                            </div>
                                            <div class="card-header">
                                                <h5 class="card-title">Suggested Titles</h5>
                                            </div>
                                            <div class="card-body">
                                                <pre>
                                                    <code>
                                                        Hello How are you?
                                                    </code>
                                                    </pre>
                                            </div>
                                            <div class="card-header">
                                                <h5 class="card-title">Suggested Keywords</h5>
                                            </div>
                                            <div class="card-body">

                                                <div class="markdown">

                                                    <pre>
                                                    <code>
                                                        Hello How are you?
                                                    </code>
                                                    </pre>
                                                    <div class="markdown-output">
                                                    </div>
                                                    <div class="markdown-text">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- email user list end -->

                                    <!-- no result when nothing to show on list -->
                                    <!-- <div class="no-results">
                                        <i class="bi bi-error-circle font-large-2"></i>
                                        <h5>No Items Found</h5>
                                    </div>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; height: 733px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 567px;"></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!--/ Email list Area -->


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('page-modals')
<!--Citation form Modal -->
<div class="modal fade text-left" id="citation-modal" tabindex="-1" role="dialog" aria-labelledby="citation-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Export citations...</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="dropdown-header">Citation only</h6>
                            <div class="form-check">
                                <input class="form-check-input citation-exportation-type" type="radio" name="citation-exportation-type" id="citation-type-bib-tex" value="bib_tex">
                                <label class="form-check-label" for="citation-type-bib-tex">
                                    BibTeX
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input citation-exportation-type" type="radio" name="citation-exportation-type" id="citation-type-ris" value="ris">
                                <label class="form-check-label" for="citation-type-ris">
                                    RIS
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input citation-exportation-type" type="radio" name="citation-exportation-type" id="citation-type-plain-text" value="plain_text">
                                <label class="form-check-label" for="citation-type-plain-text">
                                    Plain Text
                                </label>
                            </div>
                            <h6 class="dropdown-header mt-4">Citation and Abstract</h6>
                            <div class="form-check">
                                <input class="form-check-input citation-exportation-type" type="radio" name="citation-exportation-type" id="citation-type-bib-tex-abstract" value="bib_tex_abstract">
                                <label class="form-check-label" for="citation-type-bib-tex-abstract">
                                    BibTeX
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input citation-exportation-type" type="radio" name="citation-exportation-type" id="citation-type-ris-abstract" value="ris_abstract">
                                <label class="form-check-label" for="citation-type-ris-abstract">
                                    RIS
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input citation-exportation-type" type="radio" name="citation-exportation-type" id="citation-type-plain-text-abstract" value="plain_text_abstract">
                                <label class="form-check-label" for="citation-type-plain-text-abstract">
                                    Plain Text
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Citation preview </label>
                            <div class="form-group">
                                <textarea rows="10" placeholder="Citation preview" class="form-control citation-exportation-preview" disabled id="citation-exportation-preview"></textarea>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-clipboard"></i>
                    Copy to clipboard
                </button>
                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                    <i class="bi bi-download"></i>
                    Download

                </button>
            </div>
        </div>
    </div>
</div>
@endsection