<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeleGroupe extends CI_Model {
  public function __construct()
  {
  $this->load->database();
  /* chargement database.php (dans config), obligatoirement dans le constructeur */
  }
  public function addGroupe($DonneesAInjectees)
       {
              return  $this->db->insert('groupe',$DonneesAInjectees);
       }
  public function getGroupeParcours()
  {
    $requete = "SELECT num,nom,annee,nomenclature FROM groupe g ,parcours p WHERE g.idparcours =p.id";
    $query = $this->db->query($requete);
    return $query->result_array();
  }
  public function getGroupeParcoursNumGroupe($numGroupe)
  {
    $requete = "SELECT num,nom,annee,nomenclature,idParcours FROM groupe g ,parcours p WHERE g.idparcours =p.id AND num = ?";
    $DonneesInjectees['num'] = $numGroupe;
    $query = $this->db->query($requete,$DonneesInjectees);
    return $query->result_array();
  }
  public function getGroupeParcoursNumProf($numProf)
  {
    $requete ="SELECT g.num AS 'numGroupe',g.nom,annee,nomenclature FROM groupe g ,parcours p , professeur prof , exerce e WHERE g.idparcours =p.id AND prof.num = e.numProfesseur AND g.num = e.numGroupe AND numProfesseur = $numProf";
    $query = $this->db->query($requete);
      return $query->result_array();
  }
  public function getGroupeParcoursPasSelect($GroupeSelectionner)
  {
    $requete ="SELECT num,nom,annee,nomenclature FROM groupe g ,parcours p WHERE g.idparcours =p.id and num not in ($GroupeSelectionner)";
    $query = $this->db->query($requete);
    return $query->result_array();
  }
public function existeGroupe($annee)
{
  $this->db->where('annee',$annee);
  $this->db->from('Groupe');
  return $this->db->count_all_results();
}
public function setGroupe($DonneesAInjectees,$num)
     {
       $this->db->where('num', $num);
       $this->db->update('Groupe', $DonneesAInjectees);
     }
public function deleteGroupe($num)
  {
    $this->db->where('num', $num);
    $this->db->delete('groupe');
  }
}
?>
