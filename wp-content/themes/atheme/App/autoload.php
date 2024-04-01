<?php
spl_autoload_register(function ($namespace){
	if(strripos($namespace, 'Webazex') !== false){
		$correctPatch = str_replace('Webazex', '', $namespace);
		require_once get_template_directory().DIRECTORY_SEPARATOR.$correctPatch.'.php';
	}
});