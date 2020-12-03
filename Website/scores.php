<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

if(isset($_POST['addsubmit'])){
		$id = $_POST['id'];
		$tname = $_POST['tname'];
		$gameid = $_POST['gameid'];
		$pos = $_POST['pos'];
		$points = $_POST['points'];
        $query="INSERT INTO `LeadingScore` VALUES (NULL, '".$id."', '".$pos."', '".$tname."', '".$gameid."', '".$points."')";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['delsubmit'])){
		$id = $_POST['id'];
		$gameid = $_POST['gameid'];
		$pos = $_POST['pos'];
		$points = $_POST['points'];
        $query="DELETE FROM `LeadingScore` WHERE id = '".$id."'";
        $result = mysqli_query($connection, $query);
   }
   if(isset($_POST['getinfo'])){
   	$result = mysqli_query($connection, "SELECT * FROM `LeadingScore` WHERE id = '$_POST[id]'");
   	while($rowval = mysqli_fetch_array($result))
   	{
   		$getid = $rowval['id'];
   		$getplayerid = $rowval['playerId'];
   		$getpos = $rowval['Position'];
   		$getteamid = $rowval['TeamId'];
   		$getgameid = $rowval['GameId'];
   		$getpoints = $rowval['TotalPointsPerGame'];
   	}
   }
   if(isset($_POST['updsubmit'])){
		$id = $_POST['id'];
		$playerid = $_POST['playerid'];
		$gameid = $_POST['gameid'];
		$tname = $_POST['tname'];
		$newpos = $_POST['pos'];
		$newpoints = $_POST['points'];
        $query="UPDATE `LeadingScore` SET playerId = '$playerid', Position = '$newpos', TeamId = '$tname', GameId = '$gameid', TotalPointsPerGame = '$newpoints' WHERE id = '$id'";
        $result = mysqli_query($connection, $query);
   }

mysqli_close($connection); //Make sure to close out the database connection
?>
<HTML>
<HEAD>

</HEAD>
<BODY>
<center><h1>Scores</h1></center>
<center><a href="./index.html">Index</a></center>
<center><a href="./teams.php">Teams</a></center>
<center><a href="./players.php">Players</a></center>
<center><a href="./scores.php">Scores</a></center>
<center><a href="./games.php">Games</a></center>
<p>
<p>
<form name = "sort" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
Search Scores by player ID: <input type=text name="searchscores">
<button type="submit" name="searchbox" class="button" <?php echo $value='1'; ?>> Search </button><br>
<button type="submit" name="filterid" class="button"> Sort by ID </button>
<button type="submit" name="filterPos" class="button"> Sort by Position </button>
<button type="submit" name="filterPoints" class="button"> Sort by Points </button>
</form>
<?php
$connection = mysqli_connect('classmysql', '', '', 'cs340_hartwelg');
// mysqli_connect('host', 'username', 'password', 'db');

$query = "SELECT * FROM LeadingScore"; //You don't need a ; like you do in SQL

if(isset($_POST['filterid'])){
        $query="SELECT * FROM `LeadingScore` ORDER BY `id` ASC";
   }
else if(isset($_POST['filterPos'])){
        $query="SELECT * FROM `LeadingScore` ORDER BY `Position` ASC";
   }
else if(isset($_POST['filterPoints'])){
        $query="SELECT * FROM `LeadingScore` ORDER BY `TotalPointsPerGame` ASC";
   }
else if (isset($_POST['searchbox'])){
		$search = $_POST['searchscores'];
		if ($search === '')
		{
			$query = "SELECT * FROM LeadingScore";
		}
		else
		{
			$query="SELECT id, playerId, Position, TeamId, GameId, TotalPointsPerGame FROM `LeadingScore` WHERE playerId = '".$search."'";
		}		
}

$result = mysqli_query($connection, $query);

echo "<table style='width:100%'>"; // start a table tag in the HTML
echo "<tr>
			<th>ID</th>
			<th>Player ID</th>
			<th>Position</th>
			<th>TeamId</th>
			<th>Arena ID</th>
			<th>TotalPointsPerGame</th>
		</tr>";
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

