<?php
/**Classe générique des modèles. Model est une super classe. Les fonctions qui y sont peuvent être appelées ar tous les modèles**/

//require_once "{$ROOT}{$DS}config{$DS}conf.php";
require_once("../config/Config.php");


class Model{
	public static $pdo; /** On declare une variable qui est une instance de notre base de données**/

/** Initialisation de la connexion a la base de donnée. Voir fichier conf pour tout les paramètres relatifs a la connexion a la bd.*/
	public  function Init()
	{
		$host = Conf::getHostname();
		$dbname = Conf::getDatabase();
		$login = Conf::getLogin();
		$pass = Conf::getPassword();
		try
		{
			self::$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$login,$pass);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage(); // affiche un message d'erreur
			die();
		}
	}

	/**  Fonction de sélection. Permet de recuperer les informations indexées par l'objet passé en paramètre **/
	public  function select($para)
	{

	    $sql = "SELECT * from ".static::$table." WHERE ".static::$primary."=:nom_var";

	    try
	    {

	    	$req_prep = Model::$pdo->prepare($sql);
	    	$req_prep->bindParam(":nom_var", $para);
	    	$req_prep->execute();
	    	$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);

	    	if($req_prep->rowCount()>0)
	    	{
	    		$rslt = $req_prep->fetch();
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

  	/** Fonction d'insertion. Permet d'insérer de nouvelles données dans la base de données. Les valeurs a insérer sont dans le tableau passé en paramètre **/
  	public  function insert($tab)
  	{

	    $sql = "REPLACE INTO ".static::$table." VALUES(";
	    foreach ($tab as $cle => $valeur)
	    {

			$sql .=" :".$cle.",";
		}
		$sql=rtrim($sql,",");
		$sql.=");";

	    try
	    {
	    	$req_prep = Model::$pdo->prepare($sql);
	    	$values = array();
	    	foreach ($tab as $cle => $valeur)
	    	{
	      		$values[":".$cle] = $valeur;
	    	}
	    	$req_prep->execute($values);
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage(); // affiche un message d'erreur
		}
  	}


  	/** Fonction de récupération. Permet de récuper toutes les informations de la table souhaitée en bd **/
	public  function getAll()
	{
	    $SQL="SELECT * FROM ".static::$table.";";

	    try
	    {
	 		$rep = Model::$pdo->query($SQL);
	    	$rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);
	    	return $rep->fetchAll();
	    } 
	    catch(PDOException $e) 
	    {
			if (Conf::getDebug()) 
			{
				echo $e->getMessage(); // affiche un message d'erreur
			} 
			else 
			{
				echo 'Une erreur est survenue <a href="www.google.com"> retour a la page d\'accueil </a>';
			}
			die();
		}   
    }


    /** Fonction de récupération. Permet de récuper toutes les informations de la table souhaitée en bd avec un certain ordre sur celles ci **/
    public  function getAllOrder($att,$order)
    {
	    $SQL="SELECT * FROM ".static::$table." ORDER BY ".$att." ".$order.";";
	    try
	    {
	 		$rep = Model::$pdo->query($SQL);
	    	$rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);
	    	return $rep->fetchAll();
	    } 
	    catch(PDOException $e) 
	    {
			if (Conf::getDebug()) 
			{
				echo $e->getMessage(); // affiche un message d'erreur
			} 
			else 
			{
				echo 'Une erreur est survenue <a href="www.google.com"> retour a la page d\'accueil </a>';
			}
			die();
		}   
    }

    /** Fonction de suppression d'information en base de données. Les informations des données a supprimer sont indexées par le paramètre en entrée **/
	public  function delete($para)
	{
		$sql = "DELETE FROM ".static::$table." WHERE ".static::$primary."=:nom_var";
		try
		{
		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":nom_var", $para);
		  $req_prep->execute();
		  return 0;
		}
		catch(PDOException $e) 
		{
		  if (Conf::getDebug()) 
		  {
		    echo $e->getMessage(); // affiche un message d'erreur
		  }
		  return -1;
		  die();
		}
	}

	/** Function de mise a jour d'informations en base de donnée. Les nouvelles informations ( sous forme de tableau) a insérer et le paramètre d'indexation sont donnés en paramètre d'entrée de la fonction **/
	public  function update($tab, $old) {
		$sql = "UPDATE ".static::$table." SET";
		foreach ($tab as $cle => $valeur)
		{
			$sql .=" ".$cle."=:new".$cle.",";
		}
		$sql=rtrim($sql,",");
		$sql.=" WHERE ".static::$primary."=:oldid;";
		try{
		  $req_prep = Model::$pdo->prepare($sql);
		  $values = array();
		  foreach ($tab as $cle => $valeur)
		  {
		  		$values[":new".$cle] = $valeur;
		  }
		  $values[":oldid"] = $old;
		  $req_prep->execute($values);
		  //$obj = Model::select($tab[static::$primary]);
		  return 1;
		} 
		catch(PDOException $e) 
		{
		  if (Conf::getDebug()) 
		  {
		    echo "PROBLEME"; // affiche un message d'erreur
		  }
		  return -1;
		  die();
		}
	}

	/** Function de mise a jour d'informations en base de donnée. La nouvelle information a insérer et le paramètre d'indexation sont donnés en paramètre d'entrée de la fonction **/
	public  function update2($para,$val){
		$sql = "UPDATE ".static::$table." SET :para = :val ;";
		try
		{
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->bindParam(":para", $para);
		  	$req_prep->bindParam(":val", $val);
		}
		catch(PDOException $e) 
		{
			echo 'Set failed: ' . $e->getMessage();
	  	}

	}

}

//Model::Init(); /** on initialise la connection a la base de donnée **/
?>
