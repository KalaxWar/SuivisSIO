<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiant extends CI_Controller {

public function __construct()
 {
   parent::__construct();
   $this->load->view('templates/Entete');
  if (!($this->session->profil == 'étudiant')) //  : statut Etudiant
    {
      redirect('Visiteur'); // pas les droits : redirection vers connexion
    }
    $DonneesAInjectees['LesStages'] = $this->ModeleUtilisateur->getStageEtudiant($this->session->numEtudiant);
    $DonneesAInjectees['Invalide'] = $this->ModeleUtilisateur->getNombreInvalideEtudiant($this->session->numEtudiant);
    $DonneesAInjectees['EnAttente'] = $this->ModeleUtilisateur->getNombreEnAttenteEtudiant($this->session->numEtudiant);
    $DonneesAInjectees['Valide'] = $this->ModeleUtilisateur->getNombreValideEtudiant($this->session->numEtudiant);
    if (!(empty($DonneesAInjectees['LesStages']))) {
      $this->load->view('etudiant/DonneeFixe',$DonneesAInjectees); // si l'Etudiant a un stage alors on les affiches dans les données fixes
    }
    else{
      $this->load->view('etudiant/DonneeFixe'); //si l'étudiant n'a pas de stage on affiche donnéefixe sans aucun paramètre
    }
  }
public function index()
	{
    $this->load->view('etudiant/Accueil');
    $this->load->view('templates/pied'); //Pied de page
	}

//------------------------------------------------------------------------------

public function AjoutStage()
{
      $this->load->helper('form');
      $this->load->library('form_validation');
      $DonneesAInjectees['LesEntreprises'] = $this->ModeleUtilisateur->getEntreprise();
      $DonneesAInjectees['LesContacts'] = $this->ModeleUtilisateur->getContactEntreprise();
      $where = array('niveau' => '1' , ); //on récupère les prof identifié avec le niveau '1' de la table professeur
      $DonneesAInjectees['LesProfs'] = $this->ModeleUtilisateur->getProfesseur($where);
      $this->load->view('etudiant/SituationPro/AjouterStage/FormStage',$DonneesAInjectees);
      $this->load->view('templates/pied'); //Pied de page

      $varif = $this->input->post('num');
      if ($varif=='1') {
        $this->load->helper('date');
      if ($this->input->post('noContactOrga') == '') { $noContactOrga = null;} else {$noContactOrga = $this->input->post('noContactOrga');}
      if ($this->input->post('noContactTuteur') == '') { $noContactTuteur = null;} else {$noContactTuteur = $this->input->post('noContactTuteur');}
      if ($this->input->post('txtDescription') == '') { $txtDescription = null;} else {$txtDescription = $this->input->post('txtDescription');}
      if ($this->input->post('txtcommentaire') == '') { $txtcommentaire = null;} else {$txtcommentaire = $this->input->post('txtcommentaire');}
      $UnStage = array(
        'noentreprise' => $this->input->post('noEntreprise'),
        'nocontact' => $noContactOrga,
        'idoption' => $this->session->idParcours,
        'nocontact_tuteur' => $noContactTuteur,//peu être NULL
        'numProf' => $this->input->post('lstProf'),
        'numEtudiant' => $this->session->numEtudiant,
        'intitule' => $this->input->post('txtIntitule'),
        'description' => $txtDescription,//peu être NULL
        'datedebut' => $this->input->post('txtdatedebut'),
        'datefin' => $this->input->post('txtdatefin'),
        'commentaire' => $txtcommentaire, //peu être NULL
        'codeSource' => $this->input->post('Source'));
        $this->ModeleUtilisateur->addStage($UnStage);
        redirect('etudiant');
      }
}
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------


public function AjouterUneEntreprise() {
  $this->load->helper('form');
  $DonneesAInjectees['LesSecteurs'] = $this->ModeleUtilisateur->getSecteur();
  $this->load->view('etudiant/SituationPro/AjouterStage/CreeEntreprise',$DonneesAInjectees);
  $this->load->view('templates/pied'); //Pied de page
  $valide = $this->input->post('num');
  if ($valide == 1) {
    if ($this->input->post('txtimmatriculation') == '') { $txtimmatriculation = null;} else {$txtimmatriculation = $this->input->post('txtimmatriculation');}
    if ($this->input->post('txtelephone') == '') { $txtelephone = null;} else {$txtelephone = $this->input->post('txtelephone');}
    if ($this->input->post('txtfax') == '') { $txtfax = null;} else {$txtfax = $this->input->post('txtfax');}
    if ($this->input->post('txtemail') == '') { $txtemail = null;} else {$txtemail = $this->input->post('txtemail');}
    if ($this->input->post('txtnomassurance') == '') { $txtnomassurance = null;} else {$txtnomassurance = $this->input->post('txtnomassurance');}
    if ($this->input->post('txtnocontratassurance') == '') { $txtnocontratassurance = null;} else {$txtnocontratassurance = $this->input->post('txtnocontratassurance');}
  $UneEntreprise = array(
    'nosecteur' =>$this->input->post('lstsecteur'),
    'nom' =>$this->input->post('txtnom'),
    'noimmatriculation' =>$txtimmatriculation,//peu être NULL
    'telephone' =>$txtelephone,//peu être NULL
    'fax' =>$txtfax,//peu être NULL
    'email' =>$txtemail,//peu être NULL
    'adresse' =>$this->input->post('txtadresse'),
    'cp' =>$this->input->post('txtcp'),
    'ville' =>$this->input->post('txtville'),
    'pays' =>$this->input->post('txtpays'),
    'nomassurance' =>$txtnomassurance,//peu être NULL
    'nocontratassurance' =>$txtnocontratassurance);//peu être NULL
    $this->ModeleUtilisateur->addEntreprise($UneEntreprise);
    redirect('etudiant/AjoutStage');
  }
}

//------------------------------------------------------------------------------

public function CreeContact(){
  $this->load->helper('form');
  $this->load->library('form_validation');
  $DonneesAInjectees['LesEntreprises'] = $this->ModeleUtilisateur->getEntreprise();
  $this->load->view('etudiant/SituationPro/AjouterStage/CreeContact',$DonneesAInjectees);
  $this->load->view('templates/pied'); //Pied de page
  $valide = $this->input->post('num');
  if ($valide == 1) {
    if ($this->input->post('txtTelFixe') == '') { $txtTelFixe = null;} else {$txtTelFixe = $this->input->post('txtTelFixe');}
    if ($this->input->post('txtTelPortable') == '') { $txtTelPortable = null;} else {$txtTelPortable = $this->input->post('txtTelPortable');}
    if ($this->input->post('txtFonction') == '') { $txtFonction = null;} else {$txtFonction = $this->input->post('txtFonction');}
    if ($this->input->post('txtDiplome') == '') { $txtDiplome = null;} else {$txtDiplome = $this->input->post('txtDiplome');}
    $UnContact = array(
      'nom' =>$this->input->post('txtnom'),
      'telfixe' =>$txtTelFixe,//peu être NULL
      'telportable' =>$txtTelPortable,//peu être NULL
      'email' =>$this->input->post('txtEmail'),
      'fonction' =>$txtFonction,//peu être NULL
      'diplome' =>$txtDiplome);//peu être NULL
    $this->ModeleUtilisateur->addContact($UnContact);
    $UnContact = $this->ModeleUtilisateur->getWhereContact($UnContact);
    $UnEmployer = array(
      'noentreprise' => $this->input->post('noentreprise') ,
      'nocontact' => $UnContact['nocontact']);
    $this->ModeleUtilisateur->addEmployer($UnEmployer);
    redirect('etudiant/AjoutStage');
  }

}

//------------------------------------------------------------------------------

public function NouvelleSituation($switch = null,$numSituation = null)
{
  $LesSituations['LesSituations'] = $this->ModeleUtilisateur->getWhereSituation($Etudiant = array('numEtudiant' => $this->session->numEtudiant));
  foreach ($LesSituations['LesSituations'] as $UneSituation) {
    if ($UneSituation['ref'] == $numSituation ) {
      $this->session->SituationEnCours = $UneSituation;
    }
  }
  $stageSelectioné = $this->session->StageSelectioné;
  $dataSituation = $this->session->SituationEnCours;
  if ($dataSituation == null) { // au cas ou l'utilisateur change le numéro dans l'URL pour l'empecher d'avoir acces à des pages qu'il ne devrait pas
    $switch = 0;
  }
switch ($switch) {
  default:
  if (isset($stageSelectioné)) {
    if (isset($dataSituation)) {
      $donnéeAInjecter['valide'] = '1';
      $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
    }
  $donnéeAInjecter['pipo'] = "";
  $this->load->view('etudiant/SituationPro/navigation',$donnéeAInjecter);
  $donnéeAInjecter['Localisation'] = $this->ModeleUtilisateur->getLocalisation();
  $donnéeAInjecter['Source'] = $this->ModeleUtilisateur->getSource();
  $donnéeAInjecter['Cadre'] = $this->ModeleUtilisateur->getCadre();
  $donnéeAInjecter['Type'] = $this->ModeleUtilisateur->getType();
  $donnéeAInjecter['LesTypologie'] = $this->ModeleUtilisateur->getTypologie();
  if (isset($dataSituation)) {
  $donnéeAInjecter['SituationSelect'] = $this->ModeleUtilisateur->getWhereSituation($noSituation = array('ref' => $dataSituation['ref']));
  $donnéeAInjecter['typoSelect'] = $this->ModeleUtilisateur->getwhereEsttypo($noSituation = array('refSituation' => $dataSituation['ref']));
  }
  $this->load->view('etudiant/SituationPro/NouvelleSituation',$donnéeAInjecter);
  $this->load->view('templates/pied'); //Pied de page
  $valide = $this->input->post('num');
  if ($valide == 1) {
    if ($this->input->post('txtcontexte') == '') { $txtcontexte = null;} else {$txtcontexte = $this->input->post('txtcontexte');}
    if ($this->input->post('txtEnvirTechno') == '') { $txtEnvirTechno = null;} else {$txtEnvirTechno = $this->input->post('txtEnvirTechno');}
    if ($this->input->post('txtmoyen') == '') { $txtmoyen = null;} else {$txtmoyen = $this->input->post('txtmoyen');}
    if ($this->input->post('txtcommentaire') == '') { $txtcommentaire = null;} else {$txtcommentaire = $this->input->post('txtcommentaire');}
    $UneSituation = array(
      'numEtudiant' =>$this->session->numEtudiant,
      'codeLocalisation' =>$this->input->post('lstLocalisation'),
      'codeSource' =>$this->session->SourceStage,
      'codeType' =>$this->input->post('lstType'),
      'codeCadre' =>$this->input->post('lstCadre'),
      'libcourt' =>$this->input->post('txtLibelle'),
      'descriptif' =>$this->input->post('txtdescription'),
      'contexte' =>$txtcontexte,//peu être NULL
      'datedebut' =>$this->input->post('txtdatedebut'),
      'datefin' =>$this->input->post('txtdatefin'),
      'environnement' =>$txtEnvirTechno,//peu être NULL
      'moyen' =>$txtmoyen,//peu être NULL
      'commentaire' =>$txtcommentaire,
      'valide' =>'N');//peu être NULL
    if (!($dataSituation == null)) {
      $UneSituation['ref'] = $dataSituation['ref'];
      $this->ModeleUtilisateur->updateSituation($UneSituation);
      $this->ModeleUtilisateur->DeleteTypologie($dataSituation['ref']);
    }
    else {
      $this->ModeleUtilisateur->addSituation($UneSituation);
    }
    $LesSituation['laSituation'] = $this->ModeleUtilisateur->getWhereSituation($UneSituation);
    foreach ($LesSituation['laSituation'] as $laSituation) {
      $this->session->SituationEnCours = $laSituation;
      $numSituation = $laSituation['ref'];
    }
    if (isset($_POST['typologie'])) {
      $numTypologie = $_POST['typologie']; //récupération des checkbox pour les promotions
      foreach ($numTypologie as $UneCheckBox) {
        $UneTypologie = array(
          'refSituation' => $numSituation,
          'codeTypologie' => $UneCheckBox);
        $this->ModeleUtilisateur->addTypologie($UneTypologie);
      }
  }
redirect('etudiant/NouvelleSituation/3');
  }
}
  else{
    $DonneesAInjectees['donnee'] = "Sélectioner ou ajouter préalablement un stage pour pouvoir ajouter une situation";
    $this->load->view('DialogueAlert',$DonneesAInjectees); //Pied de page
    $this->load->view('templates/pied'); //Pied de page
}
    break;
  case '1':
  unset($_SESSION['SituationEnCours']);
redirect('etudiant/NouvelleSituation/');
    break;
case '3':
if (isset($stageSelectioné)) {
  if (isset($dataSituation)) {
    $donnéeAInjecter['valide'] = '1';
    $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
    $refSituation = $dataSituation['ref'];
  }
$donnéeAInjecter['pipo'] = "";

$this->load->view('etudiant/SituationPro/navigation',$donnéeAInjecter);
if ($this->session->idParcours == '2') {
$LesActivites['LesActivites'] = $this->ModeleUtilisateur->getActiviteCourtSLAM();
}
else {
$LesActivites['LesActivites'] = $this->ModeleUtilisateur->getActiviteCourtSISR();
}
  $LesActivites['LesActivitesCitee'] = $this->ModeleUtilisateur->getWhereActiviteCitee($ref = array('refSituation' => $refSituation));
  $LesActivites['LesCompétences'] = $this->ModeleUtilisateur->getCompétence();
  $this->load->view('etudiant/SituationPro/Activite',$LesActivites);
  $this->load->view('templates/pied'); //Pied de page
  if (isset($_POST['send'])) {
    $LesActivites = $_POST['send'];

    $idActivite = '(';
    foreach ($LesActivites as $UneAcitivite)
    {
      $idActivite = $idActivite.$UneAcitivite. ',';
    }
    $idActivite = $idActivite.'0)';
    var_dump($idActivite);
    $this->ModeleUtilisateur->DeleteWhereActiviteCitee($refSituation,$idActivite);
    foreach ($LesActivites as $UneActivite) {
      $donnéeAInjecter = array(
        'idActivite' => $UneActivite,
        'refSituation' => $refSituation);
      $this->ModeleUtilisateur->addActiviteCitee($donnéeAInjecter);
    }

    $UneSituation = array(
      'valide' =>'N');
    if (!($dataSituation == null)) {
      $UneSituation['ref'] = $dataSituation['ref'];
      $this->ModeleUtilisateur->updateSituation($UneSituation);
    }
redirect('etudiant/NouvelleSituation/4');
}
}
  break;
  case '4':
  if (isset($stageSelectioné)) {
    if (isset($dataSituation)) {
      $donnéeAInjecter['valide'] = '1';
      $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
      $refSituation = $dataSituation['ref'];
    }
  $donnéeAInjecter['pipo'] = "";
    $this->load->view('etudiant/SituationPro/navigation',$donnéeAInjecter);
    if ($this->session->idParcours == '2') {
    $LesActivites['LesActivites'] = $this->ModeleUtilisateur->getActiviteCourtSLAM();
    }
    else {
    $LesActivites['LesActivites'] = $this->ModeleUtilisateur->getActiviteCourtSISR();
    }
    $LesActivites['LesActivitesCitee'] = $this->ModeleUtilisateur->getWhereActiviteCitee($ref = array('refSituation' => $refSituation));
    $LesActivites['LesCompétences'] = $this->ModeleUtilisateur->getCompétence();
    $this->load->view('etudiant/SituationPro/reformulation',$LesActivites);
    $this->load->view('templates/pied'); //Pied de page
    if (isset($_POST['txtreformu'])) {
      $LesActivites = $_POST['txtreformu'];
      foreach ($LesActivites as $clé => $UneActivite) {

      $commentaire = array('idActivite' => $clé ,
      'commentaire' => $UneActivite , 'refSituation' => $refSituation);
      $this->ModeleUtilisateur->UpdateActiviteCitee($commentaire);
      }
      redirect('etudiant/NouvelleSituation/4');
    }
  }
    break;
    case'5':
      if (isset($stageSelectioné)) {
        if (isset($dataSituation)) {
          $donnéeAInjecter['valide'] = '1';
          $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
          $refSituation = $dataSituation['ref'];
        }
        $this->load->view('etudiant/SituationPro/navigation',$donnéeAInjecter);
        $LeCommentaire['LeCommentaire'] = $this->ModeleUtilisateur->GetCommentaireWhereSituation($refSituation);
        $this->load->view('etudiant/SituationPro/commentaire',$LeCommentaire);
  }
}
}
public function modifierStage($numStage = null){
  // tester si le stage fait parti des stages de l'étudiant //
  $LesStages['LesStages'] = $this->ModeleUtilisateur->getStageEtudiant($this->session->numEtudiant);
  if ($numStage == null) {
  $this->load->view('etudiant/SituationPro/ModifierStage/afficheStage',$LesStages);
  $this->load->view('templates/pied'); //Pied de page
}
  if (!($numStage == null)) {
    //affichages des données dans les champs
    $UnStages['UnStages'] = $this->ModeleUtilisateur->getWhereStage($numStage);
    foreach ($UnStages['UnStages'] as $LeStage) {
      $UneEntreprise = $this->ModeleUtilisateur->getWhereEntreprise($numprof = array('noentreprise' => $LeStage['noentreprise']));
      $DonneesAInjectees['EntrepriseSelect'] = $UneEntreprise['nom'].' | '.$UneEntreprise['ville'];
      $DonneesAInjectees['numEntrepriseSelect'] = $UneEntreprise['noentreprise'];
      $UnProf = $this->ModeleUtilisateur->getProfesseur($numprof = array('num' => $LeStage['numProf'], 'niveau' => '1'));
      foreach ($UnProf as $leProf) {
      $DonneesAInjectees['ProfSelect'] = $leProf['nom'];
      }
      $DonneesAInjectees['LesProfs'] = $this->ModeleUtilisateur->getProfesseur($where = array('niveau' => '1')); //on récupère les prof identifié avec le niveau '1' de la table professeur
      if (!($LeStage['nocontact'] == null)) {
      $UnContact = $this->ModeleUtilisateur->getWhereContactEntreprise($LeStage['nocontact']);
      $DonneesAInjectees['Orgatuteur'] = $UnContact['nom'].' | '.$UnContact['entreprise'];
      $DonneesAInjectees['NumOrgatuteur'] = $UnContact['nocontact'];
      }
      if (!($LeStage['nocontact_tuteur'] == null)) {
      $UnContact = $this->ModeleUtilisateur->getWhereContactEntreprise($LeStage['nocontact_tuteur']);
      $DonneesAInjectees['tuteur'] = $UnContact['nom'].' | '.$UnContact['entreprise'];
      $DonneesAInjectees['Numtuteur'] = $UnContact['nocontact'];
      }
      $DonneesAInjectees['LesEntreprises'] = $this->ModeleUtilisateur->getEntreprise();
      $DonneesAInjectees['LesContacts'] = $this->ModeleUtilisateur->getContactEntreprise();
      $DonneesAInjectees['intitule'] = $LeStage['intitule'];
      if (!($LeStage['description'] == null)) {
      $DonneesAInjectees['description'] = $LeStage['description'];
      }
      $DonneesAInjectees['datedebut'] = $LeStage['datedebut'];
      $DonneesAInjectees['datefin'] = $LeStage['datefin'];
      if (!($LeStage['commentaire'] == null)) {
      $DonneesAInjectees['commentaire'] = $LeStage['commentaire'];
      }
      $DonneesAInjectees['nostage'] = $numStage;
      $DonneesAInjectees['codeSource'] = $LeStage['codeSource'];
    }
$this->load->view('etudiant/SituationPro/ModifierStage/FormStage',$DonneesAInjectees);
$this->load->view('templates/pied'); //Pied de page
//-------------------------------------------------------------------------------------------
//on récupère les données des champs pour mettre a jour les données du stage
$verif = $this->input->post('num');
if ($verif=='1') {
  $this->load->helper('date');
if ($this->input->post('noContactOrga') == '') { $noContactOrga = null;} else {$noContactOrga = $this->input->post('noContactOrga');}
if ($this->input->post('noContactTuteur') == '') { $noContactTuteur = null;} else {$noContactTuteur = $this->input->post('noContactTuteur');}
if ($this->input->post('txtDescription') == '') { $txtDescription = null;} else {$txtDescription = $this->input->post('txtDescription');}
if ($this->input->post('txtcommentaire') == '') { $txtcommentaire = null;} else {$txtcommentaire = $this->input->post('txtcommentaire');}
$LeStage = array(

  'noentreprise' => $this->input->post('noEntreprise'),
  'nocontact' => $noContactOrga,
  'idoption' => $this->session->idParcours,
  'nocontact_tuteur' => $noContactTuteur,//peu être NULL
  'numProf' => $this->input->post('lstProf'),
  'numEtudiant' => $this->session->numEtudiant,//peu être NULL
  'intitule' => $this->input->post('txtIntitule'),
  'description' => $txtDescription,//peu être NULL
  'datedebut' => $this->input->post('txtdatedebut'),
  'datefin' => $this->input->post('txtdatefin'),
  'commentaire' => $txtcommentaire, //peu être NULL
  'nostage' => $numStage,
  'codeSource' => $this->input->post('Source'));
  $this->ModeleUtilisateur->UpdateStage($LeStage);
  redirect('etudiant/modifierStage/'.$numStage);
}
  }

}
public function selectionerUnStage($numStage = null)
{
  unset($_SESSION['SituationEnCours']);
  if ($numStage == null) {
    $this->session->StageSelectioné = "PPE / TP";
    $this->session->SourceStage = "1";
  }
  else {
    $UnStage['UnStage'] = $this->ModeleUtilisateur->getWhereStage($numStage);
    var_dump($UnStage);
    foreach ($UnStage['UnStage'] as $LeStage) {
      if ($LeStage['codeSource'] == '2') { $annee = 'Première année :';}
      if ($LeStage['codeSource'] == '3') {$annee = 'Deuxième année :';}
      $stageSelectioné = $LeStage['nom'].' | '.$annee;
      $this->session->StageSelectioné = $stageSelectioné;
      $this->session->NuméroStageSelectioné = $LeStage['nostage']; // permet de savoir quel stage est séléctioné
      $this->session->SourceStage = $LeStage['codeSource'];
      var_dump($UnStage);
  }
  }

  redirect('etudiant/NouvelleSituation/2');
}
public function modifierUneSituation($numSituation = null)
{
  $LesSituations['LesSituations'] = $this->ModeleUtilisateur->getWhereSituation($Etudiant = array('numEtudiant' => $this->session->numEtudiant,'codeSource'=>$this->session->SourceStage));
    if ($numSituation == null) {
        $stageSelectioné = $this->session->StageSelectioné;
      if (isset($stageSelectioné)) {
        $this->load->view('etudiant/SituationPro/ModifierSituation/AfficherSituation',$LesSituations);
        $this->load->view('templates/pied'); //Pied de page
      }
      else {
        $DonneesAInjectees['donnee'] = "Sélectioner ou ajouter préalablement un stage pour pouvoir modifier une situation";
        $this->load->view('DialogueAlert',$DonneesAInjectees); //Pied de page
        $this->load->view('templates/pied'); //Pied de page

      }
    }
}
public function SupprimerSituation($numSituation = null)
{
  $LesSituations['LesSituations'] = $this->ModeleUtilisateur->getWhereSituation($Etudiant = array('numEtudiant' => $this->session->numEtudiant));
  foreach ($LesSituations['LesSituations'] as $UneSituation) {
    if ($UneSituation['ref'] == $numSituation ) {
      $this->ModeleUtilisateur->deleteActiviteCitee($numSituation);
      $this->ModeleUtilisateur->DeleteTypologie($numSituation);
      $this->ModeleUtilisateur->deleteCommentaire($numSituation);
      $this->ModeleUtilisateur->SupprimerSituation($numSituation);
        redirect('etudiant/modifierUneSituation/');
    }
  }
}
public function AfficherEntreprise($option = null){
  if (!($option == null)) {
    $LesEntreprises['LesEntreprises'] = $this->ModeleUtilisateur->getEntrepriseOption($option);
    $LesEntreprises['LesConnaissances'] = $this->ModeleUtilisateur->getConnaissance();
    $this->load->view('etudiant/Divers/afficherEntreprise',$LesEntreprises);
    $this->load->view('templates/pied'); //Pied de page
  }
  else {
    $this->load->view('etudiant/Divers/choixOption');
    $this->load->view('templates/pied'); //Pied de page
  }
}
public function FicheEntreprise($numEntreprise = null){
  if (!($numEntreprise == null)) {
    $UneEntreprise = $this->ModeleUtilisateur->getWhereEntreprise($noEntreprise =  array('noentreprise' => $numEntreprise));
    $donnéeAInjecter['UneEntreprise'] = $UneEntreprise;
    $donnéeAInjecter['Secteur'] = $this->ModeleUtilisateur->getwhereSecteur($nosecteur =  array('nosecteur' => $UneEntreprise['nosecteur']));
    $donnéeAInjecter['LesStages'] = $this->ModeleUtilisateur->getstageWhere($numEntreprise);
    $donnéeAInjecter['LesContacts'] = $this->ModeleUtilisateur->getContact();
    $this->load->view('etudiant/Divers/ficheEntreprise',$donnéeAInjecter);
    $this->load->view('templates/pied'); //Pied de page
    }
}
public function CreeSynthese(){
  define('FPDF_FONTPATH',$this->config->item('fonts_path'));
  $this->load->library('fpdf');
  $this->load->view('Etudiant/Synthese');
}
public function Modifier_Mdp()
{
  $this->load->view('Etudiant/Divers/Modifier_Mdp');
  if ($this->input->post('submit')) {
    $this->ModeleUtilisateur->UpdateMdpEtudiant($arrayName = array('num' => $this->session->numEtudiant,'mdp'=>$this->input->post('txtMdp')));
    $DonneesAInjectees['donnee'] = "Le mot de passe a été modifier!";
    $this->load->view('DialogueAlert',$DonneesAInjectees);
  }
}
public function Modifier_Entreprise()
{ $LesEntreprises['LesEntreprises'] = $this->ModeleUtilisateur->getEntreprise();
  if ($this->input->post('SubmitRecherche')) {
  $DonneesAInjectees['LesSecteurs'] = $this->ModeleUtilisateur->getSecteur();
  $DonneesAInjectees['UneEntreprise'] = $this->ModeleUtilisateur->getWhereEntreprise($arrayName = array('noentreprise' => $this->input->post('noentreprise')));
  $this->load->view('etudiant/SituationPro/AjouterStage/CreeEntreprise',$DonneesAInjectees);
  $this->load->view('templates/pied'); //Pied de page
  }
  else {
    $this->load->view('etudiant/SituationPro/AjouterStage/rechercheEntreprise',$LesEntreprises);
  }
  if ($this->input->post('SubmitModifier')) {
    if ($this->input->post('txtimmatriculation') == '') { $txtimmatriculation = null;} else {$txtimmatriculation = $this->input->post('txtimmatriculation');}
    if ($this->input->post('txtelephone') == '') { $txtelephone = null;} else {$txtelephone = $this->input->post('txtelephone');}
    if ($this->input->post('txtfax') == '') { $txtfax = null;} else {$txtfax = $this->input->post('txtfax');}
    if ($this->input->post('txtemail') == '') { $txtemail = null;} else {$txtemail = $this->input->post('txtemail');}
    if ($this->input->post('txtnomassurance') == '') { $txtnomassurance = null;} else {$txtnomassurance = $this->input->post('txtnomassurance');}
    if ($this->input->post('txtnocontratassurance') == '') { $txtnocontratassurance = null;} else {$txtnocontratassurance = $this->input->post('txtnocontratassurance');}
  $UneEntreprise = array(
    'noentreprise' => $this->input->post('noentreprise'),
    'nosecteur' =>$this->input->post('lstsecteur'),
    'nom' =>$this->input->post('txtnom'),
    'noimmatriculation' =>$txtimmatriculation,//peu être NULL
    'telephone' =>$txtelephone,//peu être NULL
    'fax' =>$txtfax,//peu être NULL
    'email' =>$txtemail,//peu être NULL
    'adresse' =>$this->input->post('txtadresse'),
    'cp' =>$this->input->post('txtcp'),
    'ville' =>$this->input->post('txtville'),
    'pays' =>$this->input->post('txtpays'),
    'nomassurance' =>$txtnomassurance,//peu être NULL
    'nocontratassurance' =>$txtnocontratassurance);//peu être NULL
    $this->ModeleUtilisateur->UpdateEntreprise($UneEntreprise);
    //redirect('etudiant/AjoutStage');
}

}
public function Modifier_Contact()
{ $LesContacts['LesContacts'] = $this->ModeleUtilisateur->getContact();
  if ($this->input->post('SubmitRecherche')) {
  $DonneesAInjectees['UnContact'] = $this->ModeleUtilisateur->getWhereContact($arrayName = array('nocontact' => $this->input->post('nocontact')));
  $Employeur['Employeur'] = $this->ModeleUtilisateur->getWhereEmployer($arrayName = array('nocontact' => $this->input->post('nocontact')));
  $DonneesAInjectees['NumEntreprise'] = $Employeur['Employeur']['noentreprise'];
  $DonneesAInjectees['LesEntreprises'] = $this->ModeleUtilisateur->getEntreprise();
  $this->load->view('etudiant/SituationPro/AjouterStage/CreeContact',$DonneesAInjectees);
  $this->load->view('templates/pied'); //Pied de page
  }
  else {
    $this->load->view('etudiant/SituationPro/AjouterStage/rechercheContact',$LesContacts);
  }
  if ($this->input->post('SubmitModifier')) {
      if ($this->input->post('txtTelFixe') == '') { $txtTelFixe = null;} else {$txtTelFixe = $this->input->post('txtTelFixe');}
      if ($this->input->post('txtTelPortable') == '') { $txtTelPortable = null;} else {$txtTelPortable = $this->input->post('txtTelPortable');}
      if ($this->input->post('txtFonction') == '') { $txtFonction = null;} else {$txtFonction = $this->input->post('txtFonction');}
      if ($this->input->post('txtDiplome') == '') { $txtDiplome = null;} else {$txtDiplome = $this->input->post('txtDiplome');}
      $UnContact = array(
        'nocontact'=>$this->input->post('nocontact'),
        'nom' =>$this->input->post('txtnom'),
        'telfixe' =>$txtTelFixe,//peu être NULL
        'telportable' =>$txtTelPortable,//peu être NULL
        'email' =>$this->input->post('txtEmail'),
        'fonction' =>$txtFonction,//peu être NULL
        'diplome' =>$txtDiplome);//peu être NULL
      $this->ModeleUtilisateur->setContact($UnContact);
      $UnContact = $this->ModeleUtilisateur->getWhereContact($UnContact);
      $UnEmployer = array(
        'noentreprise' => $this->input->post('noentreprise') ,
        'nocontact' => $UnContact['nocontact']);
      $this->ModeleUtilisateur->setEmployer($UnEmployer);
      redirect('etudiant');
  }

}
}
