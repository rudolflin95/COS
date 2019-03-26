<?php 
require_once("password.php");
require_once("dbtools.inc.php");
session_start();
if(isset($_SESSION["username"])){
  header("location:home.php");  
}
if(isset($_GET["action"]) == "login"){
  if(empty($_POST["username"]) || empty($_POST["password"])){
    echo '<script>alert("請輸入帳號密碼")</script>';
  }else{
    $con = create_connection();
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM Userdata WHERE Name = '$username'";
    $result = execute_sql($con, "id7769686_ordersys", $sql);
    if(mysqli_num_rows($result) == 1){
      while($row = mysqli_fetch_array($result)){
        if(password_verify($password, $row["Password"])){
          // return true;
          $_SESSION["username"] = $username;
          $_SESSION["permission"] = $row["Permission"];
          header("location: home.php");
        }else{
          // return false;
          echo '<script>alert("輸入不正確")</script>';
        }
      }
    }else{
      echo '<script>alert("輸入不正確")</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>雲端點餐系統後台</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">
  <!-- font awsome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <!-- Icon -->
      <div><i class="fas fa-utensils fa-5x fa-login"></i></div>
      <!-- Login Form -->
      
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?action=login'; ?>">
        <input type="text" id="login" class="fadeIn second" name="username" placeholder="帳號">
        <input type="text" id="password" class="fadeIn third" name="password" placeholder="密碼">
        <input type="submit" name="login" class="fadeIn fourth" value="登入">
      </form>


      <!-- Remind Passowrd -->
<!--       <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div> -->
    </div>
  </div>    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>