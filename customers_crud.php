<?php
include("auth.php"); 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  if($_SESSION['position1']=='Admin'){
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_customers_a169167_pt2final(fld_customer_id, fld_customer_name,
      fld_customer_email, fld_customer_phone, fld_customer_address) VALUES(:cid, :name, :email,
      :phone, :address)");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone =  $_POST['phone'];
    $address = $_POST['address'];
       
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
    echo "window.location.href = 'customers.php';";
    echo "</script>";
}
}
 
//Update
if (isset($_POST['update'])) {
  if($_SESSION['position1']=='Admin'){
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_customers_a169167_pt2final SET
      fld_customer_id = :cid,
      fld_customer_name = :name, fld_customer_email = :email,
      fld_customer_phone = :phone, fld_customer_address = :address
      WHERE fld_customer_id = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone =  $_POST['phone'];
    $address = $_POST['address'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'customers.php';";
    echo "</script>";
}
}
 
//Delete
if (isset($_GET['delete'])) {
  if($_SESSION['position1']=='Admin'){
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a169167_pt2final WHERE fld_customer_id = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'customers.php';";
    echo "</script>";
}
}
 
//Edit
if (isset($_GET['edit'])) {
  if($_SESSION['position1']=='Admin'){
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a169167_pt2final WHERE fld_customer_id = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['edit'];
     
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
    echo "window.location.href = 'customers.php';";
    echo "</script>";
}
}
 
  $conn = null;
 
?>