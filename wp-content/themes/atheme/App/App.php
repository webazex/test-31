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

	static function getIncludesDirectory(){
		return Core::getDirectory('inc'.DIRECTORY_SEPARATOR);
	}

	static function getAcfGutenBlockSectionDir($name){
		if(!empty($name)){
			return Core::getAcfGutenBlocksDir().$name.DIRECTORY_SEPARATOR.'section.php';
		}else{
			return '';
		}
	}

	static function getAcfGutenBlockDir($name){
		if(!empty($name)){
			return Core::getAcfGutenBlocksDir().$name.DIRECTORY_SEPARATOR.'block.php';
		}else{
			return '';
		}
	}

	static function getAnyPosts(string $type, array $args = []){
		return Core::getAnyPosts($type, $args);
	}

	static function getPlaceholderImgUrl(string $format = "webp"){
		if(in_array($format, ['webp', 'png']) ){
			return get_template_directory_uri().'src/placeholder.'.$format;
		}else{
			return get_template_directory_uri().'src/placeholder.webp';
		}

	}
}