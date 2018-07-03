<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class professeur extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->view('templates/Entete');
    $this->load->view('prof/DonneeFixe');
    if (!($this->session->profil == 'professeur')) // 0 : statut visiteur
      {
        redirect('Visiteur'); // pas les droits : redirection vers connexion
      }
    }

  function index()
  {
    $this->load->view('prof/Accueil'); //Pied de page
    $this->load->view('templates/pied'); //Pied de page
  }
function situation($index = null)
{
      $this->load->view('prof/suivis/navigation');
      switch ($index) {
        case '1':
          $LesGroupes['NumGroupe'] = $this->ModeleUtilisateur->getWhereExerce($arrayName = array('numProfesseur' => $this->session->num ));
          $LesSituationsNonValide['LesSituationsNonValide'] = $this->ModeleUtilisateur->getNonValideSituation($LesGroupes['NumGroupe']);
          $this->load->view('prof/suivis/nonValide',$LesSituationsNonValide);
          $this->load->view('templates/pied'); //Pied de page
          break;
        case '2':
          $LesGroupes['NumGroupe'] = $this->ModeleUtilisateur->getWhereExerce($arrayName = array('numProfesseur' => $this->session->num ));
          $LesSituationsValide['LesSituationsValide'] = $this->ModeleUtilisateur->getValideSituation($LesGroupes['NumGroupe']);
          $this->load->view('prof/suivis/SituationValide',$LesSituationsValide);
          $this->load->view('templates/pied'); //Pied de page
        break;
        default:
          # code...
          break;
      }
}
public function modifierSituation($switch = null,$numSituation = null)
{
  $LesSituations['LesSituations'] = $this->ModeleUtilisateur->getWhereSituation($Etudiant = array('ref' => $numSituation));
  foreach ($LesSituations['LesSituations'] as $UneSituation) {
      $this->session->SituationEnCours = $UneSituation;
  }
  $stageSelectioné = $this->session->StageSelectioné;
  $dataSituation = $this->session->SituationEnCours;
  if ($dataSituation == null) { // au cas ou l'utilisateur change le numéro dans l'URL pour l'empecher d'avoir acces à des pages qu'il ne devrait pas
    $switch = 0;
  }
switch ($switch) {
  default:
    if (isset($dataSituation)) {
      $donnéeAInjecter['valide'] = '1';
      $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
      $donnéeAInjecter['Valide'] = $dataSituation['valide'];
    }
  $donnéeAInjecter['pipo'] = "";
  $this->load->view('prof/suivis/modifierSituation/navigation',$donnéeAInjecter);
  $donnéeAInjecter['Localisation'] = $this->ModeleUtilisateur->getLocalisation();
  $donnéeAInjecter['Source'] = $this->ModeleUtilisateur->getSource();
  $donnéeAInjecter['Cadre'] = $this->ModeleUtilisateur->getCadre();
  $donnéeAInjecter['Type'] = $this->ModeleUtilisateur->getType();
  $donnéeAInjecter['LesTypologie'] = $this->ModeleUtilisateur->getTypologie();
  if (isset($dataSituation)) {
  $donnéeAInjecter['SituationSelect'] = $this->ModeleUtilisateur->getWhereSituation($noSituation = array('ref' => $dataSituation['ref']));
  $donnéeAInjecter['typoSelect'] = $this->ModeleUtilisateur->getwhereEsttypo($noSituation = array('refSituation' => $dataSituation['ref']));
  }
  $this->load->view('prof/suivis/modifierSituation/NouvelleSituation',$donnéeAInjecter);
  $this->load->view('templates/pied'); //Pied de page
  $valide = $this->input->post('num');
    break;
case '3':
  if (isset($dataSituation)) {
    $donnéeAInjecter['valide'] = '1';
    $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
    $donnéeAInjecter['Valide'] = $dataSituation['valide'];
    $refSituation = $dataSituation['ref'];
  }
$donnéeAInjecter['pipo'] = "";

$this->load->view('prof/suivis/modifierSituation/navigation',$donnéeAInjecter);
  $LesActivites['LesActivites'] = $this->ModeleUtilisateur->getActivite();
  $LesActivites['LesActivitesCitee'] = $this->ModeleUtilisateur->getWhereActiviteCitee($ref = array('refSituation' => $refSituation));
  $LesActivites['LesCompétences'] = $this->ModeleUtilisateur->getCompétence();
  $this->load->view('prof/suivis/modifierSituation/Activite',$LesActivites);
  $this->load->view('templates/pied'); //Pied de page
  if (isset($_POST['send'])) {
    $LesActivites = $_POST['send'];
    $this->ModeleUtilisateur->deleteActiviteCitee($refSituation);
    foreach ($LesActivites as $UneActivite) {
      $donnéeAInjecter = array(
        'idActivite' => $UneActivite,
        'refSituation' => $refSituation);
      $this->ModeleUtilisateur->addActiviteCitee($donnéeAInjecter);
    }
redirect('professeur/modifierSituation/4');
}
  break;
  case '4':
    if (isset($dataSituation)) {
      $donnéeAInjecter['valide'] = '1';
      $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
      $donnéeAInjecter['Valide'] = $dataSituation['valide'];
      $refSituation = $dataSituation['ref'];
    }
  $donnéeAInjecter['pipo'] = "";
    $this->load->view('prof/suivis/modifierSituation/navigation',$donnéeAInjecter);
    $LesActivites['LesActivites'] = $this->ModeleUtilisateur->getActivite();
    $LesActivites['LesActivitesCitee'] = $this->ModeleUtilisateur->getWhereActiviteCitee($ref = array('refSituation' => $refSituation));
    $LesActivites['LesCompétences'] = $this->ModeleUtilisateur->getCompétence();
    $this->load->view('prof/suivis/modifierSituation/reformulation',$LesActivites);
    $this->load->view('templates/pied'); //Pied de page
    if (isset($_POST['txtreformu'])) {
      $LesActivites = $_POST['txtreformu'];
      foreach ($LesActivites as $clé => $UneActivite) {
      $commentaire = array('idActivite' => $clé ,
      'commentaire' => $UneActivite);
      $this->ModeleUtilisateur->UpdateActiviteCitee($commentaire);
      }
      redirect('professeur/modifierSituation/4');
    }
    break;
    case'5':
    if (isset($dataSituation)) {
        $donnéeAInjecter['valide'] = '1';
        $donnéeAInjecter['Situation'] = $dataSituation['libcourt'];
        $donnéeAInjecter['Valide'] = $dataSituation['valide'];
        $refSituation = $dataSituation['ref'];
      }
    $donnéeAInjecter['pipo'] = "";
    $this->load->view('prof/suivis/modifierSituation/navigation',$donnéeAInjecter);
    $DonneesAInjectees = array('refSituation' =>$refSituation, 'numProfesseur'=>$this->session->num );
    $LeCommentaire['LeCommentaire'] = $this->ModeleUtilisateur->GetCommentaire($DonneesAInjectees);
    $this->load->view('prof/suivis/modifierSituation/commentaire',$LeCommentaire);
    $valide = $this->input->post('num');
    if ($valide == 1) {
        if (!(empty($LeCommentaire['LeCommentaire']))) {
          foreach ($LeCommentaire as $UnCommentaire) {
            $parametre = array('numProf' => $this->session->num , 'refSituation' => $UnCommentaire['refSituation'] );
            $this->ModeleUtilisateur->deleteCommentaireProf($parametre);
          }
        }
      $UnCommentaire = array(
        'refSituation' => $refSituation ,
        'numProfesseur' => $this->session->num,
        'commentaire' => $this->input->post('txtCommentaire'));
        $this->ModeleUtilisateur->addCommentaire($UnCommentaire);
        redirect('professeur/modifierSituation/5');
    }

    break;
  }
}
public function ValiderSituation() {
  $dataSituation = $this->session->SituationEnCours;
  var_dump($dataSituation['ref']);
  $this->ModeleUtilisateur->updateSituation($ref = array('ref' => $dataSituation['ref'],'valide' => 'V'));
  redirect('professeur/situation/1');
}
public function InvaliderSituation() {
  $dataSituation = $this->session->SituationEnCours;
  var_dump($dataSituation['ref']);
  $this->ModeleUtilisateur->updateSituation($ref = array('ref' => $dataSituation['ref'],'valide' => 'I'));
  redirect('professeur/situation/1');
}
public function SyntheseEleve($NumGroupe = null)
{
  $LesGroupes['LesGroupes'] = $this->ModeleUtilisateur->getWhereGroupe($this->session->num);
  if (!($NumGroupe == null)) {
    $this->load->view('prof/suivis/choixGroupe',$LesGroupes);
    $LesEtudiants['LesEtudiants'] = $this->ModeleUtilisateur->getEtudiant($arrayName = array('numGroupe' =>$NumGroupe));
    $this->load->view('prof/suivis/SyntheseEleve',$LesEtudiants);
    $this->load->view('templates/pied'); //Pied de page
  }
  else {
    $this->load->view('prof/suivis/choixGroupe',$LesGroupes);
    $this->load->view('templates/pied'); //Pied de page
  }

}
public function ExportMdp($promotion = null,$numGroupe = null){

 $this->load->dbutil();
 $this->load->helper('download');
 $this->load->helper('file');
 $Groupe['LesGroupes'] = $this->modeleGroupe->getGroupeParcoursNumProf($this->session->num);
$this->load->view('prof/ExportMdp.php',$Groupe);
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
}
