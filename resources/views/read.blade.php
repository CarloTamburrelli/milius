@extends('layouts.client') 

@section('include_stylesheet')
<script src="/js/ion.sound.min.js" crossorigin="anonymous"></script>
<script src="/js/jquery.waypoints.min.js" crossorigin="anonymous"></script> 
<script src="/assets/plugins/bootstrap/bootstrap.min.js" crossorigin="anonymous"></script>
@endsection

<style>
.spinner {
  position:fixed;
  top: 30%;
  left: 50%;
  width: 40px;
  height: 40px;
  background-color: #333;
  display: none;
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
<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <a href="/" class="btn btn-default" role="button">Homepage <span class="glyphicon glyphicon-tree-conife" aria-hidden="true"></span></a>
  </div>
  <div class="btn-group" role="group">
    <a id="no_sound" class="btn btn-default" role="button">No sound <span id="label_sound" class="glyphicon glyphicon-volume-up"></span></a>
  </div>
  <div class="btn-group" role="group">
  <a href="#scroll-to-down" class="btn btn-default" role="button">Tavola giu</a>
  </div>
</div>
    <div class="row">
    <a name="scroll-to-top"></a>
@foreach ($board->illustrations as $key => $il)
 <div 
 @if($il->sound == 1)
 	class="col-xs-12 sound" data-sound="{{$il->id}}" 
 	<?php $sounds[] = $il->id ?>
 @else
 	class="col-xs-12"
 @endif

@if($key == 0)
  id= "current_board_from_start"
@elseif($key == (count($board->illustrations)-1))
  id= "current_board_from_last"
@endif

  ><img style="width:100%;height:100vh" src="/uploads/{{$board->resource->id}}/board{{$board->id}}/{{$il->id}}.jpg"></img></div>
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
<a name="scroll-to-down" id = "current_board_from_bottom"></a>

</div>
</div>
@if (!empty($sounds))
<style>
#wrapper {
  opacity: 0;
}
.spinner {
	display:block;
}
</style>
@endif
@endsection('body')
@section('scripts')
var label_sound = 0;
var flag_start_to_play = false;
var id = "";
$( document ).ready(function() {
    @if ($board->read_down == 1)
      id = "#current_board_from_last";
      $(document).scrollTop( $("#current_board_from_bottom").offset().top );
    @else
      id = "#current_board_from_start";
      $(document).scrollTop( $("#current_board_from_start").offset().top );
    @endif
    var play = $(id).data("sound");
      if(play){
        ion.sound.play(play);
        //ion.sound.destroy(play);
      }
});


 $('.sound').waypoint(function(direction) {
  var element = $(this.element);
    if(flag_start_to_play && ("#"+$(element).attr("id") != id)){
      var play_sound = $(element).data("sound");
      console.log("play!"+play_sound);
      ion.sound.play(play_sound);
      this.destroy();
    }
    });

   ion.sound({
    sounds: [
	@foreach ($sounds as $sound)
		{
		   	name: "{{$sound}}"
		},
	@endforeach
    ],
    path: "/uploads/{{$board->resource->id}}/sounds/",
    preload: true,
    ready_callback: function (info) {
    	$("#wrapper").css("opacity","1");
    	$(".spinner").css("display","none");
      flag_start_to_play = true;
    }
});
$("#no_sound").click(function(){
	label_sound = 1 - label_sound;
	if(label_sound == 1){
		$("#label_sound").removeClass("glyphicon-volume-up");
		$("#label_sound").addClass("glyphicon-volume-off");
		ion.sound.pause();
	} else {
		$("#label_sound").removeClass("glyphicon-volume-off");
		$("#label_sound").addClass("glyphicon-volume-up");
		ion.sound.play();
	} 
});
@endsection('scripts')