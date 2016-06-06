@extends('admin.layouts.base')

@section('master')

<div id="wrapper">
	
	@include('admin.partials.header')

	<div id="page-wrapper">

		<div class="panel">

		@include('flash::message')
		@include('common.errors')

		@yield('content')
	
		</div>
	</div>
</div>

@endsection