@extends('layouts/app')

@section('title')
<title>BooksOnline</title>
@endsection


@section('content')
	
	@include('includesSite.advertStrip')

	<div class="container">
		@include('includesSite.sideCategory')
		@include('includesSite.showBooks')
	</div>
	

<script type="text/javascript" src = "{{URL::asset('js/tab_buttons.js') }}"></script>


@endsection
