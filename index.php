<?php
require_once('/libs/config.php');
if ($_SERVER['PHP_SELF'] == '/index.php') {
	$title = 'Welcome';
	$body = 'landing/index';
	include_once('/views/common/landing.php');
} else {
	/* AJAX check  */
	if (
		$common == 'user' ||
		$common == 'landing'
	) {
		if (isAjax()) {
			/* special ajax here */
			ob_start();
			include_once WEBROOT . '/views/pages/' . $body . '.php';
			$content = ob_get_clean();
			die($content);
		} else {
			include_once WEBROOT . '/views/common/' . $common . '.php';
		}
	} else {
		die('Invalid common file');
	}
}