<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Stage;
use App\Video;

class CampaignStageController extends Controller
{
	public function index()
	{

		// find current stage
		$stage = Stage::find(1);


		// get all campaigns in current stage
		$campaigns = $stage->campaigns; 
		

		//get random 2 campaigns
		$count = $campaigns->count();
		if ($count > 2) {
			$count = 2;
		}
		$random = $campaigns->random(2);


		//get new campaigns in current stage
		$newcampaigns = $campaigns->sortByDesc('created_at')->take(2);


		// best views campaigns
		$views = $campaigns->map(function($campaign){
			return ['campaign' => $campaign, 'count' => $campaign->views()->count()];
		});
    	$views = $views->sortByDesc('count')->values()->take(2);


    	// last campaign uploaded video
    	$last_videos = $campaigns->map(function($campaign){
    		return [ 'campaign' => $campaign, 'created_at' => (string)$campaign->videos->sortByDesc('created_at')->first()->created_at];
    	});
		$last_videos = $last_videos->sortByDesc('created_at')->take(2);

    	return view('bederakhsh_index', compact('random', 'newcampaigns', 'views', 'last_videos'));
		
	}
}
