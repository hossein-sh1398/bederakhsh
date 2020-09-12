<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;

class CampaignController extends Controller
{
    public function search(Request $request)
    {
    	$campaigns = collect([]);

		$stage = currentStage();
		if ($stage) {
			
	    	if ($request->q) {
	    		
				$campaigns = $stage
								->campaigns()
								->where('name', 'LIKE', '%' . $request->q . '%')
								->paginate()
								->appends(request()->query());

	    	} else {
				$campaigns = $stage
								->campaigns()
								->paginate();
	    	}
		} else {

			if ($request->q) {
				$campaigns = Campaign::where('name', 'LIKE', '%' . $request->q . '%')
								->paginate(6)
								->appends(request()->query());

			} else {
				$campaigns = Campaign::latest()->paginate(20);
			}
		}

    	return view('Campaign.list', compact('campaigns'));
    }
}