echo "<tr><td align=center>" . $row['id'] . "</td><td align=center>" . $row['playerId'] . "</td><td align=center>" . $row['Position'] . "</td><td align=center>" . $row['TeamId'] . "</td><td align=center>" . $row['GameId'] . "</td><td align=center>" . $row['TotalPointsPerGame'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysqli_close($connection); //Make sure to close out the database connection
?>
<p>
<p>
<form name = "addscore" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Add a Score</h3>
	ID of player with highest score: <select name="id" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value="1">1 - Eric Gordon</option>
		<option value="2">2 - P.J. Tucker</option>
		<option value="3">3 - Clint Capela</option>
		<option value="4">4 - James Harden</option>
		<option value="5">5 - Chris Paul</option>
		<option value="6">6 - Daniel House</option>
		<option value="7">7 - Austin Rivers</option>
		<option value="8">8 - Jae Crowder</option>
		<option value="9">9 - Joe Ingles</option>
		<option value="10">10 - Rudy Gobert</option>
		<option value="11">11 - Donovan Mitchel</option>
		<option value="12">12 - Ricky Rubio</option>
		<option value="13">13 - Royce O'Neale</option>
		<option value="14">14 - Kevin Durant</option>
		<option value="15">15 - Andre Iguodala</option>
		<option value="16">16 - Draymond Green</option>
		<option value="17">17 - Klay Thompson</option>
		<option value="18">18 - Stephen Curry</option>
		<option value="19">19 - Kevon Looney</option>
		<option value="20">20 - Shaun Livingston</option>
		<option value="21">21 - Al-Fouriq Aminu</option>
		<option value="22">22 - Maurice Harkless</option>
		<option value="23">23 - Jusuf Nurkic</option>
		<option value="24">24 - Damian Lillard</option>
		<option value="25">25 - CJ McCollum</option>
		<option value="26">26 - Jake Layman</option>
		<option value="27">27 - Rodney Hood</option>
		<option value="28">28 - Zach Collins</option>
	</select>
	<p>Team Name: <select name = "tname" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value="1">1 - Rockets</option>
		<option value="2">2 - Warriors</option>
		<option value="3">3 - Trail Blazers</option>
		<option value="4">4 - Jazz</option>
	</select>
	<p>Arena ID: <select name = "gameid" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value = "1">1 - Vivint Smart Home Arena</option>
		<option value = "2">2 - Oracle Arena</option>
		<option value = "3">3 - Moda Center</option>
	</select>
	<p>Position of team member with highest score: <select name = "pos" class="required">
		<option value = "" disabled="disabled">-select-</option>
		<option value="F">F</option>
		<option value="C">C</option>
		<option value="G">G</option>
		<option value="">No Position</option>
	</select>
	<p>How many points were won? <input name = "points" type = text required>
	<p><button type="submit" name="addsubmit" class="button"> Submit </button>
</form>

<form name = "delscore" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Delete a Score</h3>
	ID: <input name="id" type=text required>
	<p><button type="submit" name="delsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

<form name = "updatescore" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<h3>Update a score</h3>
	ID: <input name="id" type="text" value="<?php echo $getid; ?>" />
	<p><button type="submit" name="getinfo" class="button">Get score info</button>
	<p>ID of player with highest score: <select name="playerid">
		<option>-select-</option>
		<option value="1" <?php if ($getplayerid === '1') echo ' selected="selected"'?>>1 - Eric Gordon</option>
		<option value="2" <?php if ($getplayerid === '2') echo ' selected="selected"'?>>2 - P.J. Tucker</option>
		<option value="3" <?php if ($getplayerid === '3') echo ' selected="selected"'?>>3 - Clint Capela</option>
		<option value="4" <?php if ($getplayerid === '4') echo ' selected="selected"'?>>4 - James Harden</option>
		<option value="5" <?php if ($getplayerid === '5') echo ' selected="selected"'?>>5 - Chris Paul</option>
		<option value="6" <?php if ($getplayerid === '6') echo ' selected="selected"'?>>6 - Daniel House</option>
		<option value="7" <?php if ($getplayerid === '7') echo ' selected="selected"'?>>7 - Austin Rivers</option>
		<option value="8" <?php if ($getplayerid === '8') echo ' selected="selected"'?>>8 - Jae Crowder</option>
		<option value="9" <?php if ($getplayerid === '9') echo ' selected="selected"'?>>9 - Joe Ingles</option>
		<option value="10" <?php if ($getplayerid === '10') echo ' selected="selected"'?>>10 - Rudy Gobert</option>
		<option value="11" <?php if ($getplayerid === '11') echo ' selected="selected"'?>>11 - Donovan Mitchel</option>
		<option value="12" <?php if ($getplayerid === '12') echo ' selected="selected"'?>>12 - Ricky Rubio</option>
		<option value="13" <?php if ($getplayerid === '13') echo ' selected="selected"'?>>13 - Royce O'Neale</option>
		<option value="14" <?php if ($getplayerid === '14') echo ' selected="selected"'?>>14 - Kevin Durant</option>
		<option value="15" <?php if ($getplayerid === '15') echo ' selected="selected"'?>>15 - Andre Iguodala</option>
		<option value="16" <?php if ($getplayerid === '16') echo ' selected="selected"'?>>16 - Draymond Green</option>
		<option value="17" <?php if ($getplayerid === '17') echo ' selected="selected"'?>>17 - Klay Thompson</option>
		<option value="18" <?php if ($getplayerid === '18') echo ' selected="selected"'?>>18 - Stephen Curry</option>
		<option value="19" <?php if ($getplayerid === '19') echo ' selected="selected"'?>>19 - Kevon Looney</option>
		<option value="20" <?php if ($getplayerid === '20') echo ' selected="selected"'?>>20 - Shaun Livingston</option>
		<option value="21" <?php if ($getplayerid === '21') echo ' selected="selected"'?>>21 - Al-Fouriq Aminu</option>
		<option value="22" <?php if ($getplayerid === '22') echo ' selected="selected"'?>>22 - Maurice Harkless</option>
		<option value="23" <?php if ($getplayerid === '23') echo ' selected="selected"'?>>23 - Jusuf Nurkic</option>
		<option value="24" <?php if ($getplayerid === '24') echo ' selected="selected"'?>>24 - Damian Lillard</option>
		<option value="25" <?php if ($getplayerid === '25') echo ' selected="selected"'?>>25 - CJ McCollum</option>
		<option value="26" <?php if ($getplayerid === '26') echo ' selected="selected"'?>>26 - Jake Layman</option>
		<option value="27" <?php if ($getplayerid === '27') echo ' selected="selected"'?>>27 - Rodney Hood</option>
		<option value="28" <?php if ($getplayerid === '28') echo ' selected="selected"'?>>28 - Zach Collins</option>
	</select>
	<p>Team Name: <select name = "tname">
		<option>-select-</option>
		<option value="1" <?php if ($getteamid === '1') echo ' selected="selected"'?>>1 - Rockets</option>
		<option value="2" <?php if ($getteamid === '2') echo ' selected="selected"'?>>2 - Warriors</option>
		<option value="3" <?php if ($getteamid === '3') echo ' selected="selected"'?>>3 - Trail Blazers</option>
		<option value="4" <?php if ($getteamid === '4') echo ' selected="selected"'?>>4 - Jazz</option>
	</select>
	<p>Arena ID: <select name = "gameid">
		<option>-select-</option>
		<option value = "1" <?php if ($getgameid === '1') echo ' selected="selected"'?>>1 - Vivint Smart Home Arena</option>
		<option value = "2" <?php if ($getgameid === '2') echo ' selected="selected"'?>>2 - Oracle Arena</option>
		<option value = "3" <?php if ($getgameid === '3') echo ' selected="selected"'?>>3 - Moda Center</option>
	</select>
	<p>Position of team member with highest score: <select name = "pos">
		<option>-select-</option>
		<option value="F" <?php if ($getpos === 'F') echo ' selected="selected"'?>>F</option>
		<option value="C" <?php if ($getpos === 'C') echo ' selected="selected"'?>>C</option>
		<option value="G" <?php if ($getpos === 'G') echo ' selected="selected"'?>>G</option>
		<option value="">No Position</option>
	</select>
	<p>How many points were won? <input name = "points" type = text value="<?php echo $getpoints; ?>" />
	<p><button type="submit" name="updsubmit" class="button" <?php echo $value='1'; ?>> Submit </button>
</form>

</BODY>
</HTML>
