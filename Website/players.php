<?php
session_start();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

	if(isset($_POST['addsubmit'])){
		$bteamid = test_input($_POST['bteamid']);
		$fname = test_input($_POST['fname']);
		$lname = test_input($_POST['lname']);
		$jnum = test_input($_POST['jnum']);
		$pos = test_input($_POST['pos']);
        $query="INSERT INTO `BasketballTeamPlayer` VALUES (NULL, '$bteamid', '$fname', '$lname', '$jnum', '$pos')";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['delsubmit'])){
		$id = $_POST['id'];
        $query="DELETE FROM `BasketballTeamPlayer` WHERE Id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['getinfo'])){
   	$result = mysqli_query($connection, "SELECT * FROM `BasketballTeamPlayer` WHERE Id = '$_POST[updid]'");
   	while($rowval = mysqli_fetch_array($result))
   	{
   		$getid = $rowval['Id'];
   		$getfname = $rowval['FirstName'];
   		$getlname = $rowval['LastName'];
   		$getjnum = $rowval['JerseyNumber'];
   		$getpos = $rowval['Position'];
   	}
   }
   if(isset($_POST['updsubmit'])){
		$id = $_POST['updid'];
		$newfname = $_POST['updfname'];
		$newlname = $_POST['updlname'];
		$newjnum = $_POST['updjnum'];
		$newpos = $_POST['updpos'];
        $query="UPDATE `BasketballTeamPlayer` SET FirstName = '".$newfname."', LastName = '".$newlname."', JerseyNumber = '".$newjnum."', Position = '".$newpos."' WHERE id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }

mysqli_close($connection); //Make sure to close out the database connection
?>
<HTML>
<HEAD>

</HEAD>
<BODY>
<center><h1>Players</h1></center>
<center><a href="./index.html">Index</a></center>
<center><a href="./teams.php">Teams</a></center>
<center><a href="./players.php">Players</a></center>
<center><a href="./scores.php">Scores</a></center>
<center><a href="./games.php">Games</a></center>
<p>
<p>
<form name = "sort" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
Search Players by name (first) <input type="text" name="searchname">
<button type="submit" name="searchplayer" class="button" <?php echo $value='1'; ?>> Search </button><br>
<button type="submit" name="filterId" class="button" <?php echo $value='1'; ?>> Sort by ID </button>
<button type="submit" name="filterFname" class="button" <?php echo $value='1'; ?>> Sort by First Name </button>
<button type="submit" name="filterLname" class="button" <?php echo $value='1'; ?>> Sort by Last Name </button>
<button type="submit" name="filterJersey" class="button" <?php echo $value='1'; ?>> Sort by Jersey Number </button>
<button type="submit" name="filterPos" class="button" <?php echo $value='1'; ?>> Sort by Position </button>
</form>
<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

$query = "SELECT * FROM BasketballTeamPlayer"; //You don't need a ; like you do in SQL

if(isset($_POST['filterId'])){
        $query="SELECT * FROM `BasketballTeamPlayer` ORDER BY `Id` ASC";
   }
else if(isset($_POST['filterFname'])){
        $query="SELECT * FROM `BasketballTeamPlayer` ORDER BY `FirstName` ASC";
   }
else if(isset($_POST['filterLname'])){
        $query="SELECT * FROM `BasketballTeamPlayer` ORDER BY `LastName` ASC";
   }
else if(isset($_POST['filterJersey'])){
        $query="SELECT * FROM `BasketballTeamPlayer` ORDER BY `JerseyNumber` ASC";
   }
else if(isset($_POST['filterPos'])){
        $query="SELECT * FROM `BasketballTeamPlayer` ORDER BY `Position` ASC";
   }
else if (isset($_POST['searchplayer'])){
		$search = $_POST['searchname'];
		if ($search === '')
		{
			$query = "SELECT * FROM BasketballTeamPlayer";
		}
		else
		{
			$query="SELECT Id, FirstName, LastName, JerseyNumber, Position FROM `BasketballTeamPlayer` WHERE FirstName = '".$search."'";
		}		
}

$result = mysqli_query($connection, $query);

echo "<table style='width:100%'>"; // start a table tag in the HTML
echo "<tr>
			<th>ID</th>
			<th>TeamId</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Jersey #</th>
			<th>Position</th>
		</tr>";
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

echo "<tr><td>" . $row['Id'] . "</td><td align=center>" . $row['BasketballTeamId'] . "</td><td align=center>" . $row['FirstName'] . "</td><td align=center>" . $row['LastName'] . "</td><td align=center>" . $row['JerseyNumber'] . "</td><td align=center>" . $row['Position'] .  "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysqli_close($connection); //Make sure to close out the database connection
?>
<p>
<p>
<form name = "addPlayer" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Add a Player</h3>
	<p>ID of Basketball team: <select name = "bteamid" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value="1">1 - Rockets</option>
		<option value="2">2 - Warriors</option>
		<option value="3">3 - Trail Blazers</option>
		<option value="4">4 - Jazz</option>
	</select>
	<p>First Name: <input name = "fname" type = text required>
	<p>Last Name: <input name = "lname" type = text required>
	<p>Jersey Number: <input name = "jnum" type = text required>
	<p>Position: <select name = "pos" required>
		<option value = "" disabled="disabled">-select-</option>
		<option value="F">F</option>
		<option value="C">C</option>
		<option value="G">G</option>
		<option value="">No Position</option>
	</select>
	<p><button type="submit" name="addsubmit" class="button" onSubmit='validate();' <?php echo $value='1'; ?>> Submit </button>
</form>

<form name = "delPlayer" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Delete a Player</h3>
	ID: <input name="id" type=text required>
	<p><button type="submit" name="delsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

<form name = "updatePlayer" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Update player info</h3>
	Player ID: <input name = 'updid' type = text value="<?php echo $getid; ?>" />
	<p><button type="submit" name="getinfo" class="button">Get player info</button>
	<p>First Name: <input name = "updfname" type = text value="<?php echo $getfname; ?>" />
	<p>Last Name: <input name = "updlname" type = text value="<?php echo $getlname; ?>" />
	<p>Jersey Number: <input name = "updjnum" type = text value="<?php echo $getjnum; ?>" />
	<p>Position: <select name = "updpos" value="<?php echo $getpos; ?>" />
		<option>-select-</option>
		<option value="F" <?php if ($getpos === 'F') echo ' selected="selected"'?>>F</option>
		<option value="C" <?php if ($getpos === 'C') echo ' selected="selected"'?>>C</option>
		<option value="G" <?php if ($getpos === 'G') echo ' selected="selected"'?>>G</option>
	</select>
	<p><button type="submit" name="updsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

</BODY>
</HTML>
