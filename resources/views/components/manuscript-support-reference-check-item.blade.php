<?php

use App\Entities\DAO\ReferenceApi\Response\Author;
use App\Entities\DAO\ReferenceApi\Response\CrossRef\ApiResponseDAO;
use App\Entities\DAO\ReferenceApi\Response\Reference;
use App\Helpers\Helpers;

//$response = new ApiResponseDAO("");
//$references = $response->getReferences();
/* $reference = new Reference();
$author = new Author();
//$reference->getAuthors()[0]->get;
$author->getFullName(); */

$freeApiSources = Helpers::REFERENCE_FREE_API_SOURCES;
$bibStyles = Helpers::SUPPORTED_BIBLIOGRAPHY_STYLES;
$citationStyles = Helpers::SUPPORTED_CITATION_STYLES;
?>

<div class="accordion" id="accordion-references">
    @foreach($freeApiSources as $apiSourceIndex => $apiSource)
    <div class="accordion-item ">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button
            {{($apiSourceToUse == $apiSourceIndex)?'':'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$apiSourceIndex}}" aria-expanded="{{($apiSourceToUse == $apiSourceIndex)?'true':'false'}}" aria-controls="collapse-{{$apiSourceIndex}}">
                {{$apiSource}}
            </button>
        </h2>
        <div id="collapse-{{$apiSourceIndex}}" class="accordion-collapse collapse {{($apiSourceToUse == $apiSourceIndex)?'show':''}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample44">
            <div class="accordion-body p-0">
                @if($apiSourceToUse == $apiSourceIndex)
                @foreach($references as $referenceIndex => $reference)
                <div class="card border-radius-0">
                    <div class="citations-list d-none">
                        @foreach($citationStyles as $citationStyleIndex => $citationStyle)
                        <div class="citations-item citations-item-{{$citationStyleIndex}}">{{$reference->getCitations()[$citationStyleIndex]}}</div>
                        @endforeach
                    </div>
                    <div class="bibliography-list d-none">
                        @foreach($bibStyles as $bibStyleIndex => $bibStyle)
                        <div class="bibliography-item bibliography-item-{{$bibStyleIndex}}">{{$reference->getBibliography()[$bibStyleIndex]}}</div>
                        @endforeach
                    </div>
                    <h6 class="card-header p-2 mb-2">
                        <span class="checkbox checkbox-shadow checkbox-sm">
                            <input type="checkbox" id="reference-checkbox{{$referenceIndex}}" class='form-check-input reference-checkbox'>
                        </span>
                        <label for="reference-checkbox{{$referenceIndex}}" class="d-inline">{{$reference->getTitle()}}</label>
                    </h6>
                    <div class="card-body py-0">
                        <!-- <h6 class="card-title">Special title treatment</h6>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        <div class="mail-message">
                            <p class="list-group-item-text truncate mb-2">
                                <b>Author(s)</b> :
                                <?php
                                $authors = $reference->getAuthors();
                                //$badgeColors = ["text-bg-primary", "text-bg-secondary", "text-bg-success", "text-bg-danger", "text-bg-warning", "text-bg-info"];
                                $badgeColors = ["text-bg-primary", "text-bg-secondary", "text-bg-success", "text-bg-danger", "text-bg-warning", "text-bg-info"];
                                if ($authors) {
                                    foreach ($authors as $author) {
                                ?>
                                        <span class="badge {{$badgeColors[array_rand($badgeColors)]}} p-2 mb-2">{{$author->getFullName()}}</span>
                                <?php
                                    }
                                }
                                ?>
                            </p>
                            <p class="list-group-item-text truncate mb-2">
                                <b>Abstrat</b> : {{$reference->getAbstract() == ""? "Not provided":strip_tags($reference->getAbstract())}}
                            </p>
                            <div class="more-features">
                                <p class="list-group-item-text truncate mb-2">
                                    <b>URL</b> :
                                    <a class="mb-2" href="{{!$reference->getUrl() ? '#':$reference->getUrl()}}" target="_blank">
                                        {{!$reference->getUrl()? "#":$reference->getUrl()}}
                                    </a>
                                </p>
                            </div>
                            <div class="mail-meta-item">
                                <span class="float-right">
                                    <span class="bullet bullet-success bullet-sm"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @endforeach

    <!-- <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Accordion Item #2
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
        </div>
    </div> -->


</div>