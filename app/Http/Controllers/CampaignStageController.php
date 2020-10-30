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
			'random_campaigns' => collect([]),
			'new_campaigns' => collect([]),
			'best_views_campaigns' => collect([]),
			'last_upload_video' => collect([]),
			'last_updated' => collect([])
		];
		/*
		* خواندن مرحله جاری مسابقه
		*/

		if ($stage = currentStage()) {

			$params['stage'] = $stage; 
			/*
			*خواندن تمام شرکت کنندگان مرحله جاری
			*/
			$campaigns = $stage->campaigns;
			/*
			*خواندن تعداد 8 شرکت کننده به صورت رندوم
			*/
			if ($campaigns->isNotEmpty()) {
				$count = $campaigns->count();
				$count = $count > 8 ? 8 : $count;
				$random_campaigns = $campaigns->random($count);

				/*
				* خواندن 8 تا از جدیدترین شرکت کنندگان
				*/
				$new_campaigns = $campaigns->sortByDesc('created_at')->values()->take(8);

				/*
				* شرکت کنندگانی که بیشترین بازدیدهارو داشتن
				*/
				$best_views_campaigns = $campaigns->sortByDesc( function( $campaign ) {
						return $campaign->views->count();
					})->take(8);

		    	/*
		    	*شرکت منندگانی که آخرین ویدیوها رو آپلود کردن
		    	*/ 
		    	$params['last_upload_video'] = $campaigns->sortByDesc(function($campaign) {
						if ($campaign->videos->isNotEmpty()) {
							return $campaign->videos->where('status', 'published')
									->sortBy('created_at')
									->last()->created_at;
						}
			    	})->values()->take(8);

		    	/*
		    	*آخرین کمپین هایی که اپدیت شدند.
		    	*/
		    	$params['last_updated'] = $campaigns->sortByDesc('updated_at')->take(8);

			}
		}
    	return $params;
	}
}
