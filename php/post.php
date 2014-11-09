<?php
 /* create a connection */
$mysqli = new mysqli("localhost", "root", "root", "MSCFD");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* let's say we're grabbing this from an HTTP GET or HTTP POST variable called jsonGiven... */
/* $jsonString = $_REQUEST['jsonGiven']; */
/* but for the sake of an example let's just set the string here */
$jsonString = '{"name":"jack","school":"colorado state","city":"NJ","id":null}';

/* use json_decode to create an array from json */
$jsonArray = json_decode($jsonString, true);

/* create a prepared statement */
if ($stmt = $mysqli->prepare('INSERT INTO leaderboard (name, school, city, id) VALUES (?,?,?,?)')) {

    /* bind parameters for markers */
    $stmt->bind_param("ssss", $jsonArray['name'], $jsonArray['school'], $jsonArray['city'], $jsonArray['id']);

    /* execute query */
    $stmt->execute();

    /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();
?>