<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo empty($title) ? 'Hello World' : $title; ?></title>
</head>
<body>
	<div>
		<?php flash('message'); ?>
	</div>
	<?php if (isset($body)) { include('pages/' . $body . '.php'); } ?>
</body>
</html>