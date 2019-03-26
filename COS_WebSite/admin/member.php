<?php 
  session_start();

  if(!isset($_SESSION["username"]) || !isset($_SESSION["permission"])){
    header("location:index.php?action=login");
  }
  require_once("dbtools.inc.php");

  if(isset($_POST["operate"])){
    //這裡執行update
    if($_POST["operate"] == "update"){
      if($_POST['u_name'] == "" || $_POST['u_phone'] == "" || $_POST['u_credit'] == "" || $_POST['u_permission'] == ""){
        echo '<script>alert("請把資料填寫完整")</script>';
      }else{
        $uid = $_POST["u_id"];
        $uname = $_POST['u_name'];
        $uphone = $_POST['u_phone'];
        $ucredit = $_POST['u_credit'];
        $upermission = $_POST['u_permission'];
        $con = create_connection();
        $sql = "UPDATE Userdata SET Name='$uname', Phone='$uphone', Credit= '$ucredit', Permission = '$upermission' WHERE ID='$uid'";
        if(execute_sql($con, "id7769686_ordersys", $sql)){
          echo $sql;
          echo '<script>alert("更新成功")</script>';

        }else{
          echo '<script>alert("更新失敗")</script>';
        }
      }
    }
  }


  $con = create_connection();
  $sql = "SELECT * FROM Userdata ORDER BY Permission DESC";
  $result = execute_sql($con, "id7769686_ordersys", $sql);
  $row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/chart.js@2.8.0/dist/Chart.min.css,npm/chart.js@2.8.0/dist/Chart.min.css">

    <title>雲端點餐後台管理</title>
  </head>
  <body>
    <!-- navbar start here -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">點餐系統後台</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto text-white">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">首頁 <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="member.php">會員管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php?type=food">餐點管理</a>
          </li>
        </ul>
        <ul class="navbar-nav text-white">
          <li class="nav-item pr-2">hi, <?php echo $_SESSION["username"]; ?></li>
        </ul>
        
        <form class="form-inline my-2 my-lg-0">
          <button class="btn btn-outline-light my-2 my-sm-0" type="button" onclick="logout()" value="logout">登出</button>
        </form>
      </div>
    </nav>
    <!-- nav bar end up here -->

    <!-- content -->
    <div class="container mt-2">
      <div class="row">
        <div class="table-responsive">
          
            <table class="table">
              <thead class="table-dark">
                <tr class="mt-2">
                  <th scope="col">#</th>
                  <th scope="col">使用者名稱</th>
                  <th scope="col">電話</th>
                  <th scope="col">評價</th>
                  <th scope="col">權限</th>
                  <th scope="col">修改</th>
                  <th scope="col">刪除</th>
                </tr>
              </thead>
              <tbody class="table-hover">
                <?php do {
                  if($row['Permission'] == 5){
                  ?>
                  <!-- 超級管理員 -->
                <tr class="table-danger mt-2">
                  <th scope="row"><?php echo $row['ID']; ?></th>
                  <td><?php echo $row['Name'];?></td>
                  <td><?php echo $row['Phone'];?></td>
                  <td><?php echo $row['Credit'];?></td>
                  <td><?php echo $row['Permission'];?></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php }else if($row['Permission'] == 2){ ?>
                  <!-- 店家 -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <tr class="table-success mt-2">
                    <th scope="row"><?php echo $row['ID']; ?></th>
                    <td><input type="text" class="form-control" name="u_name" value="<?php echo $row['Name'];?>"></td>
                    <td><input type="text" class="form-control" name="u_phone" value="<?php echo $row['Phone'];?>"></td>
                    <td><input type="text" class="form-control" name="u_credit" value="<?php echo $row['Credit'];?>"></td>
                    <td><input type="text" class="form-control" name="u_permission" value="<?php echo $row['Permission'];?>"></td>
                    <td>
                      <button type="submit" class="btn btn-primary" name="operate" value="update">更新</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger" value="delete" data-id="<?php echo $row['ID']; ?>" onclick="del(this)">刪除</button>
                    </td>
                    <input type="hidden" name="u_id" value="<?php echo $row['ID']; ?>">
                  </tr>
                </form>
                <?php }else{  ?>
                  <!-- 一般使用者 -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <tr class="table-secondary">
                    <th scope="row"><?php echo $row['ID']; ?></th>
                    <td><input type="text" class="form-control" name="u_name" value="<?php echo $row['Name'];?>"></td>
                    <td><input type="text" class="form-control" name="u_phone" value="<?php echo $row['Phone'];?>"></td>
                    <td><input type="text" class="form-control" name="u_credit" value="<?php echo $row['Credit'];?>"></td>
                    <td><input type="text" class="form-control" name="u_permission" value="<?php echo $row['Permission'];?>"></td>
                    <td><button type="submit" class="btn btn-primary" name="operate" value="update">更新</button></td>
                    <td><button type="button" class="btn btn-danger" value="delete" data-id="<?php echo $row['ID']; ?>" onclick="del(this)">刪除</button></td>
                    <input type="hidden" name="u_id" value="<?php echo $row['ID']; ?>">
                  </tr>
                </form>
                <?php
                  }   
                }while ($row = mysqli_fetch_assoc($result)); ?>
              </tbody>
            </table>
          
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/combine/npm/chart.js@2.8.0/dist/Chart.min.js,npm/chart.js@2.8.0,npm/chart.js@2.8.0/dist/Chart.bundle.min.js,npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>
    <script>
      function del(elem){
        var id_del= $(elem).data("id");
        var status = confirm("請問確定刪除嗎?");
        if(status == true){
          location.href="delete-api.php?id="+id_del;
        }
      }

      function logout(){
        var status = confirm("確定要登出嗎?");

        if(status == true){
          window.location = "logout.php";
        }
      }
    </script>

  </body>
</html>