<?php

require_once ("model.php");


class Evenement extends Model
{
	private $id_evenement;
	private $intitule_evenement;
	private $description_evenement;
	private $status_evenement; // =1 si évènement approuvé => plus de 10 partcipations, 0 sinon
	private $nb_participation;
	private $nb_jaime;
	private $id_academie;

	protected static $table = 'evenement';
 	protected static $primary = 'id_evenement';

	public function getIntituleEvent()
 	{
 		return $this->intitule_evenement;
 	}

 	public function getDescripEvent()
 	{
 		return $this->description_evenement;
 	}

 	public function getStatus()
 	{
 		return $this->status_evenement;
 	}

 	public function getNbParticipation()
 	{
 		return $this->nb_participation;
 	}

 	public function getNbJaime()
 	{
 		return $this->nb_jaime;
 	}

	//affiche les évènements à venir filtré par académie
	public function getEvtFromAcademy($param){

		$sql = "SELECT * from ".static::$table." INNER JOIN academie ON ".static::$table.".id_academie = academie.id_academie WHERE ".static::$table.".id_academie=:nom_var AND date_event >= NOW() ORDER BY ".static::$table.".date_event";
		if($param === 0){
			$sql = "SELECT * from ".static::$table." INNER JOIN academie ON ".static::$table.".id_academie = academie.id_academie WHERE date_event >= NOW() ORDER BY ".static::$table.".date_event";
		}
		try
		{
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->bindParam(":nom_var", $param);
			$req_prep->execute();
			$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);

			if($req_prep->rowCount()>0)
			{

				$rslt = $req_prep->fetchAll();
			}
			else
			{
				$rslt = null;
			}
			return $rslt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	//les dates des evenements seront de type DATETIME : AAAA-MM-JJ HH:MM:SS
	//this function returns all events wich didn't happen yet ( order by date)
	function getEventOrderByDate(){
		$sql = 'SELECT * FROM evenement WHERE date_event>=NOW() ORDER BY date_event';
		try
		{
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->execute();
			$event = $req_prep->fetchAll();
			$req_prep->closeCursor();
			return $event;
		}
		catch(PDOException $e)
		{
			echo'Search failed' . $e<>getMessage();
		}
	}

	public function getAllEventJoinAcademy(){
		$sql = "SELECT * from ".static::$table." INNER JOIN academie ON ".static::$table.".id_academie = academie.id_academie  ORDER BY ".static::$table.".date_event";
		try
		{
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->execute();
			$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);

			if($req_prep->rowCount()>0)
			{

				$rslt = $req_prep->fetchAll();
			}
			else
			{
				$rslt = null;
			}
			return $rslt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}



 	public function __construct($inti = NULL, $desc = NULL, $status= NULL, $participation= NULL, $jaime= NULL, $academie= NULL)
 	{
	    if (!is_null($inti) && !is_null($desc) && !is_null($status) && !is_null($participation) && !is_null($jaime) && !is_null($academie))
	    {
	      $this->intitule_evenement = $inti;
	      $this->description_evenement = $desc;
	      $this->status_evenement = $status;
	      $this->nb_participation = $participation;
	      $this->nb_jaime = $jaime;
	      $this->id_academie = $academie;
	    }
	}
}
?>