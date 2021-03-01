<?php 
	session_start();
	if(isset($_SESSION['user'])){
		$n=$_SESSION['user'];
		echo "<span id='hello'> <br> &#160; User: $n </span> <br>";
	}
	else{
		header('Location:phpIndex.php');
	}
        
	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$db = "2249802_tests";
        
	$conn = mysqli_connect($serverName,$userName,$password,$db);
	if(!$conn){
		die();
	}
 
    $ttitle="";
	$allTs = "select * from test where subName='www'";
    $resultTs = $conn->query($allTs);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="wwwcss.css">
    <title>www</title>
</head>

<body class="main">
	<button onclick="location.href='page2.php';" class="goback"></button>
    <button onclick="location.href='logout.php';" class="logoutb"></button>
	<br>
	<h2> &nbsp;&nbsp;&#9656; Choose a test to write: </h2>
	<?php
		if ($resultTs->num_rows > 0) {
			// output data of each row
            while($rowTs = $resultTs->fetch_assoc()) {
	?> 
	<div class="testLinks"> <font size="5"> &nbsp;&nbsp;&nbsp;&nbsp;&#8226; <?php echo $rowTs["title"] ?> </font> </div> <br><!-- display test titles -->
	<?php         
            } // telos while
		}
		else{
			echo "No results";
		}
    ?>
	
    <form method="post">
		<b><font size="5"> &nbsp; Give title's test: </font></b> <input type="text" name="ttitle" placeholder="Same way it is displayed.." maxlength='30'required>
		<input type="submit" name="submit2" value="Submit"> 
    </form>
	
	<?php
		$ttitle = $conn->real_escape_string($_POST["ttitle"]);
		$_SESSION['test'] = $ttitle;
		
		if(strcmp($ttitle,"")!= 0){
			echo "<script> location.replace('wwwPrintTests.php'); </script>";
		}
	?>
</body>
</html>

