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
<nav id="belcms_user_content_ul">
    <ul>
        <li>
            <img src="/assets/img/default_avatar.jpg" alt="default avatar">
            <span>Bienvenue adminisrtrateur</span>
        </li>
        <li>
            <a href="User">Accueil</a>
            <div><i class="fa-solid fa-house-user"></i></div>
        </li>
        <li>
            <a href="User/Security">Mot de passe</a>
            <div><i class="fa-solid fa-key"></i></div>
        </li>
        <li>
            <a href="User/Social">Social</a>
            <div><i class="fa-solid fa-retweet"></i></div>
        </li>
        <li>
            <a href="User/sessions">Historique des sessions</a>
            <div><i class="fa-solid fa-users-gear"></i></div>
        </li>
        <li>
            <a href="User/Groups">Groupe(s)</a>
            <div><i class="fa-solid fa-layer-group"></i></div>
        </li>
        <li>
            <a href="User/Logout">Se déconnecter</a>
            <div><i class="fa-solid fa-power-off"></i></div>
        </li>
    </ul>
</nav>