<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeleProfesseur extends CI_Model {
  public function __construct()
  {
  $this->load->database();
  /* chargement database.php (dans config), obligatoirement dans le constructeur */
  }
  //----------------------------------------------------------------------------------------------------
  public function existeMelProfesseur($mel,$num = 0)
  {
    $requete ="SELECT count(*) as 'nombre' FROM `professeur` where mel = '$mel' AND num not in (select num from professeur where num = '$num')";
    $query = $this->db->query($requete);
    foreach ($query->result() as $row){
      return $row->nombre;}
  }
  //----------------------------------------------------------------------------------------------------
  public function addProfesseur($professeur)
  {
    $requete = $this->db->insert('professeur',$professeur);
  }
  //----------------------------------------------------------------------------------------------------
public function getnumProf($mel)
{
  $sql = "SELECT * FROM professeur WHERE mel = ?";
  $DonneesInjectees['mel'] = $mel;
  $query = $this->db->query($sql, $DonneesInjectees);
  foreach ($query->result() as $row){
    return $row->num;}
}
//----------------------------------------------------------------------------------------------------
public function addExerce($DonneesAInjectees)
{
  return $this->db->insert('exerce',$DonneesAInjectees);
}
//----------------------------------------------------------------------------------------------------
public function getProfesseurs()
{
  $requete = $this->db->get('professeur');
  return $requete->result_array();
}
//----------------------------------------------------------------------------------------------------
public function getProfesseurNum($num)
{
  $requete = "SELECT num,nom,prenom,mel,niveau,mdp FROM professeur WHERE num = $num";
  $query = $this->db->query($requete);
  return $query->result_array();
}
//----------------------------------------------------------------------------------------------------
public function setProf($DonneesAInjectees,$num)
     {
       $this->db->where('num', $num);
       $this->db->update('professeur', $DonneesAInjectees);
     }
     //----------------------------------------------------------------------------------------------------
public function deleteCheckProf($numProf)
  {
    $requete = "delete FROM exerce WHERE numProfesseur = $numProf";
    $query = $this->db->query($requete);
  }
  //----------------------------------------------------------------------------------------------------
  public function setProfesseurNumGroupe($numGroupe)
  {
    $requete = "delete FROM exerce WHERE numGroupe = $numGroupe";
    $query = $this->db->query($requete);
  }
//----------------------------------------------------------------------------------------------------
public function getValidationProf()
{
  $requete ="SELECT count(*) as 'nombre' FROM `commentaire` where numProfesseur is null";
  $query = $this->db->query($requete);
  foreach ($query->result() as $row){
    $nbNull = $row->nombre;}
  $requete ="SELECT count(*) as 'nombre' FROM `commentaire`";
  $query = $this->db->query($requete);
  foreach ($query->result() as $row){
    $nbcommentaire = $row->nombre;}
  if ($nbNull == $nbcommentaire) {
    $valide = 0; // si toute les lignes de la colonne numProfesseur de la table commentaire est NULL alors
  }
  else {
    $valide = 1; // si il y a au moins une ligne de la colonne numProfesseur de la table commentaire qui n'est pas nul alors
  }
  if ($valide == 1) { // la bonne requete si au moins 1 numProfesseur est rentré dans la table commentaire
    $requete ="SELECT num,nom,prenom,mel,count(*) as nombre From professeur, commentaire Where professeur.num=commentaire.numProfesseur and niveau='1' Group by num,nom,prenom,mel union Select num,nom,prenom,mel,0 from professeur where niveau='1' and num not in (select numProfesseur from commentaire) order by num";
    $query = $this->db->query($requete);
    return $query->result_array();
  }
  if ($valide == 0) { // la bonne requete si tout les numProfesseur sont NULL dans la table commentaire
    $requete ="SELECT num,nom,prenom,mel,count(*) as nombre From professeur, commentaire Where professeur.num=commentaire.numProfesseur and niveau='1' Group by num,nom,prenom,mel union Select num,nom,prenom,mel,0 from professeur where niveau='1' order by num";
    $query = $this->db->query($requete);
    return $query->result_array();
  }
}
public function setCommentaireProf($DonneesInjectees,$num)
{
  $this->db->where('numProfesseur', $num);
  $this->db->update('commentaire', $DonneesInjectees);
}
public function deleteProfesseur($numProf)
  {
    $requete = "delete FROM professeur WHERE num = $numProf";
    $query = $this->db->query($requete);
  }
}
?>
