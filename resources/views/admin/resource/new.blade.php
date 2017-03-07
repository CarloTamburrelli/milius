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

@if (count($errors))
<div class="alert alert-danger" role="alert">
  <span class="sr-only">Error:</span>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


                <div class="col-lg-12">
                    <!-- Form Elements -->
                    {{ Form::open(array('url' => 'admin/resources','files' => true)) }}
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
                                            <input class="form-control" name="title">
                                            <p class="help-block">Example "La vita è bella"</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Descrizione</label>
                                            <textarea name="description" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Immagine copertina</label>
                                            <input type="file" class="form-control" name="photo">
                                            <p class="help-block">Quest'immagine apparirà nella home principale del sito come link al fumetto.</p>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Url risorsa</label>
                                            <input name ="url" class="form-control">
                                            <p class="help-block">e' necessario inserire un indirizzo senza spazi, al max trattini ( - ).</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input name="tags" class="form-control">
                                            <p class="help-block">parole chiave per riconoscere la risorsa, separarli con un virgola.</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tavola 1
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12"><b>Impostazioni</b><p>Lettura dal basso: <input type="checkbox" name="read_down1" value="1" /></p><p>
                                Scroll rapido: <input type="checkbox" name="fast_scroll1" value="1" /></p></div>
                                <div id="vignette_1" class="col-lg-6">
                                       <div class="form-group">
                                            <label>Vignetta 1 *</label>
                                            <input type="file" name="vign1_1">
                                        </div>
                                </div>
                                <div id="suoni_1" class="col-lg-6">
                                       <div class="form-group">
                                            <label>Suono 1</label>
                                            <input type="file" name="sound1_1">
                                        </div>
                                </div>
                                <div class="col-lg-12">
                                <center><button class="add_illustration btn btn-primary" data-id="1" data-qty="2" onclick="return false">Aggiungi vignetta</button></center>
                                </div>
                            </div>
                            <input type="hidden" name="board1" id="board1" value="1"></input>
                        </div>
                    </div>
                    <div id="further_data"></div>
                                                            <button id="add_board" class="btn btn-success" onclick="return false" >Nuova tavola</button>

<input type="hidden" name="n_boards" id="n_boards" value="1"></input>
                                                             <input type="submit" style="margin-top:10px" value="CONCLUDI" class="btn btn-primary btn-lg btn-block"></input>
                                                             {{ Form::close() }}

    </div>

@endsection


@section('scripts')
    $(document).on('click', '.add_illustration', function() {
      var n = $(this).data("id");
      var qty = $(this).data("qty");
      $(this).data("qty",qty+1);
      $("#vignette_"+n).append("<div class=\"form-group\"><label>Vignetta "+qty+" *</label><input type=\"file\" name=\"vign"+n+"_"+qty+"\"></div>");
      $("#suoni_"+n).append("<div class=\"form-group\"><label>Suono "+qty+"</label><input type=\"file\" name=\"sound"+n+"_"+qty+"\"></div>");
      $("#board"+n).val(qty);
    });
    var n_board = 2;
    $("#add_board").click(function() {
        $("#n_boards").val(n_board);
        $("#further_data").append("<div class=\"panel panel-default\"><div class=\"panel-heading\">Tavola "+n_board+"</div><div class=\"panel-body\"><div class=\"row\"><div class=\"col-lg-12\"><b>Impostazioni</b><p>Lettura dal basso: <input type=\"checkbox\" name=\"read_down"+n_board+"\" value=\"1\" /></p><p>Scroll rapido: <input type=\"checkbox\" name=\"fast_scroll"+n_board+"\" value=\"1\" /></p></div><div id=\"vignette_"+n_board+"\" class=\"col-lg-6\"><div class=\"form-group\"><label>Vignetta 1 *</label><input type=\"file\" name=\"vign"+n_board+"_1\"></div></div><div id=\"suoni_"+n_board+"\" class=\"col-lg-6\"><div class=\"form-group\"><label>Suono 1</label><input type=\"file\" name= \"sound"+n_board+"_1\"></div></div><div class=\"col-lg-12\"><center><button data-id=\""+n_board+"\" data-qty=\"2\" class=\"add_illustration btn btn-primary\" onclick=\"return false\">Aggiungi vignetta</button></center></div></div><input type=\"hidden\" name=\"board"+n_board+"\" id=\"board"+n_board+"\" value=\"1\"></input></div></div>");

        n_board = n_board + 1;
    });
@endsection