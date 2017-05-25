<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            minDate: 0
        });
    } );
</script>

<?php

    echo '<div id="myModalAddEvent" class="modal fade" role="dialog">'.
        '<div class="modal-dialog">'.
            '<!-- Modal content-->'.
            '<div class="modal-content">'.
                '<div class="modal-header">'.
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>'.
                    '<h4 class="modal-title">Inscription</h4>'.
                    '</div>'.
                '<form method="post" action="evenements.php">'.
                    '<div class="modal-body">'.
                       '<div class="form-group">
                            <label for="intitule" >Intitulé</label>
                            <input class="form-control" type="text" placeholder="Intitulé de l\'évenement" id="intitule" name="intitule" required>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description de l\'évènement:</label>
                            <textarea class="form-control" rows="5" id="desc" placeholder="Description de l\'évènement" name="desc" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="emailFilleul" class="col-2 col-form-label" >Email</label>
                            <input class="form-control" class="col-2 col-form-label"type="email" placeholder="xxx@example.com" id="emailFilleul" name="emailFilleul" required>
                        </div>
                        <div class="form-group">
                            <label for="datepicker">date de l\'évènement</label>
                            <input  class="form-control" type="text" id="datepicker" name="dateEvt" required>
                        </div>
                        <div class="form-group">
                            <label for="datepicker">Académie</label><div style="float:right">';
                            $controllerPage->getAllAcademie();
                echo    '</div></div>';

                echo    '</div>
                    <div class="modal-footer">'.
                        '<button type="submit" class="btn btn-default" >Créer</button>'.
                        '</div>'.
                    '</form>'.
                '</div>'.
            '</div>'.
    '</div>';
?>