<?php

class RMPluginActivate
{
	public static function activate() {

		global $wpdb;
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}rm_plugin(
		`rmid` INT NOT NULL AUTO_INCREMENT,
		`id` VARCHAR(155) NULL,
		`buscar` VARCHAR(155) NULL,
		`sustituir` VARCHAR(155) NULL,
		PRIMARY KEY (`rmid`));";
		$wpdb->query($sql);

		flush_rewrite_rules();
	}
}