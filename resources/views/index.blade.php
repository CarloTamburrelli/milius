@extends('layouts.client')

@section('body')

<div class="container">
<div class="page-header">
  <h1>Milius <small>short and fun stories</small></h1>
</div>

<div class="row">
<div class="col-md-4 col-centered">

<div class="form-group">
    <input type="text" class="form-control" id="exampleInputName2" placeholder="Cerca fumetto">
  </div>
</div>
</div>
 	<div class="row">
 	@foreach ($resources as $res)
 		<div class="col-md-3" style="background:yellow"><a href="read/{{$res->url}}"><img src="uploads/{{$res->id}}/photo.jpg" class="img-responsive"></img></a></div>
 	@endforeach
 	</div>
</div>

@endsection