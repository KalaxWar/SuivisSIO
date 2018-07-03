<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
   {
     parent::__construct();
     $this->load->view('templates/Entete');
     $this->load->view('Admin/DonneeFixe');

    if (!($this->session->profil == 'administrateur')) // 0 : statut visiteur
      {
        redirect('Visiteur'); // pas les droits : redirection vers connexion
      }
    }
public function index()
	{
		$this->load->view('Admin/accueil');
    $this->load->view('templates/pied');
	}

//------------------------------------------------------------------------------

public function AjouterDesComptes($select)
{
  switch ($select) {
    case '1':
  	$this->load->helper('form');
    $this->load->view('Admin/Comptes/AjouterDesComptes/navigation');
  	$this->load->view('Admin/Comptes/AjouterDesComptes/groupe/promotion');
    $this->load->view('templates/pied'); //Pied de page
    $Utilisateur = array(
    'nom' => "BTS SIO", //donnée recuperé du FORM
    'annee' => $this->input->post('annee'),
    'idParcours' => $this->input->post('parcours'), );
    $valide = $this->input->post('num');
    if ($valide == 1) // valide = 1 si le bouton 'enregistrer' est pressé
    {
      $valide = $this->modeleGroupe->existeGroupe($this->input->post('annee'));
      if ($valide == 0) // valide = 0 si l'année utilisé n'existe deja pas dans la table GROUPE
      {
        for ($i=1; $i <3 ; $i++) {
          $Utilisateur = array(
          'nom' => "BTS SIO", //donnée recuperé du FORM
          'annee' => $this->input->post('annee'),
          'idParcours' => $i );
          $this->modeleGroupe->addGroupe($Utilisateur); // ajout du groupe
        }
      $DonneesAInjectees['donnee'] = "Le Groupe a été crée !";
      $this->load->view('DialogueAlert',$DonneesAInjectees);
      }
      else {
        $DonneesAInjectees['donnee'] = "Le Groupe existe déjà !";
        $this->load->view('DialogueAlert',$DonneesAInjectees); //Pied de page
      }
    }
      break;
    case '2':
    $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
    $this->load->view('Admin/Comptes/AjouterDesComptes/navigation');
    $this->load->view('Admin/Comptes/AjouterDesComptes/professeur/Professeur',$Groupe);
    $this->load->view('templates/pied'); //Pied de page
    $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // génération du mdp
    $mot_de_passe = str_shuffle($char);
    $mot_de_passe = substr($mot_de_passe, '0','6'); //mdp généré
    $professeur = array(
    'nom' => $this->input->post('nom'), //donnée recuperé du FORM
    'prenom' => $this->input->post('prenom'),
    'mel' => $this->input->post('mel'),
    'mdp' => $mot_de_passe, //utilisation du mdp généré
    'niveau' => $this->input->post('niveau'), );
    $valide = $this->input->post('num'); // valide = 1 si le bouton 'enregistrer' est pressé
    if ($valide == 1)
    {
      $valide = $this->ModeleProfesseur->existeMelProfesseur($this->input->post('mel'));
      if ($valide == 0) // valide = 0 si l'adresse mail est pas deja utilisé dans la table professeur
      {
      $this->ModeleProfesseur->addProfesseur($professeur); // ajout du professeur
      $numProf= $this->ModeleProfesseur->getnumProf($this->input->post('mel'));
      if (isset($_POST['chkGroupe'])) {
        $numGroupe = $_POST['chkGroupe']; //récupération des checkbox pour les promotions
        foreach ($numGroupe as $UneCheckBox) {
          $exerce = array(
            'numProfesseur' => $numProf,
            'NumGroupe' => $UneCheckBox);
          $this->ModeleProfesseur->addExerce($exerce);
        }
      }
      $DonneesAInjectees['donnee'] = "Le professeur a été crée !";
      $this->load->view('DialogueAlert',$DonneesAInjectees);
      }
      else {
        $DonneesAInjectees['donnee'] = "Le professeur existe déjà !";
        $this->load->view('DialogueAlert',$DonneesAInjectees);
      }
    }

      break;
    case '3':
    $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
    $this->load->view('Admin/Comptes/AjouterDesComptes/navigation');
    $this->load->view('Admin/Comptes/AjouterDesComptes/etudiant/Etudiant',$Groupe);
    $this->load->view('templates/pied'); //Pied de page
    $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // génération du mdp
    $mot_de_passe = str_shuffle($char);
    $mot_de_passe = substr($mot_de_passe, '0','6'); //mdp généré
    $etudiant = array(
    'nom' => $this->input->post('nom'), //donnée recuperé du FORM
    'prenom' => $this->input->post('prenom'),
    'mel' => $this->input->post('mel'),
    'mdp' => $mot_de_passe, //utilisation du mdp généré
    'numGroupe' => $this->input->post('groupe'), );
    $valide = $this->input->post('num');
    if ($valide == 1)
    {
      $valide = $this->ModeleUtilisateur->existeMelEtudiant($this->input->post('mel'));
      if ($valide == '0') // valide = 0 si l'adresse mail est pas deja utilisé dans la table Adminesseur
      {
        $this->ModeleUtilisateur->addEtudiant($etudiant); // ajout de l'Etudiant
        $DonneesAInjectees['donnee'] = "L'étudiant a été crée !";
        $this->load->view('DialogueAlert',$DonneesAInjectees);
        }
        else {
          $DonneesAInjectees['donnee'] = "L'étudiant existe déjà !";
          $this->load->view('DialogueAlert',$DonneesAInjectees);
        }
      }
      break;
    case '4':
    $this->load->helper('form');
    $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
    $this->load->view('Admin/Comptes/AjouterDesComptes/navigation');
    $this->load->view('Admin/Comptes/AjouterDesComptes/fichier/Fichier',$Groupe);
    $this->load->view('templates/pied'); //Pied de page
    $valide = $this->input->post('num');
    if ($valide == 1){
  		$filename=$_FILES["file"]["tmp_name"];
      $extension = strrchr($_FILES['file']['name'], '.');
      if ($extension == '.csv') {
  		 if($_FILES["file"]["size"] > 0)
  		 {
  		  	$file = fopen($filename, "r");
  	        while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
  	         {
               if ($this->input->post('groupe') != '0') {
                 $valide = $this->ModeleUtilisateur->existeMelEtudiant($getData[2]);
                 if ($valide =='0') {
                   $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // génération du mdp
                   $mot_de_passe = str_shuffle($char);
                   $mot_de_passe = substr($mot_de_passe, '0','6'); //mdp généré
                   $data = array('nom' => $getData[0],
                  'numGroupe' => $this->input->post('groupe'),
                  'prenom' => $getData[1],
                  'mel' => $getData[2],
                  'mdp' => $mot_de_passe);
                  $requete = $this->ModeleUtilisateur->addEtudiant($data);
                }
              }
            }
            if ($this->input->post('groupe') == '0') {
              $DonneesAInjectees['donnee'] = "Choisissez d'abord une promotion";
              $this->load->view('DialogueAlert',$DonneesAInjectees);
            }
            if (isset($requete)){
              $DonneesAInjectees['donnee'] = "Upload et traitement du fichier ok, les étudiants sont ajoutés";
              $this->load->view('DialogueAlert',$DonneesAInjectees);
            }
          }
          fclose($file);
        }
        else {
          $DonneesAInjectees['donnee'] = "Type de fichier incorrect, << .CSV >> uniquement";
          $this->load->view('DialogueAlert',$DonneesAInjectees);
          }
      }
      break;
  }
}
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------


