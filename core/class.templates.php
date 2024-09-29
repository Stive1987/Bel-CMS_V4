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

namespace BelCMS\Core;
use BelCMS\PDO\BDD;

if (!defined('CHECK_INDEX')):
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Direct access forbidden');
    exit('<!doctype html><html><head><meta charset="utf-8"><title>BEL-CMS : Error 403 Forbidden</title><style>h1{margin: 20px auto;text-align:center;color: red;}p{text-align:center;font-weight:bold;</style></head><body><h1>HTTP Error 403 : Forbidden</h1><p>You don\'t permission to access / on this server.</p></body></html>');
endif;

class Templates
{
    public  $link,
            $css,
            $js,
            $page,
            $widgets,
            $fullwide,
            $host;

    public function __construct($var = null)
    {
        $this->link         = ucfirst($var->link ?? '');
        $this->css          = self::cascadingStyleSheets($var->link);
        $this->js           = self::javaScript($var->link);
        $this->page         = $var->page;
        $this->fullwide     = self::getFullWide();
        $this->host         = GetHost::getBaseUrl();
        $this->widgets      = $var->widgets;
        $fileLoadTpl        = constant('DIR_TPL').self::getNameTpl().DS.'template.php';
        $fileLoadTplDefault = ROOT.DS.'assets'.DS.'templates'.DS.'default'.DS.'template.php';
        if (is_file($fileLoadTpl) === true) {
            require $fileLoadTpl;
        } else {
            require $fileLoadTplDefault;
        }
    }
    #########################################
    # Récupère le nom du template si pas
    # default sera utilisé
    #########################################
    protected function getNameTpl () : string
    {
        $return = 'default';
        $sql = new BDD;
        $sql->table('TABLE_CONFIG');
        $sql->where(array(
            'name'  => 'name',
            'value' => 'CMS_TPL_WEBSITE'
        ));
        $sql->fields(array('value'));
        $sql->queryOne();
        if (!empty($sql->data->value)) {
            $return = $sql->data->value;
        }
        return $return;
    }
    #########################################
    # Récupère les page en fullwide
    #########################################
    protected function getFullWide ()
    {
        $page = explode(',', $_SESSION['CONFIG']['CMS_TPL_FULL']);
        foreach ($page as $k => $v) {
            $return[$k] = trim($v);
        }

        $page = strtolower(Dispatcher::page() ?? '');
        $view = strtolower(Dispatcher::view() ?? '');

        if (in_array($page, $return)) {
            return true;
        }
        if (in_array($view, $return)) {
            return true;
        }
    }
    #########################################
    # Gestions des styles (css)
    #########################################
    public function cascadingStyleSheets ($var) : string
    {
        $return         = '';
        /* GLOBAL STYLE */
        $files[] = 'assets/css/belcms.global.css';
        /* jQuery ui 1.13.2 */
        $files[] = 'assets/plugins/jquery-ui-1.13.2/themes/base/jquery-ui.min.css';
        $files[] = 'assets/plugins/jquery-ui-1.13.2/themes/base/theme.css';
        /* bootstrap v5.3.3 */
        $files[] = 'assets/plugins/bootstrap-5.3.3/css/bootstrap.min.css';
        /* FONTAWASOME 6.5.1 ALL */
        $files[] = 'assets/plugins/fontawesome-6.5.1/css/all.min.css';

        /* pages css */
        $dirPage = constant('DIR_PAGES').strtolower($var).DS.'css'.DS.'styles.css';
        if (is_file($dirPage)) {
            $files[] = 'pages/'.strtolower($var).'/css/styles.css';
        }

        foreach ($files as $v) {
            $return .= '	<link href="'.$v.'" rel="stylesheet" type="text/css" media="all">'.PHP_EOL;
        }
        return $return;
    }
    #########################################
    # Gestions des scripts (js)
    #########################################
    public function javaScript ($var) : string
    {
        $link           = strtolower($var);
        $files          = array();
        $return         = '';
        /* jQuery 3.7.1 */
        $files[] = 'assets/plugins/jQuery/jquery-3.7.1.min.js';
        /* jQuery UI 1.13.2 */
        $files[] = 'assets/plugins/jQuery/jquery-ui-1.13.2/jquery-ui.min.js';
        /* bootstrap v5.3.3 */
        $files[] = 'assets/plugins/bootstrap-5.3.3/js/bootstrap.min.js';
        /* FONTAWASOME 6.5.1 ALL */
        $files[] = 'assets/plugins/fontawesome-6.5.1/js/all.min.js';
        /* Tinymce */
        $files[] = 'assets/plugins/tinymce/tinymce.min.js';
        /* Tooltip */
        $files[] = 'assets/plugins/tooltip/popper.min.js';
        $files[] = 'assets/plugins/tooltip/tippy-bundle.umd.min.js';
        $files[] = 'assets/plugins/tooltip/tooltip.js';
        /* jQuery BEL-CMS */
        $files[] = 'assets/js/belcms.core.js';
		/* pages js */
		$dirPage = constant('DIR_TPL').strtolower($var).DS.'js'.DS.'javascripts.js';
		if (is_file($dirPage)) {
			$files[] = $dirPage;
		}

		if (is_file(ROOT.DS.'pages'.DS.strtolower($var).DS.'js'.DS.'javascripts.js')) {
			$files[] = 'pages/'.strtolower($var).'/js/javascripts.js';
		}

        foreach ($files as $v) {
            $return .= '	<script type="text/javascript" src="'.$v.'"></script>'.PHP_EOL;
        }
        return $return;
    }
}