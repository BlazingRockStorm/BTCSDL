<?php
/*
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'codexworld';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM skills WHERE skill LIKE '%".$searchTerm."%' ORDER BY skill ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['skill'];
}
*/
//return json data
//echo json_encode($data);
require_once('search_db.php');
$searchTerm = $_GET['term'];
$user = 'postgres'; 
$pass = 'password';
$db = new PDO('pgsql:dbname=guitar_shop host=localhost port=5432', $user, $pass);

//$results = search_from_skills($searchTerm);
$results = get_product_from_key($searchTerm);
$lists = array();
foreach($results as $result){
	$lists[] = $result['productname'];
}
if($searchTerm == 'key'){
$list = array(
        "Autocomplete",
        "AJAX is fun!",
        "Alphabeth",
        "Alphanumeric",
        "Bravo",
        "Charlie",
        "Connection",
        "Delta",
        "Echo",
        "Internetprotocol",
        "IP-Address",
        "Geo-IP",
        "GPU",
        "CPU",
        "Foxtrott",
        "Tango",
        "Torpedo",
        "TCP-Protocol",
        "Shark",
        "Shakespeare",
        "Speed",
        "South",
        "So",
        "X-Ray",
        "Yankee",
        "Zulu",
        "Monkey",
        "Mike",
        "Microphone",
        "Metapher",
        "Metatag");
}
 echo json_encode($lists);


/*
$user = 'postgres'; 
$pass = 'admiral1996';
$db = new PDO('pgsql:dbname=codexworld host=localhost port=5433', $user, $pass);

$searchTerm = $_GET['term'];
echo $searchTerm;
//$searchTerm = strtolower($searchTerm);
//echo 1;
$query = $db->query("SELECT * FROM skills WHERE skill LIKE '%$searchTerm%' ORDER BY skill ASC");
$statement = $db->prepare($query);
$statement->execute();
$results = $statement->fetchAll();
//$statement->closeCursor();
$data = array();
foreach($results as $result){
	$data[] = $result['skill'];
}

echo json_encode($data);*/
?>