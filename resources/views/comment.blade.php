<!DOCTYPE html>
<html>
<head>
	<title>Comment List</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-4">
		<div class="card mb-4">
			<div class="card-header">
				Comment List
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>ارسال کننده</th>
							<th>موضوع</th>
							<th>زمان ارسال</th>
							<th>منت دیدگاه</th>
							<th>وضعیت</th>
							<th>عملیات</th>
						</tr>
						<tbody>
							<div class="card mb-4">
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<p><strong>کمپین</strong></p>
											<select class="form-control" onchange="filter( 'App\\Campaign', this.value );">
												<option></option>
												<option value="all" {{request('subject_id') == 'all' && request('subject_type') == subjects()['campaign'] || count( request()->all() ) == 0  ? 'selected' : '' }}>همه</option>
												@foreach($campaigns as $campaign)
													<option value="{{$campaign->id}}" {{request('subject_id') == $campaign->id && request('subject_type') == subjects()['campaign'] ? 'selected' : '' }}>{{$campaign->name}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-6">
											<p><strong>Video</strong></p>
											<select class="form-control" onchange="filter( 'App\\Video', this.value )">
												<option></option>
												<option value="all" {{request('subject_id') == 'all' && request('subject_type') == subjects()['video'] ? 'selected' : '' }}>همه</option>
												@foreach($videos as $video)
													<option value="{{$video->id}}" {{request('subject_id') == $video->id && request('subject_type') == subjects()['video'] ? 'selected' : '' }}>{{$video->title}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<p><strong>Article</strong></p>
											<select class="form-control" onchange="filter( 'App\\Models\\Article', this.value )">
												<option></option>
												<option value="all" {{request('subject_id') == 'all' && request('subject_type') == subjects()['article'] ? 'selected' : '' }}>همه</option>
												@foreach($articles as $article)
													<option value="{{$article->id}}" {{request('subject_id') == $article->id && request('subject_type') == subjects()['article'] ? 'selected' : '' }}>{{$article->title}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-6">
											<p><strong>Approved</strong></p>
											<select class="form-control" onchange="status( this.value )">
												<option value="0" {{request('approved') == '0' ? 'selected' : '' }}>در انتظار تایید</option>
												<option value="1" {{request('approved') == '1' ? 'selected' : '' }}>تایید</option>
											</select>
										</div>
									</div>
									<div class="row mt-3 mt-4">
										<div class="col-md-12">
											<form>
												<input type="hidden" name="subject_type" id="subject_type" value="{{request('subject_type') ?? subjects()[ 'campaign' ]}}">
												<input type="hidden" name="approved" id="approved" value="{{request('approved') ?? 0}}">
												<input type="hidden" name="subject_id" id="subject_id" value="{{request('subject_id') ?? 'all'}}">
												<div class="form-group">
													<button type="submit" class="btn btn-primary btn-sm">
														فیلتر
													</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							@foreach($comments as $comment)
								<tr>
									<td>{{$comment->user->name}}</td>
									<td>
										@switch($comment->commentable_type)
											@case ('App\Campaign')
												{{$comment->commentable->name}}
											@break

											@default
												{{$comment->commentable->title}}
										@endswitch
									</td>
									<td>{{jdate($comment->created_at)->format('Y-m-d')}}</td>
									<td>{{$comment->comment}}</td>
									<td>
										@if($comment->approved)
											<span class="badge badge-success">تایید شده</span>
										@else
											<span class="badge badge-warning">در انتظار تایید</span>
										@endif
									</td>
									<td class="d-flex" style="align-items: center;">
										<!-- اگر دیدگاه پاسخ بود در این صورت دیدگاه اصلی رو در کنارش نشون بده -->
										@if($comment->parent)
											<!-- Button trigger modal -->
											<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-parent-comment-{{$comment->parent->id}}">
											  دیدگاه اصلی
											</button>

											<!-- Modal -->
											<div class="modal fade" id="modal-parent-comment-{{$comment->parent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">{{$comment->parent->user->name}}</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<ul class="list-group">
																<li class="list-group-item"><span>زمان ارسال</span>
																	<p>{{jdate($comment->parent->created_at)->format('Y-m-d')}}</p>
																</li>
																<li class="list-group-item"><span>متن دیدگاه</span>
																	<p>{{$comment->parent->comment}}</p>
																</li>
																<li class="list-group-item"><span>وضعیت</span>
																	@if($comment->parent->approved)
																		<span class="badge badge-success">تایید شده</span>
																	@else
																		<span class="badge badge-warning">در انتظار تایید</span>
																	@endif
																</li>
																<li class="list-group-item"><span>موضوع</span>
																	<p>
																		@switch($comment->parent->commentable_type)
																			@case ('App\Campaign')
																				{{$comment->parent->commentable->name}}
																			@break

																			@default
																				{{$comment->parent->commentable->title}}
																		@endswitch
																	</p>
																</li>

															</ul>
															
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
														</div>
													</div>
												</div>
											</div>
										@else
											<!-- Button trigger modal -->
											<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-answred-{{$comment->id}}">
											 	پاسخ
											</button>

											<form action="{{route('comment.store')}}" method="post">
												<!-- Modal -->
												<div class="modal fade" id="modal-answred-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLongTitle">پاسخ دیدگاه</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																@csrf
																<div class="form-group">
																	<input type="text" name="comment" autocomplete="off" class="form-control">
																</div>
																<input type="hidden" name="commentable_id" value="{{$comment->commentable_id}}">
																<input type="hidden" name="commentable_type" value="{{$comment->commentable_type}}">
																<input type="hidden" name="parent_id" value="{{$comment->id}}">
																<div class="form-group text-center">
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn btn-primary btn-sm">ارسال</button>
																<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">انصراف</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										@endif
										<form action="{{route('comment.destroy', $comment->id)}}" method="post">
											@csrf
											@method('delete')
											<div><button class="btn btn-danger btn-sm mr-1 ml-1">حذف</button></div>
										</form>
										@if( ! $comment->approved )
											<a href="{{route('comment.verify', $comment->id)}}" class="btn btn-success btn-sm">تایید</a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</thead>
				</table>
			</div>
			<div class="card-footer">
				
			</div>
		</div>
	</div>
</body>
</html>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<script type="text/javascript">
			
			function filter( subject_type, subject_id ) {

				document.getElementById('subject_type').value = subject_type;
				document.getElementById('subject_id').value = subject_id;
			}

			function status( approved) {
				
				document.getElementById('approved').value = approved;
			}
	</script>
