<?php

class Interview
{
	/* $title should be declared static so that it can be accessed irrespective of instantiation */
	// public $title = 'Interview test';
	public static $title = 'Interview test';
}

$lipsum = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus incidunt, quasi aliquid, quod officia commodi magni eum? Provident, sed necessitatibus perferendis nisi illum quos, incidunt sit tempora quasi, pariatur natus.';

$people = array(
	array('id'=>1, 'first_name'=>'John', 'last_name'=>'Smith', 'email'=>'john.smith@hotmail.com'),
	array('id'=>2, 'first_name'=>'Paul', 'last_name'=>'Allen', 'email'=>'paul.allen@microsoft.com'),
	array('id'=>3, 'first_name'=>'James', 'last_name'=>'Johnston', 'email'=>'james.johnston@gmail.com'),
	array('id'=>4, 'first_name'=>'Steve', 'last_name'=>'Buscemi', 'email'=>'steve.buscemi@yahoo.com'),
	array('id'=>5, 'first_name'=>'Doug', 'last_name'=>'Simons', 'email'=>'doug.simons@hotmail.com')
);

/* Assuming all of the data submitted is required (taking into account the $person null 
  check later on), each individual property should be validated for completeness once it is received here. 
  If either one of them is empty, the person variable should be set to null
*/

// $person = $_POST['person'];
$person = empty($_POST['person']) || 
		empty($_POST['person']['first_name']) || 
		empty($_POST['person']['last_name']) ||
		empty($_POST['person']['email']) ? null : $_POST['person'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Interview test</title>
	<style>
		body {font: normal 14px/1.5 sans-serif;}
	</style>
</head>
<body>

	<h1><?=Interview::$title;?></h1>

	<?php
	// Print 10 times

	/* for loop seems to have a typo. Easiest solution is to swap initial value with condition value. 
		($i should typically start counting up from 0 to 10 anyways).

		Also, string concatination should be with '.' operator in php
		(not to be confused with '+' from JavaScript)
	*/
	
	// for ($i=10; $i<0; $i++) {
	// 	echo '<p>'+$lipsum+'</p>';
	// }
	for ($i=0; $i<10; $i++) {
		echo '<p>' . $lipsum . '</p>';
	}
	?>


	<hr>

	<!-- As per REST guidelines, new form data should be sent in a POST request 
  (GET should only be used for performing idempotent actions – retrieving and not modifying backend data) -->

	<!-- <form method="get" action="<?=$_SERVER['REQUEST_URI'];?>"> -->
	<form method="POST" action="<?=$_SERVER['REQUEST_URI'];?>">


		<!-- Assuming each field is required, form data should be validated clientside first to reduce
		the number of requests to be sent out for serverside validation. The 'required' attribute (by itself) will
		filter out at least the most trivial cases of empty user submissions and reduce load. It is ideal to
		include autocomplete hint attributes to improve user experience when filling out forms when they use 
		autocomplete tools. Setting the email input type to 'email' instead of text is a new HTML5 feature which 
		will conveniently validate the email for correctness in the clientside and may also optimize the typing 
		experience for email when a virtual keyboard is present-->

		<!-- <p><label for="firstName">First name</label> <input type="text" name="person[first_name]" id="firstName"></p> -->
		<p><label for="firstName">First name</label> <input type="text" name="person[first_name]" id="firstName" required autocomplete="fname"></p>
		<!-- <p><label for="lastName">Last name</label> <input type="text" name="person[last_name]" id="lastName"></p> -->
		<p><label for="lastName">Last name</label> <input type="text" name="person[last_name]" id="lastName" required autocomplete="lname"></p>
		<!-- <p><label for="email">Email</label> <input type="text" name="person[email]" id="email"></p> -->
		<p><label for="email">Email</label> <input type="email" name="person[email]" id="email" required autocomplete="email"></p>
		<p><input type="submit" value="Submit" /></p>
	</form>


	<!-- If $person is empty, it is good practice to inform the user to resubmit it so they know the server found a mistake.
		It may also be a good to practice to validate the user data to prevent XSS -->

	<!-- <?php if (!empty($person)): ?>
		<p><strong>Person</strong> <?= htmlspecialchars($person["first_name"], ENT_QUOTES, 'UTF-8'); ?>, <?= htmlspecialchars($person["last_name"], ENT_QUOTES, 'UTF-8'); ?>, <?= htmlspecialchars($person["email"], ENT_QUOTES, 'UTF-8'); ?></p>
	<?php endif; ?> -->

	<?php if (empty($person)): ?>
		<p>Please enter all information.</p>
	<?php else: ?>
		<p style="color: green;"><strong>Person:</strong> <?=$person['first_name'];?>, <?=$person['last_name'];?>, <?=$person['email'];?></p>
	<?php endif; ?>


	<hr>


	<table>
		<thead>
			<tr>
				<th>First name</th>
				<th>Last name</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($people as $person): ?>
				<tr>
					<!-- $people is not an instance of an object, it is an associative array. 
					Array properties should be accessed with the [""] syntax. It may also be
					a good to practice to validate the user data to prevent XSS -->

					<!-- <td><?=$person->first_name;?></td>
					<td><?=$person->last_name;?></td>
					<td><?=$person->email;?></td> -->

					<td><?= htmlspecialchars($person["first_name"], ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?= htmlspecialchars($person["last_name"], ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?= htmlspecialchars($person["email"], ENT_QUOTES, 'UTF-8'); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

</body>
</html>