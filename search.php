<?php
include("auth.php");
include_once 'database.php';

if(isset($_POST['search']))
{

    $valueToSearch = $_POST['valueToSearch'];
    /* Use tab and newline as tokenizing characters as well  */
      $tok = strtok($valueToSearch, " \n\t");
      $a=array();
      while ($tok !== false) {
        array_push($a,"$tok");
        $tok = strtok(" \n\t");
      }
      if (count($a)==1){
        $query = "SELECT * FROM `tbl_products_a169167_pt2final` WHERE CONCAT(`fld_product_price`, `fld_product_brand`,`fld_product_type`) REGEXP '$a[0]'";
        $search_result = filterTable($query);
      }
      else if (count($a)==2){
        $query = "SELECT * FROM `tbl_products_a169167_pt2final` WHERE CONCAT(`fld_product_price`, `fld_product_brand`,`fld_product_type`) REGEXP '$a[0]|$a[1]'";
        $search_result = filterTable($query);
      }
      else if (count($a)==3){
        $query = "SELECT * FROM `tbl_products_a169167_pt2final` WHERE CONCAT(`fld_product_price`, `fld_product_brand`,`fld_product_type`) REGEXP '$a[0]|$a[1]|$a[2]'";
        $search_result = filterTable($query);
      }
     
}
else {
    $query = "SELECT * FROM `tbl_products_a169167_pt2final`";
  
    $search_result = filterTable($query);
   //$total_records = mysqli_num_rows($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("lrgs.ftsm.ukm.my", "a169167", "giantredhamster", "a169167");
    $filter_Result = mysqli_query($connect, $query);

    return $filter_Result;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Search Product</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00ab';
  position: absolute;
  opacity: 0;
  top: 0;
  left: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-left: 25px;
}

.button:hover span:after {
  opacity: 1;
  left: 0;
}
  .topnav input[type=text] {
    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: inset;
  }

  .topnav .search-container button {
    float: right;
    padding: 6px 10px;
    margin-top: 8px;
    margin-right: 16px;
    background: #ddd;
    font-size: 17px;
    border: inset;
    cursor: pointer;
  }

  .topnav .search-container button:hover {
    background: #ccc;
  }

  @media screen and (max-width: 600px) {
    .topnav .search-container {
      float: none;
    }
    .topnav a, .topnav input[type=text], .topnav .search-container button {
      float: none;
      display: block;
      text-align: left;
      width: 100%;
      margin: 0;
      padding: 14px;
    }
    .topnav input[type=text] {
      border: 1px solid #ccc;  
    }
  }

    .column {
    float: left;
    width: 33.33%;
    padding: 10px;
    }

    /* Clear floats after image containers */
    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .picture-grid {
      display: grid;
      width: 100%;
 object-fit: cover;
      
      grid-gap: 1em;
    }
    
    .thumbnail:hover {
        background: #f7f7f7;
         object-fit: cover;
    }

    .thumbnail {           
        object-fit: cover;
        width : 98%;
        height: 275px;
        overflow: auto;
    }
    
  </style>
 <style>
  body{
    margin:0;
    background-color: #FFFFFF;
     background-image: url("bg1.jpg") ;
        background-size: 100%;

  }
  </style>
</head>
<body>
  <?php include_once 'nav_bar.php'; ?>

<!--<form action="search.php" method="post">-->
  <div class="container-fluid">     
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="topnav">
          <form action="products.php">
              <button class="button" style="vertical-align:middle; display: inline-block; border-radius: 4px; background-color: #FFFFFF; border: none; color: #000000; text-align: center; font-size: 16px; padding: 10px 24px; width: 270px; transition: all 0.5s; cursor: pointer;"><span>More Details</span></button>
          </form>
          <div class="page-header">            
            <h2 style="color:white">Products</h2>          
            <div class="search-container">
              <form action="search.php" method="post" style="position:absolute; left:65%; bottom: 98.8%; width:30%;">
                <input type="text" class="form-control" placeholder="Price Brand Type" id="search" name="valueToSearch" required>
                <button type="submit" id="search_btn" name="search" style="position:absolute; left:103%; bottom:-13%;"><i class="fa fa-search"></i></button>
              </form>
            </div>
          </div>
        </div>

        <div class="picture-grid">             
          <div class="row">
            <?php 


      while($row = mysqli_fetch_array($search_result))

            :?>

            <div class="col-xs-12 col-md-3"> 
                <div class="thumbnail">              
                    <img src="products/<?php echo $row['fld_product_image'] ?>" class="img-responsive">   
                  <div class="caption">
                    <h4><?php echo $row['fld_product_id']; ?></h4>
                    <p>Name: <?php echo $row['fld_product_name']; ?></p>
                    <p>Price(RM): <?php echo $row['fld_product_price']; ?></p>
                    <p>Brand: <?php echo $row['fld_product_brand']; ?></p>
                    <p>Type: <?php echo $row['fld_product_type']; ?></p>
                    <p>Stock: <?php echo $row['fld_product_stock']; ?></p>
                    <p>Warranty Length: <?php echo $row['fld_product_warrantylength']; ?></p>
                                           
                  </div>           
                  
                </div>
            </div>
            <?php endwhile;?>
          </div>             
        </div>            
      </div>
    </div>
    
       <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
         <?php 
          ?> 
        </ul>
      </nav>
    </div>
<!--</form>-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>