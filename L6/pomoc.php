<?php 
    session_start();

	if(isset($_SESSION['logged_in']))
	{
echo '<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>eBank Polska S.A.</title>
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="css/style2.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<h1 class="header-heading">eBank</h1>
			</div>
			<div class="nav-bar">
				<ul class="nav">
					<li><a href="home.php">Home</a></li>
					<li><a href="przelew.php">Przelew</a></li>
					<li><a href="doladowanie.php">Doładowanie</a></li>
					<li><a href="historia.php">Historia</a></li>
					<li><a href="pomoc.php">Pomoc</a></li>
					<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
	       			<li><a href="logout.php">Wyloguj</a></li>
				</ul>
			</div>
			<div class="content">
				<div class="main">';
							$imie = $_SESSION['imie'];
							$nazwisko = $_SESSION['nazwisko'];
							echo '<div><span class="prawa"><h6>Jesteś zalogowany jako:  '.$imie." ".$nazwisko.'</h6></span><span class="lewa"><h2>Pomoc</h2>';	
							echo '</span></div>';
							//print_r($_SESSION);
							echo '<hr>
					<h5>W razie jakichkolwiek problemów związanych z naszym serwisem prosimy o kontakt mailowy lub telefoniczny.</h5>
					<hr>
					<h4>Adres mail: help@ebankpoland.com <br /> <br /> Infolinia: +48 674 365 059 </h4>
					<hr>
				</div>
			</div>
			<div class="footer">
				&copy; eBank Polska S.A. Wszelkie prawa zastrzeżone.
			</div>
		</div>
	</body>
</html>';
}
else 
						{
							//header("Refresh: 0; url=niezalogowany.php");
							echo '<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>eBank Polska S.A.</title>
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="css/style2.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<h1 class="header-heading">eBank</h1>
			</div>
			<div class="nav-bar">
				<ul class="nav">
					<li><a href="niezalogowany.php">Home</a></li>
					<li><a href="niezalogowany.php">Przelew</a></li>
					<li><a href="niezalogowany.php">Doładowanie</a></li>
					<li><a href="niezalogowany.php">Historia</a></li>
					<li><a href="pomoc.php">Pomoc</a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href="login.php">Zaloguj</a></li>
				</ul>
			</div>
			<div class="content">
				<div class="main">
						<div><span class="prawa"></span><span class="lewa"><h2>Pomoc</h2>';	
							echo '</span></div>';
							echo '<hr>
					<h5>W razie jakichkolwiek problemów związanych z naszym serwisem prosimy o kontakt mailowy lub telefoniczny.</h5>
					<hr>
					<h4>Adres mail: help@ebankpoland.com <br /> <br /> Infolinia: +48 674 365 059 </h4>
					<hr>
				</div>
			</div>
			<div class="footer">
				&copy; eBank Polska S.A. Wszelkie prawa zastrzeżone.
			</div>
		</div>
	</body>
</html>';
						}
						
?>					
