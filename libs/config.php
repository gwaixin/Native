<?php
// Set Constant variables

define('COMPANY_NAME', 'NATIVE');

define('WEBROOT', $_SERVER['DOCUMENT_ROOT']);

include_once 'flash.php';
include_once 'session.php';

function isValidDate($date, $format = 'Y-m-d H:i:s') {
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) == $date;
}

function isValidEmail($email){ 
  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function redirect($location) {
	header("Location: $location");
	die();
}

function isAjax() {
	return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}