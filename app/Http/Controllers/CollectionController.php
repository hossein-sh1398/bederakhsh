<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Vote;
use App\Campaign;

class CollectionController extends Controller
{
    public function coll()
    {
        $arr = collect([1,2,3,4,5,6]);
        $arr2 = ['one', 'two', 'three', 'four', 'five', 'sex'];
        dd($arr->zip($arr2));
        //sort [10, 9, 8, 6, 7, ] => 6 , 7, 8 , 9, 10
        //sortDesc 10, 9, 8, 7, 6

        $campaigns = Campaign::skip(0)->take(5)->get();
        $campaigns2 = Campaign::skip(5)->take(9)->get();
        dd($campaigns->union($campaigns2)->toArray());



       //  $collection = collect( [ 3, 1, 4, 5, 10, 9, 8, 6, 7 ] );

       //  //$slice = $collection->sort();
       // $slice = $collection->sortDesc();
       //  dd( $slice->all() );




        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        $slice = $collection->splice(5);
        dd($collection->all());



        $arr = ['age'=> 1,2, 3, 4, 5, 6, 7, 8, 9, 10];
        $arr = collect($arr);

        $res = $arr->search(111);
        dd($res);


       


        //$ar = $arr->pull(3); delete for key and return value deleted
        //$arr->prepend('name', 'hossein'); add value in start array for key or without key
        // $arr->push(11, 12);
        $arr->put('age', 33);
        $arr->prepend( 33, 'age');
        $arr->push(33);
        dd($arr);

        $res = $campaigns->pop();
        dd($campaigns);


        $res = $campaigns->pluck('firstname', 'id');
        dd($res);

        $res = $campaigns->last(function($item){
            return $item->id > 3;
        });
        dd($res);



        $res=$campaigns->keyBy(function($item){
            return strtoupper($item->firstname);
        });
        dd($res->keys());

        //dd(collect([1,3])->implode('##'));


        $res=$campaigns->implode('id', '|');
        dd($res);

        $collection = collect(['account_id' => 1, 'product' => 'Desk']);
        dd($collection->has('product'));

        $campaigns = Campaign::limit(5)->get();
        dd($campaigns->get(55));


        $collection = collect(['name' => 'taylor', 'framework' => 'laravel']);
        $value = $collection->get('name');
        dd($value);


        $forget = collect(['name'=>'hossein','family'=>'shirinegad']);
        $forget->forget('name');
        $forget->forget('family');
        dd($forget);



        $flip = collect(['name'=>'hossein','family'=>'shirinegad']);
        $flip = $flip->flip();
        dd($flip);


        $collection = collect(['hossein', 'name' => 'taylor', 'languages' => ['ff'=>'php', 'javascript']]);
        $flattened = $collection->flatten();
        dd($flattened);

        $campaigns = Campaign::limit(5)->get();

        $res = $campaigns->map(function($c){
            
            $c->firstname = strtoupper($c->firstname);
            return $c->id;
        });

        dd($res);


        $collection = collect([
           ['name' => 'Sally'],
           ['school' => 'Arkansas'],
           ['age' => 28]
        ]);

        $flattened = $collection->flatMap(function ($values) {
            foreach ($values as $key => $value) {
                return [ $key => strtoupper($value)];
            }
        });
        dd($flattened);




        $campaigns = Campaign::limit(5)->get();

        $items = $campaigns->flatMap(function($item) {
            return  strtolower($item->firstname); 
        });
        dd($items);


        // $item = $campaigns->first(function($item, $key) {
        //     return $item->id > 3;
        // });

        // dd($item);
        // exit();




       // $collection = collect(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);
       //  $filtered = $collection->except(['price', 'discount']);
       //  dd($filtered->all());

        $campaigns = Campaign::limit(5)->get();
        dd($campaigns->except($campaigns->first()->id)->toArray());
        // $campaign = Campaign::find(1);
        // dd($campaigns->contains($campaign));
        // $arr = collect([ ['one' => 1], 2, 3, 4]);

        // dd($arr->contains('one', 1));

        // $list = collect(['name', 'family', 'age']);
  
        // dd($list->combine(['hossein', 'shirinegad', 32]));
        

        // $ar = collect([[1,2], [3,4], [5]]);
        // $ar = $ar->collapse();
        // dd($ar);


        // $campaigns = Campaign::get();
        // dd($campaigns->chunk(4));
        
        
        
        // $arr = collect([1,2,3,]);
        //  $videos = Video::get();
        //  dd($videos->avg('campaign_id'));
        //  dd($videos->toArray());

        // $res = collect($arr)->map(function($item){
        //     return $item*3;
        // })->map(function($item){
        //     return $item+1;
        // });

        // dd($arr->has(1));
        // dd($arr->search(2));
        //dd($arr->search(2));
    }
}
