<?php

error_reporting(0);

$allRelatedPackages = array();

function getRecommendedKeywords($userEmail){
    $returnArray = array();
    $conn = mysqli_connect("localhost", "root", "", "tms");
    $sql = "Select keyword from cookies where userEmail like '%$userEmail%' group by keyword ORDER BY Avg(time) desc";
    $results =  $conn->query($sql);
    while($row = $results->fetch_assoc()){
        $returnArray[] = $row['keyword'];
    }
    return $returnArray;
}

function getRecommendedPackages($keywords){
    $temp_keywords = $keywords;


    $conn = mysqli_connect("localhost", "root", "", "tms");
    foreach($keywords as $keyword){
        $queryString = implode(", ", $temp_keywords);
        array_pop($temp_keywords);
        $sql = "Select * from tbltourpackages where PackageFetures like '%$queryString%'";
        $results = $conn->query($sql);
        while($row = $results->fetch_assoc()){
            $allRelatedPackages[] = $row;
        }
    }

    if(sizeof($allRelatedPackages)<4){
        foreach($keywords as $keyword){
            $sql =  "Select * from tbltourpackages where PackageFetures like '%$keyword%'";
            $results = $conn->query($sql);
            while($row = $results->fetch_assoc()){
                $allRelatedPackages[] =  $row;
            }
        }
    }
    return $allRelatedPackages;
}

function showRecommendation($allRelatedPackages){
    $i=0;
    foreach($allRelatedPackages as $result){
        if($i >=4){
            return;
        }
        $i++
    ?>
        <div class="rom-btm" style="border: 1px solid black">
            <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                <img src="admin/pacakgeimages/<?php echo htmlentities($result['PackageImage']);?>" class="img-responsive" alt="">
            </div>
            <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                <h4>Package Name: <?php echo htmlentities($result['PackageName']);?></h4>
                <h6>Package Type : <?php echo htmlentities($result['PackageType']);?></h6>
                <p><b>Package Location :</b> <?php echo htmlentities($result['PackageLocation']);?></p>
                <p><b>Features</b> <?php echo htmlentities($result['PackageFetures']);?></p>
            </div>
            <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                <h5>USD <?php echo htmlentities($result['PackagePrice']);?></h5>
                <a href="package-details.php?pkgid=<?php echo htmlentities($result['PackageId']);?>" class="view">Details</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php
    }
}



$userEmail = $_SESSION['login'];
$keywords = getRecommendedKeywords($userEmail);
$allRelatedPackages = getRecommendedPackages($keywords);
showRecommendation($allRelatedPackages);