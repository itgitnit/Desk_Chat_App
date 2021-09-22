<?php

Class Database
{
private $con;

// Construct
function __construct()
{
    $this->con = $this->connect();
}

// Connect To The DB
private function connect()
{
    $string = "mysql:host=localhost;dbname=mychat_db";
    try
    {
        $connection = new PDO($string,DBUSER,DBPASS);
return $connection;
    }
    catch(PDOException $e)
    {
echo $e->getMessage();
die;
    }
    return false;
}

// Write to the database
public function write($query,$data_array = [])
{
 $con = $this->connect();

//  prepare statements separate the variables from actual query
 $statement = $con->prepare($query);

 $check = $statement->execute($data_array);
 if($check)
 {
     return true;
 }
 return false;
}

public function generate_id($max){

    $rand = "";
  $rand_count = rand(4,$max) ;
  for ($i=0; $i < $rand_count; $i++) { 
      # code...
      $r = rand(0,9);
      $rand .= $r;
  }

  return $rand;
}

}

// $myclass = new Database();