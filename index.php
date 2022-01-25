<!DOCTYPE html>
<html lang="en">
<head>
<style>
  body {
  background: #8c8900;
  color: #fff;
  font-size: 22px;
}
span {
  display: inline-block;
  padding: 6px 6px 4px;
  border-radius: 3px;
  background: #5a9671;
  margin-right: -2px;
}
.center {
  text-align: center;
  width: 50%;
  margin: 20px auto;
}
.message {
  color: #ccc6e3;
  font-family: Verdana;
  font-size: 12px;
}
.img1 {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
  </style>
</head>
<body><center><br><br><br>
<?php function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
echo 'User Real IP - '.getUserIpAddr();
 $ip = getUserIpAddr();
 echo "<br>";
?>
  <?php
		include 'dbconfig.php';
		$qry = "SELECT * FROM `ipdb` WHERE `ip` = '$ip'";
		$result = mysqli_query($con,$qry);
		$num = mysqli_num_rows($result);
		if ($num == 0){
			$qry3 = "INSERT INTO `ipdb`(`ip`) VALUES ('$ip')";
			mysqli_query($con,$qry3);
			//echo "new ip register";	
			$qry1 = "SELECT * FROM `counter` WHERE `id` = 0";
			$result1 = mysqli_query($con,$qry1);
			$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
			$count = $row1['visiters'];
			$count = $count + 1;
			//echo "<br>";
			//echo "number of unique visiters is $count";
			$qry2 = "UPDATE `counter` SET `visiters`='$count' WHERE `id`=0";
			$result2=mysqli_query($con,$qry2);
}else{
			$qry1 = "SELECT * FROM `counter` WHERE `id` = 0";
			$result1 = mysqli_query($con,$qry1);
			$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
			$count = $row1['visiters'];
			//echo "<br>";
			//echo "number of unique visiters is $count";
}
  ?>
  <?php
$numlength = strlen((string)$count); ?>
<br><h3>Unique Visit Counter</h3><?php $count; 
 $stri = (string)$count;?>
This value Shows Unique Visit Count</center>
  <body/>
  </html>