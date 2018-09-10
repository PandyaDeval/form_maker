<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"u16co010")or
mysqli_query($con,"CREATE DATABSE u16co010");
echo "
<html>
<head>
<script>
function xyz(number){
	var radcheck='radcheck'+number;
	var ftype='ftype'+number;
	var dropdown=document.getElementsByName(ftype)[0].value;
	//alert(dropdown);
	var field='fields'+number;
	if(dropdown=='radio'){
		//document.getElementById(field).style.display='initial';
		var x=document.getElementsByName(field)[0].value;
		document.getElementsByName(radcheck)[0].innerHTML ='<p></p>';
		while(x>0){
			var radiotext='radiotext'+x;
			var element='Option Name <input form=\'form2\' type=\'text\' name=\''+radiotext+'\'/><br><br>';
			document.getElementsByName(radcheck)[0].innerHTML += element;
			x-=1;
		}
		//alert(x);
	}
	else if(dropdown=='checkbox'){
		//document.getElementById(field).style.display='initial';
		document.getElementsByName(radcheck)[0].innerHTML ='<p></p>';
		var x=document.getElementsByName(field)[0].value;
		while(x>0){
			var checktext='checktext'+x;
			var element='Option Name <input form=\'form2\' type=\'text\' name=\''+checktext+'\'/><br><br>';
			document.getElementsByName(radcheck)[0].innerHTML += element;
			x-=1;
		}
		//alert(x);
	}
	else if(dropdown=='dropdown'){
		document.getElementsByName(radcheck)[0].innerHTML ='<p></p>';
		var x=document.getElementsByName(field)[0].value;
		while(x>0){
			var droptext='droptext'+x;
			var element='Option Name <input form=\'form2\' type=\'text\' name=\''+droptext+'\'/><br><br>';
			document.getElementsByName(radcheck)[0].innerHTML += element;
			x-=1;
		}
	}
	else{
		document.getElementsByName(radcheck)[0].innerHTML ='<p></p>';
	}
	/*else if(dropdown=='checkbox'){
		<!--document.getElementById(field).style.display='initial';-->
		var x=document.getElementsByName(field)[0].value;
		<!--alert(x);-->
	}*/
}

function addboxes(number){
	var x=document.getElementById('fieldnumber').value;
	x='fieldnumber'+number;
	alert(x);
}
</script>
</head>
<body>
<pre>
<form class='form1' method='POST'>
Number of fields     <input type='number' name='number'/>
<input type='submit'/>
</form>
</pre>";
@$number=$_POST['number'];
if($number>0){
	$qry="INSERT INTO `ass2` VALUES('$number')";
	if(!mysqli_query($con,$qry)){
		mysqli_query($con,"CREATE TABLE `ass2`(number INT)");
		mysqli_query($con,$qry);
	}
	echo "<style>.form1{display:none;}</style>";
	echo "<pre><form action='format.php' method='POST' id='form2' enctype='multipart/form-data'>
	 
</form>";
	while($number){
		
		$fname='fname'.$number;
		$ftype='ftype'.$number;
		$fieldnumber='fieldnumber'.$number;
		$fields='fields'.$number;
		$radcheck='radcheck'.$number;
		echo "Field Name	<input name='$fname' type='text' form='form2'>	Field Type <select name='$ftype' form='form2' onchange='xyz($number)'>
			<option value='text'>text</option>
			<option value='number'>number</option>
			<option value='color'>color</option>
			<option value='radio'>radio</option>
			<option value='checkbox'>checkbox</option>
			<option value='password'>password</option>
			<option value='email'>email</option>
			<option value='dropdown'>dropdown</option>
		</select>		<input form='form2' type='number' name='$fields'/>

<div name='$radcheck'></div>		
<!--<div id='$fields' style='display:none;'><input form='form2' name='$fieldnumber' type='text' id='fieldnumber'/>		<button type='button' onClick='addboxes($number)'>Add</button></div>-->

";
		$number-=1;
	}

	echo "
Form Title					<textarea form='form2' name='title'>Add title here...</textarea>

Title Style 					<input form='form2' type='text' name='titlestyle' value='Helvetica'/>

Title Size					<input type='number' form='form2' name='titlesize'/>

Title Color					<input type='color' name='titlecolor' form='form2' value='#FFFFFF'/>

Title Background Color				<input type='color' name='titleback' form='form2' value='#000000'/>

Regular Font Style				<input type='text' name='fontstyle' value='arial' form='form2'/>

Regular Font Color				<input type='color' name='fontcolor' value='#FFFFFF' form='form2'/>

Regular Font Size				<input type='number' name='fontsize' form='form2'/>
	
Form Background					<input type='radio' name='background' form='form2' value='fillcolor' checked>Choose Color</input>  <input type='color' form='form2' value='#FF0000' name='solidcolor'>		<input type='radio' form='form2' name='background' value='fillimage'>Choose Image</input><input form='form2' type='file' name='bgimage'/>

	
	<input type='submit' form='form2'/></pre>";
}
#echo $_POST['fname1'];
#echo $_POST['fname1'];
#echo $_POST['fname1'];
#echo $_POST['ftype1'];
echo "<a href='test.php'>reset</a>
</body>
</html>";
?>
