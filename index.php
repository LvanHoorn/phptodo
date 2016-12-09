<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
		SELECT id, name, done
		FROM items
		WHERE user = :user
");

$itemsQuery->execute([
	'user' => $_SESSION ['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];


?>

<!-- HTML -->

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
		<title>To do</title>

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/main.css ">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	</head>
	<body>
		<div class="list">
				<h1 class="header">To Do</h1>

				<?php if(!empty($items)): ?>
			
				<ul class="items">
					
					<?php foreach ($items as $item): ?>

							<li>
									<span class="item <?php echo $item['done'] ? ' done' :  '' ?>"><?php echo $item['name']; ?></span>
									<?php if(!$item['done']): ?>
									<a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
									<?php endif; ?>
							</li>

						<?php endforeach; ?>
				</ul>
				<?php else: ?>
						<p>You haven't edit any items </p>
				<?php endif; ?>

				<form class="items-add" action="add.php" method="post">
						<input type="text" name="name" placeholder="Type a new item here" class="input" autocomplete="off" required="">
						<input type="submit" value="Add" class="submit">
				</form>

		</div>
	</body>
</html>