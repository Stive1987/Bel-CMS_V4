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

use BelCMS\Core\Config;
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
                <div class="col-4">
                    <form action="user/ChangeGroup" method="post" class="belcms_section_user_main_form">
                        <div class="card">
                            <div class="card-header">Vos Groupes</div>
                            <div class="card-body">
                                <select name="id" class="form-select">
                                <?php
                                foreach ($_SESSION['USER']->groups->all_groups as $key => $value):
                                    $name = defined(strtoupper(Config::getGroupsForID($value)->name)) ? constant(strtoupper(Config::getGroupsForID($value)->name)) : Config::getGroupsForID($value)->name;
                                ?>
                                    <option class="form-control" value="<?=Config::getGroupsForID($value)->id_group;?>"><?=$name;?></option>
                                <?php
                                endforeach;
                                ?>
                                </select>
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Enregistrer" class="btn btn-secondary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">Groupes principal</div>
                        <div class="card-body">
                            <?php
                            $grp = $_SESSION['USER']->groups->user_group;
                            $name = defined(strtoupper(Config::getGroupsForID($grp)->name)) ? constant(strtoupper(Config::getGroupsForID($grp)->name)) : Config::getGroupsForID($grp)->name;
                            ?>
                            <span style="color: <?=$_SESSION['USER']->user->color;?>"><?=$name;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>