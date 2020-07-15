<?php
session_start();
try
{
$bdd = new PDO("pgsql:host=localhost;dbname=FleeteckDB","postgres", "admin");
}
catch (Exception $e)
{
    die('Erreur : '.$e->getMessage());

}

if (isset($_POST['formconnexion']))
{ 
$Login = ($_POST['email']);
$Password = ($_POST['pass']);
 if((empty($Login)) AND empty($Password)  )
{ 
  header('Location: erreurcnx.php');
}
else
{   
 $requser= $bdd->prepare("SELECT * FROM \"public\".\"User\" WHERE username = ? AND password= ? ;");
 $requser->execute(array($Login, $Password ));
 $userexist = $requser->rowCount();
     if ($userexist == 1)
     {
     	//Si tu a besoin de garder l user name de user et l utiliser dans les autres pages
    	$userinfo = $requser->fetch();
    	 $_SESSION['user'] = $userinfo;
       header('Location: dashboard.php');
    }
     else
     { 
      header('Location: erreurcnx.php');
     }
    }
  }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100 "  style="background-image: url('img/back.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title p-b-33">
						<img src="img/logo.png">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="Password" name="pass" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

				 <div class="login100-form-btn" >
                    <input class="login100-form-btn" type="submit" name="formconnexion" value="Se connecter"></input>
                </div>

					<div class="text-center p-t-45 p-b-4">
						
					</div>
				


					<div class="text-center">
						
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
 <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-pre
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://adminlte.io">FlyTech.io</a></strong>Tout les droits sont réservés.
  </footer>
</div>
	

</body>
</html>