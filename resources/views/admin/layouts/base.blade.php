<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<script src="https://use.fontawesome.com/4d61063bad.js"></script>
	
	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{ URL::to('/css/admin/admin.css') }}">

	<!-- Timeline CSS -->
    <link href="{{ URL::to('/css/admin/timeline.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
	<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">

    <!-- MetisMenu CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.min.css" rel="stylesheet">


	@yield('styles')
</head>
<body>

@yield('master')

<!-- JQuery -->
<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>
<script src="{{ URL::to('/js/admin/morris-data.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script type="text/javascript" src="{{ URL::to('/js/admin/admin.js') }}"></script>

@yield('scripts')

</body>
</html>