<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<title>Ingresso.Art</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<script src="https://use.fontawesome.com/4d61063bad.js"></script>

	<link rel="stylesheet" href="{{ URL::to('/css/construcao/style.css') }}">

</head>
<body>


<div id="wrapper">
	<div class="container">
		<div class="row">
			<img src="img/logo.jpg">
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<h2 class="subtitle">Esse site ainda está em construção, espere só mais um pouquinho... </h2>
				<div id="countdown"></div>
			</div>

			<div class="col-md-4">
				<img src="img/ingressito.png">
			</div>
			
		</div>
		
	</div>
</div>


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src="{{ URL::to('/js/construcao/jquery.countdown.min.js') }}"></script>

<script type="text/javascript">
	
  $('#countdown').countdown('2016/10/01', function(event) {
    $(this).html(event.strftime('%w semanas %d dias <br /> %H:%M:%S'));
  });
</script>

</body>
</html>