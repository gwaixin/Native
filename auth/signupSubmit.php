<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	header('Location: /auth/signup.php');
	die();	
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/libs/config.php';
include_once WEBROOT . '/models/User.php';

$user = new User();

$res = array();

// VALIDATIONS
if (empty($_POST['username'])) {
	$res['message'][] = 'Username must not be empty';
}
if (empty($_POST['password'])) {
	$res['message'][] = 'Password must not be empty';
}
if (empty($_POST['password_confirm'])) {
	$res['message'][] = 'Password confirm must not be empty';
} else if ($_POST['password'] != $_POST['password_confirm']) { // Check password and confirm password
	$res['message'][] = 'Password does not match';
}

if (empty($_POST['full_name'])) {
	$res['message'][] = 'Full name must not be empty';
}
if (empty($_POST['gender'])) {
	$res['message'][] = 'Gender must not be empty';
} else if (!($_POST['gender'] == 'female' || $_POST['gender'] == 'male')) {
	$res['message'][] = 'Gender is not female or male';
}

if (empty($res['message'])) {
	$data = array(
		$user->getUsername() => $_POST['username'],
		$user->getPassword() => $_POST['password'],
		$user->getFullname() => $_POST['full_name'],
		$user->getGender() => $_POST['gender']
	);
	$result = $user->insert($data);
	if ($result == 'success') {
		flash('message', 'Successfully created an account, you may now login');
	  header('Location: /index.php');
		die();
	} else {
		flash('message', $result, 'danger');
	}
} else {
	flash('message', implode(', <br>', $res['message']), 'danger');
}

include_once 'signup.php';