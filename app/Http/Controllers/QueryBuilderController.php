<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QueryBuilderController extends Controller
{
    public function builder()
    {

    	$res = DB::table('users');
  //   	$res->where('id', 2) = $res->where(['id' => 2]) = $res->where([ ['id', 2] ])
		// $res->where([
		// 	['id', '>', 50],
		// 	['name', '>', 'farman']
		// ]);

		// $res->whereIn('id', [2, 3, 4]);
		// $res->whereNotIn('id', [2, 3, 4]);
		// $res->whereNull('name');
		// $res->whereNotNull('name')
		// $res->whereBetween('id', [2, 22])
		// $res->whereNotBetween('id', [2, 22])

		// $res->where(function($query) {
		// 	$query
		// 		->where('name', 'Hossein');
		// });

		// $res->whereExists()
    		// $res->where('id', '>', 50)
    		// ->where('name', '>', 'farman')
    	dd($res->get());
    }
}
