<?php
$conn=mysqli_connect('localhost','e-register','e-register','e-register');
if (!$conn) {
	echo ("connessione non riuscita").mysql_error($conn);
}

	$user=isset($_REQUEST['email'])? $_REQUEST['email']:"";
	//echo $user;
	$pass=isset($_REQUEST['pass'])? $_REQUEST['pass']:"";
//echo $pass;
	if (isset($_POST['btnlogin'])) {
		
		if (isset($_POST['email'])&&isset($_POST['pass'])) {
			
			
		$sql="SELECT * FROM teacher"; #WHERE email LIKE '" . mysqli_escape_string($conn, $_REQUEST['email'])."'";
		$q=mysqli_query($conn,$sql);
		while ($r=mysqli_fetch_array($q)) {
			
			if (password_verify($pass,$r['pass'])&&$r['email']==$user) 
			{
      $_SESSION["email"]=$user;
			header('Location:http://localhost/progetto/private.php');
			}
			else 
			{
			echo "password o email non corretti".mysqli_error($conn);
			}
	}
	}
	}
?>


<link rel="stylesheet" type="text/css" href="css/public.css">

<header>
<title>REGISTROH ELETTRONICOH</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/header.css">
<body>

<div class="w3-container">
  
<form class="login100-form validate-form" name="form" method='post' action="index.php">
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Login</button>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-section">
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="email" required>
          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Enter Password" name="pass" required>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="btnlogin">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
        </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>

    </div>

  </div>
</div>
</header>




<section>
  <h1>Dati Voti</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>Materia</th>
          <th>Media</th>
          <th>Voto Minimo</th>
          <th>Voto Massimo</th>
          <th>Deviazione Standard</th>
        </tr>
      </thead>
      <?php
      $conn=mysqli_connect('localhost','e-register','e-register','e-register');
      if (!$conn) {
        echo ("connessione non riuscita").mysql_error($conn);
      }
      $sql="SELECT * from materie";
      $result= $conn -> query($sql);
      
      while ($row=$result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["descr"]. "</td>";

        //media
        $sql0 = "SELECT round(avg(voto),2) as aveg FROM voti v inner join materie m on v.id_materie=m.id_materie WHERE v.id_materie=" . $row["id_materie"];
        $result0 = $conn->query($sql0);
        while ($row0 = $result0->fetch_assoc()) {
          echo "<td>" . $row0["aveg"]. "</td>";
        }

        //voto minimo
        $sql1 = "SELECT MIN(voto) as min FROM voti v inner join materie m on v.id_materie=m.id_materie WHERE v.id_materie=" . $row["id_materie"];
        $result1 = $conn->query($sql1);
        while ($row1 = $result1->fetch_assoc()) {
          echo "<td>" . $row1["min"]. "</td>";
        }
        
        //VOTO MASSIMO
        $sql2 = "SELECT MAX(voto) as max FROM voti v inner join materie m on v.id_materie=m.id_materie WHERE v.id_materie=" . $row["id_materie"];
        $result2 = $conn->query($sql2);
        while ($row2 = $result2->fetch_assoc()) {
          echo "<td>" . $row2["max"]. "</td>";
        }

        //STANDARD DEVIATION
        $sql3 = "SELECT STDDEV(voto) as STD FROM voti v inner join materie m on v.id_materie=m.id_materie WHERE v.id_materie=" . $row["id_materie"];
        $result3 = $conn->query($sql3);
        while ($row3 = $result3->fetch_assoc()) {
          echo "<td>" . $row3["STD"]. "</td>";
        }
        




        echo "</tr>";
      }
      
      ?>
    </table>
  </div>
 
</section>
