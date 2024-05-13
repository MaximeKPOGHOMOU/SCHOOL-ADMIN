<div class="card height-auto">
    <div class="ui-modal-box">
        <div class="modal-box">
            <!-- Sign Up Modal -->
            <div class="modal sign-up-modal fade" id="imprimerEnseignant" tabindex="-1" role="dialog"
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
                                <label for="">IMPRIMER LA LISTE DES ENSEIGNANTS</label>
                            </div>
                            <form class="login-form" method="POST" action="imprimerEnseignant.php" id="modal">
                                <div class="row gutters-15">
                                    <div class="form-group col-sm-6">
                                        <select class="select2" id="fan" name="toute">
                                            <option value="">Toute la liste </option>                                                      
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="select2" id="fstatu" name="status">
                                            <option value="">Choisir un status *</option>
                                            <option value="Titulaire">Titulaire</option>
                                            <option value="Contratuel">Contratuel</option>
                                            <option value="Profesorat">Autres</option>
                                        </select>
                                    </div>
                                                                                            
                                    <div class="form-group col-12">
                                        <button type="submit" name="btnSubEnseignant" class="login-btn">Impression</button>
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
