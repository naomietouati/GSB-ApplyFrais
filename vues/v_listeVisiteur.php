<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<form action="index.php?uc=validerFrais&action=detailFicheFrais" 
      method="post" role="form">
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
                            <?php echo $nom . ' ' . $unNom ?> </option>
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
    <br>
    <input id="ok" type="submit" value="Valider" class="btn btn-success" 
               role="button">
        <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
               role="button"> 
</form>