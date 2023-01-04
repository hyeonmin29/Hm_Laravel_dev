<?php
namespace App\Libraries;

class Script
{

    protected $scripts = '';
    protected static $instance = null;

    public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public  function add($script)
    {
        $this->scripts .= $script;
        return $this;
    }

    public function alert($message = null)
    {
        if (empty($message) === false){
            return $this->add("alert('" . ($message) . "');");
        }
        return this;
    }
}
