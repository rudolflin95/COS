<?php 
  session_start();
  if(!isset($_SESSION["username"]) || !isset($_SESSION["permission"])){
  header("location:index.php?action=login");
  }else{
   require_once("dbtools.inc.php");

    if($_GET["type"] == "food"){
      $con = create_connection();
      $sql = "SELECT * FROM Products WHERE Type = 'b'";
      $result = execute_sql($con, "id7769686_ordersys", $sql);
      $row = mysqli_fetch_assoc($result);
    }

    if(isset($_POST["operate"])){
        if($_POST["operate"] == "change"){
        $productname = $_POST["productname"];
        $s_price = $_POST["s_price"];
        $l_price = $_POST["l_price"];
        $image = $_POST["image"];
        $pid = $_POST["pid"];
        $con = create_connection();
        $sql = "UPDATE Products SET Productname='$productname',  L_price='$l_price',  S_price= '$s_price', Image = '$image' WHERE PID= '$pid'";

        if(execute_sql($con, "id7769686_ordersys", $sql)){
          echo '<script>alert("更新成功")</script>';

        }else{
          echo '<script>alert("更新失敗")</script>';
        }    
      }
    }
  }




?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/combine/npm/chart.js@2.8.0/dist/Chart.min.css,npm/chart.js@2.8.0/dist/Chart.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">


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
            <a class="nav-link" href="products.php?type=food">餐點管理</a>
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

    <!-- 新增container -->
    <div class="container mt-2">
      <div class="row justify-content-end">
        <ul class="nav">
          <li class="nav-item">
            <a class="btn btn-danger" href="#"><i class="fas fa-plus mr-2"></i>新增</a>
          </li>
        </ul>        
      </div>      
    </div>
    <!-- 新增container end -->
    <!-- main content -->
    <div class="container mt-2">
      <div class="row mb-3">
        <ul class="nav">
          <li class="nav-item mr-2">
            <a class="btn btn-success" href="#"><i class="fas fa-hamburger mr-2"></i>輕食</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-success" href="#"><i class="fas fa-cocktail mr-2"></i>飲料</a>
          </li>
        </ul>   
      </div>
      <div class="row ">

        <?php do { ?>

        <div class="col-md-4 mb-3">
          <div class="card p-2 card-hover" >
            <img src="<?php echo $row['Image'] ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-hamburger mr-2"></i><?php echo $row['Productname'] ?></h5>
              <button class="btn btn-outline-success float-right" data-toggle="modal" data-target="#setting-product" onclick="settingproduct(this)" data-id="<?php echo $row['PID'] ?>"><i class="far fa-edit mr-2"></i>編輯</button>
            </div>
          </div>          
        </div>

      <?php }while ($row = mysqli_fetch_assoc($result));  ?>

      <!-- modal start here -->
      <div class="modal fade" id="setting-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="<?php echo $_SERVER['PHP_SELF'].'?type=food'; ?>" method="post">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">產品修改</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table">
                  <thead class="table-dark">
                    <tr class="mt-2">
                      <th scope="col">產品名稱</th>
                      <th scope="col">價錢-L</th>
                      <th scope="col">價錢-S</th>
                      <th scope="col">圖片位址</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table-danger mt-2" id="modal-content">
  <!--                <td><input type='text' class='form-control' name='u_name' value='1'></td>
                      <td><input type='text' class='form-control' name='u_name' value='2'></td>
                      <td><input type='text' class='form-control' name='u_name' value='2'></td>
                      <td><input type='text' class='form-control' name='u_name' value='2'></td> -->
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="submit" class="btn btn-outline-success" name="operate" value="change">修改</button>
              </div>
            </form>
          </div>
        </div>
      </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<!--     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
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

      function settingproduct(elem){
        var id_product = $(elem).data("id");
        $.ajax({
          type: "POST",
          url: "https://tcnr1611.000webhostapp.com/COS_WebSite/admin/read-api.php",
          data: {pid: id_product},
          dataType: "json",
          success: showProduct,
          error:function(){
            alert("產品列表api回傳失敗");
          }
        });
      }

      function showProduct(data){
        for(i=0; i < data.length; i++){
          strHtml ="";
          strHtml ="<td><input type='text' class='form-control' name='productname' value='"+data[i].Productname+"'></td>"+
                    "<td><input type='text' class='form-control' name='l_price' value='"+data[i].L_price+"'></td>"+
                    "<td><input type='text' class='form-control' name='s_price' value='"+data[i].S_price+"'></td>"+
                    "<td><input type='text' class='form-control' name='image' value='"+data[i].Image+"'></td>"+
                    "<td><input type='hidden' class='form-control' name='pid' value='"+data[i].PID+"'></td>"+
                    "<td><input type='hidden' class='form-control' name='type' value='food'></td>";
          $("#modal-content").empty();
          $("#modal-content").append(strHtml);
        }
      }
    </script>

  </body>
</html>