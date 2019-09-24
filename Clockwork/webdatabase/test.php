<html>
   <head>
      <title>Connecting MySQLi Server</title>
   </head>
   
   <body>
      <?php
      ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
         $dbhost = '127.0.0.1';
         $dbuser = 'root';
         $dbpass = 'KG7c$14&2cJv';
         $dbname = "clockwork";
         $dbport = "6603";
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
   
         if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
         echo 'Connected successfully';
         mysqli_close($conn);
      ?>
   </body>
</html>