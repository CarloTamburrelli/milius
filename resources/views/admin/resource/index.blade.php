@extends('layouts.admin')

@section('include_stylesheet')
<link href="/assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Gestione Risorse</h1>

@if(Session::has('message'))
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i> <b>{{ Session::get('message') }}</b>
                    </div>
                @endif  
                     <div class="panel panel-default">
                        <div class="panel-heading">
                             Elenco Risorse
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titolo</th>
                                            <th>Autore</th>
                                            <th>Tags</th>
                                            <th>Indirizzo web</th>
                                            <th>Registrato il</th>
                                            <th>Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if (count($resources))
                                    	@foreach ($resources as $res)
                                    		<tr class="odd gradeX">
                                            <td>{{ $res->id }}</td>
                                            <td>{{ $res->title }}</td>
                                            <td>{{ $res->user->name }}</td>
                                            <td>{{ $res->tags }}</td>
                                            <td>{{ $res->url }}</td>
                                            <td>{{ $res->created_at }}</td>
                                            <td>
{!! Form::open(['method' => 'DELETE', 'id' => 'resource_$res->id', 'action' => ['ResourceController@destroy', $res->id]]) !!}
                    {!! Form::button( '<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'deleteResource btn btn-warning btn-circle', 'data-id' => $res->id ] ) !!}
               {!! Form::close() !!}
</td>
                                        	</tr>
                                    	@endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->

                </div>
                <!--End Page Header -->
    </div>

@endsection
	@section('include_scripts')
	<script src="/assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/assets/plugins/dataTables/dataTables.bootstrap.js"></script>@endsection

@section('scripts')
            $('#dataTables-example').dataTable();


$('.deleteResource').on('click', function(e) {
if (!confirm('ATTENZIONE: Confermando rimuoverai la risorsa '+$(this).data("id"))) {
    return false;
} 
});



@endsection
