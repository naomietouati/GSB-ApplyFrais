<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$listevisiteur = $pdo-> getLesVisiteurs();
$moisA = getMois(date('d/m/Y'));
$lesMois =  getLesDouzeDerniersMois($moisA);

switch ($action) {
case 'selectionnerVisiteur':
    $lesCles[] = array_keys($listevisiteur);
    $visiteurASelectionner = $lesCles[0];
    $lesCles1[] = array_keys($lesMois);
    $moisASelectionner = $lesCles1[0];
    include 'vues/v_listeVisiteur.php';
    break;

case 'detailFicheFrais':
    $idVisiteur = filter_input(INPUT_POST, 'listeVisiteur', FILTER_SANITIZE_STRING);
    $moisV = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
    
    $condition= $pdo-> estPremierFraisMois($idVisiteur, $moisV);
    if (!$condition){
        $visiteurASelectionner = $idVisiteur;
        $moisASelectionner = $moisV;
        
        $nbJustificatifs = $pdo->getNbjustificatifs($idVisiteur, $moisV);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisV);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $moisV); 
        include 'vues/v_detailFicheFrais.php';  
    } else {
        ajouterErreur('Aucunes informations pour le mois saisi pour ce visiteur');
        include 'vues/v_erreurs.php';
        header("Refresh: 1;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");
    }
    break;
case 'modifierElementsForfaitisés':
    $idVisiteur = filter_input(INPUT_POST, 'listeVisiteur', FILTER_SANITIZE_STRING);
    $moisV = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
    $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $idFrais = filter_input(INPUT_POST, 'id',FILTER_SANITIZE_STRING);
    
    $visiteurASelectionner = $idVisiteur;
    $moisASelectionner = $moisV;
        
    $nbJustificatifs = $pdo->getNbjustificatifs($idVisiteur, $moisV);
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisV);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $moisV); 
        
     if (isset ($_POST['corrigerff']))
    {
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $moisV, $lesFrais);
            ajouterErreur('Les informations ont bien été modifiées');
            include 'vues/v_erreurs.php';
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $moisV);
            include 'vues/v_detailFicheFrais.php';
            
        } else {
            ajouterErreur('Les valeurs des frais forafaitisés doivent être numériques');
            include 'vues/v_erreurs.php';
        } 
    }
    else if (isset ($_POST['corrigerfhf']))
    {
       $pdo->majFraisHorsForfait($idVisiteur,$moisV,$libelle,$date,$montant);
       ajouterErreur('Les informations ont bien été corrigées');
           include 'vues/v_erreurs.php';
       $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisV);
       include 'vues/v_detailFicheFrais.php';
    }
    else if (isset ($_POST['reporter'])) {
        $condition= $pdo-> estPremierFraisMois($idVisiteur, $moisA);
        if (!$condition){
            $pdo->creeNouvellesLignesFrais($idVisiteur, $moisA);
        }
        //$pdo->supprimerFraisHorsForfait($idFrais);
        $libelle2 = ("Refusé ").$libelle;
        $pdo->creeNouveauFraisHorsForfait( $idVisiteur,$moisA,$libelle2,$date,$montant);
        var_dump($idFrais,$idVisiteur,$moisA,$libelle2,$date,$montant);
        ajouterErreur('Les informations ont bien été reportées');
            include 'vues/v_erreurs.php';
        include 'vues/v_detailFicheFrais.php';
    }
    else if(isset ($_POST['validerfinal'])) {
            $etat='VA';
            $pdo->majEtatFicheFrais($idVisiteur, $moisV, $etat);
            $sommeHF=$pdo->getMontantHF($idVisiteur,$moisV);
            $totalHF=$sommeHF[0][0];
            $sommeFF=$pdo->getMontantFF($idVisiteur,$moisV);
            $totalFF=$sommeFF[0][0];
            $montantTotal=$totalHF+$totalFF;
            $pdo->majTotal($idVisiteur,$moisV,$montantTotal);
            include 'vues/v_retourAccueil.php';  
    }
    break;
}    