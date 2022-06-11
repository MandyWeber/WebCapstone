<!--

Author: Amanda Weber

Creation Date: 6/5/2022

Modification Date: 6/10/2022

FileName: search.php

Purpose: This is the page where we connect to the music_library database. The
database is filled with over 10,000 songs for a user to search from. The user
will search on the library.html page via a form and the results will populate on
this search.php page. After the user searches on the library.html page, they can
search again on this search.php page again if they would like.

Input: User will type in what they wish to search for in the search bar. They
can also navigate to other pages and social media sites from here.

Output: A list of song titles and the corresponding artists will populate on
this page for the user to view.

-->

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title>Fine Line Entertainment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!-- Navigation bar -->
  <ul>
    <img class="image1" src="logo.jpg" alt="FLE Logo"/>
    <li><a href="library.html">Music Library</a></li>
    <li><a href="about.html">About Us</a></li>
    <li><a href="home.html">Home</a></li>
  </ul>

<!-- Search form for the user to search the songs they're interested in -->
  <form name="form1" method="post" action="search.php">
      <input type="text" placeholder="Search" name="search" aria-label="Search" required>
      <input type="submit" value="Search" name="submit"></input>
    </form>
<p class="big">

<!-- PHP code starts below -->
<?php
$ftp_username = "amandaweber@sotd.us";
$ftp_userpass = "Amwe7785!";
$ftp_server = "ftp.sotd.us";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);


$search = $_POST['search'];

// Defines the user information to log into the database
$servername = "localhost";
$username = "root";
$password = "";
$db = "music_library";

// Connection that allows the page to connect to the databse.
$conn = new mysqli($servername, $username, $password, $db);

// Purpose: Function for if there is an error connection to the database
if ($conn->connect_error){
	die("Connection failed: ". $conn->connect_error);
}

// This is where the search connects to the databases table
$sql = "select * from finalized_karaoke_book where song_title like '%$search%'";

$result = $conn->query($sql);


// Purpose: This is the function that verifies the connection to the database
// happens. Next it fetches the results and displays the song title and artist
// associated with the song search.
// Input: This takes the input from the user in the search form from either the
// library.html page or the search.php page
// Output: This displays the song title and artist associated with the searched
// song or "No results found." if there were no matches.
if ($result->num_rows > 0){

while($row = $result->fetch_assoc() ){
	echo "<b>Song: </b>" . $row["song_title"] . "&nbsp &nbsp &nbsp &nbsp ";
  echo "<b>Artist: </b>" . $row["artist"] . "<br>";

}
// This tells the user there are no results found if they typed something that
// isn't in the database.
} else {
	echo "No Results Found.";
}

$conn->close();

?>
</p>

<br>
<br>
<br>
<br>

<footer>Fine Line Entertainment  &nbsp | &nbsp   support@fineline.com  &nbsp | &nbsp  320-321-6129 &nbsp | &nbsp  <a href="https://www.facebook.com/" class="fa fa-facebook"></a> &nbsp | &nbsp
  <a href="https://www.twitter.com/" class="fa fa-twitter"></a> &nbsp | &nbsp <a href="https://www.instagram.com/" class="fa fa-instagram"></a></footer>
</body>
</html>
