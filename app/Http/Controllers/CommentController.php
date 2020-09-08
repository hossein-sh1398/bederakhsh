<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Campaign;
use App\Models\Article;
use App\Video;

class CommentController extends Controller
{
	public function index()
	{
		switch ( request( 'subject_type' ) ) {
			
			case subjects()[ 'campaign' ]:
				if ( request( 'subject_id' ) == 'all' ) {

					$comments = Comment::with( 'parent','user', 'commentable' )
						->where( 'approved', request( 'approved' ) )
						->where( 'commentable_id', request( 'subject_id' ) )
						->where( 'commentable_type', subjects()[ 'campaign' ] )
						->get();

				} else {

					$comments = Comment::with( 'parent','user', 'commentable' )
						->where( 'approved', request( 'approved' ) )
						->where( function( $query ) {
							$query
								->where( 'commentable_type', subjects()[ 'video' ] )
								->Orwhere( 'commentable_type', subjects()[ 'campaign' ] );
						} )
						->get();
				}
				break;

			case subjects()['video']:

				if ( request( 'subject_id' ) == 'all' ) {

					$comments = Comment::with( 'parent','user', 'commentable' )
						->where( 'approved', request( 'approved' ) )
						->where( 'commentable_type', subjects()[ 'video' ] )
						->get();					

				} else {

					$comments = Comment::with( 'parent','user', 'commentable' )
						->where( 'approved', request( 'approved' ) )
						->where( 'commentable_id', request( 'subject_id' ) )
						->where( 'commentable_type', subjects()[ 'video' ] )
						->get();
				}
				break;

			case subjects()[ 'article' ]:

				if ( request( 'subject_id' ) == 'all' ) {

					$comments = Comment::with( 'parent','user', 'commentable' )
					->where( 'approved', request( 'approved' ) )
					->where( 'commentable_type', subjects()[ 'article' ] )
					->get();
				} else {
					
					$comments = Comment::with( 'parent','user', 'commentable' )
						->where( 'approved', request( 'approved' ) )
						->where( 'commentable_id', request( 'subject_id' ) )
						->where( 'commentable_type', subjects()[ 'article' ] )
						->get();
				}
				break;

			
			default:

				$comments = Comment::with( 'parent','user', 'commentable' )
					->where( [ 'approved' => false, 'commentable_type' => subjects()[ 'campaign' ] ] )
					->get();
				break;
		}


		//dd(request()->all());
		// subquery with query bilder
		// return User::addSelect( [
		// 	'comment' => function( $query ) {
		// 		$query
		// 			->select('comment', 'created_at')
		// 			->from('comments')
		// 			->whereColumn( 'user_id', 'users.id' )
		// 			->limit( 1 )
		// 			->latest();
		// 	}
		// ] )
		// ->paginate(10);	

		// subquery with model
		// return User::addSelect( [
		// 			'comment' => Comment::select('comment')
		// 				->whereColumn( 'user_id', 'users.id' )
		// 				->limit( 1 )
		// 				->latest()	
		// 		] )
		// 		->paginate(10);



		$articles = Article::get();
		$videos = Video::get();
		$campaigns = Campaign::get();

		return view( 'comment', compact( 'articles', 'videos', 'campaigns', 'comments' ) ); 
	}


	public function verify(Comment $comment)
	{
		$comment->update( [ 'approved' => true ] );
		return back();
	}


	public function destroy(Comment $comment)
	{
		$comment->delete();
		return back();
	}


	public function store(Request $request)
	{
		$data = $this->validate( $request, [
			'comment' => 'required',
			'parent_id' => 'required',
			'commentable_id' => 'required',
			'commentable_type' => 'required'
		] );

		$subject = ( new $data[ 'commentable_type' ] )->find( $data[ 'commentable_id' ] );

		$subject
			->comments()
			->create( [ 	
				'user_id' => auth()->id(), 
				'approved' => true, 
				'parent_id' => $data[ 'parent_id' ], 
				'comment' => $data[ 'comment' ] 
			] );

		return back();
	}


	public function ajax()
	{
		dd('yes');
	} 

}
