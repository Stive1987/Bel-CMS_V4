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

namespace Belcms\Pages\Models;

use BelCMS\Core\eMail;
use BelCMS\Core\encrypt;
use BelCMS\Core\User as CoreUser;
use BelCMS\PDO\BDD;
use BelCMS\Requires\Common;

if (!defined('CHECK_INDEX')):
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
    exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
endif;

final class User
{
    public function isUserExistName ($data) : bool
    {
        $sql = new BDD;
        $sql->table('TABLE_USERS');
        $sql->where(array('name' => 'username', 'value' => $data));
        $sql->count();
        if ($sql->data == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function isUserExistMail ($data) : bool
    {
        $sql = new BDD;
        $sql->table('TABLE_USERS');
        $sql->where(array('name' => 'mail', 'value' => $data));
        $sql->count();
        if ($sql->data == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function mailBlacklist () : array
    {
        $sql = New BDD();
        $sql->table('TABLE_MAIL_BLACKLIST');
        $sql->isObject(false);
        $sql->queryAll();
        $results = $sql->data;
        return $results;
    }

    public function post_registred ($data) {
        $hash_key = md5(uniqid(rand(), true));

        $passwordCrypt =  new encrypt($data['pwd'], $_SESSION['CONFIG']['CMS_KEY_ADMIN']);
        $password      = $passwordCrypt->encrypt();

        $pass_key      = Common::randomString(32);

        $test = New BDD();
        $test->table('TABLE_USERS');
        $test->count();

        $insertUser = array(
            'id'                => null,
            'username'          => $data['username'],
            'hash_key'          => $hash_key,
            'password'          => $password,
            'mail'              => $data['mail'],
            'ip'                => Common::getIp(),
            'expire'            => (int) 0,
            'token'             => '',
        );

        if ($_SESSION['CONFIG']['CMS_VALIDATION'] == 'mail') {
            if ($test->data == 0) {
                $insertUser['valid'] = (int) 1;
            } else {
                $insertUser['valid'] = (int) 0;
            }
            $insertUser['number_valid'] = $pass_key;
        } else {
            $insertUser['valid'] = (int) 1;
            $insertUser['number_valid'] = null;
        }

        $insert = New BDD();
        $insert->table('TABLE_USERS');
        $insert->insert($insertUser);

        if ($test->data == 0) {
            $insertGroups = array(
                'id'                => null,
                'hash_key'          => $hash_key,
                'user_group'        => 1,
                'user_groups'       => 1
            );
        } else {
            $insertGroups = array(
                'id'                => null,
                'hash_key'          => $hash_key,
                'user_group'        => 2,
                'user_groups'       => 2
            );
        }

        $insertGrp = New BDD();
        $insertGrp->table('TABLE_USERS_GROUPS');
        $insertGrp->insert($insertGroups);

        $dataProfils = array(
            'hash_key'     => $hash_key,
            'gender'       => 'unisexual',
            'public_mail'  => '',
            'websites'     => '',
            'list_ip'      => '',
            'avatar'       => constant('DEFAULT_AVATAR'),
            'info_text'    => '',
            'birthday'     => date('Y-m-d'),
            'country'      => '',
            'hight_avatar' => '',
            'friends'      => ''
        );
        $insertProfils = New BDD();
        $insertProfils->table('TABLE_USERS_PROFILS');
        $insertProfils->insert($dataProfils);

        $insertSocial = New BDD();
        $insertSocial->table('TABLE_USERS_SOCIAL');
        $insertSocial->insert(array('hash_key'=> $hash_key));

        $insertPage = New BDD();
        $insertPage->table('TABLE_USERS_PAGE');
        $insertPage->insert(array('hash_key'=> $hash_key));

        if ($_SESSION['CONFIG']['CMS_VALIDATION'] == 'mail' and $test->data != 0) {
            $mail = new eMail;
            $mail->setFrom($_SESSION['CONFIG']['CMS_WEBSITE_NAME']);
            $mail->addAdress($data['mail'], $data['username']);
            $mail->subject('ACCOUNT_REGISTRATION');
            $mail->body(self::sendHtmlBody($hash_key));
            $mail->submit();
        }
        self::login($hash_key, $data['username'], $password);
        return true;
    }
    private function sendHtmlBody ($hash_key)
    {
        setLocale(LC_TIME, 'fr_FR.utf8');

        $date = new \DateTime();
        $date = $date->format('d/m/Y à H:i:s');
        $user = CoreUser::getInfosUserAll($hash_key);

        if ($_SERVER['SERVER_PORT'] == '80') {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        } else {
            $host = 'https://'.$_SERVER['HTTP_HOST'].'/';
        }

        return '<table width="100%" border="0" cellspacing="5" cellpadding="5" bgcolor="#666666">
                <thead><tr><th><a style="color:#CCC; text-decoration:none" href="'.$host.'" style="display:block; text-align:center">'.$_SESSION['CONFIG']['CMS_WEBSITE_NAME'].'</a></th></tr>
                </thead>
                <tbody><tr><td>
                <table width="90%" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFF"><tr><td><p>'.constant('ACTIVE_TO_SERIAL').'</p></td></tr></table></td></tr></tbody></table>
                <table style="color:#FFF; text-align:center" width="100%" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#3333"><tr><td>'.$user->user->number_valid.'</td></tr></table>
                <table style="color:#FFF; text-align:center" width="100%" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#8f8e8c"><thead><tr><td colspan="2"><b>'.constant('INFOS').'</b></td></tr></thead><tbody><tr bordercolor="#FFF"><td style="text">'.constant('NAME').'</td><td><b>'.$user->user->username.'</b></td></tr><tr><td>'.constant('DATE').'</td><td><b>'.$date.'</b></td></tr><tr><td>IP</td><td><b>'.Common::GetIp().'</b></td></tr></tbody>
                </table></body></html>';
    }
    private function login ($hash_key,$username,$password )
    {
        setcookie(
            'BELCMS_HASH_KEY_'.$_SESSION['CONFIG']['CMS_COOKIES'],
            $hash_key,
            time()+60*60*24*30*3,
            "/",
            $_SERVER['HTTP_HOST'],
            true,
            true
        );
        setcookie(
            'BELCMS_NAME_'.$_SESSION['CONFIG']['CMS_COOKIES'],
            $username,
            time()+60*60*24*30*3,
            "/",
            $_SERVER['HTTP_HOST'],
            true,
            true
        );
        setcookie(
            'BELCMS_PASS_'.$_SESSION['CONFIG']['CMS_COOKIES'],
            $password,
            time()+60*60*24*30*3,
            "/",
            $_SERVER['HTTP_HOST'],
            true,
            true
        );
    }
    #########################################
    # Enregistre un nouveau mot de passe
    #########################################
    public function sendSecurity ($data) : array
    {
        $sql = New BDD();
        $sql->table('TABLE_USERS');
        $sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']->user->hash_key));
        $sql->queryOne();
        $results = $sql->data;

        $a = new encrypt($results->password, $_SESSION['CONFIG']['CMS_KEY_ADMIN']);
        $a = $a->decrypt();
        $b = $data['password_old'];

        if ($a == $b) {
            $new = new encrypt($data['password_new'], $_SESSION['CONFIG']['CMS_KEY_ADMIN']);
            $new = $new->encrypt();
            $insert['password'] = $new;
            $sql = New BDD();
            $sql->table('TABLE_USERS');
            $sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']->user->hash_key));
            $sql->update($insert);
            setcookie('BELCMS_HASH_KEY', $_SESSION['USER']->user->hash_key, time()+60*60*24*30*3, '/');
            setcookie('BELCMS_NAME', $_SESSION['USER']->user->username, time()+60*60*24*30*3, '/');
            setcookie('BELCMS_PASS', $insert['password'], time()+60*60*24*30*3, '/');
            $return = array('type' => 'success', 'msg' => constant('SEND_PASS_IS_OK'), 'title' => constant('PASSWORD'));
            return $return;
        } else {
            $return = array('type' => 'error', 'msg' => constant('OLD_PASS_FALSE'), 'title' => constant('PASSWORD'));
            return $return;
        }
    }

    public function sendSocial ($data) : array
    {   
        $sql = new BDD;
        $sql->table('TABLE_USERS_SOCIAL');
        $sql->where(array('name' => 'hash_key', 'value' => $_SESSION['USER']->user->hash_key));
        $sql->update($data);
        $countRowUpdate = $sql->rowCount;

        if ($countRowUpdate != 0) {
            $return['msg']   = 'Vos informations ont été sauvegardées avec succès';
            $return['type']  = 'success';
            $return['title'] = 'Social';
            $_SESSION['USER'] = CoreUser::getInfosUserAll($_SESSION['USER']->user->hash_key);
        } else {
            $return['title'] = 'Social';
            $return['msg']   = 'Vos informations n\'ont pas été sauvegardées ou partiellement';
            $return['type']  = 'warning';
        }

        return $return;
    }
}