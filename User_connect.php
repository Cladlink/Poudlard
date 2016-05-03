<?php
session_start();
include("php/connexion.php");
// session_start();  dans le config.php

if (isset($_POST['sessions_connexion']) )
{

    // code version 1
    unset($_SESSION['droit']);
    unset($_SESSION['erreur']);
    unset($_SESSION['login']);

    $donnees['login']=$_POST['login'];
    $donnees['password']=htmlentities($_POST['password']);

    $ma_requete_SQL = "SELECT identifiantUser, passwordUser, droitUser
                        from USERS
                        where passwordUser like '".$donnees['password']."' and identifiantUser like '".$donnees['login']."';";
    $reponse =  $ma_connexion_mysql->query($ma_requete_SQL);

    if($reponse != NULL && $reponse->rowCount() == 1)
        {
            $ligne = $reponse->fetchall();
            $_SESSION['droit'] = $ligne[0]['droitUser'];
            $_SESSION['login'] = $ligne[0]['identifiantUser'];
            // redirection
            $_SESSION['message'] = "Bienvenue " . $_SESSION['login'];
            header("Location: index.php");
        }
        else
            $_SESSION['messageErreur']='mot de passe ou login incorrect';
    }

if
( isset($_POST['sessions_connexion']) )
{
    // ## contrôle des données
    $donnees['login']=$_POST['login'];
    $donnees['password']=htmlentities($_POST['password']);
    $erreurs=array();
    if ((! preg_match("/^[A-Za-z0-9]{2,}$/",$donnees['login']))) $erreurs['login']='nom composé de 2 lettres minimum';
    if ((! preg_match("/^[A-Za-z0-9]{2,}$/",$donnees['password']))) $erreurs['password']='nom composé de 2 lettres minimum';

    if(empty($erreurs))
    {
        // ## accés au modéle
        // code version 1
    }
    else
        $_SESSION['messageErreur']='mot de passe ou login incorrect';
}
?>

<?php include("Header.php");?>
    <div class="row">
        <form method="post" action="User_connect.php">
            <div class="row">
                <fieldset>
                    <legend>Connexion</legend>
                    <label>Nom
                        <input name="login"  type="text"  size="18"
                               value="<?php if(isset($donnees['login'])) echo $donnees['login']; ?>"/>
                        <?php if(isset($erreurs['login']))    echo '<small class="error">'.$erreurs['login'].'</small>'; ?>
                    </label>


                    <label>Mot de passe
                        <input name="password"  type="password"  size="18"
                               value="<?php if(isset($donnees['password'])) echo $donnees['password']; ?>"/>
                        <?php if(isset($erreurs['password']))    echo '<small class="error">'.$erreurs['password'].'</small>'; ?>
                    </label>
                    <input type="submit" name="sessions_connexion" value="connexion" />

                    <?php if(isset($_SESSION['erreur'])) echo  '<small class="error">'.$_SESSION['erreur'].'</small>'; ?>
                </fieldset>
            </div>
        </form>
    </div>
<?php include("Footer.php");?>