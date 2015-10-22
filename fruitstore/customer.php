<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)

		if (!checkEntry()) {
		?>

		<!-- Ex 4 : 
			Display the below error message : --> 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		#} elseif (checkName()) {
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		--> 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		# } elseif () {
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		--> 

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?=$_POST['name']?></li>
			<li>Membership Number: <?=$_POST['membership']?></li>
			<li>Options: <?php optionPrint()?></li>
			<li>Fruits: <?=$_POST['fruits']?> - <?=$_POST['quantity']?></li>
			<li>Credit: <?=$_POST['cardnumber']?> (<?=$_POST['card']?>)</li>
		</ul>
		
		<!-- Ex 3 : -->
			<p>This is the sold fruits count list:</p> 

		<?php
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */
			$filename = "customers.txt";
			soldFruitCount($filename);

		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt".
			Create unordered list to show the number of fruit sold -->
		<ul>
		<?php 
		#$fruitcounts = soldFruitCount($filename);
		#foreach() {
		?>
		<!-- <li></li> -->
		<?php
		#}
		?>
		</ul>
		
		<?php
		}
		?>
		
		<?php
			/* Ex 3 :
			* Get the fruits species and the number from "customers.txt"
			* 
			* The function parses the content in the file, find the species of fruits and count them.
			* The return value should be an key-value array
			* For example, array("Melon"=>2, "Apple"=>10, "Orange" => 21, "Strawberry" => 8)
			*/
			function soldFruitCount($filename) {
			$lines = file($filename);

			$melonCounter = 0;
			$appleCounter = 0;
			$orangeCounter = 0;
			$strawberryCounter = 0;
			foreach ($lines as $line) {
				$temp = explode(";", $line);
				if ($temp[2]=="Melon") {
					$melonCounter += $temp[3];
				} else if ($temp[2] == "Orange") {
					$orangeCounter += $temp[3];
				} else if ($temp[2] == "Apple") {
					$appleCounter += $temp[3];
				} else if ($temp[2] == "Strawberry") {
					$strawberryCounter += $temp[3];
				}
			}
			print "<ul>";
			print "<li>Melon - $melonCounter</li>";
			print "<li>Apple - $appleCounter</li>";
			print "<li>Orange - $orangeCounter</li>";
			print "<li>Strawberry - $strawberryCounter</li>";
 			}

			function optionPrint(){
				$temp = array();
				if (isset($_POST['organic'])) {
					array_push($temp, "Organic");
				}
				if (isset($_POST['domestic'])) {
					array_push($temp, "Domestic Product");
				}
				if (isset($_POST['gmo'])) {
					array_push($temp, "Genetically Modified");
				}
				if (isset($_POST['new'])) {
					array_push($temp, "Newly Harvested");
				}

				$result = implode(", ",$temp);
				print_r($result);
			}
			function checkCardType() {
				if (isset($_POST['card'])) {
					print $_POST['card'];
				}
			}

			function checkEntry() {
				$result = True;
				if (!isset($_POST['name']) || $_POST['name'] == "") {
					$result = False;
				}
				elseif (!isset($_POST['membership']) || $_POST['membership'] == "") {
					$result = False;
				}
				elseif (!isset($_POST['fruits']) || $_POST['fruits'] == "") {
					$result = False;
				}
				elseif (!isset($_POST['quantity']) || $_POST['quantity'] == "") {
					$result = False;
				}
				elseif (!isset($_POST['card']) || $_POST['card'] == "") {
					$result = False;
				}
				elseif (!isset($_POST['cardnumber'])|| $_POST['cardnumber'] == "") {
					$result = False;
				}
				elseif (!isset($_POST['name']) || $_POST['name'] == "") {
					$result = False;
				}
				return $result;
			}

			function checkName() {
				$result = True;
				$input = $_POST['name'];
				$test1 = '/[a-zA-Z]*[a-zA-Z]/';

				if (preg_match($test1, $input) && !preg_match(pattern, subject)) {
				}
			}
		?>
		
	</body>
</html>
