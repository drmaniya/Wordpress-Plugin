<?php
/**
 * @package  DR
 */
class DRpluginActivate
{
	public static function activate() {
		flush_rewrite_rules();
	}
}