<!DOCTYPE html>
<html>
<head>
	<title>
		Index Page
	</title>
	<link rel="stylesheet", href="../css/style.css">
	<link rel="stylesheet", href="css/style.css">
</head>
<body>
	@yield('notification')

	<div class="left-div"><!--Holds the left side of the first page-->
		<div class="header">
			FR
		</div>

		<div class="content-sec">
			<div class="exstn-users"><!--YIELD LEFT PAGE CONTENT-->
				@yield('left_content')
			</div>
		</div>

		<div class="footer">
			
		</div>
	</div>
	<div class="right-div">
		<div class="header">
			<span class='header-name'>@yield('name')</span>
		</div>
			<div class="create-user">
				@yield('right_content')
			</div>
		</div>

</body>
</html>