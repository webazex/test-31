<?php

namespace Webazex\App;
use Webazex\App\Core\Core as Core;
use Webazex\App\Core\CPT\CPT as CPT;
class App {
	static function init(){
		Core::init();
	}

	static function getAppDirectory(){
		return Core::getDirectory('App'.DIRECTORY_SEPARATOR);
	}

	static function getSourcesDirectory(string $source = ""){
		if(!empty($source)){
			return Core::getDirectory('src'.DIRECTORY_SEPARATOR).$source.DIRECTORY_SEPARATOR;
		}else{
			return Core::getDirectory('src'.DIRECTORY_SEPARATOR);
		}
	}
}