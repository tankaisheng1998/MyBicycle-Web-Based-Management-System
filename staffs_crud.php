<?php
 
include_once 'database.php';
include("auth.php");
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  if($_SESSION['position1']=='Admin'){
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a169167_pt2final(fld_staff_id, fld_staff_name, fld_staff_email, fld_staff_phone, fld_staff_position, fld_staff_password) VALUES(:sid, :name, :email, :phone, :position, :staffpass)");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':staffpass', $staffpass, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $staffpass = $_POST['staffpass'];
         
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'staffs.php';";
    echo "</script>";
}
}
 
//Update
if (isset($_POST['update'])) {
  if($_SESSION['position1']=='Admin'){
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a169167_pt2final SET
      fld_staff_id = :sid, fld_staff_name = :name,
      fld_staff_email = :email, fld_staff_phone = :phone, fld_staff_position = :position, fld_staff_password = :staffpass
      WHERE fld_staff_id = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':staffpass', $staffpass, PDO::PARAM_STR); 
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];  
    $staffpass = $_POST['staffpass']; 
    $oldsid = $_POST['oldsid'];
         
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'staffs.php';";
    echo "</script>";
}
}
 
//Delete
if (isset($_GET['delete'])) {
  if($_SESSION['position1']=='Admin'){
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a169167_pt2final where fld_staff_id = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'staffs.php';";
    echo "</script>";
}
}
 
//Edit
if (isset($_GET['edit'])) {
  if($_SESSION['position1']=='Admin'){
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a169167_pt2final where fld_staff_id = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'staffs.php';";
    echo "</script>";
}
}
 
  $conn = null;
 
?>