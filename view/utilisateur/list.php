<?php       
if(isset($_SESSION["notExist"])){
    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Erreur</span>
                                            Cet utilisateur est inexistant
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
    unset($_SESSION["notExist"]);
}else if(isset($_SESSION["deleteAdmin"])) {
    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Erreur</span>
                                            Vous n\'avez pas les droits nécessaire pour supprimer cet utilisateur
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
    unset($_SESSION["deleteAdmin"]);
}else if(isset($_SESSION["deleteComplete"])) {
    echo '<div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show">
                                            <span class="badge badge-pill badge-secondary">Success</span>
                                            Le compte de l\'utilisateur a bien été retirer
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
    unset($_SESSION["deleteComplete"]);
}
?>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Liste des utilisateurs</h3>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Email</th>
                                                <th>Rôle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($users as $user) {
                                                
                                                $status;

                                                if($user->get("actif") == 0){
                                                    $status = "Compte non confirmé";
                                                }else{
                                                    if($user->get("admin") == 0){
                                                        $status = "Compte confirmé";
                                                    }else{
                                                        $status = "Administrateur";
                                                    }
                                                }
                                                    
                                                echo('
                                                <tr class="tr-shadow">
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>' . $user->get("nom") . '</td>
                                                <td>' . $user->get("prenom") . '</td>
                                                <td>
                                                    <span class="block-email">' . $user->get("email") . '</span>
                                                </td>
                                                <td class="desc">' . $status . '</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                            <a href="#"><i class="zmdi zmdi-mail-send"></i></a>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <a href="?action=getProfil&controller=utilisateur&user_id='. $user->get("id") .'"><i class="zmdi zmdi-edit"></i></a>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <a href="?action=delete&controller=utilisateur&user_id='. $user->get("id") .'"><i class="zmdi zmdi-delete"></i></a>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                            <a href="?action=getProfil&controller=utilisateur&user_id='. $user->get("id") .'"><i class="zmdi zmdi-more"></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            ');

                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>

<script src="vendor/wow/wow.min.js"></script>