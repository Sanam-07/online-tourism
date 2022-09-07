
<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TTMS  | Package List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>
<?php include('includes/header.php');?>

<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TTMS- Package List</h1>
	</div>
</div>



<?php
if(isset($_GET['q'])){
    $parma = $_GET['q'];
    $results =  searchThis('tbltourpackages', $parma);

}
foreach($results as $result)
{
    
    ?>
			<div class="rom-btm">
				<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
					<img src="admin/pacakgeimages/<?php echo $result['PackageImage'];?>" class="img-responsive" alt="">
				</div>
				<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
					<h4>Package Name: <?php echo $result['PackageName'];?></h4>
					<h6>Package Type : <?php echo $result['PackageType'];?></h6>
					<p><b>Package Location :</b> <?php echo $result['PackageLocation']?></p>
					<p><b>Features</b> <?php echo $result['PackageFetures']?></p>
				</div>
				<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
					<h5>USD <?php echo $result['PackagePrice']?></h5>
					<a href="package-details.php?pkgid=<?php echo $result['PackageId']?>" class="view">Details</a>
				</div>
				<div class="clearfix"></div>
			</div>

<?php } ?>

<table>
    <thead>
        <tr>
            <td>#</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </thead>
</table>






<?php

function searchThis($table, $thingy){
    $query = "SELECT * from $table where PackageName like '%$thingy%' OR PackageLocation like '%$thingy%'";
    // echo $query;
    $conn = new mysqli('localhost', 'root', '', 'tms');
    $result =  $conn->query($query);
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    return $data;
}
?>