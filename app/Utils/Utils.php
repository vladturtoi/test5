<?php
/**
 * Created by PhpStorm.
 * User: vlad.turtoi
 * Date: 05/08/2017
 * Time: 16:59
 */

namespace App\Utils;

class Utils
{
	public static function isHttps() {
		return
			(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
			|| $_SERVER['SERVER_PORT'] == 443;
	}
}