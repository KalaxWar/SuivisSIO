<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Synthese extends CI_Controller {

	public function index()
	{
		$InfoEtudiant = $this->ModeleUtilisateur->getOptionEtudiant($this->session->numEtudiant);
		$donnéeAInjecter['Parcours'] = $InfoEtudiant['nomenclature'];
		$donnéeAInjecter['nom'] = $InfoEtudiant['nom'].' '.$InfoEtudiant['prenom'];
		$donnéeAInjecter['numCandidat'] = $InfoEtudiant['num'];
		$donnéeAInjecter['id'] = $InfoEtudiant['id'];
		if ($InfoEtudiant['nomenclature'] == 'SLAM') {
			$donnéeAInjecter['LesActivites'] = $this->ModeleUtilisateur->getActiviteCourtSLAM($InfoEtudiant['id']);
		}
		if ($InfoEtudiant['nomenclature'] == 'SISR') {
			$donnéeAInjecter['LesActivites'] = $this->ModeleUtilisateur->getActiviteCourtSISR($InfoEtudiant['id']);
		}
    $donnéeAInjecter['LesActivitesCitee'] = $this->ModeleUtilisateur->getActiviteCitee();
		$donnéeAInjecter['LesSituationsForma'] = $this->ModeleUtilisateur->getWhereSituation($numEtudiant = array('numEtudiant' =>$this->session->numEtudiant,'codeSource' => '1','valide' => 'V'));
		$donnéeAInjecter['LesSituationsPremiere'] = $this->ModeleUtilisateur->getWhereSituation($numEtudiant = array('numEtudiant' =>$this->session->numEtudiant,'codeSource' => '2','valide' => 'V'));
		$donnéeAInjecter['LesSituationsDeuxieme'] = $this->ModeleUtilisateur->getWhereSituation($numEtudiant = array('numEtudiant' =>$this->session->numEtudiant,'codeSource' => '3','valide' => 'V'));
		$donnéeAInjecter['LesTypologies'] = $this->ModeleUtilisateur->getEsttypo();
    define('FPDF_FONTPATH',$this->config->item('fonts_path'));
    $this->load->library('fpdf');
		if ($InfoEtudiant['nomenclature'] == 'SLAM') {
					$this->load->view('etudiant/SyntheseSLAM',$donnéeAInjecter);
		}
		else {
			$DonneesAInjectees['donnee'] = "Une erreure est survenue ! Contactez l'administrateur";
			$this->load->view('DialogueAlert',$DonneesAInjectees); //Pied de page
		}
		if ($InfoEtudiant['nomenclature'] == 'SISR') {
					$this->load->view('etudiant/SyntheseSISR',$donnéeAInjecter);
		}
		else {
			$DonneesAInjectees['donnee'] = "Une erreure est survenue ! Contactez l'administrateur";
			$this->load->view('DialogueAlert',$DonneesAInjectees); //Pied de page
		}
	}
	public function SyntheseEleve($numEtudiant = null)
	{
			$this->session->numEtudiant = $numEtudiant;
			redirect('Synthese');
		}
}
