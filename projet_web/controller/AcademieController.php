<?php
    require_once("../model/modelAcademie.php");
    require_once("../model/modelEvenement.php");
    require_once("globalController.php");

    class AcademieController extends globalController{
        private $academieRequester;


        //gestion   du menu déroulant contenant la liste des académies en base
        public function initPageAcademie(){
            $this->academieRequester =new Academie();
            $this->academieRequester->Init();
            $response =$this->academieRequester->getAll();

            echo '<select class="form-control dropdownList" name="academySelection">';
            echo '<option value="0">Tous</option>';
            foreach ($response as $key ) {
                if($key["id_academie"] === $_POST["academySelection"]){
                    echo '<option selected="selected" value="'.$key["id_academie"].'">'.$key["nom_academie"].'</option>';
                }
                else{
                    echo '<option  value="'.$key["id_academie"].'">'.$key["nom_academie"].'</option>';
                }

            }
            echo '</select>';

        }

        // affiche les évenements d'une académie
        public function getEvtOfAcademy($idAcademy){
            $modelEvt = new Evenement();
            $modelEvt->Init();

            if( isset($idAcademy)){
                $response = $modelEvt->getEvtFromAcademy(intval($idAcademy));

                if(count($response) !== 0){
                    foreach($response as $value){
                        $dateMySQL = $value["date_event"];
                        //objet DateTime correspondant :
                        $date = new DateTime($dateMySQL);

                        //affichage de la date au format francophone:$date->format('d/m/Y'

                        echo '<div class="panel panel-default">'.
                                '<div class="panel-heading">'.
                                    $value["intitule_evenement"].
                                    '<span class="containerDate">Date de l\'évènement: '.$date->format('d/m/Y ').'</span>'.
                                '</div>'.
                                '<div class="panel-body">'.
                                    '<div class="containerDesc">'.$value["description_evenement"].'</div>'.
                                    '<br/><span style="display:block;float:right">lieu: '.$value["nom_academie"].'</span>'.
                                '</div>'.
                             '</div>';
                    }

                }
            }
            else{
                echo "erreur";
            }
        }

        public function __construct($page = NULL)
        {
            if (!is_null($page))
            {
                $this->page = $page;
            }
        }
    }
    /*controles des varibales passés en poste*/
    globalController::logout();
    globalController::login();
    globalController::addUser();

?>