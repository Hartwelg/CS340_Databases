<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

if(isset($_POST['addsubmit'])){
		$winningteam = $_POST['winningteam'];
		$losingteam = $_POST['losingteam'];
		$loc = $_POST['loc'];
		$gameid = $_POST['gameid'];
		$winningscore = $_POST['winningscore'];
		$losingscore = $_POST['losingscore'];
        $query="INSERT INTO `BasketballGame` VALUES (NULL, '".$winningscore."', '".$losingscore."', '".$loc."', '".$gameid."', '".$winningteam."', '".$losingteam."')";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['delsubmit'])){
		$id = $_POST['id'];
        $query="DELETE FROM `BasketballGame` WHERE id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['getinfo'])){
   	$result = mysqli_query($connection, "SELECT * FROM `BasketballGame` WHERE id = '$_POST[id]'");
   	while($rowval = mysqli_fetch_array($result))
   	{
   		$getid = $rowval['id'];
   		$getwinningscore = $rowval['FinalScoreOfWinningTeam'];
   		$getlosingscore = $rowval['FinalScoreOfLosingTeam'];
   		$getloc = $rowval['Location'];
   		$getgameid = $rowval['GameId'];
   		$getwinningteam = $rowval['Team1Id'];
   		$getlosingteam = $rowval['Team2Id'];
   	}
   }
   if(isset($_POST['updsubmit'])){
		$id = $_POST['id'];
		$winningscore = $_POST['winningscore'];
		$losingscore = $_POST['losingscore'];
		$winningteam = $_POST['winningteam'];
		$losingteam = $_POST['losingteam'];
		$loc = $_POST['loc'];
        $query="UPDATE `BasketballGame` SET FinalScoreOfWinningTeam = '".$winningscore."', FinalScoreOfLosingTeam = '".$losingscore."', Location = '".$loc."', Team1Id = '".$winningteam."', Team2Id = '".$losingteam."' WHERE id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }

mysqli_close($connection); //Make sure to close out the database connection
?>
<HTML>
<HEAD>

</HEAD>
<BODY>
<center><h1>Games</h1></center>
<center><a href="./index.html">Index</a></center>
<center><a href="./teams.php">Teams</a></center>
<center><a href="./players.php">Players</a></center>
<center><a href="./scores.php">Scores</a></center>
<center><a href="./games.php">Games</a></center>
<p>
<p>

<form name = "sort" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
Search Games by winning team <input type="text" name="searchgame">
<button type="submit" name="searchbox" class="button" <?php echo $value='1'; ?>> Search </button><br>
<button type="submit" name="filterId" class="button" <?php echo $value='1'; ?>> Sort by ID </button>
<button type="submit" name="filterWinning" class="button" <?php echo $value='1'; ?>> Sort by Winning Score </button>
<button type="submit" name="filterLosing" class="button" <?php echo $value='1'; ?>> Sort by Losing Score </button>
<button type="submit" name="filterLoc" class="button" <?php echo $value='1'; ?>> Sort by Location </button>
</form>
<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');
$query = "SELECT * FROM BasketballGame"; //You don't need a ; like you do in SQL

if(isset($_POST['filterId'])){
        $query="SELECT * FROM `BasketballGame` ORDER BY `id` ASC";
   }
else if(isset($_POST['filterWinning'])){
        $query="SELECT * FROM `BasketballGame` ORDER BY `FinalScoreOfWinningTeam` ASC";
   }
else if(isset($_POST['filterLosing'])){
        $query="SELECT * FROM `BasketballGame` ORDER BY `FinalScoreOfLosingTeam` ASC";
   }
else if(isset($_POST['filterLoc'])){
        $query="SELECT * FROM `BasketballGame` ORDER BY `Location` ASC";
   }
else if (isset($_POST['searchbox'])){
		$search = $_POST['searchgame'];
		if ($search === '')
		{
			$query = "SELECT * FROM BasketballGame";
		}
		else
		{
			$query="SELECT id, FinalScoreOfWinningTeam, FinalScoreOfLosingTeam, Location, GameId, Team1Id, Team2Id FROM `BasketballGame` WHERE Team1Id = '".$search."'";
		}		
}

$result = mysqli_query($connection, $query);

echo "<table style='width:100%'>"; // start a table tag in the HTML
echo "<tr>
			<th>ID</th>
			<th>WinningTeamFinalScore</th>
			<th>LosingTeamFinalScore</th>
			<th>Location</th>
			<th>GameId</th>
			<th>Team1</th>
			<th>Team2</th>
		</tr>";
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

echo "<tr><td align=center>" . $row['id'] . "</td><td align=center>" . $row['FinalScoreOfWinningTeam'] . "</td><td align=center>" . $row['FinalScoreOfLosingTeam'] . "</td><td align=center>" . $row['Location'] . "</td><td align=center>" . $row['GameId'] . "</td><td align=center>" . $row['Team1Id'] . "</td><td align=center>" . $row['Team2Id'] . "</td><td align=center>" . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysqli_close($connection); //Make sure to close out the database connection
?>
<p>
<p>
<form name = "addGame" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Add a Game</h3>
	<p>Winning Team: <select name = "winningteam" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value="1">1 - Rockets</option>
		<option value="2">2 - Warriors</option>
		<option value="3">3 - Trail Blazers</option>
		<option value="4">4 - Jazz</option>
	</select>
	<p>Losing Team: <select name = "losingteam" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value="1">1 - Rockets</option>
		<option value="2">2 - Warriors</option>
		<option value="3">3 - Trail Blazers</option>
		<option value="4">4 - Jazz</option>
	</select>
	<p>Location of game: <select name = "loc" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value = "Vivint Smart Home Arena">1 - Vivint Smart Home Arena</option>
		<option value = "Oracle Arena">2 - Oracle Arena</option>
		<option value = "Moda Center">3 - Moda Center</option>
	</select>
	<p>Game ID: <input name = gameid type = text required>
	<p>Final Score of Winning Team: <input name = "winningscore" required>
	<p>Final Score of Losing Team: <input name = "losingscore" required>
	<p><button type="submit" name="addsubmit" class="button"> Submit </button>
</form>

<form name = "delgame" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Delete a Game</h3>
	ID: <input name="id" type=text required>
	<p><button type="submit" name="delsubmit" class="button"> Submit </button>
</form>

<form name = "updateGame" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Update game info</h3>
	ID: <input name="id" type=text value="<?php echo $getid; ?>" />
	<p><button type="submit" name="getinfo" class="button">Get game info</button>
	<p>Winning Team: <select name = "winningteam">
		<option>-select-</option>
		<option value="1" <?php if ($getwinningteam === '1') echo ' selected="selected"'?>>1 - Rockets</option>
		<option value="2" <?php if ($getwinningteam === '2') echo ' selected="selected"'?>>2 - Warriors</option>
		<option value="3" <?php if ($getwinningteam === '3') echo ' selected="selected"'?>>3 - Trail Blazers</option>
		<option value="4" <?php if ($getwinningteam === '4') echo ' selected="selected"'?>>4 - Jazz</option>
	</select>
	<p>Losing Team: <select name = "losingteam">
		<option>-select-</option>
		<option value="1" <?php if ($getlosingteam === '1') echo ' selected="selected"'?>>1 - Rockets</option>
		<option value="2" <?php if ($getlosingteam === '2') echo ' selected="selected"'?>>2 - Warriors</option>
		<option value="3" <?php if ($getlosingteam === '3') echo ' selected="selected"'?>>3 - Trail Blazers</option>
		<option value="4" <?php if ($getlosingteam === '4') echo ' selected="selected"'?>>4 - Jazz</option>
	</select>
	<p>Location of game: <select name = "loc">
		<option>-select-</option>
		<option value = "Vivint Smart Home Arena" <?php if ($getloc === "Vivint Smart Home Arena") echo ' selected="selected"'?>>1 - Vivint Smart Home Arena</option>
		<option value = "Oracle Arena" <?php if ($getloc === "Oracle Arena") echo ' selected="selected"'?>>2 - Oracle Arena</option>
		<option value = "Moda Center" <?php if ($getloc === "Moda Center") echo ' selected="selected"'?>>3 - Moda Center</option>
	</select>
	<p>Final Score of Winning Team: <input name = "winningscore" type=text value="<?php echo $getwinningscore; ?>" />
	<p>Final Score of Losing Team: <input name = "losingscore" type=text value="<?php echo $getlosingscore; ?>" />
	<p><button type="submit" name="updsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

</BODY>
</HTML>
