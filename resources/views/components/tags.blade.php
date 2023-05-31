<?php
/* $badgeColors = ["bg-light-primary", "bg-light-secondary", "bg-light-success", "bg-light-danger", "bg-light-warning", "bg-light-info"];
$badgeColors = ["text-bg-primary", "text-bg-secondary", "text-bg-success", "text-bg-danger", "text-bg-warning", "text-bg-info"]; */

use App\Helpers\Helpers;

$badgeColors = ["bg-light-primary text-bg-primary", "bg-light-secondary text-bg-secondary", "bg-light-success text-bg-success", "bg-light-danger text-bg-danger", "bg-light-warning text-bg-warning", "bg-light-info text-bg-info"];

// Helpers::str_lreplace(';','',implode(';',$tags));
?>
<div class="tags-list" data-value="{{implode('; ',$tags)}}">
    @foreach($tags as $index => $tag)
    <span class="badge {{$badgeColors[array_rand($badgeColors)]}} my-2 mx-1 p-2">{{$tag}}</span>
    @endforeach
</div>