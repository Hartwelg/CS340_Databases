<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

if(isset($_POST['addsubmit'])){
		$name = $_POST['name'];
		$mascot = $_POST['mascot'];
		$numwins = $_POST['numwins'];
		$numlosses = $_POST['numlosses'];
		$query = "INSERT INTO `BasketballTeams` VALUES (NULL, '$name', '$mascot', '$numwins', '$numlosses', '99')";
        $result = mysqli_query($connection, $query);

		$query1 = "SELECT id FROM `BasketballTeams` WHERE name = '$name' AND mascot = '$mascot' AND NumWins = '$numwins' AND NumLosses = '$numlosses'";
		$result1 = mysqli_query($connection, $query1);
		$row = mysqli_fetch_row($result1);
		$newid = $row[0];

		$query2 = "UPDATE `BasketballTeams` SET BasketballTeamId = '$newid' WHERE id = '$newid'";
		$result2 = mysqli_query($connection, $query2);
   }
   if(isset($_POST['delsubmit'])){
		$id = $_POST['id'];
        $query="DELETE FROM `BasketballTeams` WHERE id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['updsubmit'])){
		$id = $_POST['id'];
		$newname = $_POST['name'];
		$newmascot = $_POST['mascot'];
		$newnumwins = $_POST['numwins'];
		$newnumlosses = $_POST['numlosses'];
        $query="UPDATE `BasketballTeams` SET name = '".$newname."', mascot = '".$newmascot."', NumWins = '".$newnumwins."', NumLosses = '".$newnumlosses."' WHERE id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['getinfo'])){
   	$result = mysqli_query($connection, "SELECT * FROM `BasketballTeams` WHERE id = '$_POST[id]'");
   	while($rowval = mysqli_fetch_array($result))
   	{
   		$updid = $rowval['id'];
   		$updname = $rowval['name'];
   		$updmascot = $rowval['mascot'];
   		$updnumwins = $rowval['NumWins'];
   		$updnumlosses = $rowval['NumLosses'];
   	}
   }

mysqli_close($connection); //Make sure to close out the database connection
?>
<HTML>
<HEAD>
</HEAD>
<BODY>
<center><h1>Teams</h1></center>
<center><a href="./index.html">Index</a></center>
<center><a href="./teams.php">Teams</a></center>
<center><a href="./players.php">Players</a></center>
<center><a href="./scores.php">Scores</a></center>
<center><a href="./games.php">Games</a></center>
<p>
<p>
<form name = "sort" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
Search Teams by name <input type="textbox" name="searchname">
<button type="submit" name="search" class="button" <?php echo $value='1'; ?>> Search </button><br>
<button type="submit" name="filterId" class="button" <?php echo $value='1'; ?>> Sort by ID </button>
<button type="submit" name="filterName" class="button" <?php echo $value='1'; ?>> Sort by Name </button>
<button type="submit" name="filterMascot" class="button" <?php echo $value='1'; ?>> Sort by Mascot </button>
<button type="submit" name="filterwins" class="button" <?php echo $value='1'; ?>> Sort by # wins </button>
<button type="submit" name="filterlosses" class="button" <?php echo $value='1'; ?>> Sort by # losses </button>
</form>
<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

$query = "SELECT * FROM BasketballTeams";

if(isset($_POST['filterId'])){
        $query="SELECT * FROM `BasketballTeams` ORDER BY `id` ASC";
   }
else if(isset($_POST['filterName'])){
        $query="SELECT * FROM `BasketballTeams` ORDER BY `name` ASC";
   }
else if(isset($_POST['filterMascot'])){
        $query="SELECT * FROM `BasketballTeams` ORDER BY `mascot` ASC";
   }
else if(isset($_POST['filterwins'])){
        $query="SELECT * FROM `BasketballTeams` ORDER BY `NumWins` ASC";
   }
else if(isset($_POST['filterlosses'])){
        $query="SELECT * FROM `BasketballTeams` ORDER BY `NumLosses` ASC";
   }
else if (isset($_POST['search'])){
		$search = $_POST['searchname'];
		if ($search === '')
		{
			$query = "SELECT * FROM BasketballTeams";
		}
		else
		{
			$query = "SELECT id, name, mascot, NumWins, NumLosses, BasketballTeamId FROM `BasketballTeams` WHERE name = '".$search."'";
		}
}
	
$result = mysqli_query($connection, $query);

echo "<table style='width:100%'>"; // start a table tag in the HTML
echo "<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Mascot</th>
			<th># Wins</th>
			<th># Losses</th>
			<th>TeamId</th>
		</tr>";
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

echo "<tr><td align=center>" . $row['id'] . "</td><td align=center>" . $row['name'] . "</td><td align=center>" . $row['mascot'] . "</td><td align=center>" . $row['NumWins'] . "</td><td align=center>" . $row['NumLosses'] . "</td><td align=center>" . $row['BasketballTeamId'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysqli_close($connection); //Make sure to close out the database connection
?>
<p>
<p>
<form name = "addTeam" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Add a Team</h3>
	<p>Team Name: <input name = "name" type = text required>
	<p>Mascot: <input name = "mascot" type = text required>
	<p>Number of Wins: <input name = "numwins" type = text required>
	<p>Number of Losses: <input name = "numlosses" type = text required>
	<p><button type="submit" name="addsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

<form name = "delTeam" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Delete a Team</h3>
	Team ID: <input name = "id" type = text required>
	<p><button type="submit" name="delsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

<form name = "updateTeam" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Update Team info</h3>
	Team ID: <input name = "id" type = text value="<?php echo $updid; ?>" />
	<p><button type="submit" name="getinfo" class="button">Get team info</button>
	<p>Team Name: <input name = "name" type = text value="<?php echo $updname; ?>" />
	<p>Mascot: <input name = "mascot" type = text value="<?php echo $updmascot; ?>" />
	<p>Number of Wins: <input name = "numwins" type = text value="<?php echo $updnumwins; ?>" />
	<p>Number of Losses: <input name = "numlosses" type = text value="<?php echo $updnumlosses; ?>" />
	<p><button type="submit" name="updsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

</BODY>
</HTML>
