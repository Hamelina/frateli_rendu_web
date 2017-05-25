<?php
class Conf {

  static private $databases = array(

    'hostname' => 'localhost',

    'database' => 'frateli_evenement',

    'login' => 'root',

    'password' => 'root'
  );

  /*données de connexion serveur*/
  /*static private $databases = array(

      'hostname' => 'db683312400.db.1and1.com',

      'database' => 'db683312400',

      'login' => 'dbo683312400',

      'password' => '?Garabla58'
  );*/

  static public function getLogin() {
    // getLogin : => char[]
    //resultat : chaîne de caractère qui correspond au login 
    return self::$databases['login'];
  }

  static public function getHostname(){
    //resultat : renvoie une chaîne de caractère qui correspond au serveur où est hebergé la base de donnée
    return self::$databases['hostname'];
  }

  static public function getDatabase() {
    /**getDatabase : => char[]
      resultat : renvoie le nom de la base de donnée en ligne **/
    return self::$databases['database'];
  }

  static public function getPassword(){
    /**getPassword : => char[]
      résultat: chaîne de caractères qui renvoie le mot de passe*/ 
    return self::$databases['password'];
  }
}
?>