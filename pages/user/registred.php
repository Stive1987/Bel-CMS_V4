<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?=$_SESSION['CONFIG']['CMS_WEBSITE_NAME'];?> - Login</title>
        <link rel="stylesheet" href="/assets/plugins/bootstrap-5.3.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="/pages/user/css/login.css">
        <link rel="stylesheet" href="/assets/plugins/fontawesome-6.5.1/css/all.min.css">
        <script src="/assets/plugins/jQuery/jquery-3.7.1.min.js"></script>
        <script src="/assets/plugins/bootstrap-5.3.3/js/bootstrap.min.js"></script>
        <script src="/assets/plugins/fontawesome-6.5.1/js/all.min.js"></script>
		<script src="/assets/plugins/tooltip/popper.min.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="wrapper_content">
                <div id="title"><a class="belcms_tooltip_right" data="Retour a l'accueil" href="/index.php" title="Accueil"><i class="fa-solid fa-house-user"></i></a>Se connecter</div>
                <p>Veuillez saisir toutes les informations pour vous inscrire</p>
                <form id="form" action="/user/SendRegistred" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input name="mail" type="mail" class="form-control" placeholder="e-mail" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input name="username" type="text" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input name="password" type="password" class="form-control" placeholder="Mot de passe" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input name="password_repeat" type="password" class="form-control" placeholder="Répète Mot de passe" required>
                    </div>
                    <div id="cpt">
                        <?php echo $_SESSION['CAPTCHA']['CODE'];?>
                    </div>
                    <select name="select" class="form-select form-select-sm">
                        <option selected>Selectioné le bon nombre</option>
                        <?php
                        foreach ($captcha as $key => $value):
                            ?>
                             <option value="<?=$value;?>"><?=$value;?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <div class="form-group align_center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCharter">Nous vous demandons de lire le <i style="color: red;">règlement</i></button>
                        <div class="modal fade" id="ModalCharter" tabindex="-1" aria-labelledby="charter" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="charter">Règlement</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?=$_SESSION['CONFIG']['CMS_REGISTER_CHARTER'];?></p>
                                        <div class="form-check form-switch align_center">
                                            <input name="charte" value="true" id="myCheck" class="form-check-input" type="checkbox"">
                                            <label class="form-check-label">Accepter</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button onclick="myFunction()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Accepter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="send">
                        <input type="submit" value="Enregistrer">
                    </div>
                    <input type="hidden" name="captcha" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="nom@domaine.com">
                </form>
            </div>
        </div>
		<script>
			function myFunction() {
				document.getElementById("myCheck").required = true;
			}
		</script>
    </body>
</html>