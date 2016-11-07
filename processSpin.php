<?php

function validateData($playerId,$coinsBet,$coinsWon,$hash,$link){
   // Validates the data by hashing it with the salt from the database
   
   // Local Variables
   $salt;
   $vHash;
   $saltQuery;
   $saltResults;
   $row;

   // Function Code
   $saltQuery = "SELECT Salt FROM Player WHERE PlayerID = {$playerId}";
   $saltResults = mysqli_query($link,$saltQuery);
   if(mysqli_num_rows($saltResults) > 0){
      $row = mysqli_fetch_assoc($saltResults);
      $salt = $row["Salt"];
   } else {
      echo "Unable to retrieve salt from database\n";
      exit;
   } 

   $vHash = hash("md5",$salt.$coinsWon.$coinsBet.$playerId);   

   if(!strcmp($hash,$vHash)){
      echo "Data successfully validated.\n";
      return True;
   } else {
      echo "Unable to validate data.\n";
      return False;
   }
}

function updatePlayer($playerId,$coinsBet,$coinsWon,$link){
   // Updates the player's record in the database

   // Local Variables
   $updateQuery;
   
   // Function Code
   $updateQuery = "UPDATE `Player` 
                   SET `LifetimeSpins` = LifetimeSpins + 1,
                       `Credits` = Credits - '{$coinsBet}' + '{$coinsWon}'
                   WHERE `PlayerID` = '{$playerId}'";
   if(mysqli_query($link,$updateQuery)){
      echo "Record successfully updated.\n";
      return True;
   } else {
      echo "Error updating record: ".mysqli_error($link).".\n";
      return False;
   }
}

function outputJSON($playerId,$link){
   // Outputs JSON
   
   // Local Variables
   $jsonQuery;
   $jsonResult;
   $jsonArray = array();
   $message = "Error selecting json: ";

   // Function Code
   $jsonQuery = "SELECT `PlayerId`,`Name`,`Credits`,
                `LifetimeSpins`,
                (Credits/LifetimeSpins) as `LifetimeAverageReturn`
                FROM `Player` 
                WHERE `PlayerId` = {$playerId}";
   $jsonResult = mysqli_query($link,$jsonQuery) or
                 die(json_encode($message.mysqli_error($link))."\n");
   $jsonArray[] = mysqli_fetch_assoc($jsonResult);
   echo "\nJSON Output\n".json_encode($jsonArray)."\n\n";
}

// Main Program

// Input data variables (for testing)
// Hash is salt+coinsWon+coinsBet+playerId using md5
$hash = "c87065daa6716c6e422d04bebe2d7989";
$coinsWon = "5000";
$coinsBet = "900";
$playerId = "8711";

// Connection Variables
$database = "Player";
$servername = "localhost";
$username = "root";
$password = "password";

// Connect to database
$link = mysqli_connect($servername,
                       $username,
                       $password,
                       $database);

if(!$link){
   die("Unable to connect to database $database.\n".mysqli_connect_error());
} else {
   printf("Successfully connected to database $database.\n");
}

// Display data
echo "Player ID: $playerId\nCoins Bet: $coinsBet\nCoins Won: $coinsWon\n";
echo "Hash using md5: $hash\n";

// Validate data
if (validateData($playerId,$coinsBet,$coinsWon,$hash,$link)){
   // Send data to database
   if(updatePlayer($playerId,$coinsBet,$coinsWon,$link)){
      // Output JSON
      outputJSON($playerId,$link);
   }
}

// Close connection
echo "Closing connection to database $database.\n";
mysqli_close($link);

?>
