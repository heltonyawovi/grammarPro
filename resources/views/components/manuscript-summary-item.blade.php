<?php

$data = json_decode($data);
?>
<div class="card diff-container">
    <div class="card-header">
        <h5 class="card-title">Suggested Abstract</h5>
    </div>
    <div class="card-body">
        <pre><code>{{$data->abstract}}</code></pre>
    </div>
    <div class="card-header">
        <h5 class="card-title">Suggested Titles</h5>
    </div>
    <div class="card-body">
        <pre><code>@foreach ($data->titles as $title)
                                                   + {{$title}}
                                                    @endforeach</code></pre>
    </div>
    <div class="card-header">
        <h5 class="card-title">Suggested Keywords</h5>
    </div>
    <div class="card-body">

        <div class="markdown">


            <pre><code>@foreach ($data->keywords as $keyword)
                                                    + {{$keyword}}
                                                    @endforeach</code></pre>
            <div class="markdown-output">
            </div>
            <div class="markdown-text">
            </div>
        </div>

    </div>
</div>