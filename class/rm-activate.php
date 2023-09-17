<?php

class RMPluginActivate
{
	public static function activate() {

		global $wpdb;
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}rm_plugin(
		`id` INT NOT NULL AUTO_INCREMENT,
		`guid` VARCHAR(155) NULL,
		`buscar` VARCHAR(155) NULL,
		`sustituir` VARCHAR(155) NULL,
		PRIMARY KEY (`id`));";
		$wpdb->query($sql);

		flush_rewrite_rules();
	}
}