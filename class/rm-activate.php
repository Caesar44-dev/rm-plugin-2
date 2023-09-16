<?php

class RMPluginActivate
{
	public static function activate() {

		global $wpdb;
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}rm_plugin(
		`ID` INT NOT NULL AUTO_INCREMENT,
		`Buscar` VARCHAR(155) NULL,
		`Sustituir` VARCHAR(155) NULL,
		PRIMARY KEY (`ID`));";
		$wpdb->query($sql);

		flush_rewrite_rules();
	}
}