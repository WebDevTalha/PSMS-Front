<?php
$host = "localhost";
$db_name = "psms";
$user = "root";
$password = "";

date_default_timezone_set("Asia/Dhaka");
try {
  $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



// Count any Column Value from Profile Table
function pfRowCount($col, $val) {
  global $pdo;
  $stm=$pdo->prepare("SELECT $col FROM students WHERE $col=?");
  $stm->execute(array($val));
  $count = $stm->rowCount();
  return $count;
}

// GET Student Data
function student($col,$id){
  global $pdo;
  $stm = $pdo->prepare("SELECT $col FROM students WHERE id=?");
  $stm->execute(array($id));
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  return $result[0][$col];
}

// GET Student Current Class
function studentClass($col,$id){
  global $pdo;
  $stm = $pdo->prepare("SELECT $col FROM students WHERE id=?");
  $stm->execute(array($id));
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  return $result[0][$col];
}

// GET Student id
function studentIdFormMobile($col,$mobile){
  global $pdo;
  $stm = $pdo->prepare("SELECT $col FROM students WHERE mobile=?");
  $stm->execute(array($mobile));
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  return $result[0][$col];
}

// GET Student Result Count
function resultCount($id){
  global $pdo;
  $stm=$pdo->prepare("SELECT id FROM students_results WHERE st_id=?");
  $stm->execute(array($id));
  $count = $stm->rowCount();
  return $count;
}

// Get Subject Name
function getSubjectCode($id){
  global $pdo;
  $stm=$pdo->prepare("SELECT code FROM subjects WHERE id=?");
  $stm->execute(array($id));
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  return $result[0]['code'];
} 

// Get Subject Name
function getSubjectName($id){
  global $pdo;
  $stm=$pdo->prepare("SELECT name,code FROM subjects WHERE id=?");
  $stm->execute(array($id));
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  return $result[0]['name']."-".$result[0]['code'];
} 