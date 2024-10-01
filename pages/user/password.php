<?php
/**
 * Bel-CMS [Content management system]
 * @version 4.0.0 [PHP8.3]
 * @link https://bel-cms.dev
 * @link https://determe.be
 * @license MIT License
 * @copyright 2015-2025 Bel-CMS
 * @author as Stive - stive@determe.be
*/

if (!defined('CHECK_INDEX')):
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
    exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
endif;

?>
<article class="belcms_user">
    <section class="belcms_user_content">
        <div class="container text-center">
            <div class="row">
                <div class="col-4">
                    <?php include 'menu.php'; ?>
                </div>
                <div class="col-8">
                    <form action="user/sendsecurity" method="post">
                    <div class="card">
                        <div class="card-header">Modifier le mot de passe</div>
                        <div class="card-body">
                            <div id="section_user_profil">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input class="form-control" placeholder="Ancien mot de passe" autocomplete="off" type="password" required="required" name="password_old">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"> <i class="fa-solid fa-key"></i></span>
                                    <input type="text" class="form-control" rel="gp" placeholder="nouveau mot de passe" data-size="8" data-character-set="a-z,A-Z,0-9,#" type="password" required="required" name="password_new">
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a class="getNewPass btn btn-warning">Générer</a>
                                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</article>