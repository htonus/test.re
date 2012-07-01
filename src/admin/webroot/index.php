<?php
	
	define('MODE', 'admin');

	$appPath =
		realpath(
			dirname(__FILE__).DIRECTORY_SEPARATOR
			.'..'.DIRECTORY_SEPARATOR
			.'..'.DIRECTORY_SEPARATOR
			.'..'.DIRECTORY_SEPARATOR
		)
		.DIRECTORY_SEPARATOR;
	
	if (file_exists($appPath.'config.inc.php'))
		require_once ($appPath.'config.inc.php');
	else
		require_once ($appPath.'config.inc.php.tpl');
	
	try {
		Application::create()->run();
	} catch (Exception $e) {
		$trace = $e->getTraceAsString();
		$extensionClass = get_class($e);
		
		echo '<pre>';
		echo "Exception: $extensionClass\n";
		echo 'Message: '.$e->getMessage()."\n";
		
		if ($extensionClass == 'ClassNotFoundException') {
			$className = 'unknown';
			if (preg_match("/__autoload\(\'([^\']+)\'\)/m", $trace, $m)) {
				$className = $m[1];
			}
			echo 'Class not found: ['.$className.']';
		}
		
		echo "\nTrace:\n$trace\n";
		echo '</pre>';
//		header('Location: /');
	}
