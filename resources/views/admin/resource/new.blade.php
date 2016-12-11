@extends('layouts.admin')



@section('content')
    
	<div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Nuova risorsa</h1>
                </div>
                <!--End Page Header -->
    </div>

    <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dati di base
                        </div>
                        <div class="panel-body">
                            <form>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Titolo</label>
                                            <input class="form-control">
                                            <p class="help-block">Example "La vita è bella"</p>
                                            <div class="form-group">
                                            <label>Descrizione</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Url risorsa</label>
                                            <input class="form-control">
                                            <p class="help-block">e' necessario inserire un indirizzo senza spazi, al max trattini ( - ).</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input class="form-control">
                                            <p class="help-block">parole chiave per riconoscere la risorsa, separarli con un virgola.</p>
                                        </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tavola 1
                        </div>
                        <div class="panel-body">
                            <form>
                            <div class="row">
                                <div id="vignette_1" class="col-lg-6">
                                       <div class="form-group">
                                            <label>Vignetta 1</label>
                                            <input type="file">
                                        </div>
                                </div>
                                <div id="suoni_1" class="col-lg-6">
                                       <div class="form-group">
                                            <label>Suono 1</label>
                                            <input type="file">
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                <center><button class="add_illustration btn btn-primary" data-id="1" data-qty="2" onclick="return false">Aggiungi vignetta</button></center>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div id="further_data"></div>
                                                            <button id="add_board" class="btn btn-success" onclick="return false" >Nuova tavola</button>

                                                             <button style="margin-top:10px" type="button" class="btn btn-primary btn-lg btn-block">-Concludi-</button>

    </div>

@endsection


@section('scripts')
    var n_vign = 2;
    $(document).on('click', '.add_illustration', function() {
      var n = $(this).data("id");
      var qty = $(this).data("qty");
      $(this).data("qty",qty+1);
      $("#vignette_"+n).append("<div class=\"form-group\"><label>Vignetta "+qty+"</label><input type=\"file\"></div>");
      $("#suoni_"+n).append("<div class=\"form-group\"><label>Suono "+qty+"</label><input type=\"file\"></div>");
      n_vign = n_vign + 1;
    });
    var n_board = 2;
    $("#add_board").click(function() {
        $("#further_data").append("<div class=\"panel panel-default\"><div class=\"panel-heading\">Tavola "+n_board+"</div><div class=\"panel-body\"><div class=\"row\"><div id=\"vignette_"+n_board+"\" class=\"col-lg-6\"><div class=\"form-group\"><label>Vignetta 1</label><input type=\"file\"></div></div><div id=\"suoni_"+n_board+"\" class=\"col-lg-6\"><div class=\"form-group\"><label>Suono 1</label><input type=\"file\"></div></div><div class=\"col-lg-12\"><center><button data-id=\""+n_board+"\" data-qty=\"2\" class=\"add_illustration btn btn-primary\" onclick=\"return false\">Aggiungi vignetta</button></center></div></div></div></div>");

        n_board = n_board + 1;
    });
@endsection