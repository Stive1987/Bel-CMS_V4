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

if (defined('DB_PREFIX')) { $DB_PREFIX = constant('DB_PREFIX'); } else { $DB_PREFIX = ''; }

$tables = array(
    #####################################################
    # Tables
    #####################################################
    'TABLE_BAN'                 => $DB_PREFIX.'ban',
    'TABLE_CAPTCHA'             => $DB_PREFIX.'captcha',
    'TABLE_COMMENTS'            => $DB_PREFIX.'comments',
    'TABLE_STATS'               => $DB_PREFIX.'Stats',
    'TABLE_WIDGETS'             => $DB_PREFIX.'widgets',
    'TABLE_CONFIG'              => $DB_PREFIX.'config',
    'TABLE_CONFIG_PAGES'        => $DB_PREFIX.'config_pages',
    'TABLE_GROUPS'              => $DB_PREFIX.'groups',
    'TABLE_NEWS'                => $DB_PREFIX.'news',
    'TABLE_NEWS_CAT'            => $DB_PREFIX.'news_cat',
    'TABLE_STATS'               => $DB_PREFIX.'stats',
    'TABLE_MAIL_BLACKLIST'      => $DB_PREFIX.'mails_blacklist',
    'TABLE_MAIL_CONFIG'         => $DB_PREFIX.'mails_config',
    'TABLE_USERS'               => $DB_PREFIX.'users',
    'TABLE_USERS_GAMING'        => $DB_PREFIX.'users_gaming',
    'TABLE_USERS_GROUPS'        => $DB_PREFIX.'users_groups',
    'TABLE_USERS_NOTIFICATION'  => $DB_PREFIX.'users_notification',
    'TABLE_USERS_PAGE'          => $DB_PREFIX.'users_page',
    'TABLE_USERS_PROFILS'       => $DB_PREFIX.'users_profils',
    'TABLE_USERS_SOCIAL'        => $DB_PREFIX.'users_social',
    #####################################################
);
#####################################################
foreach ($tables as $name => $value) {
    define($name, $value); unset($tables);
}
#####################################################
?>