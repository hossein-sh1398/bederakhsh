<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;
use App\Vote;
use App\Campaign;
use Carbon\Carbon;

class VoteController extends Controller
{
	public function form()
	{
		return view('vote');
	}


    public function vote(Request $request)
    {
    	$data = $request->validate( $this->rules() ); 

		$stage = Stage::where([
	            ['status', 'published'],
	            ['id', $data['stage']]
	    	])
        	->whereDate('vote_date', '<=', Carbon::now()->toDateString())
        	->whereDate('end_date', '>=', Carbon::now()->toDateString())
        	->first();

    	if ($stage)
    	{
    		$campaign = Campaign::where([
    				['status', 'published'],
    				['id', $data['campaign']]
    			])
    			->first();

    		if ($campaign) {
	    		if ( $stage->campaigns->contains($campaign) ) {
	    			$this->authorize('allow_to_vote_campaign', $campaign);
		    		$user = auth()->user();
		    		if ( $user->vote( $data ) ) {
		    			alert()->success('vote to campaign successfully', 'successfully Message');
		    		}
	    		}
    		}
    	}
    	return redirect()->back();
    }

    /*
    *
    */
    protected function rules()
    {
    	return [
    		'stage' => 'required|exists:stages,id',
    		'count_vote' => 'required|numeric',
    		'campaign' => 'required|exists:campaigns,id'
    	];
    }
}
