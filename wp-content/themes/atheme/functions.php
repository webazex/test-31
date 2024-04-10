<?php
use Webazex\App\App as App;

use Webazex\App\Core\Core as Core;
require_once get_template_directory().'/App/autoload.php';
//menu
require_once App::getIncludesDirectory().'registeredMenuArea.php';

//theme supports
require_once App::getIncludesDirectory().'supports.php';

//assets
require_once App::getIncludesDirectory().'sources.php';

//acf gutenberg blocks
if(function_exists('acf_register_block_type')){
	require_once App::getIncludesDirectory().'gutenberg-blocks.php';
}

//cpt
require_once App::getIncludesDirectory().'cpt.php';

Core::getWorks();