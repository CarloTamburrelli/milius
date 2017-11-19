@extends('layouts.client')

@section('body')

<div class="container">
<div class="page-header">
  <h1>Teatro situation <small>short and fun stories</small></h1>
</div>

<div class="row">
<div class="col-md-4 col-centered">

<div class="form-group">
    <input type="text" class="form-control" id="search" placeholder="Cerca fumetto"><span class="hide" id="loading"><b>Loading...</b></span>
  </div>
</div>
</div>
 	<div class="row main">
 	@foreach ($resources as $res)

<div class="rim col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="read/{{$res->url}}">
                    <img class="img-responsive" style="width:300px;height:200px" src="uploads/{{$res->id}}/photo.jpg" alt="">
                    <div class="panel-footer">{{$res->title}}</div>
                </a>
            </div>



 	@endforeach
 	</div>

</div>

@endsection

@section('scripts')

var CSRF_TOKEN = "{{ csrf_token() }}";

$( "#search" ).keyup(function() {
var val = $(this).val();
$("#loading").removeAttr("class");
$.ajax({
    url: 'get-resources',
    type: 'POST',
    data: { word : val,
    		_token : CSRF_TOKEN},
    dataType: 'JSON',
    success: function (data) {
    $("#loading").attr("class","hide");
    $(".rim").remove();

for (var i = 0; i < data.length; ++i) {
    $("div.main").append("<div class=\"rim col-lg-3 col-md-4 col-xs-6 thumb\"><a class=\"thumbnail\" href=\"read/"+data[i].url+"\"><img class=\"img-responsive\" style=\"width:300px;height:200px\" src=\"uploads/"+data[i].id+"/photo.jpg\" alt=\"\"><div class=\"panel-footer\">"+data[i].title+"</div></a></div>");
}

    }
});

});
@endsection