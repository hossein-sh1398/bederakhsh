<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Period;
use App\Stage;

class StageController extends Controller
{

	public function index()
	{
        $stages = Stage::query();
        
        if ($keyword = request('search')) {
            $stages->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                ->orWhere('id', $keyword);
        }
        
        $stages = $stages->paginate()->appends(request()->query());

		return view('Admin.Stage.stage_list', compact('stages'));
	}




    public function create()
    {
    	$periods = Period::latest()->pluck('name', 'id')->toArray();

    	return view('Admin.Stage.create_stage', compact('periods'));
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

    public function update(Request $request, Stage $stage)
    {
        $data = $request->validate($this->storeRules());

        $stage->name        = $data['name'];
        $stage->description = $data['description'];
        $stage->count       = $data['count'];
        $stage->start_date  = toGregorian( $data['start_date'] );
        $stage->end_date    = toGregorian( $data['end_date'] );
        $stage->vote_date   = toGregorian( $data['vote_date'] );
        $stage->status      = $data['status'];
        $stage->period_id   = $data['period_id'];
        $stage->update();

        alert()->success('add success fully', 'success');
        return back();
    }
}
