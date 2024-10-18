<?php

class Loader{
    private string $namespace;
    private string $repertoire;
    function __construct(string $namespace, string $repertoire){
        $this->namespace = $namespace;
        $this->repertoire = $repertoire;
    }

    function loadClass($class): void
    {
        $load = explode($this->namespace, $class)[1];
        $load = str_replace('\\', DIRECTORY_SEPARATOR, $load);
        $load = $this->repertoire . $load . ".php";
        if(is_file($load)) require_once($load) ;
    }

    function register(): void
    {
        spl_autoload_register([$this,'loadClass']);
    }
}