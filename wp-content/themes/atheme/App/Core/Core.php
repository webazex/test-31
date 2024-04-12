<?php

namespace Webazex\App\Core;

use function GuzzleHttp\Psr7\str;

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
				'inc'.DIRECTORY_SEPARATOR,
				'src'.DIRECTORY_SEPARATOR,
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
			$searchInArray = array_search($name, $whiteListDir, false);
			if($searchInArray !== false){
				return get_template_directory().DIRECTORY_SEPARATOR.$whiteListDir[$searchInArray];
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

	static function __getAcfGutenBlocksDir(){
		return self::getDirectory('inc'.DIRECTORY_SEPARATOR).'acf-gutenberg-blocks'.DIRECTORY_SEPARATOR;
	}

	static function getAcfGutenBlocksDir() {
		return self::__getAcfGutenBlocksDir();
	}

	static function getWorks(array $args = []){
		if(!empty($args)){
			$newArgs = self::__parseArgs($args);
			$obj = self::__getWorksObj($newArgs);
		}else{
			$obj = self::__getWorksObj();
		}
		return self::__fetchWorksObj($obj);
	}

	static function getDate($id){
		return (!empty($id))? self::__getDate(intval($id)) : '';
	}

	static function __getDate(int $id){
		$dateInDB = get_the_date("j-F-Y- -H-i", $id);
		$dateParts = explode("-", str_replace(" - ", "-", $dateInDB));
		return [
			'day' => $dateParts[0],
			'month' => $dateParts[1],
			'year' => $dateParts[2],
			'th' => $dateParts[3],
			'tm' => $dateParts[4],
		];
	}

	static function __getWorksObj(array $args = []){
		if(!empty($args)){
			$obj = new \WP_Query(array_merge(['post_type' => 'works'], $args));
		}else{
			$obj = new \WP_Query([
				'posts_per_page' => get_option('posts_per_page'),
				'post_type' => 'works',
			]);
		}
		return (!empty($obj->posts))? $obj->posts : [];
	}

	static function __fetchAcfReviewsObj($reviews){
		$ret = [];
		if( is_array($reviews) AND !empty($reviews) ){
			foreach ($reviews as $review){
				if(!empty($review['review'])){
					$ret[$review['review']->ID] = [
						'id' => $review['review']->ID,
						'date' => self::getDate($review['review']->ID),
						'title' => $review['review']->post_title,
						'excerpt' => (!empty($review['review']->post_excerpt)) ? $review['review']->post_excerpt : get_the_excerpt($review['review']->ID),
						'content' => $review['review']->post_content,
						'src' => get_the_post_thumbnail_url($review['review']->ID, 'full'),
						'link' => get_permalink($review['review']->ID),
					];
				}
			}
		}
		return $ret;
	}
	static function __fetchWorksObj(array $obj = []){
		$ret = [];
		if(empty($obj)){
			return $ret;
		}
		foreach ( $obj as $objItem ) {
			$data = get_field('data', $objItem->ID);
			$ret[$objItem->ID] = [
				'id' => $objItem->ID,
				'title' => $objItem->post_title,
				'excerpt' => (!empty($objItem->post_excerpt)) ? $objItem->post_excerpt : get_the_excerpt($objItem->ID),
				'content' => $objItem->post_content,
				'date' => self::getDate($objItem->ID),
				'estimate' => (!empty($data['estimate']))? $data['estimate'] : '',
				'price' => (!empty($data['price']))? $data['price'] : '',
				'src' => get_the_post_thumbnail_url($objItem->ID, 'full'),
				'link' => get_permalink($objItem->ID),
				'reviews' => self::__fetchAcfReviewsObj($data['reviews'])
			];
		}
		return $ret;
	}

	static function __parseArgs($args = []){
		if(!empty($args)){
			$newArgs = [];
			foreach ( $args as $k => $v ) {
				switch ($k){
					case "count":
						if(is_archive() OR is_search()){
							$newArgs['posts_per_archive_page']  = (!empty($v)) ? intval($v) : get_option('posts_per_page');
						}else{
							$newArgs['posts_per_page']  = (!empty($v)) ? intval($v) : get_option('posts_per_page');
						}
						break;
					case "page":
						if(is_archive() OR is_search()){
							$newArgs['posts_per_archive_page']  = (!empty($v)) ? intval($v) : get_option('posts_per_page');
						}else{
							$newArgs['posts_per_page']  = (!empty($v)) ? intval($v) : get_option('posts_per_page');
						}
						if(is_front_page()){
							$newArgs['page'] = (!empty($v))? intval($v) : 1;
						}else{
							$newArgs['paged'] = (!empty($v))? intval($v) : 1;
						}
						break;
					case "type":
						$newArgs['type'] = (!empty($v))? strval($v) : 'post';
						break;

				}
			}
		}else{
			$newArgs = [
				'post_type' => 'post',
				'posts_per_page' => -1,
			];
		}
		return $newArgs;
	}

	static function __getReviewsObj($args = []){
		if(!empty($args)){
			$obj = new \WP_Query(array_merge(['post_type' => 'reviews'], $args));
		}else{
			$obj = new \WP_Query([
				'posts_per_page' => get_option('posts_per_page'),
				'post_type' => 'reviews',
			]);
		}
		return (!empty($obj->posts))? $obj->posts : [];
	}

	static function __fetchReviewsObj($obj = []): array {
		$ret = [];
		if(empty($obj)){
			return $ret;
		}
		foreach ( $obj as $objItem ) {
			$ret[$objItem->ID] = [
				'id' => $objItem->ID,
				'title' => $objItem->post_title,
				'excerpt' => (!empty($objItem->post_excerpt)) ? $objItem->post_excerpt : get_the_excerpt($objItem->ID),
				'content' => $objItem->post_content,
				'date' => self::getDate($objItem->ID),
				'src' => get_the_post_thumbnail_url($objItem->ID, 'full'),
				'link' => get_permalink($objItem->ID),
			];
		}
		return $ret;
	}

	static function __fetchPostsObj($obj = []): array {
		$ret = [];
		if(empty($obj)){
			return $ret;
		}
		foreach ( $obj as $objItem ) {
			$ret[$objItem->ID] = [
				'id' => $objItem->ID,
				'title' => $objItem->post_title,
				'excerpt' => (!empty($objItem->post_excerpt)) ? $objItem->post_excerpt : get_the_excerpt($objItem->ID),
				'content' => $objItem->post_content,
				'date' => self::getDate($objItem->ID),
				'src' => get_the_post_thumbnail_url($objItem->ID, 'full'),
				'link' => get_permalink($objItem->ID),
			];
		}
		return $ret;
	}

	static function __getPostsObj($args = []){
		if(!empty($args)){
			$obj = new \WP_Query(array_merge(['post_type' => 'post'], $args));
		}else{
			$obj = new \WP_Query([
				'posts_per_page' => get_option('posts_per_page'),
				'post_type' => 'post',
			]);
		}
		return (!empty($obj->posts))? $obj->posts : [];
	}
	static function getReviews($args = []){
		if(!empty($args)){
			$newArgs = self::__parseArgs($args);
			$obj = self::__getReviewsObj($newArgs);
		}else{
			$obj = self::__getReviewsObj();
		}
		return self::__fetchReviewsObj($obj);
	}

	static function getPosts($args = []){
		if(!empty($args)){
			$newArgs = self::__parseArgs($args);
			$obj = self::__getPostsObj($newArgs);
		}else{
			$obj = self::__getPostsObj();
		}
		return self::__fetchPostsObj($obj);
	}
	static function getAnyPosts(string $type, $args = []){
		switch ($type){
			case "reviews":
				return self::getReviews($args);
			case "post":
				return self::getPosts($args);
			case "works":
				return self::getWorks($args);
			default:
				return [];
		}
	}
}
