<?php

namespace Webazex\App\Core;

class Core {
	static array $whitelist;

	static function init(){
		self::setInWhiteList(
			[
				'App'.DIRECTORY_SEPARATOR,
				'inc'.DIRECTORY_SEPARATOR,
				'App'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR,
				'App'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR,
				'App'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR,
				'App'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'gutenberg'.DIRECTORY_SEPARATOR.'sections'.DIRECTORY_SEPARATOR,
			]
		);
		self::$whitelist = self::getWhiteListDir();
	}

	protected static function __getWhiteListDir(){
		return get_option('whitelist_dir', false);
	}

	static function getWhiteListDir(){
		if(!empty(self::$whitelist)){
			return self::$whitelist;
		}else{
			return self::__getWhiteListDir();
		}

	}

	static function refreshWhiteListDir(){
		self::init();
		return self::getWhiteListDir();
	}
	protected static function __settedWhiteListDir(array $dir):bool{
		if(!empty($dir)){
			return update_option('whitelist_dir', $dir);
		}else{
			return false;
		}
	}
	static function setInWhiteList(array $dir){
		if(!empty($dir) ){
			$cleanArray = [];
			foreach ($dir as $dirStr){
				if(is_array($dirStr)){
					continue;
				}else{
					$cleanArray[] = sanitize_text_field( $dirStr );
				}
			}
			return self::__settedWhiteListDir($cleanArray);
		}else{
			return false;
		}
	}
	static function getDirectory($name){
		$whiteListDir = (!empty(self::getWhiteListDir()) AND self::getWhiteListDir() !== false ) ?
			self::getWhiteListDir() : self::refreshWhiteListDir();
		if(!empty($whiteListDir)){
			$searchInArray = array_search($name, $whiteListDir);
			if($searchInArray !== false){
				return get_template_directory().DIRECTORY_SEPARATOR.$whiteListDir[2].DIRECTORY_SEPARATOR;
			}else{
				return get_template_directory().DIRECTORY_SEPARATOR;
			}
		}else{
			return [];
		}
	}

	static function getAllDirectories(){
		return (!empty(self::getWhiteListDir()) AND self::getWhiteListDir() !== false ) ?
			self::getWhiteListDir() : self::refreshWhiteListDir();
	}
}
