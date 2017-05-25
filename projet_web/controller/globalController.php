<?php
    require_once("../model/modelFilleul.php");//model qui gère les différentes opérations en base de données
    class globalController{
        private $filleul;
        protected $page;
        protected $isConnected = false;

        function checkAccount($login, $password){
            $this->filleul = new Filleul();
            $this->filleul->Init();
            return $this->filleul->getAccountFromBdd($login,$password);

        }

        //affichage de la vue du menu
        function loadMenu(){
            echo '<div id="logo">'.
                    '<img src="view/img/logo.jpg" alt="Logo de Frateli" />'.
                '</div>'.
                '<ul class="nav nav-tabs">'.
                    '<li><a href="accueil">Accueil</a></li>'.
                    '<li><a href="evenements">Evènements</a></li>'.
                    '<li><a href="contact">Contact</a> </li>';
            echo '</ul>';
            if(isset($_COOKIE["connected"]) && $_COOKIE["connected"] === "true"){
                echo '<div class="infoUserContainer">
                            <span class="infoUser">Bonjour mr '.$_COOKIE["nomUser"].'</span>'.
                            '<form action="index.php" method="POST" class="formDeconnexion"><input type="hidden" name="logout" value ="yes"><button class="btn-deconnect btn btn-lg btn-primary btn-block" type="submit">déconnexion</button></form>
                       </div>';

            }
            else{

                echo    '<div class="formLogin" ><button class="btn btn-lg btn-primary btn-block btnLogin" data-toggle="modal" data-target="#myModalAddUSer">s\'inscrire comme filleul</button></div>';
            }

        }

        // fonction qui récupère et affiche tout les académies présents en base
        public function getAllAcademie(){
            $academie =new Academie();
            $academie->Init();
            $response =$academie->getAll();

            echo '<select class="form-control dropdownList"  name="academySelection" >';
            foreach ($response as $key ) {
                echo '<option value="'.$key["id_academie"].'">'.$key["nom_academie"].'</option>';
            }
            echo '</select>';
        }


        //ajout d'un utilisateur
        public static function addUser(){
            if(isset($_POST["nomUser"]) && isset($_POST["prenomUser"]) && isset($_POST["pwdUser"]) && isset($_POST["emailUser"])){
                $filleul = new Filleul($_POST["nomUser"],$_POST["prenomUser"],$_POST["pwdUser"],$_POST["emailUser"]  );
                $filleul->Init();
                $userCreated =  $filleul->insertUser();
                if($userCreated){
                    echo '<div class="alert alert-success alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>utlisateur crée avec succès</strong>
                         </div>';
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>une erreur s\'est produite</strong>
                         </div>';
                }
            }
        }

        //gestion de la connexion utilisateur
        public static function login(){

            if(isset($_POST["login"]) && isset($_POST["pwd"])){
                $filleul = new Filleul();
                $filleul->Init();
                $userInfo = $filleul->checkUserAccount($_POST["login"],$_POST["pwd"] );

                if(count($userInfo) !== 0){
                    setCookie("connected","true",time()+60,"/");
                    $_COOKIE["connected"] = "true";

                    setCookie("nomUser",$userInfo["nom_filleul"],time()+60,"/");
                    $_COOKIE["nomUser"] = $userInfo["nom_filleul"];

                    setCookie("prenomUser",$userInfo["prenom_filleul"]);
                    $_COOKIE["prenomUser"] = $userInfo["prenom_filleul"];

                    setCookie("mailUser",$userInfo["adr_mail"]);
                    $_COOKIE["mailUser"] = $userInfo["adr_mail"];

                    setCookie("idUser",$userInfo["id_filleul"]);
                    $_COOKIE["idUser"] = $userInfo["id_filleul"];
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>l\'utilisateur n\'existe ou le mot de passe ne correspond pas</strong>
                         </div>';
                    setCookie("connected","false");
                }

            };
        }

        //deconnexion
        public static function logout(){
            if(isset($_POST["logout"]) && $_POST["logout"] !== ""){
                if($_POST["logout"] === "yes") {
                    unset($_COOKIE["connected"]);
                    setCookie("connected", "", time() + 60, "/");

                    unset($_COOKIE["nomUser"]);
                    setCookie("nomUser", "", time() + 60, "/");

                    unset($_COOKIE["prenomUser"]);
                    setCookie("prenomUser", "", time() + 60, "/");

                    unset($_COOKIE["mailUser"]);
                    setCookie("mailUser", "", time() + 60, "/");

                    unset($_COOKIE["idUser"]);
                    setCookie("idUser", "", time() + 60, "/");
                }
            }
        }
    }
?>