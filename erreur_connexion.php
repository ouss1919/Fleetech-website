
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Style des icones -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Style de la page-->
	<link rel="stylesheet" type="text/css" href="style_erreur_connexion2.css">
	<!-- icone de la page-->
	<link rel="SHORTCUT ICON" href="./icon.png" />
</head>

<body>
	<header>
		<div class="row">
			<div class="logo">
				<img src="./logo1.png" / alt="graduation" class="logo-img">
			</div>
			<ul class="main-nav">
				<li><a href="Home.php"><i class="fa fa-home"></i><span> Retourner à la page principale</span> &nbsp ACCUEIL</a></li>
				<li class="active"><a href="membres.php"><i class="fa fa-lock"></i><span> Cliquer ici pour vous connecter</span> &nbspCONNEXION</a></li>
				<li><a href="aide.php"><i class="fa fa-question-circle-o"></i><span> Obtenir de l'aide</span> &nbspAIDE</a></li>
				<li><a href="a_propos.php"><i class="fa fa-info-circle"></i><span> Lire à propos de nous</span> &nbspA PROPOS</a></li>
			</ul>
		</div>

		<div class="loginbox">
            <h1> La connexion a échoué, veuillez réessayer! </h1>
            
			<div class="avatar">
				<img src="./avatar.png" / alt="avatar" class="avatar-img">
			</div>
			<form method="POST" action="">
				<p> Email </p>
				<input type="email" class="Email" name="Login" placeholder="Exemple@esi.dz" />
				<p> Mot de passe </p>
				<input type="password" class="mot2pass" name="Password" placeholder="Entrer le mot de passe" />
				<br/>
				<br/>
				<input class="save" type="submit" name="formconnexion" value="CONNEXION" />
				<br/>
			</form>
		</div>
	</header>
</body>


</html>
<?php
session_start();
try
{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=pfe','root', '');
}
catch (Exception $e)
{
	die('Erreur : '.$e->getMessage());

}

if (isset($_POST['formconnexion']))
{ 
$Login = htmlspecialchars($_POST['Login']);
$Password = ($_POST['Password']);
$mdp =  ($_POST['Password']);
 if((empty($Login)) AND empty($Password)  AND empty($mdp))
{ 
  header('Location: erreur_connexion.php');

}
else
{   
 $requser1= $bdd->prepare("SELECT * FROM compte WHERE Login = ? AND Password = ?  ");
 $requser2= $bdd->prepare("SELECT * FROM compte WHERE Login = ? AND Password = ?  ");
 $requser1->execute(array($Login, $Password ));
 $requser2->execute(array($Login, $mdp ));
 $userexist1 = $requser1->rowCount();
 $userexist2 = $requser2->rowCount();

     if ($userexist1 == 1  )
     {
       $userinfo1 = $requser1->fetch();
      $_SESSION['Login']=$userinfo1['Login'];
      $_SESSION['compteID']=$userinfo1['compteID'];
      $profil_type =  $bdd->prepare('SELECT `Type` FROM `compte` WHERE `Login`=?');
      $profil_type-> execute(array($Login));
      while($type = $profil_type->fetch())
      {
        if ($type['Type']=='enseignant')
        {
          header("Location: profil.php?compteID=".$_SESSION['compteID']);
     
        }
        elseif ($type['Type']=='responsable')
        {
          header("Location: profil1.php?compteID=".$_SESSION['compteID']);
        }
        elseif($type['Type']=='employe')
        {
         
          header("Location: profil2.php?compteID=".$_SESSION['compteID']);
        }
      }
     
    
    }
      elseif ($userexist2 == 1) 
      {     
         $userinfo2 = $requser2->fetch();
        $_SESSION['Login']=$userinfo2['Login'];
        $_SESSION['compteID']=$userinfo2['compteID'];
        $profil_type =  $bdd->prepare('SELECT `Type` FROM `compte` WHERE `Login`');
        
        $profil_type-> execute(array($Login));
      
        while($type = $profil_type->fetch())
        { 
          if ($type['Type']=='enseignant')
          {
            header("Location: profil.php?compteID=".$_SESSION['compteID']);
       
          }
          elseif ($type['Type']=='responsable')
          {
            header("Location: profil1.php?compteID=".$_SESSION['compteID']);
          }
          elseif($type['Type']=='employe')
          {   
            header("Location: profil2.php?compteID=".$_SESSION['compteID']);
          }
        }
        }
     
     else
     { 
      header('Location: erreur_connexion.php');
      
     }
    }
  }   
?>
