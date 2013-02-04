<pre>
<?php
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

include '../../classes/Auto/schema.php';

echo $schema->toDialectString(PostgresDialect::me());
?>
</pre>
