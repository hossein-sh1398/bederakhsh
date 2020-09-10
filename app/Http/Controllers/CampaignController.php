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
		
		if (!$stage) {
			
	    	if ($request->q) {
	    		
				$campaigns = $stage
								->campaigns()
								->where('name', 'LIKE', '%' . $request->q . '%')
								->paginate(1);

	    	} else {

				$campaigns = $stage
								->campaigns()
								->paginate(1);
	    	}
		} else {

			$campaigns = Campaign::latest()->paginate(1);
		}

    	dd($campaigns);
    }
}
