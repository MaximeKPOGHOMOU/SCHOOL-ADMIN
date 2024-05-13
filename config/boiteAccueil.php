
<div class="card height-auto">
    <div class="ui-modal-box">
        <div class="modal-box">
            <!-- Sign Up Modal -->
            <div class="modal sign-up-modal fade" id="semestre" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="close-btn">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="item-logo">
                                <label for="">EMPLOIS DU TEMPS</label>
                            </div>
                            <form class="login-form" method="POST" action="emploiEtudiant.php" id="modal">
                                <div class="row gutters-15">
                                    <div class="form-group col-sm-6">
                                        <select class="select2" id="max" name="semestre">
                                            <option value="">Choisir un semestre </option>
                                            <?php 
                                            foreach (getSemestre() as $libele)
                                                echo "<option value='".$libele['code']."'>".$libele['libele']."</option>"; 
                                            ?>                                                        
                                        </select>
                                    </div>                                                             
                                    <div class="form-group col-sm-6">
                                        <button type="submit" name="btn" class="login-btn">Afficher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>