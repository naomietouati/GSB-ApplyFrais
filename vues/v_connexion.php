<?php //pour mettre des com officiels
/**
 * Vue Connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div class="row"> 
    <!-- pour creer un espace (ici tableau avec colonne) -->
    <div class="col-md-6 col-md-offset-3">
        <!-- taille tableau (300 pouces de long) -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Identification utilisateur</h3>
                <!-- taille du titre (h3) -->
            </div>
            <div class="panel-body">
                <!-- cree un formulaire -->
                <form role="form" method="post"  
                     action="index.php?uc=connexion&action=valideConnexion">
                      <!-- on est dirigé vers l'index, on va filtrer uc on va trouver connexion et pour action on va trouver valideConnexion -->
                    <fieldset>
                        <!-- groupe de champs rattachés -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                <input class="form-control" placeholder="Login"
                                       name="login" type="text" maxlength="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
                                <input class="form-control"
                                       placeholder="Mot de passe" name="mdp"
                                       type="password" maxlength="45">
                            </div>
                        </div>
                        <input class="btn btn-lg btn-success btn-block"
                               type="submit" value="Se connecter">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>