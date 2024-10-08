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

function debug ($data, $exitAfter = true, $collapse = false)
{
	$recursive = function($data, $level=0) use (&$recursive, $collapse) {
		global $argv;

		$isTerminal = isset($argv);

		if (!$isTerminal && $level == 0 && !defined("DUMP_DEBUG_SCRIPT")) {
			define("DUMP_DEBUG_SCRIPT", true);
			echo '<script language="Javascript">function toggleDisplay(id) {';
			echo 'var state = document.getElementById("container"+id).style.display;';
			echo 'document.getElementById("container"+id).style.display = state == "inline" ? "none" : "inline";';
			echo 'document.getElementById("plus"+id).style.display = state == "inline" ? "inline" : "none";';
			echo '}</script>'."\n";
		}

		$type = !is_string($data) && is_callable($data) ? "Callable" : ucfirst(gettype($data));
		$type_data   = null;
		$type_color  = null;
		$type_length = null;

		switch ($type) {
			case "String": 
				$type_color = "green";
				$type_length = strlen($data);
				$type_data = "\"" . htmlentities($data) . "\""; break;

			case "Double": 
			case "Float": 
				$type = "Float";
				$type_color = "#0099c5";
				$type_length = strlen($data);
				$type_data = htmlentities($data); break;

			case "Integer": 
				$type_color = "red";
				$type_length = strlen($data);
				$type_data = htmlentities($data); break;

			case "Boolean": 
				$type_color = "#92008d";
				$type_length = strlen($data);
				$type_data = $data ? "TRUE" : "FALSE"; break;

			case "NULL": 
				$type_length = 0; break;

			case "Array": 
				$type_length = count($data);
		}

		if (in_array($type, array("Object", "Array"))) {
			$notEmpty = false;

			foreach($data as $key => $value) {
				if (!$notEmpty) {
					$notEmpty = true;

					if ($isTerminal) {
						echo $type . ($type_length !== null ? "(" . $type_length . ")" : "")."\n";

					} else {
						$id = substr(md5(rand().":".$key.":".$level), 0, 8);

						echo "<a href=\"javascript:toggleDisplay('". $id ."');\" style=\"text-decoration:none\">";
						echo "<span style='color:red;font-weight:bold;text-align:left;'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>";
						echo "</a>";
						echo "<span id=\"plus". $id ."\" style=\"" . ($collapse ? "inline" : "none") . ";\">&nbsp;&#10549;</span>";
						echo "<div id=\"container". $id ."\" style=\"display: " . ($collapse ? "" : "inline") . ";\">";
						echo "<br />";
					}

					for ($i=0; $i <= $level; $i++) {
						echo $isTerminal ? "|    " : "<span style='color:red'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					}

					echo $isTerminal ? "\n" : "<br />";
				}

				for ($i=0; $i <= $level; $i++) {
					echo $isTerminal ? "|    " : "<span style='color:red'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}

				echo $isTerminal ? "[" . $key . "] => " : "<span style='width:width:250px; float; display: inline-block;color:blue;font-weight:bold;'><i style='width:100px; display: inline-table'>[" . $key . "]</i><span style='width:25px;float:right; padding:0 10px;'>&nbsp;=>&nbsp;</span></span>";

				call_user_func($recursive, $value, $level+1);
			}

			if ($notEmpty) {
				for ($i=0; $i <= $level; $i++) {
					echo $isTerminal ? "|    " : "<span style='color:red'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}

				if (!$isTerminal) {
					echo "</div>";
				}

			} else {
				echo $isTerminal ? 
						$type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " : 
						"<span style='color:#666666;width:75px;display: inline-block;'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>&nbsp;&nbsp;";
			}

		} else {
			echo $isTerminal ? 
					$type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " : 
					"<span style='color:#666666;width:80px;display: inline-block;text-align:right;'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>&nbsp;&nbsp;";

			if ($type_data != null) {
				print_r($isTerminal ? $type_data : "<span style='color:" . $type_color . "; width:100px;'><i style='width: 100px;';>" . $type_data . "</i></span>");
			}
		}

		echo $isTerminal ? "\n" : "<br />";
	};

	call_user_func($recursive, $data);
	if ($exitAfter == true) {
		die();
	}
}