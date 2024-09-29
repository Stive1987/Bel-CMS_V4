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
                <p>Veuillez entrer votre email ou votre nom d'utilisateur et le mot de passe.</p>
                <form id="form" action="/user/loginSubmit" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                        <input name="password" type="password" class="form-control" placeholder="Mot de passe" aria-label="password" required>
                    </div>
                    <span id="registred" ><a class="belcms_tooltip_right" data="S'enregistrer" href="/User/registred?echo"><i class="fa-solid fa-user-plus"></i></a></span>
                    <span id="nouser"><a class="belcms_tooltip_left" data="Mot de passe perdu" href="/User/lost?echo" title="Compte"><i class="fa-solid fa-unlock-keyhole"></i></a></span>
                    <div id="send">
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="/assets/plugins/tooltip/tippy-bundle.umd.min.js"></script>
    <script src="/assets/plugins/tooltip/tooltip.js"></script>
</html>