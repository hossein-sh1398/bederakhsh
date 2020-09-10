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
			'random' => collect([]),
			'newcampaigns' => collect([]),
			'views' => collect([]),
			'last_videos' => collect([]),
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

				$params['random'] = $campaigns
										->random($count);


				/*
				* خواندن 8 تا از جدیدترین شرکت کنندگان
				*/
				$params['newcampaigns'] = $campaigns
											->sortByDesc('created_at')
											->take(8);


				/*
				* شرکت کنندگانی که بیشترین بازدیدهارو داشتن
				*/ 
				$views = $campaigns
							->map( function( $campaign ) {

								return [
									'campaign' => $campaign, 
									'count' => $campaign->views->count()
								];

							});

		    	$params['views'] = $views
		    							->sortByDesc( 'count' )
		    							->values()
		    							->take(8);


		    	/*
		    	*شرکت منندگانی که آخرین ویریوها رو آپلود کردن
		    	*/ 
		    	$last_videos = $campaigns
						    	->map( function( $campaign) {

						    		if ($campaign->videos->isNotEmpty()) {

						    			$created_at = (string)$campaign
						    							->videos
									    				->sortByDesc('created_at')
									    				->first()
									    				->created_at;

							    		return [ 
							    			'campaign' => $campaign, 
							    			'created_at' => $created_at 
							    		];
						    		}
						    	})
						    	->filter(function($item) {

						    	 	if ($item) {
						    	 		return $item;
						    	 	}

						    	 });

				$params['last_videos'] = $last_videos
											->sortByDesc('created_at')
											->take(8);
		    	//last updated capmaign
		    	$params['lastUpdated'] = $campaigns
		    								->sortByDesc('updated_at')
		    								->take(8);
				
			}
		}
			
    	return view('bederakhsh_index', $params);
		
	}
}
