<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeleUtilisateur extends CI_Model {
public function __construct()
{
$this->load->database();
} // __construct

public function existeMelEtudiant($mel,$num = null)
{
  $requete ="SELECT count(*) as 'nombre' FROM `etudiant` where mel = '$mel' AND num not in (select num from etudiant where num = '$num')";
  $query = $this->db->query($requete);
  foreach ($query->result() as $row){
    return $row->nombre;
  }
}
public function getEtudiant($donnee)
  {
   $requete = $this->db->get_where('etudiant',$donnee);
   return $requete->result_array(); //retour de l'étudiant
   }
public function getProfesseur($donnee)
  {
    $requete = $this->db->get_where('professeur',$donnee);
    return $requete->result_array();//retour du prof
  }
Public function getGroup($num)
  {
    $requete = $this->db->get_where('groupe',$num);
    return $requete->row();
  }
public function addEtudiant($Etudiant)
{
  return  $this->db->insert('etudiant',$Etudiant);
}
public function getToutEtudiant()
{
  $requete = $this->db->get('etudiant');
  return $requete->result_array();
}
public function setEtudiant($DonneesAInjectees,$num)
     {
       $this->db->where('num', $num);
       $this->db->update('etudiant', $DonneesAInjectees);
}
public function setContact($Contact)
{
  $this->db->where('nocontact', $Contact['nocontact']);
  $this->db->update('contact', $Contact);
}
public function setEmployer($Employer)
{
  $this->db->where('nocontact', $Employer['nocontact']);
  $this->db->update('employer', $Employer);
}
public function setEtudiantNumGroupe($DonneesAInjectees,$numGroupe)
     {
       $this->db->where('numGroupe', $numGroupe);
       $this->db->update('etudiant', $DonneesAInjectees);
}
public function deleteProduction($refSituation)
  {
    $requete = "delete FROM production WHERE refSituation = $refSituation";
    $query = $this->db->query($requete);
  }
public function deleteSituation($numEtudiant)
  {
    $requete = "delete FROM situation WHERE numEtudiant = $numEtudiant";
    $query = $this->db->query($requete);
  }
public function GetrefSituation($numEtudiant)
  {
    $requete = "Select ref FROM situation WHERE numEtudiant = $numEtudiant";
    $query = $this->db->query($requete);
    return $query->result();
  }
public function deleteCommentaire($refSituation)
  {
    $requete = "delete FROM commentaire WHERE refSituation = $refSituation";
    $query = $this->db->query($requete);
  }
public function deleteEtudiant($numEtudiant)
  {
    $requete = "delete FROM etudiant WHERE num = $numEtudiant";
    $query = $this->db->query($requete);
  }
  public function donneesToCsv($numGroupe) {
  $requete = "SELECT num,nom,prenom,mel,mdp FROM etudiant WHERE numGroupe = $numGroupe";
  return $this->db->query($requete);
}
public function getEntreprise(){
  $this->db->order_by('nom ASC');
  $requete = $this->db->get('entreprise');
  return $requete->result_array();
}
public function getWhereEntreprise($DonneesInjectees){
  $requete = $this->db->get_where('entreprise',$DonneesInjectees);
  return $requete->row_array();
}
public function getSecteur(){
  $requete = $this->db->get('secteur');
  return $requete->result_array();
}
public function getContactEntreprise(){
  $requete = "SELECT contact.nom AS 'nom', entreprise.nom AS 'entreprise', contact.nocontact AS 'nocontact' from entreprise,contact,employer where contact.nocontact = employer.nocontact and employer.noentreprise = entreprise.noentreprise ORDER BY nom ASC";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getWhereContactEntreprise($nocontact){
  $requete = "SELECT contact.nom AS 'nom', entreprise.nom AS 'entreprise', contact.nocontact AS 'nocontact' from entreprise,contact,employer where contact.nocontact = employer.nocontact and employer.noentreprise = entreprise.noentreprise and contact.nocontact = $nocontact";
  $requete = $this->db->query($requete);
  return $requete->row_array();
}
public function addEntreprise($UneEntreprise){
  return  $this->db->insert('entreprise',$UneEntreprise);
}
public function addContact($UnContact){
  return  $this->db->insert('contact',$UnContact);
}
public function getWhereContact($UnContact){
  $requete = $this->db->get_where('contact',$UnContact);
  return $requete->row_array();
}
public function addEmployer($UnEmployer){
  return  $this->db->insert('employer',$UnEmployer);
}
public function getWhereEmployer($UnEmployer){
  $requete = $this->db->get('employer',$UnEmployer);
  return $requete->row_array();
}
public function addStage($UnStage){
  return  $this->db->insert('stage',$UnStage);
}
public function getStageEtudiant($UnEtudiant)
{
  $requete = "SELECT nom,nostage,ville,nocontact,nocontact_tuteur,numProf,intitule,description,datedebut,datefin,commentaire,stage.noentreprise,codeSource from entreprise,stage where entreprise.noentreprise = stage.noentreprise AND numEtudiant = $UnEtudiant";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getWhereStage($donnéeAInjecter)
{
  $requete = "SELECT nom,nostage,ville,nocontact,nocontact_tuteur,numProf,intitule,description,datedebut,datefin,commentaire,stage.noentreprise,codeSource
              from entreprise,stage
              where entreprise.noentreprise = stage.noentreprise AND nostage = $donnéeAInjecter";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getLocalisation()
{
  $requete = $this->db->get('localisation');
  return $requete->result_array();
}
public function getSource()
{
  $requete = $this->db->get('source');
  return $requete->result_array();
}
public function getCadre()
{
  $requete = $this->db->get('cadre');
  return $requete->result_array();
}
public function getType()
{
  $requete = $this->db->get('type');
  return $requete->result_array();
}
public function getTypologie()
{
  $requete = $this->db->get('typologie');
  return $requete->result_array();
}
public function getWhereSituation($DonneesAInjectees)
{
  $requete = $this->db->get_where('situation',$DonneesAInjectees);
  return $requete->result_array();
}
public function addSituation($UneSituation){
  return  $this->db->insert('situation',$UneSituation);
}
public function addTypologie($UneSituation){
  return  $this->db->insert('esttypo',$UneSituation);
}
public function getActivite(){
  $requete = $this->db->get('activite');
  return $requete->result_array();
}
public function getCompétence(){
  $requete = $this->db->get('competence');
  return $requete->result_array();
}
public function addActiviteCitee($DonneesInjectees){
  return  $this->db->insert('activitecitee',$DonneesInjectees);
}
public function deleteActiviteCitee($refSituation){
  $requete = "delete FROM activitecitee WHERE refSituation = $refSituation";
  $query = $this->db->query($requete);
}
public function DeleteWhereActiviteCitee($refSituation,$idActivite){
  $requete = "delete FROM activitecitee WHERE refSituation = $refSituation AND idactivite NOT IN $idActivite";
  $query = $this->db->query($requete);
}
public function getWhereActiviteCitee($refSituation){
  $requete = $this->db->get_where('activitecitee',$refSituation);
  return $requete->result_array();
}
public function UpdateActiviteCitee($commentaire){
  $this->db->where('idActivite', $commentaire['idActivite']);
  $this->db->where('refSituation', $commentaire['refSituation']);
  $this->db->update('activitecitee', $commentaire);
}
public function UpdateStage($data){
$this->db->where('nostage', $data['nostage']);
$this->db->update('stage', $data);
}
public function getSituation(){
  $requete = $this->db->get('situation');
  return $requete->result_array();
}
public function getwhereEsttypo($DonneesAInjectees){
  $requete = $this->db->get_where('esttypo',$DonneesAInjectees);
  return $requete->result_array();
}
public function updateSituation($data){
  $this->db->where('ref', $data['ref']);
  $this->db->update('situation', $data);
}
public function DeleteTypologie($refSituation){
  $requete = "delete FROM esttypo WHERE refSituation = $refSituation";
  $query = $this->db->query($requete);
}
public function SupprimerSituation($refSituation){
  $requete = "delete FROM situation WHERE ref = $refSituation";
  $query = $this->db->query($requete);
}
public function GetStage(){
  $requete = "SELECT entreprise.nom,parcours.nomenclature,datedebut,entreprise.ville,etudiant.prenom as 'prenom_etudiant', codeSource from stage,entreprise,parcours,etudiant where stage.noentreprise = entreprise.noentreprise AND stage.idoption = parcours.id and stage.numEtudiant=etudiant.num";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getEntrepriseOption($option){
  $requete = "SELECT stage.nostage,nom,ville,nomenclature,entreprise.noentreprise
              from entreprise,stage,parcours
              where entreprise.noentreprise = stage.noentreprise AND stage.idoption=parcours.id and nomenclature = '$option'
              Union
              select 0,nom,ville,'inconu',entreprise.noentreprise
              from entreprise
              where entreprise.noentreprise not in(select entreprise.noentreprise from entreprise,stage,parcours where entreprise.noentreprise = stage.noentreprise AND stage.idoption=parcours.id)
              order by nom";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getConnaissance(){
  $requete ="SELECT stage.nostage,libelle from stage,implique,connaissance where stage.nostage=implique.nostage AND implique.noconnaissance=connaissance.noconnaissance";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getwhereSecteur($DonneesInjectees){
  $requete = $this->db->get_where('secteur',$DonneesInjectees);
  return $requete->row_array();
}
public function getstageWhere($DonneesInjectees){
  $requete ="SELECT noentreprise,nom,prenom,commentaire,datedebut,codeSource,nocontact,nocontact_tuteur, nomenclature from stage,etudiant,parcours where stage.numEtudiant = etudiant.num AND noentreprise = $DonneesInjectees AND stage.idoption = parcours.id";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getContact(){
  $requete = $this->db->get('contact');
  return $requete->result_array();
}
public function getActiviteCitee(){
  $requete = $this->db->get('activitecitee');
  return $requete->result_array();
}
public function getEsttypo(){
  $requete = $this->db->get('esttypo');
  return $requete->result_array();
}
public function getNonValideSituation($numGroup){
  $requete = "SELECT etudiant.nom,prenom,groupe.nom as 'classe',annee,libcourt,ref,situation.valide from situation,etudiant,groupe where situation.numEtudiant=etudiant.num and etudiant.numGroupe=groupe.num AND situation.valide IN('N','I') and numGroupe IN";
  $data = "(";
  foreach ($numGroup as $UnGroupe) {
   $data .=$UnGroupe['numGroupe'].",";
 }
 $data .='0)';
 $requete .= $data;
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getWhereExerce($DonneesInjectees){
  $requete = $this->db->get_where('exerce',$DonneesInjectees);
  return $requete->result_array();
}
public function getValideSituation($numGroup){
  $requete = "SELECT etudiant.nom,prenom,groupe.nom as 'classe',annee,libcourt,ref from situation,etudiant,groupe where situation.numEtudiant=etudiant.num and etudiant.numGroupe=groupe.num AND situation.valide = 'V' and numGroupe IN";
  $data = "(";
  foreach ($numGroup as $UnGroupe) {
   $data .=$UnGroupe['numGroupe'].",";
 }
 $data .='0)';
 $requete .= $data;
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getOptionEtudiant($numEtudiant){
  $requete = "SELECT nomenclature,etudiant.nom,etudiant.prenom,id,etudiant.num from etudiant,groupe,parcours where etudiant.num = $numEtudiant and groupe.num = etudiant.numGroupe and groupe.idParcours=parcours.id";
  $requete = $this->db->query($requete);
  return $requete->row_array();
}
public function getEstTypoWhereSituation($numSituation)
{
  $requete ="	SELECT * FROM Typologie typ LEFT OUTER JOIN esttypo etyp  ON (typ.code = etyp.codeTypologie) and refsituation = $numSituation	ORDER BY typ.code";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getActiviteCourtSLAM(){
  $requete = "Select * from activitecourtslam";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getActiviteCourtSISR(){
  $requete = "Select * from activitecourtsisr";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getCroixSLAM($donnee)
{
  $requete = "SELECT * FROM activitecourtslam court
    LEFT OUTER JOIN activitecitee citee  ON (court.id = citee.idActivite)
    and refsituation = ".$donnee['ref']."
    ORDER BY court.id";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getCroixSISR($donnee)
{
  $requete = "SELECT * FROM activitecourtsisr court
    LEFT OUTER JOIN activitecitee citee  ON (court.id = citee.idActivite)
    and refsituation = ".$donnee['ref']."
    ORDER BY court.id";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getWhereGroupe($numProf)
{
  $requete = "Select * from exerce,groupe,parcours where exerce.numGroupe = groupe.num and groupe.idParcours = parcours.id and numProfesseur = $numProf order by annee";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function getNombreInvalideEtudiant($numEtudiant)
{
  $requete = "Select Count(*) 'Nombre' from situation where Valide = 'I' and numEtudiant = $numEtudiant";
  $requete = $this->db->query($requete);
  return $requete->row_array();

}
public function getNombreEnAttenteEtudiant($numEtudiant)
{
  $requete = "Select Count(*) 'Nombre' from situation where Valide = 'N' and numEtudiant = $numEtudiant";
  $requete = $this->db->query($requete);
  return $requete->row_array();

}
public function getNombreValideEtudiant($numEtudiant)
{
  $requete = "Select Count(*) 'Nombre' from situation where Valide = 'V' and numEtudiant = $numEtudiant";
  $requete = $this->db->query($requete);
  return $requete->row_array();
}
public function addCommentaire($donnéeInjecter)
{
 $this->db->insert('commentaire', $donnéeInjecter);
}
public function GetCommentaire($DonneesInjectees)
{
  $requete = $this->db->get_where('commentaire',$DonneesInjectees);
  return $requete->row_array();
}
public function GetCommentaireWhereSituation($refSituation)
{
  $requete = "  select * from commentaire,professeur where commentaire.numprofesseur = professeur.num and refSituation = $refSituation";
  $requete = $this->db->query($requete);
  return $requete->result_array();
}
public function deleteCommentaireProf($donnéeInjecter)
  {
    $requete = "delete FROM commentaire WHERE refSituation = ".$donnéeInjecter['refSituation']." and numProfesseur = ".$donnéeInjecter['numProf'];
    $query = $this->db->query($requete);
  }
  public function UpdateMdpEtudiant($Value)
  {
    $this->db->where('num', $Value['num']);
    $this->db->update('Etudiant', $Value);
  }
  public function UpdateEntreprise($Value)
  {
    $this->db->where('noentreprise', $Value['noentreprise']);
    $this->db->update('entreprise', $Value);
  }

} // Fin Classe
?>
