<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;
use App\Period;

class StageController extends Controller
{
	public function index()
	{
		$stages = Stage::latest()->get();

		return view('stage_list', compact('stages'));
	}




    public function create()
    {
    	$periods = Period::latest()->pluck('name', 'id')->toArray();

    	return view('create_stage', compact('periods'));
    }


    public function store(Request $request)
    {
    	$data = $request->validate($this->storeRules());

    	Stage::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'count'       => $data['count'],
            'start_date'  => toGregorian( $data['start_date'] ),
            'end_date'    => toGregorian( $data['end_date'] ),
            'vote_date'   => toGregorian( $data['vote_date'] ),
            'status'      => $data['status'],
            'period_id'   => $data['period_id']
        ]);

        alert()->success('add success fully', 'success');
        
    	return back();
    }

    private function storeRules()
    {
    	return [
    		'name' => 'required|min:3|max:191',
    		'description' => 'nullable|min:3',
    		'count' => 'required|numeric',
			'start_date' => 'required',   		
			'end_date' => 'required',
			'vote_date' => 'required',
			'status' => 'required',
			'period_id' => 'required|exists:periods,id|numeric'
    	];
    }
}
