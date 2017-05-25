<?php

require_once ("model.php"); 


class Ambassadeur extends Model 
{
	private $id_ambassadeur;
	private $nom_ambassadeur;
	private $prenom_ambassadeur;
	private $date_naissance;
	private $adr_email;
	private $img_ambassadeur;

	protected static $table = 'ambassadeur';
 	protected static $primary = 'id_ambassadeur';

 	public function getNom()
 	{
 		return $this->$nom_ambassadeur;
 	}

 	public function getPrenom()
 	{
 		return $this->$prenom_ambassadeur;
 	}

 	public function getDateNaissance()
 	{
 		return $this->$date_naissance;
 	}

 	public function getAdrMail()
 	{
 		return $this->$adr_email;
 	}

 	public function getImage()
 	{
 		return $this->$img_ambassadeur;
 	}

 	public function __construct($nom = NULL, $prenom = NULL, $dateN= NULL, $adrMail= NULL, $img= NULL) 
 	{
	    if (!is_null($nom) && !is_null($prenom) && !is_null($dateN) && !is_null($adrMail) && !is_null($img=)) 
	    {
	      $this->$nom_ambassadeur = $nom;
	      $this->$prenom_ambassadeur = $prenom;
	      $this->$date_naissance = $dateN;
	      $this->$adr_email = $adrMail;
	      $this->$img_ambassadeur = $img;
	    }
	}
}
?>