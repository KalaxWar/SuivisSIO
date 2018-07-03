<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visiteur extends CI_Controller {

public function index()
	{
		$this->load->view('templates/Entete');
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
	 }
	else
	 {  // formulaire validé
		 $Utilisateur = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur
		 'mel' => $this->input->post('txtLogin'),
		 'mdp' => $this->input->post('txtMdp'),
		 ); // on récupère les données du formulaire de connexion
		 // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
		 $EtudiantRetourné = $this->ModeleUtilisateur->getEtudiant($Utilisateur);
		 if (!($EtudiantRetourné == null))
			 {    // Etudiant trouvé!!
			 $this->session->prenom = $EtudiantRetourné->prenom;
			 $this->session->nom = $EtudiantRetourné->nom;
			 $this->session->profil = 'étudiant';
			 $numGroup = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur
			 'num' => $EtudiantRetourné->numGroupe,
			 );
					$GroupRetourné = $this->ModeleUtilisateur->getGroup($numGroup);
					$this->session->nomGroup = $GroupRetourné->nom;
					$this->session->anneeGroup = $GroupRetourné->annee;
			 		redirect('Etudiant');
		 	}
	 	else
	 		{
		 		$UtilisateurRetourne = $this->ModeleUtilisateur->getProfesseur($Utilisateur);
		 		if (!($UtilisateurRetourne == null))
		 			{
						 $this->session->prenom = $UtilisateurRetourne->prenom;
						 $this->session->nom = $UtilisateurRetourne->nom;
						 $this->session->profil = 'administrateur';
						 redirect('Prof');
				 	}
					else
					{
						$this->load->view('connexion/echecConnexion');
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

public function ajouterPanier($noproduit,$prix)
{
	$DonneesAInjectees = array(
		'noproduit' =>$noproduit ,
	  'utilisateur' =>$this->session->utilisateur,
		'prix' =>$prix
	);
	$this->load->view('templates/Entete');
	$this->load->model('ModelePanier');
	$LigneInséré = $this->ModelePanier->ajouterPanier($DonneesAInjectees);
}
}
