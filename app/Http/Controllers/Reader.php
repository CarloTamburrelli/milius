<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Board;

class Reader extends Controller
{
     public function index()
    {
        $resources = Resource::all();
        return view('index',['resources' => $resources]);
    }

    public function read($url_resource,$board_id = null)
	{
		//di default si legge la prima tavola, quando board vale null
		$board = null;
		$board_minus_1 = null;
		$board_plus_1 = null;
		if(is_null($board_id)){
			$resource = Resource::where('url', $url_resource)->first();
			$board = Board::find($resource->boards()->min("id"));
			$board_plus_1 = Board::where("id",($board->id+1))->first(['id']);
		}else{
			$board = Board::where("id",$board_id)->first();
			$board_minus_1 = Board::where("id",$board->id-1);
			if(!is_null($board_minus_1)){
				$board_minus_1 = $board_minus_1->first(['id']);
			}
			$board_plus_1 = Board::where("id",$board->id+1);
			if(!is_null($board_plus_1)){
				$board_plus_1 = $board_plus_1->first(['id']);
			}
		}
		return view('read',['board' => $board, 'board_minus_1' => $board_minus_1, 'board_plus_1' => $board_plus_1]);
	}
}
