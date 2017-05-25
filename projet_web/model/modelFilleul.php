<?php

require_once ("model.php"); 


class Filleul extends Model 
{
	private $id_filleul;
 	private $nom_filleul;
 	private $prenom_filleul;
 	private $adr_mail_filleul;
	private $pwd;

 	protected static $table = 'filleul';
 	protected static $primary = 'id_filleul';

	/*GETTERS */
 	public function getNom()
 	{
 		return $this->nom_filleul;
 	}

 	public function getPrenom()
 	{
 		return $this->prenom_filleul;
 	}

 	public function getAdrMail()
 	{
 		return $this->adr_mail_filleul;
 	}

	//vérifie si un utilisateur existe en base en comparant le mot de passe renseigné avec celui stocké en base crypté
	public function checkUserAccount($login,$password){
		try
		{

			$sql = 'SELECT * FROM filleul WHERE adr_mail = :log';
			$req_prep = Model::$pdo->prepare($sql);
			$param = array('log' => $login);
			$req_prep->execute($param);
			$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);

			if($req_prep->rowCount()>0){
				$rslt = $req_prep->fetch();
				$check = password_verify($password,$rslt["motdepasse"]); //decryptage et vérification du mot de passe
				if($check){
					return $rslt;
				}
				else{
					return array();
				}
			}
		}
		catch(PDOException $e)
		{
			echo'Checking failed' . $e->getMessage();
		}
	}

 	public function __construct($nom = NULL, $prenom = NULL,$pwd = NULL ,  $adr_mail= NULL)
 	{
	    if (!is_null($nom) && !is_null($prenom) && !is_null($adr_mail) && !is_null($pwd))
	    {
			$this->nom_filleul = $nom;
			$this->prenom_filleul = $prenom;
			$this->adr_mail_filleul = $adr_mail;
			$this->pwd = $pwd;

	    }
	}

	//ajout d'un utlisateur(filleul) en base de donnée
	function insertUser(){
		$success = false;
		$cryptedPwd = password_hash($this->pwd,PASSWORD_DEFAULT);//cryptage du mot de passe
		$param =array(
			"id_filleul" => NULL,
			"nom_filleul" => $this->nom_filleul,
			"prenom_filleul" => $this->prenom_filleul,
			"adr_mail" => $this->adr_mail_filleul,
			"motdepasse" => $cryptedPwd,
		);
		if(!Filleul::mailExist($this->adr_mail_filleul)){
			$this->insert($param);
			$success = true;
		}
		return $success;

	}

/** Permet de verifier si le mail passé en paramètre existe bien dans la table des filleuls de la base de données 
* 
**/
	public static function mailExist($mail)
	{
		$sql = "SELECT adr_mail FROM filleul WHERE adr_mail= :mail";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->bindParam(":mail", $mail);
		$req_prep->execute();
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.static::$table);
		return ($req_prep->rowCount()!=0);
	}
}
?>