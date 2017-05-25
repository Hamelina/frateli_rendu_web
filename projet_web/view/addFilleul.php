<?php
    echo '<div id="myModalAddUSer" class="modal fade" role="dialog">'.
        '<div class="modal-dialog">'.
           '<!-- Modal content-->'.
            '<div class="modal-content">'.
                '<div class="modal-header">'.
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>'.
                    '<h4 class="modal-title">Inscription</h4>'.
                '</div>'.
                '<form method="post" action="index.php">'.
                    '<div class="modal-body">'.
                        '<div class="form-group">
                            <label for="nomUser" >Nom</label>
                            <input class="form-control" type="text" placeholder="Nom" name="nomUser" id="nomUser" name="intitule" required>
                        </div>
                        <div class="form-group">
                            <label for="prenomUser" >Prénom</label>
                            <input class="form-control" type="text"  placeholder="Prénom"  name="prenomUser" id="prenomUser" name="intitule" required>
                        </div>
                        <div class="form-group">
                            <label for="pwdUser">Mot de passe</label>
                            <input type="password" class="form-control" id="pwdUser"  name="pwdUser" placeholder="Mot de passe" required>
                         </div>
                        <div class="form-group">
                            <label for="emailUser">Email</label>
                            <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="adresse mail" required>
                        </div>
                         '.
                    '</div>'.
                    '<div class="modal-footer">'.
                        '<button type="submit" class="btn btn-default" >s\'inscrire</button>'.
                    '</div>'.
                '</form>'.
            '</div>'.
        '</div>'.
    '</div>';
?>