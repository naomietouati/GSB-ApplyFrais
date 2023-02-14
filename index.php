<?php 
//balise ouvrante pour que la page qui est automatiquement en html soit en php

// (commentaire personnel sur une seule ligne)
/* 
 * (commentaire personnel
 * il est sur plusieurs lignes)
 */
/** 
 * (commentaire officiel 
 * - sera généré dans la documentation technique
 * - sur plusieurs lignes)
 */

// on termine chaque ligne avec ;

/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php'; 
/*
 * mot cle du language php
 * ce qui suit le mot cle 'require_once' est obligatoire pour le demarage de la page
 * apres on a une adresse d'où il faut aller chercher
 * c'est ecrit dossier/nom_du_fichier
 */
require_once 'includes/class.pdogsb.inc.php';
session_start(); //fonction car il y a les ()
/*
 * chaque p a ses variables locales qui ne soont accessibles que dans cette p. 
 * si on veut les passer d'une p a l'autre, il faut une super globale, cad un tableau accessible dans tout le projet
 * la super globale c'est $_SESSION
 */
$pdo = PdoGsb::getPdoGsb(); 
// variable du nom de pdo a laquelle on affecte le resultat de la fonction getPdoGsb() qui appartient a la classe PdoGsb
//on reconnait une variable avec $
$estConnecte = estConnecte();
include 'vues/v_entete.php';

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
/*
 * $uc c une superglobale qui récupére le champ de uc.
 * get vs post en html c pour direr si l'info est protégée (post) ou non (get)
 * 'uc' nom du champ à filtrer 
 *   
 */
if ($uc && !$estConnecte)     // && --> il y a deux conditions, que uc soit valide est que est connecte est vide (a cause du !)
{   $uc = 'connexion';
} elseif (empty($uc)) // empty --> la variable qui suit ne donne pas un booleen et on veut savoir si elle est vide --> possible qu'elle soit pleine
    { $uc = 'accueil';
}
switch ($uc) // a la place de plein de if elseif elsif...
    {
case 'connexion': //c'est un cas
    include 'controleurs/c_connexion.php';
    break; //fin du cas
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'payerFrais':
    include 'controleurs/c_payerFrais.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
}
require 'vues/v_pied.php';

/*
 * dans cet index
 * 2 require obligat sinn projet demare pas
 * lance superglobale session
 * fct getpdogsb lance la connexion
 * est connecte
 * vue en tete
 * filtre uc 
 * switch sur uc pour envoyer sur la p correspondante a l'etat
 */