@extends('layouts.admin')



@section('content')
    
	<div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--End Page Header -->
    </div>

     <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">

                @if(Session::has('message'))
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i> <b>{{ Session::get('message') }}</b>
                    </div>
                @endif    
                    Raga facciamo fumetti, <b>adesso!</b>


                </div>
                <!--end  Welcome -->
     </div>




@endsection