<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<form method="post"
       action="index.php?uc=validerFrais&action=modifierElementsForfaitisés"
       role="form">
    <!--form1 method="post" 
              action="index.php?uc=validerFrais&action=modifierElementsForfaitisés" 
              role="form"-->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="listeVisiteur" accesskey="n">Choisir le visiteur : </label>
                    <select id="listeVisiteur" name="listeVisiteur" class="form-control">
                        <?php
                        foreach ($listevisiteur as $unVisiteur) {
                            $id = $unVisiteur['id'];
                            $nom = $unVisiteur['nom'];
                            $prenom = $unVisiteur['prenom'];
                            if ($id == $visiteurASelectionner) {
                                ?>
                                <option selected value="<?php echo $id ?>">
                                    <?php echo $nom . ' ' . $prenom ?> </option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $id ?>">
                                    <?php echo $nom . ' ' . $prenom ?> </option>
                                <?php
                            }
                        }
                        ?>    
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lstMois" accesskey="n">Mois : </label>
                    <select id="lstMois" name="lstMois" class="form-control">
                        <?php
                        foreach ($lesMois as $unMois) {
                            $mois = $unMois['mois'];
                            $numAnnee = $unMois['numAnnee'];
                            $numMois = $unMois['numMois'];
                            if ($mois == $moisASelectionner) {
                                ?>
                                <option selected value="<?php echo $mois ?>">
                                    <?php echo $numMois.'/'.$numAnnee ?> </option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $mois ?>">
                                    <?php echo $numMois.'/'.$numAnnee ?> </option>
                                <?php
                            }
                        }
                        ?>    

                    </select>
                </div>
            </div> 
        </div>
        <div style="color: orangered">
            <h2>Valider la fiche de frais</h2>
        </div>
        <div class="row">
            <h3>Eléments forfaitisés</h3>

            <div class="col-md-4">
                    <fieldset>       
                        <?php
                        foreach ($lesFraisForfait as $unFrais) {
                            $idFrais = $unFrais['idfrais'];
                            $libelle = htmlspecialchars($unFrais['libelle']);
                            $quantite = $unFrais['quantite']; ?>
                            <div class="form-group">
                                <label for="idFrais"><?php echo $libelle ?></label>
                                <input type="text" id="idFrais" 
                                       name="lesFrais[<?php echo $idFrais ?>]"
                                       size="10" maxlength="5" 
                                       value="<?php echo $quantite ?>" 
                                       class="form-control">
                            </div>
                            <?php
                        }
                        ?>
                        <input id="corrigerff" name="corrigerff" type="submit" value="Corriger" class="btn btn-success"/>
                        <input id="corrigerff" name="corrigerff" type="reset" value="Réinitialiser" class="btn btn-danger"/>
                    </fieldset>
            </div>
        </div>
    <!--/form1-->
        <hr>
        <div class="row"
             class="col-md-4">
            <div class="panel" style="border-color:orangered; color:white">
                <div class="panel-heading" style="background-color:orangered">Descriptif des éléments hors forfait</div>
                <table class="table table-bordered table-responsive" style="color:#000">
                    <thead>
                        <tr>
                            <th class="date">Date</th>
                            <th class="libelle">Libellé</th>  
                            <th class="montant">Montant</th>  
                            <th class="action">&nbsp;</th> 
                        </tr>
                    </thead>  
                    <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date = $unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id']; ?>           
                        <tr> 
                            <td> <input type="text" id="date" 
                                       name="date"
                                       size="10" maxlength="5" 
                                       value="<?php echo $date ?>" 
                                       class="form-control">
                            </td>
                            <td> 
                                <input type="text" id="libelle" 
                                       name="libelle"
                                       size="10" maxlength="5" 
                                       value="<?php echo $libelle ?>" 
                                       class="form-control">
                                </td>
                            <td>
                                <input type="text" id="montant" 
                                       name="montant"
                                       size="10" maxlength="5" 
                                       value="<?php echo $montant ?>" 
                                       class="form-control">
                            </td>
                            <td>   
                                   <input id="corrigerfhf" name="corrigerfhf" type="submit" value="Corriger" class="btn btn-success"/>
         
                                   <a href="index.php?uc=validerFrais&action=modifierElementsForfaitisés&idFrais=<?php echo $id ?>&$_POST=reporter">
                                    <input id="reporterfhf" name="reporter" type="submit" value="Reporter" class="btn btn-danger"/></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>  
                </table>
            </div>
        </div>
<label>Nombre de justificatifs: </label>
<input value=<?php echo $nbJustificatifs ?> type="text"  
        size="4" maxlength="5" >
<br>
<div class="col-md-4"
                 class="row">
    <br>
            <input id="validerfinal" name="validerfinal" type="submit" value="Valider" class="btn btn-success"/>
            </div> 
</form>