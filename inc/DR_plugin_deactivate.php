<?php
/**
 * @package  DR
 */
class DRpluginDeactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}