<?php
 
include_once 'database.php';
include("auth.php");
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  if($_SESSION['position1']=='Admin'){
  $tempname = $_FILES["filename"]["tmp_name"]; //
    //tes
    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]); //
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($tempname);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $message = "File is not an image.";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["filename"]["size"] > 10000000) { //
      $message = "Sorry, your file is too large. Please upload file smaller than 10MB";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType !== "gif" ) {
      $message = "Sorry, only GIF files are allowed.";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      $message = "Sorry, your file was not uploaded.";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
    
    } 
    else {
      if (move_uploaded_file($tempname, $target_file)) {
 
      try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a169167_pt2final(fld_product_id,
        fld_product_name, fld_product_price, fld_product_brand, fld_product_type, fld_product_stock, fld_product_warrantylength, fld_product_image) VALUES(:pid, :name, :price, :brand, :type, :stock, :warrantylength, :pimage)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
      $stmt->bindParam(':warrantylength', $warrantylength, PDO::PARAM_STR);
      $stmt->bindParam(':pimage', $pimage, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type =  $_POST['type'];
    $stock = $_POST['stock'];
    $warrantylength = $_POST['warrantylength'];
    $pimage = $_FILES["filename"]["name"];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else {
        $message = "Sorry, there was an error uploading your file.";
        echo "<script type='text/javascript'>alert('$message');";
        echo "window.location.href = 'products.php';";
        echo "</script>";
      }
    }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'products.php';";
    echo "</script>";
}
}
 
//Update
if (isset($_POST['update'])) {
  if($_SESSION['position1']=='Admin'){
  $tempname = $_FILES["filename"]["tmp_name"]; //
    //tes
    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]); //
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($tempname);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $message = "File is not an image.";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["filename"]["size"] > 10000000) { //
      $message = "Sorry, your file is too large. Please upload file smaller than 10MB";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
      $uploadOk = 0;
    }
 
    // Allow certain file formats
    if($imageFileType !== "gif" ) {
      $message = "Sorry, only GIF file is allowed.";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      $message = "Sorry, your file was not uploaded.";
      echo "<script type='text/javascript'>alert('$message');";
      echo "window.location.href = 'products.php';";
      echo "</script>";
    } 
    else {
      if (move_uploaded_file($tempname, $target_file)) {
 
      try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a169167_pt2final SET fld_product_id = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand, fld_product_type = :type, fld_product_stock = :stock, fld_product_warrantylength = :warrantylength, fld_product_image = :pimage
        WHERE fld_product_id = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
      $stmt->bindParam(':warrantylength', $warrantylength, PDO::PARAM_STR);
      $stmt->bindParam(':pimage', $pimage, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type =  $_POST['type'];
    $stock = $_POST['stock'];
    $warrantylength = $_POST['warrantylength'];
    $pimage = $_FILES["filename"]["name"];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else {
        $message = "Sorry, there was an error uploading your file.";
        echo "<script type='text/javascript'>alert('$message');";
        echo "window.location.href = 'products.php';";
        echo "</script>";
      }
    }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'products.php';";
    echo "</script>";
}
}
 
//Delete
if (isset($_GET['delete'])) {
  if($_SESSION['position1']=='Admin'){
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a169167_pt2final WHERE fld_product_id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  }
  else{
  $message = "Sorry, you have no rights to modify!!";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'products.php';";
    echo "</script>";
}
}
 
//Edit
if (isset($_GET['edit'])) {
  if($_SESSION['position1']=='Admin'){
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a169167_pt2final WHERE fld_product_id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
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
    echo "window.location.href = 'products.php';";
    echo "</script>";
}
}
 
  $conn = null;
?>