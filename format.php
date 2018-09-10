<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"u16co010")or
mysqli_query($con,"CREATE DATABASE u16co010");


$title=$_POST['title'];
$titlestyle=$_POST['titlestyle'];
$titlesize=$_POST['titlesize'];
$titlecolor=$_POST['titlecolor'];
$titleback=$_POST['titleback'];
$fontstyle=$_POST['fontstyle'];
$fontcolor=$_POST['fontcolor'];
$fontsize=$_POST['fontsize'];
$background=$_POST['background'];
$imagename=$_FILES['bgimage']['name'];
if($background=="fillimage"){
	$imagetmp=addslashes(file_get_contents($_FILES['bgimage']['tmp_name']));
	$qry="INSERT INTO `image` VALUES('$imagename','$imagetmp')";
	if(!mysqli_query($con,$qry)){
		mysqli_query($con,"CREATE TABLE `image`(name VARCHAR(300), content LONGBLOB)");
		mysqli_query($con,$qry);
	}
	$qry="SELECT * FROM `image`";
	$var=mysqli_query($con,$qry);
	if($row=mysqli_fetch_array($var)){
		$imagename=$row["name"];
		$image_content=$row["content"];
	}
	$image_content="<img name='bgimage' src='data:image/png;base64,".base64_encode($image_content)."' width='100%' height='100%'/>";
	$fillcolor='';
}
else{
	$image_content='';
	$fillcolor=$_POST['solidcolor'];
	$fillcolor="background-color:$fillcolor;";
}



$xyz=mysqli_fetch_row(mysqli_query($con,"SELECT * FROM `ass2`"));
#echo $xyz[0]-1;

echo "<html>
<head>
<script>
function xyz(){
	alert('Response submitted.');
	window.location.href='test.php';
}
</script>
<style>
	.container{
		
	}	
	
	.form2{
		position:absolute;
		top:15%;
		left:5%;
		font-family:$fontstyle;
		color:$fontcolor;
		font-size:$fontsize;
	}
	
	.title{
		position:absolute;
		top:3%;
		left:50%;
		transform:translate(-50%);
		font-size:$titlesize;
		text-align:center;
		font-family:$titlestyle;
		color:$titlecolor;
		background-color:$titleback;
	}
	body{
		margin:0;
		$fillcolor
	}
</style>
</head>
<body id='body'>
<div class='container'>
	$image_content
	<div class='title'>$title</div>
	<pre>
	<form class='form2'>";
while($xyz[0]>0){
	$fname='fname'.strval($xyz[0]);
	$fname=$_POST[$fname];
	$ftype='ftype'.strval($xyz[0]);
	$ftype=$_POST[$ftype];
	if($ftype=='radio'){
		$radio='radio'.strval($xyz[0]);
		$fields='fields'.strval($xyz[0]);
		$fields=$_POST[$fields];
		echo "$fname			";
		while($fields>0){
			$radiotext='radiotext'.strval($fields);
			$radiotext=$_POST[$radiotext];
			echo "$radiotext <input name='$radio' type='$ftype'/>		";
			$fields-=1;
		}
		echo "<br><br>";
	}
	else if($ftype=='checkbox'){
		$check='check'.strval($xyz[0]);
		$fields='fields'.strval($xyz[0]);
		$fields=$_POST[$fields];
		echo "$fname			";
		while($fields>0){
			$checktext='checktext'.strval($fields);
			$checktext=$_POST[$checktext];
			echo "$checktext <input name='$check' type='$ftype'/>		";
			$fields-=1;
		}
		echo "<br><br>";
	}
	else if($ftype=='dropdown'){
		$drop='drop'.strval($xyz[0]);
		$fields='fields'.strval($xyz[0]);
		$fields=$_POST[$fields];
		echo "$fname			<select>";
		
		while($fields>0){
			$droptext='droptext'.strval($fields);
			$droptext=$_POST[$droptext];
			echo "<option value='$droptext'>$droptext</option>";
			$fields-=1;
		}
		echo "</select><br><br>";
	}
	else{
		echo "$fname			<input type='$ftype'/>

";}
	$xyz[0]-=1;
}
echo "<button type='button' onclick='xyz()'>submit</button></form></pre></div></body></html>";
mysqli_query($con,"DELETE FROM `image`");
mysqli_query($con,"DELETE FROM `ass2`");
?>