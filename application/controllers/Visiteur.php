<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visiteur extends CI_Controller {

	public function __construct()
   {
     parent::__construct();
     $this->load->view('templates/Entete');
    }
public function index()
	{
		$this->home();
	}

//------------------------------------------------------------------------------

public function home()
{
	$this->load->model('ModeleUtilisateur');
	$this->load->helper('form');
	$this->load->library('form_validation');

	$DonneesInjectees['TitreDeLaPage'] = 'Se connecter';

	$this->form_validation->set_rules('txtLogin', 'Login', 'required');
	$this->form_validation->set_rules('txtMdp', 'Mot de passe', 'required');
	// Les champs txtIdentifiant et txtMotDePasse sont requis
	// Si txtMotDePasse non renseigné envoi de la chaine 'Mot de passe' requis

	if ($this->form_validation->run() === FALSE)
	 {  // échec de la validation
		 // cas pour le premier appel de la méthode : formulaire non encore appelé
		 $this->load->view('connexion/Authentification', $DonneesInjectees);
		 $this->load->view('connexion/accueil');	 // on renvoie le formulaire
		 $this->load->view('templates/pied'); //Pied de page
	 }
	else
	 {  // formulaire validé
		 $Utilisateur = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur
		 'mel' => $this->input->post('txtLogin'),
		 'mdp' => $this->input->post('txtMdp'),
		 ); // on récupère les données du formulaire de connexion
		 // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
		 $EtudiantRetourné['UnEtudiant'] = $this->ModeleUtilisateur->getEtudiant($Utilisateur);
		 if (!($EtudiantRetourné['UnEtudiant'] == null))
			 {  // Etudiant trouvé!!
				 foreach ($EtudiantRetourné['UnEtudiant'] as $UnEtudiant) {
			 $this->session->prenom = $UnEtudiant['prenom'];
			 $this->session->nom = $UnEtudiant['nom'];
  	 	 $this->session->numEtudiant = $UnEtudiant['num'];
			 $this->session->profil = 'étudiant';
			 $numGroup = array(
			 'num' => $UnEtudiant['numGroupe'],
			 );
			 }
					$GroupRetourné = $this->ModeleUtilisateur->getGroup($numGroup);
					$this->session->numEtudiant = $UnEtudiant['num'];
					$this->session->idParcours = $GroupRetourné->idParcours;
					$this->session->nomGroup = $GroupRetourné->nom;
					$this->session->anneeGroup = $GroupRetourné->annee;
			 		redirect('Etudiant');
		 	}
	 	else
	 		{
		 		$UtilisateurRetourne['UnUtilsateur'] = $this->ModeleUtilisateur->getProfesseur($Utilisateur);
		 		if (!($UtilisateurRetourne['UnUtilsateur'] == null))
		 			{
						foreach ($UtilisateurRetourne['UnUtilsateur'] as $UnUtilisateur) {
						 $this->session->prenom = $UnUtilisateur['prenom'];
						 $this->session->nom = $UnUtilisateur['nom'];
						 $this->session->profil = 'administrateur';
						 $this->session->num = $UnUtilisateur['num'];
						 if ($UnUtilisateur['niveau'] == '0') {
						 	redirect('Admin');
						 }
						 if ($UnUtilisateur['niveau'] == '1') {
							 $this->session->profil = 'professeur';
						 	redirect('professeur');
						 }
						}
				 	}
					else
					{
						$this->load->view('connexion/echecConnexion');
	          $this->load->view('templates/pied'); //Pied de page
					}
			}
}
}
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------


public function seDeConnecter() { // destruction de la session = déconnexion
    $this->session->sess_destroy();
		redirect('Visiteur');
}

//------------------------------------------------------------------------------


//------------------------------------------------------------------------------

}
