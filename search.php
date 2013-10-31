<html>
<head>
<Title>Registration Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1><strong>Search Database</strong></h1>
<h3>Search Details</h3>
<p>Fill in the name you need to search and click <strong>Search</strong></p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Search  <input type="text" name="name" id="name"/></br>
      <input type="submit" name="submit" value="Search" />
</form>

<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b0b847319f6ae0";
    $pwd = "1bb73cf2";
    $db = "newmyAN8AEtBPsqg";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_POST)) {
    try {
        $name = $_POST['name'];
        $company_name=$_POST['company_name'];
        $email = $_POST['email'];
        $date = date("Y-m-d");
 
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    }
    // Retrieve data
    $sql_select = "SELECT * FROM registration_tbl WHERE name LIKE '%$name%'";
    $stmt = $conn->prepare($sql_select);
    $stmt->execute();
    $registrants = $stmt->fetchAll(); 
    if(count($registrants)>0 ) {
        echo "<h2>Search Results:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Company Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['company_name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Nothing searched.</h3>";
    }
?>
</body>
</html>
