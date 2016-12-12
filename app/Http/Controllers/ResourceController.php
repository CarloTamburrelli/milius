<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Illustration;
use App\Board;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.resource.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resource.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $n_boards = $request->input('n_boards');

        $rules = [
            'title'          => 'required',
            'url'          => 'required',
            'description'   => 'required',
            'tags' => 'required',
            'photo' => 'required'
        ];

        for($i=1; $i<=$n_boards; $i++){
            $n_vign = $request->input('board'.$i); //restituisce il numero di vignette per quella board
            for($y=1; $y<=$n_vign; $y++){
                $rules['vign'.$i."_".$y] = 'required|image';
                if($request->hasFile('sound'.$i."_".$y)){ //il suono e' un input facoltativo
                    $rules['sound'.$i."_".$y] = 'mimes:audio/mpeg,audio/mpga,mpga'; //al momento solo mp3
                }
            }
        }

        $validator = \Validator::make($request->all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return \Redirect::to('admin/resources/create')
                ->withErrors($validator)->withInput();
        } else {
            $resource = new Resource;
            $resource->title =  $request->input('title');
            $resource->tags =  $request->input('tags');
            $resource->description =  $request->input('description');
            $resource->url =  $request->input('url');
            $resource->user_id =  \Auth::user()->id;
            $resource->save();

            $destinationPath = 'uploads/'.$resource->id;
            $photo = $request->file('photo');
            $photo->move($destinationPath,"photo.jpg");
            for($i=1; $i<=$n_boards; $i++){
                $board = new Board;
                $board->resource_id = $resource->id;
                $board->save();
                $Illustration = null;
                $n_vign = $request->input('board'.$i); 
                for($y=1; $y<=$n_vign; $y++){
                    $illustration = new Illustration;
                    $illustration->board_id = $board->id;
                    $img = $request->file('vign'.$i."_".$y);
                    $upload_success = $img->move($destinationPath."/board".$i, $y.".jpg");
                    if($request->hasFile('sound'.$i."_".$y)){ //il suono e' un input facoltativo
                        $illustration->sound = 1;
                        $sou = $request->file('sound'.$i."_".$y);
                        $upload_success = $sou->move($destinationPath."/sound".$i, $y.".mp3");
                    }else{
                        $illustration->sound = 0;
                    }
                    $illustration->save();
                }
            }
            return view('admin.resource.index');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