//------------------------------------------------------------------------------


//------------------------------------------------------------------------------

public function ModifierDesComptes($select,$numParametre = null)
{
 switch ($select) {
   case '1':
   $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
     $this->load->view('Admin/Comptes/ModifierDesComptes/navigation');
     $this->load->view('Admin/Comptes/ModifierDesComptes/groupe/promotion',$Groupe);
     if (!($numParametre == null))
     {
  $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcoursNumGroupe($numParametre);
  $this->load->view('Admin/Comptes/ModifierDesComptes/groupe/modificationGroupe',$Groupe);
  $this->load->view('templates/pied'); //Pied de page
  $setGroupe = array(
  'nom' => "BTS SIO",
  'annee' => $this->input->post('annee'),
  'idParcours' => $this->input->post('parcours'), );
  $valide = $this->input->post('num');
  if ($valide == 1)
  {
  $this->modeleGroupe->setGroupe($setGroupe,$numParametre);
  redirect('Admin/ModifierDesComptes/1/'.$numParametre);
  }
}
     break;
   case '2':
   $Prof['LesProfesseurs'] = $this->ModeleProfesseur->getProfesseurs();
   $this->load->view('Admin/Comptes/ModifierDesComptes/navigation');
   $this->load->view('Admin/Comptes/ModifierDesComptes/professeur/professeur',$Prof);
   if (!($numParametre == null))
   {
   $Prof['UnProf'] = $this->ModeleProfesseur->getProfesseurNum($numParametre);
   $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcoursNumProf($numParametre);
   $this->load->view('Admin/Comptes/ModifierDesComptes/professeur/modificationProfesseur',$Prof);
   $this->load->view('Admin/Comptes/ModifierDesComptes/professeur/groupeSelectioner',$Groupe); //affichage des groupes coché pour le prof
   $donner ='';
   foreach ($Groupe['LesGroupes'] as $UnGroupe) {
     $donner .= $UnGroupe['numGroupe'].',';
   }
   $donner .= '0';
   $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcoursPasSelect($donner);
   $this->load->view('Admin/Comptes/ModifierDesComptes/professeur/groupeNonSelectioner',$Groupe); //affichage des groupes pas coché pour le prof
   $this->load->view('templates/pied'); //Pied de page
   $valide = $this->input->post('num');
   $setProf = array(
   'nom' => $this->input->post('nom'),
   'prenom' => $this->input->post('prenom'),
   'mel' => $this->input->post('mel'),
   'mdp' => $this->input->post('mdp'),
   'niveau' => $this->input->post('niveau'), );
   if ($valide == 1)
   {
     $validemel = $this->ModeleProfesseur->existeMelProfesseur($this->input->post('mel'),$numParametre);
     if ($validemel == '0') // valide = 0 si l'adresse mail est pas deja utilisé dans la table professeur
     {
       $this->ModeleProfesseur->deleteCheckProf($numParametre);
       if (isset($_POST['chkGroupe'])) {
         $numeroGroupe = $_POST['chkGroupe']; //récupération des checkbox pour les promotions
         foreach ($numeroGroupe as $UneCheckBox) {
           $exerce = array(
             'numProfesseur' => $numParametre,
             'NumGroupe' => $UneCheckBox);
           $this->ModeleProfesseur->addExerce($exerce);
         }
       }
       $this->ModeleProfesseur->setProf($setProf,$numParametre);
       redirect('Admin/ModifierDesComptes/2/'.$numParametre);
     }
     else
     {
      $this->load->view('Admin/Comptes/ModifierDesComptes/professeur/profexistant'); // si l'adresse mail est deja utilisé
     }
    }
 }
     break;

   case '3':
   $Etudiant['LesEtudiants'] = $this->ModeleUtilisateur->getToutEtudiant();
   $this->load->view('Admin/Comptes/ModifierDesComptes/navigation');
   $this->load->view('Admin/Comptes/ModifierDesComptes/etudiant/etudiant',$Etudiant);
   if (!($numParametre == null))
   {
     $numEtudiant = array('num' => $numParametre , );
     $DesEtudiant = $this->ModeleUtilisateur->getEtudiant($numEtudiant);
     $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
     foreach ($DesEtudiant as $UnEtudiant) {
       $EtudiantGroupe = array(
         'UnEtudiant' => $UnEtudiant ,
         'LesGroupes' => $Groupe['LesGroupes'] );
     }
     $this->load->view('Admin/Comptes/ModifierDesComptes/etudiant/modificationEtudiant',$EtudiantGroupe);
     $this->load->view('templates/pied'); //Pied de page
if ($this->input->post('groupe') ==0) {
  $numGroupe = null; // si la promotion choisis est "aucune" alors le numGroupe est initialisé a NULL
}
else
{
  $numGroupe = $this->input->post('groupe');
}
     $valide = $this->input->post('num');
     $setEtudiant = array(
     'nom' => $this->input->post('nom'),
     'prenom' => $this->input->post('prenom'),
     'mel' => $this->input->post('mel'),
     'mdp' => $this->input->post('mdp'),
     'numGroupe' => $numGroupe, );
     if ($valide == 1) // valide = 1 si le formulaire est validé
     {
        $validemel = $this->ModeleUtilisateur->existeMelEtudiant($this->input->post('mel'),$numParametre);
        if ($validemel == '0') // valide = 0 si l'adresse mail est pas deja utilisé dans la table professeur
        {
          $this->ModeleUtilisateur->setEtudiant($setEtudiant,$numParametre);
          redirect('Admin/ModifierDesComptes/3/'.$numParametre);
        }
        else
        {
         $this->load->view('Admin/Comptes/ModifierDesComptes/professeur/profexistant'); // si l'adresse mail est deja utilisé
        }
     }
   }
     break;
 }
}
//----------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------
public function SupprimerDesComptes($select,$numParametre = null)
{
 switch ($select) {
   case '1':
   $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
     $this->load->view('Admin/Comptes/SupprimerDesComptes/navigation');
     $this->load->view('Admin/Comptes/SupprimerDesComptes/groupe/promotion',$Groupe);
     $this->load->view('templates/pied'); //Pied de page
     $valide = $this->input->post('num');
     if ($valide == 1) {
       if (isset($_POST['numero'])) {
         $numeroGroupe = $_POST['numero']; //récupération des checkbox pour les promotions
         foreach ($numeroGroupe as $UnNumGroupe) {
           $this->modeleGroupe->deleteGroupe($UnNumGroupe);
           $DonneesAInjectees = array('numGroupe' => null);
           $this->ModeleProfesseur->setProfesseurNumGroupe($UnNumGroupe);
           $this->ModeleUtilisateur->setEtudiantNumGroupe($DonneesAInjectees,$UnNumGroupe);
           redirect('Admin/SupprimerDesComptes/1/');
         }
       }
     }
     break;
   case '2':
   $Prof['LesProfesseurs'] = $this->ModeleProfesseur->getValidationProf();
   $this->load->view('Admin/Comptes/SupprimerDesComptes/navigation');
   $this->load->view('Admin/Comptes/SupprimerDesComptes/professeur/professeur',$Prof);
   $this->load->view('templates/pied'); //Pied de page
   $valide = $this->input->post('num');
   if ($valide == 1) {
     if (isset($_POST['numero'])) {
       $numeroProf = $_POST['numero']; //récupération des checkbox pour les promotions
       foreach ($numeroProf as $UnNumProf) {
         $this->ModeleProfesseur->deleteCheckProf($UnNumProf);
         $DonneesAInjectees = array('numProfesseur' => null);
         $this->ModeleProfesseur->setCommentaireProf($DonneesAInjectees,$UnNumProf);
         $this->ModeleProfesseur->deleteProfesseur($UnNumProf);
         redirect('Admin/SupprimerDesComptes/2/');
       }
     }
   }
     break;

   case '3':
   $Etudiant['LesEtudiants'] = $this->ModeleUtilisateur->getToutEtudiant();
   $this->load->view('Admin/Comptes/SupprimerDesComptes/navigation');
   $this->load->view('Admin/Comptes/SupprimerDesComptes/etudiant/etudiant',$Etudiant);
   $this->load->view('templates/pied'); //Pied de page
   $valide = $this->input->post('num');
   if ($valide == 1) {
     if (isset($_POST['numero'])) {
       $numeroEtudiant = $this->input->post('numero'); //récupération des checkbox pour les promotions
       foreach ($numeroEtudiant as $UnNumEtudiant) {
               $LesRefsituations = $this->ModeleUtilisateur->GetrefSituation($UnNumEtudiant);
               if (!($LesRefsituations == null)) {
                 foreach ($LesRefsituations as $UneRefSituation) {
                   var_dump($UneRefSituation);
                   $this->ModeleUtilisateur->deleteProduction($UneRefSituation->ref);
                   $this->ModeleUtilisateur->deleteCommentaire($UneRefSituation->ref);
                 }
                 $this->ModeleUtilisateur->deleteSituation($UnNumEtudiant);
                 $this->ModeleUtilisateur->deleteEtudiant($UnNumEtudiant);
                 redirect('Admin/SupprimerDesComptes/3/');
               }
               $this->ModeleUtilisateur->deleteEtudiant($UnNumEtudiant);
               redirect('Admin/SupprimerDesComptes/3/');
             }
           }
         }

     break;
}
}
public function SuivisDesPromotions($numParametre = null)
{
  $this->load->helper('form');
  $this->load->library('form_validation');
  $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
  $DonneesAInjectees['LesEntreprises'] = $this->ModeleUtilisateur->getToutEtudiant();
        $DonneesAInjectees['LesContacts'] = $this->ModeleUtilisateur->getContactEntreprise();
        $where = array('niveau' => '1' , ); //on récupère les prof identifié avec le niveau '1' de la table professeur
        $DonneesAInjectees['LesProfs'] = $this->ModeleUtilisateur->getProfesseur($where);
  $this->load->view('Admin/Comptes/SuivisPromo/groupe/promotion',$Groupe);
  $this->load->view('Admin/Comptes/SuivisPromo/ToutEleve',$DonneesAInjectees);
  if (!($numParametre == null))
    {
      $numGroupe = array('numGroupe' => $numParametre , );
      $LesEtudiants['LesEtudiants'] = $this->ModeleUtilisateur->getEtudiant($numGroupe);
      if (count($LesEtudiants['LesEtudiants']) != 0) {
      $this->load->view('Admin/Comptes/SuivisPromo/groupe/ListEleve.php',$LesEtudiants);
      $this->load->view('templates/pied'); //Pied de page
      }
      else{
      $this->load->view('Admin/Comptes/SuivisPromo/groupe/AucunEleve.php');
      $this->load->view('templates/pied'); //Pied de page
      }
}
}
public function ExportMdp($promotion = null,$numGroupe = null){

 $this->load->dbutil();
 $this->load->helper('download');
 $this->load->helper('file');
 $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
$this->load->view('Admin/CodesAcces/promotion.php',$Groupe);
$this->load->view('templates/pied'); //Pied de page
if (!($promotion == null))
{
 $result = $this->ModeleUtilisateur->donneesToCsv($numGroupe);
 $delimiter = ";";
 $newline = "\r\n";
 force_download($promotion.'.csv',$this->dbutil->csv_from_result($result, $delimiter, $newline));
 $csv = $this->dbutil->csv_from_result($result, $delimiter, $newline);
 if (!write_file('D:\MotDePasse.csv', $csv))
  {
   echo 'Un problème est survenu lors de la génération du fichier CSV';
   }
  else
   {
  echo 'Le fichier CSV a bien été généré';
    }
}
}
public function Sauvegarde()
{
  $this->load->dbutil();
  $prefs = array(
        'format'        => 'txt',                       // gzip, zip, txt
);
  $backup = $this->dbutil->backup($prefs);
  $this->load->helper('download');
  $data = "SET FOREIGN_KEY_CHECKS=1;";
  $backup .= $data;
  $data = "SET FOREIGN_KEY_CHECKS=0;";
  $backup = $data.$backup;
  force_download('Sauvegarde_BDD.sql',$backup);
}
public function rechercheEleve()
{
  $this->load->helper('form');
  $this->load->library('form_validation');
  $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcours();
  $DonneesAInjectees['LesEntreprises'] = $this->ModeleUtilisateur->getToutEtudiant();
        $DonneesAInjectees['LesContacts'] = $this->ModeleUtilisateur->getContactEntreprise();
        $where = array('niveau' => '1' , ); //on récupère les prof identifié avec le niveau '1' de la table professeur
        $DonneesAInjectees['LesProfs'] = $this->ModeleUtilisateur->getProfesseur($where);
  $this->load->view('Admin/Comptes/SuivisPromo/groupe/promotion',$Groupe);
  $this->load->view('Admin/Comptes/SuivisPromo/ToutEleve',$DonneesAInjectees);
  $valide = $this->input->post('num');
  if ($valide == 1)
    {
      $numEleve = array('num' => $this->input->post('noEleve') , );
      $LesEtudiants['LesEtudiants'] = $this->ModeleUtilisateur->getEtudiant($numEleve);
      if (count($LesEtudiants['LesEtudiants']) != 0) {
      $this->load->view('Admin/Comptes/SuivisPromo/groupe/ListEleve.php',$LesEtudiants);
      $this->load->view('templates/pied'); //Pied de page
      }
      else{
      $this->load->view('Admin/Comptes/SuivisPromo/groupe/AucunEleve.php');
      $this->load->view('templates/pied'); //Pied de page
      }
}
}
}
