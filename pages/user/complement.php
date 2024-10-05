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

use BelCMS\Requires\Common;

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
                <form action="user/saveprofils" method="post">
                        <div class="card">
                            <div class="card-header">Historique des mouvements sur le compte</div>
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope-open-text"></i></span>
                                    <input class="form-control" placeholder="e-mail public" type="email" name="public_mail" value="<?=$_SESSION['USER']->profils->public_mail;?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                    <input class="form-control" placeholder="votre siteweb" type="url" name="websites" value="<?=$_SESSION['USER']->profils->websites;?>">
                                </div>
                                <div style="text-align: left;">
                                    <?php
                                    $gravatar = $_SESSION['USER']->profils->gravatar == 1 ? 'checked' : '';
                                    ?>
                                    <input class="form-check-input" type="checkbox" <?=$gravatar;?> value="1" id="gravatar" name="gravatar">
                                    <label for="gravatar">Utiliser gravatar</label>
                                </div>
                                <div style="text-align: left;">
                                    <?php
                                    $profils = $_SESSION['USER']->profils->profils == 1 ? 'checked' : '';
                                    ?>
                                    <input class="form-check-input" type="checkbox" <?=$profils;?> value="1" id="profils" name="profils">
                                    <label for="profils">Autoriser les personnes à voir votre profil</label>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning"><?=constant('SAVE');?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</article>