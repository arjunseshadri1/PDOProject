<?php
$host = "sql2.njit.edu";
$username = "as3395";
$password = "Ilw3YILr3";
$db = "as3395";

try {
    $connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
      echo "Connected successfully"."<br>";
      $sql="select * from accounts where id<6";
      $query = $connection->query($sql); 
      $query->setFetchMode(PDO::FETCH_ASSOC);
      echo $query->rowCount();
      
      echo '<table border="1">';
        while($r = $query->fetch())
        {
            echo "<tr>";
                echo "<td>" . htmlspecialchars($r['id']) ."</td>";
                echo "<td>" . htmlspecialchars($r['email']) ."</td>";
                echo "<td>" . htmlspecialchars($r['fname']) ."</td>";
                echo "<td>" . htmlspecialchars($r['lname']) ."</td>";
                echo "<td>" . htmlspecialchars($r['phone']) ."</td>";
                echo "<td>" . htmlspecialchars($r['birthday']) ."</td>";
                echo "<td>" . htmlspecialchars($r['gender']) ."</td>";
                echo "<td>" . htmlspecialchars($r['password']) ."</td>";
            echo "</tr>";      
        }
      
      echo "</table>";
      
    }
catch(PDOException $e)
    {
      echo $e->getMessage()."<br>";
    }
?>