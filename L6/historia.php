<?php 

  session_start();

  if(!isset($_SESSION['logged_in']))
  {
    header('Location: index.php');
    exit();
  }

  require_once "set_db.php";

    echo
    '<html lang="en">
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
	       echo '<div><span class="prawa"><h6>Jesteś zalogowany jako:  '.$imie." ".$nazwisko.'</h6></span><span class="lewa"><h2>Historia</h2>';	
	       echo '</span></div><hr>';
               
	       $zapytanieIdKlient = "select id_klient from klient where imie = '$imie' and nazwisko = '$nazwisko'";
	       $wynikIdKlient = mysql_query( $zapytanieIdKlient );
	       $wiersz20 = mysql_fetch_row( $wynikIdKlient );
	       $idKlient = $wiersz20[0];

           $zapytanieIdKlientOdb = "select id_klient_odb from przelew where id_klient_nad = '$idKlient'";
           $wynikIdKlientOdb = mysql_query( $zapytanieIdKlientOdb );
           $wiersz21 = mysql_fetch_row( $wynikIdKlientOdb );
           $idKlientOdb = $wiersz21[0];

	       $wynik = mysql_query("SELECT p.dataPrzelewu, p.tytulPrzelewu, k.imie, k.nazwisko, p.kwotaPrzelewu, p.saldoOdbPoOperacji, p.zrealizowany FROM przelew as p inner join klient as k on p.id_klient_nad = k.id_klient where p.id_klient_odb = '$idKlient'")
	       or die('Błąd zapytania');

           $wynik2 = mysql_query("SELECT p.dataPrzelewu, p.tytulPrzelewu, k.imie, k.nazwisko, p.kwotaPrzelewu, p.saldoNadPoOperacji, p.zrealizowany FROM przelew as p inner join klient as k on p.id_klient_odb = k.id_klient where p.id_klient_nad = '$idKlient'")
           or die('Błąd zapytania');

           $wynik3 = mysql_query("select dataDoladowania, nazwaSieci, kwotaDoladowania, stanKontaPoDoladowaniu from doladowanie where id_konto = '$idKlient'")
           or die('Błąd zapytania');
	       
	       if(mysql_num_rows($wynik) > 0 || mysql_num_rows($wynik2) > 0) {
	         echo
	         '<table>
  		    <tr>
		          <th>Data</th>
		          <th>Tytuł</th>
    		      <th>Od / do</th>
    		      <th>Kwota </th>
    		      <th>Saldo po operacji</th>
  		    </tr>';
    	         while($r = mysql_fetch_array($wynik)) {
                 if($r[6] == 1) {
                //echo $r[6];
                         echo
                             '<tr>
    		      <td><h6>' . $r[0] . '</h6></td>
		          <td><h6>' . $r[1] . '</h6></td>
    	 	      <td><h6>' . $r[2] . ' ' . $r[3] . '</h6></td>';
                         echo '<td><h6><font color = "green">+ ' . $r[4] . ' PLN </font></h6></td>';
                         echo '
    		      <td><h6>' . $r[5] . ' PLN</h6></td>
  		    </tr>';}
                 }
                     while ($w = mysql_fetch_array($wynik2)) {
                       if($w[6] == 1) {
                         echo
                             '<tr>
    		      <td><h6>' . $w[0] . '</h6></td>
		          <td><h6>' . $w[1] . '</h6></td>
    	 	      <td><h6>' . $w[2] . ' ' . $w[3] . '</h6></td>';
                         echo '<td><h6><font color = "red">- ' . $w[4] . ' PLN </font></h6></td>';
                         echo '
    		      <td><h6>' . $w[5] . ' PLN</h6></td>
  		    </tr>';}
                     }
               while ($q = mysql_fetch_array($wynik3)) {
                   echo
                       '<tr>
    		      <td><h6>' . $q[0] . '</h6></td>
		          <td><h6>doladowanie ' . $q[1] . ' ' . $q[2] . ' zl</h6></td>
    	 	      <td><h6>---------------------</h6></td>';
                             echo '<td><h6><font color = "red">- ' . $q[2] . ' PLN </font></h6></td>';
                             echo '
    		      <td><h6>' . $q[3] . ' PLN</h6></td>
  		    </tr>';
                         }


		 echo '</table>';
	         echo '<br /><br />';
	       }
	       else
	       {
	         echo '<center>BRAK WYKONANYCH PRZELEWÓW</center>';
	       }

               echo '<br /><br /><hr>';
?>
					
  </div>
    </div>
      <div class="footer">
        &copy; eBank Polska S.A. Wszelkie prawa zastrzeżone.
      </div>
    </div>
  </body>
</html>
