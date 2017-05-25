<?php

require_once("model.php"); 

class Academie extends Model {
	private $id_academie;
	private $nom_academie;


	protected static $table = 'academie';
 	protected static $primary = 'id_academie';

 	public function getNom()
 	{
 		return $this->nom_academie;
 	}

 	public function __construct($nom = NULL) 
 	{
	    if (!is_null($nom)) 
	    {
	      $this->nom_academie = $nom;
	    }
	}
}
?>