<?php
use Webazex\App\App as App;
use Webazex\App\Core\Core as Core;
require_once get_template_directory().'/App/autoload.php';
Core::refreshWhiteListDir();
App::getAppDirectory();