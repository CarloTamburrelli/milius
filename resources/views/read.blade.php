@extends('layouts.client') 

@section('include_stylesheet')
<script src="/js/ion.sound.min.js" crossorigin="anonymous"></script>
<script src="/js/jquery-3.1.1.min.js" crossorigin="anonymous"></script> 
<script src="/js/jquery.waypoints.min.js" crossorigin="anonymous"></script> 
@endsection

<style>

.spinner {
  width: 40px;
  height: 40px;
  background-color: #333;
  display: none;

  margin: 100px auto;
  -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
  animation: sk-rotateplane 1.2s infinite ease-in-out;
}

@-webkit-keyframes sk-rotateplane {
  0% { -webkit-transform: perspective(120px) }
  50% { -webkit-transform: perspective(120px) rotateY(180deg) }
  100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
}

@keyframes sk-rotateplane {
  0% { 
    transform: perspective(120px) rotateX(0deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg) 
  } 50% { 
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg) 
  } 100% { 
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
  }
}
</style>


<?php $sounds = array() ?>
@section('body')
<div class="spinner"></div>
<div id="wrapper" class="container-fluid" style="background:black">
    <div class="row">
    <a name="scroll-to-top"></a>
@foreach ($board->illustrations as $key => $il)
 <div 
 @if($il->sound == 1)
 	class="col-xs-12 sound" data-sound="{{$il->id}}" 
 	{{$sounds[] = $il->id}}
 @else
 	class="col-xs-12"
 @endif ><img style="width:100%" src="/uploads/{{$board->resource->id}}/board{{$board->id}}/{{$il->id}}.jpg"></img></div>
@endforeach
<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    @if(!is_null($board_minus_1))
    <a href="/read/{{$board->resource->url}}/{{$board_minus_1->id}}" class="btn btn-default" role="button">Tavola precedente</a>
  	@endif
  </div>
  <div class="btn-group" role="group">
    <a href="#scroll-to-top" class="btn btn-default" role="button">Tavola attuale</a>
  </div>
  <div class="btn-group" role="group">
  @if(!is_null($board_plus_1))
    <a href="/read/{{$board->resource->url}}/{{$board_plus_1->id}}" class="btn btn-default" role="button">Tavola successiva</a>
  @endif
  </div>
</div>


</div>
</div>

<style>

@if (!empty($sounds))
#wrapper {
	display:none;
}
.spinner {
	display:block;
@endif

</style>
@endsection('body')


@section('scripts')

$('.sound').waypoint(function() {
	var play_sound = $(this).data("sound");
    ion.sound.play(play_sound);
    this.destroy();
});


   ion.sound({
    sounds: [
	@foreach ($sounds as $sound)
		{
		   	name: "{{$sound}}"
		},
	@endforeach
    ],
    volume: 0.5,
    path: "/uploads/{{$board->resource->id}}/sounds/",
    preload: true,
    ready_callback: function (info) {
    	$("#wrapper").css("display","block");
    	$(".spinner").css("display","none");
    }
});

@endsection('scripts')