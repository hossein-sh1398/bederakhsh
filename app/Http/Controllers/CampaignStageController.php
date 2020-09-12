<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Stage;
use App\Video;
use Carbon\Carbon;

class CampaignStageController extends Controller
{
	public function index()
	{
		$params = [
			'stage' => '',
			'randomCampaigns' => collect([]),
			'newcampaigns' => collect([]),
			'bestViewsCampaign' => collect([]),
			'lastUploadedVideo' => collect([]),
			'lastUpdated' => collect([])
		];

		/*
		* خواندن مرحله جاری مسابقه
		*/
		$stage = currentStage(); 
		if ($stage) {
			$params['stage'] = $stage;

			/*
			*خواندن تمام شرکت کنندگان مرحله جاری
			*/
			$campaigns = $stage->campaigns; 

			/*
			*خواندن تعداد 8 شرکت کننده به صورت رندوم
			*/
			$count = $campaigns->count();
			if ($count) {
				if ($count > 8) {
					$count = 8;
				}

				$params['randomCampaigns'] = $campaigns->random($count);


				/*
				* خواندن 8 تا از جدیدترین شرکت کنندگان
				*/
				$params['newcampaigns'] = $campaigns->sortByDesc('created_at')
					->take(8);


				/*
				* شرکت کنندگانی که بیشترین بازدیدهارو داشتن
				*/ 
				$bestViewsCampaign = $campaigns
					->map( function( $campaign ) {
						return [
							'campaign' => $campaign, 
							'count' => $campaign->views->count()
						];
					});

		    	$params['bestViewsCampaign'] = $bestViewsCampaign->sortByDesc('count')
					->values()
					->take(8);


		    	/*
		    	*شرکت منندگانی که آخرین ویدیوها رو آپلود کردن
		    	*/ 
		    	$lastUploadedVideo = $campaigns
			    	->map( function($campaign) {
			    		
						$lastVideo = $campaign->videos->where('status', 'published')
									->sortByDesc('created_at')
			    					->first();

			    		if ( $lastVideo ) {
				    		return [ 
				    			'campaign' => $campaign, 
				    			'created_at' => (string) $lastVideo->created_at
				    		];
			    		}
			    	} )
			    	->filter( function($item) {
			    	 	if ($item) {
			    	 		return $item;
			    	 	}
			    	 } );

				$params['lastUploadedVideo'] = $lastUploadedVideo->sortByDesc('created_at')
					->take(8);


		    	/*
		    	*آخرین کمپین هایی که اپدیت شدند.
		    	*/
		    	$params['lastUpdated'] = $campaigns->sortByDesc('updated_at')
					->take(8);
			}
		}
    	return view('bederakhsh_index', $params);
	}
}
