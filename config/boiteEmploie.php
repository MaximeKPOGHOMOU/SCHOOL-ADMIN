<div class="card height-auto">
    <div class="ui-modal-box">
        <div class="modal-box">
            <!-- Sign Up Modal -->
            <div class="modal sign-up-modal fade" id="emploie" tabindex="-1" role="dialog"
                aria-hidden="true">
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
                                <label for="">DETAILS DES EMPLOIS DE TEMPS</label>
                            </div>
                            <form class="login-form" method="POST" action="detailEmploie.php" id="modal">
                                <div class="row gutters-15">
                                    <div class="form-group col-sm-6">
                                        <select class="select2" id="fsemestre" name="semestre">
                                            <option value="">Choisir un semestre </option>
                                            <?php 
                                            foreach (getSemestre() as $libele)
                                                echo "<option value='".$libele['code']."'>".$libele['libele']."</option>"; 
                                            ?>                                                        
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="select2" id="fprom" name="promotion">
                                            <option value="">Choisir une promotion *</option>
                                            <?php 
                                            foreach (getPromotion() as $promotion){
                                                echo "<option value='".$promotion['code']."'>".$promotion['code']."</option>";
                                            }                       
                                            ?>        
                                        </select>
                                    </div>                                                              
                                    <div class="form-group col-sm-12">
                                        <select class="select2" id="flicence" name="licence">
                                            <option value="">Choisir une licence *</option>
                                            <option value="L1">L1</option>
                                            <option value="L2">L2</option>
                                            <option value="L3">L3</option>
                                            <option value="L4">L4</option>
                                        </select>
                                    </div>                                                              
                                    <div class="form-group col-12">
                                        <button type="submit" name="btnSubEmplois" class="login-btn">Afficher</button>
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