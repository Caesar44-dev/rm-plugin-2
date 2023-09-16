<?php

class AdminCallbacks extends RMPlugin
{
    public function home()
    {
        return require_once("$this->plugin_path/templates/home.php");
    }

    public function createrm()
    {
        return require_once("$this->plugin_path/templates/createrm.php");
    }

    public function updaterm()
    {
        return require_once("$this->plugin_path/templates/updaterm.php");
    }

    public function deleterm()
    {
        return require_once("$this->plugin_path/templates/deleterm.php");
    }
}
