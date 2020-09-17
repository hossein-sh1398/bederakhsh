
@extends('layouts.admin')

@section('breadcrumb')
	{{$breadcrumb}}
@endsection

@section('body')

	{{$body ?? ''}}

@endsection

@section('title')
	{{$title ?? ''}}
@endsection

@section('script')
	{{$script ?? ''}}
@endsection

@section('css')
	
	{{$css ?? ''}}

@endsection
