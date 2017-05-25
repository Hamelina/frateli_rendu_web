<?php

require_once ("model.php"); 


class Commentaire extends Model 
{
	private $id_commentaire;
	private $description_commentaire;
	private $id_evenement;
	private $date_com;

	protected static $table = 'commentaire';
 	protected static $primary = 'id_commentaire';

 	public function getDescription()
 	{
 		return $this->description_commentaire;
 	}

 	public function getIdEvenement()
 	{
 		return $this->id_evenement;
 	}

 	public function getDateCom()
 	{
 		return $this->date_com;
 	}

	public function getComByIdEvt($id){
		$sql = 'SELECT * FROM commentaire WHERE id_evenement = :idEvt';
		try
		{

			$intId = intval($id);
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->bindParam(":idEvt", $intId);
			$req_prep->execute();
			return $req_prep->fetchAll();
		}
		catch(PDOException $e)
		{
			echo'Checking failed' . $e->getMessage();
		}
	}

 	public function __construct($desc = NULL, $event = NULL, $dateC= NULL) 
 	{
	    if (!is_null($desc) && !is_null($event) && !is_null($dateC)) 
	    {
	    	$this->description_commentaire = $desc;
	    	$this->id_evenement = $event;
	    	$this->date_com = $dateC;
	    }
	}


}
?>