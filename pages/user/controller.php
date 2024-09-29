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

namespace Belcms\Pages\Controller;

use BelCMS\Core\Captcha;
use BelCMS\Core\Pages;
use BelCMS\Core\Secure;
use BelCMS\Core\User as CoreUser;
use BelCMS\Requires\Common;

if (!defined('CHECK_INDEX')):
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
    exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
endif;

class User extends Pages
{
    var $useModels = 'User';
    ################################################
    # Index de la page user
    ################################################
    function index ()
    {
        if (CoreUser::isLogged() === false) {
            $this->redirect('User/Login?echo', 0);
        } else {
			$_SESSION['USER'] = CoreUser::getInfosUserAll($_SESSION['USER']->user->hash_key);
			$d['current'] ='user';
			$d['user']    = $_SESSION['USER'];
			$this->set($d);
            $this->render('index');
        }
    }
    ################################################
    # Login
    ################################################
    public function login ()
    {
        if (CoreUser::isLogged() === false) {
            $this->render('login');
        } else {
            $this->redirect('User', 0);
        }
    }
    public function loginSubmit ()
    {
        $username = Common::VarSecure($_POST['username'], null);
        $password = Common::VarSecure($_POST['password'], null);
        $return   = CoreUser::login($username, $password);
        $this->message ($return['type'], $return['msg'],'login', false);
        $this->redirect('User', 3);
    }
    ################################################
    # Mot de passe / Changement
    ################################################
    public function security ()
    {
        if (CoreUser::isLogged() === true) {
            $this->render('password');
        } else {
            $this->redirect('User/Login?echo', 0);
        }
    }
    public function sendsecurity()
    {
        if (CoreUser::isLogged() === true) {
            $data['password_old'] = Common::VarSecure($_POST['password_old'], null);
            $data['password_new'] = Common::VarSecure($_POST['password_new'], null);
            $return = $this->models->sendSecurity($data);
            $this->message($return['type'], $return['msg'], $return['title'], false);
            $this->redirect('User', 2);
        } else {
            $this->redirect('User/Login?echo', 0);
        }
    }
    ################################################
    # Social
    ################################################
    public function social ()
    {
        $d['user'] = $_SESSION['USER'];
        $this->set($d);
        $this->render('social');
    }
    public function submitsocial ()
    {
       $data['facebook']  = Common::VarSecure($_POST['facebook'], null);
       $data['youtube']   = Common::VarSecure($_POST['youtube'], null);
       $data['whatsapp']  = Common::VarSecure($_POST['whatsapp'], null);
       $data['instagram'] = Common::VarSecure($_POST['instagram'], null);
       $data['messenger'] = Common::VarSecure($_POST['messenger'], null);
       $data['tiktok']    = Common::VarSecure($_POST['tiktok'], null);
       $data['snapchat']  = Common::VarSecure($_POST['snapchat'], null);
       $data['telegram']  = Common::VarSecure($_POST['telegram'], null);
       $data['pinterest'] = Common::VarSecure($_POST['pinterest'], null);
       $data['x_twitter'] = Common::VarSecure($_POST['x_twitter'], null);
       $data['reddit']    = Common::VarSecure($_POST['reddit'], null);
       $data['linkedIn']  = Common::VarSecure($_POST['linkedIn'], null);
       $data['skype']     = Common::VarSecure($_POST['skype'], null);
       $data['viber']     = Common::VarSecure($_POST['viber'], null);
       $data['teams_ms']  = Common::VarSecure($_POST['teams_ms'], null);
       $data['discord']   = Common::VarSecure($_POST['discord'], null);
       $data['twitch']    = Common::VarSecure($_POST['twitch'], null);

       $return = $this->models->sendSocial ($data);
       $this->message($return['type'], $return['msg'], $return['title'], false);
       $this->redirect('User/Social', 2);
    }
    ################################################
    # S'inscrire
    ################################################
    public function registred ()
    {
        if (CoreUser::isLogged() === false) {
            $captcha['captcha'] = new Captcha();
            $captcha['captcha'] = $captcha['captcha']->createCaptcha();
            $this->set($captcha);
            $this->render('registred');
        } else {
            $this->redirect('User', 0);
        }
    }
    ################################################
    # Enregistre en BDD le nouvelle utilisateur
    ################################################
    public function SendRegistred ()
    {
        $array['mail']       = Secure::isMail($_POST['mail']);
        $array['username']   = Common::VarSecure($_POST['username'],null);
        $array['username']   = str_replace(' ', '_', $array['username']);
        $array['password ']  = Common::VarSecure($_POST['password'], null);
        $array['pwd']        = Common::VarSecure($_POST['password_repeat'], null);
        $select              = is_numeric($_POST['select']) ? $_POST['select'] : false;
        if (isset($_POST['charte'])) {
            if ($_POST['charte'] != 'true') {
                $this->message ('error', 'La charte n\'a pas été valide','Enregistrement', true);
                $this->redirect('User/registred?echo', 3);
            }
        } else {
            $this->message ('error', 'La charte n\'a pas été valide','Enregistrement', true);
            $this->redirect('User/registred?echo', 3);
        }
        if (!empty($_POST['captcha'])) {
            $this->message ('error', 'Erreur de Captcha','Enregistrement', true);
            $this->redirect('User/registred?echo', 3);
        }
        if ($array['password '] != $array['pwd']) {
            $this->message ('error', 'Le mot de passe n\'est pas identique','Enregistrement', true);
            $this->redirect('User/registred?echo', 3);
        }
        if ($this->models->isUserExistName($array['username']) !== true) {
            $this->message ('warning', 'Le nom d\'utilisateur existe déjà','Enregistrement', true);
            $this->redirect('User/registred?echo', 3);
        }
        if ($this->models->isUserExistMail($array['mail']) !== true) {
            $this->message ('warning', 'L\'email existe déjà','Enregistrement', true);
            $this->redirect('User/registred?echo', 3);
        }
        if ($select === false) {
            $this->message ('error', 'Le captcha doit-être numerique','Enregistrement', true);
            $this->redirect('User/registred?echo', 3);
        }
        if (Captcha::verifCaptcha($select) !== true) {
            $this->message ('error', 'Erreur de Captcha','Enregistrement', true);
            $this->redirect('User/registred?echo', 3); 
        }

        $blackList = $this->models->mailBlacklist ();
        $arrayBlackList = array();

        foreach ($blackList as $k => $v) {
            $arrayBlackList[$v['id']] = $v['name'];
        }

        if (!empty($array['mail'])) {
            $tmpMailSplit = explode('@', $array['mail']);
            $tmpNdd =  explode('.', $tmpMailSplit[1]);
        }

        if (in_array($tmpNdd[0], $arrayBlackList)) {
            $this->message ('error', 'Email jetable refusé','E-Mail', false);
        }

        $return = $this->models->post_registred ($array);
        if ($return === true) {
            $this->message ('success', constant('CURRENT_RECORD'),'Enregistrement', false);
            $this->redirect('User', 3);
        }
    }
    ################################################
    # Déconnexion
    ################################################
    public function logout ()
    {
        CoreUser::logout();
        $this->message ('success', 'Suppresion du auto-login et des Cookies', 'Utilisateur', false);
        $this->redirect('index.php', 3);
    }
}