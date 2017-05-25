<?php
    require_once("../model/modelEvenement.php");
    require_once("../model/modelAcademie.php");
    require_once("../model/modelFilleul.php");
    require_once ("../model/modelCommentaire.php");
    require_once("globalController.php");

    class evtController extends globalController{
        private $modelEvt;

        //affichage de tout les évènements frateli
        public function getAllEvents(){
            $this->modelEvt = new Evenement();
            $this->modelEvt->Init();
            $response =$this->modelEvt->getAllEventJoinAcademy();
            $commentaire = new Commentaire();
            $commentaire->Init();
            foreach($response as $value){

                $dateMySQL = $value["date_event"];

                //objet DateTime correspondant :
                $date = new DateTime($dateMySQL);
                //date au format francophone:$date->format('d/m/Y'
                $listCom = $commentaire->getComByIdEvt($value["id_evenement"]);

                echo '<div class="panel panel-default">'.
                        '<div class="panel-heading">'.
                            $value["intitule_evenement"].
                            '<span class="containerDate">Date de l\'évènement: '.$date->format('d/m/Y ').'</span>'.
                        '</div>'.
                        '<div class="panel-body">'.
                            $value["description_evenement"].
                            '<br/><span style="display:block;float:right">'.$value["nom_academie"].'</span>'.
                        '</div>'.
                        '<table class="table">
                            <tr>
                                <th>Commentaires</th>
                            </tr>';
                            foreach($listCom as $com){
                                    echo '<tr>'.
                                            '<td>'.$com["description_commentaire"].'</td>'.
                                          '</tr>';
                            }
                            '<tr>
                                <td> </td>
                            </tr>';

                echo    '</table>'.
                    '</div>';
            }

        }


        //callbacks d'ajout d'évènement avec une vérification du mail de l'utilisateur si il existe en base, si ce n'est pas un filleul il ne peut pas créer d'évènement
        public static function addEvt(){
            if(isset($_POST["intitule"])  && $_POST["intitule"] !==  ""
                && isset($_POST["desc"]) && $_POST["desc"] !==  ""
                && isset($_POST["emailFilleul"]) && $_POST["emailFilleul"] !==  ""
                && isset($_POST["academySelection"]) && $_POST["academySelection"] !==  ""
                && isset($_POST["dateEvt"]) && $_POST["dateEvt"] !==  ""
            ){
                $date = new DateTime($_POST["dateEvt"]);
                $filleul = new Filleul();
                $filleul->Init();
                $mailExist =$filleul->mailExist($_POST["emailFilleul"]);
                if($mailExist){
                    $new_academie=array(
                        "id_evenement" => null,
                        "intitule_evenement" =>     $_POST["intitule"],
                        "description_evenement" =>  $_POST["desc"],
                        "status_evenement"     =>   0,
                        "nb_participation"     =>   0,
                        "nb_jaime"  =>             0,
                        "id_academie" =>            intval($_POST["academySelection"]),
                        "date_event" => $date->format('Y/m/d ')
                    );
                    $evt = new Evenement();
                    $evt->Init();
                    $evt->insert($new_academie);
                }
                else{
                    echo '<div class="alert alert-danger  alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Veuillez renseigner une adresse mail de filleul valide</strong>
                         </div>';
                }
            }
        }

        //constructeur
        public function __construct($page = NULL)
        {
            if (!is_null($page))
            {
                $this->page = $page;
            }
        }

    }
    globalController::logout();
    evtController::addEvt();
    globalController::addUser();
    globalController::login();
?>