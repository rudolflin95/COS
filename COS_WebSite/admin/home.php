<?php 
  session_start();
  if(!isset($_SESSION["username"]) || !isset($_SESSION["permission"])){
    header("location:index.php?action=login");
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
          <button class="btn btn-outline-light my-2 my-sm-0" type="button" onclick="logout()">登出</button>
        </form>
      </div>
    </nav>
    <!-- nav bar end up here -->

    <!-- content -->
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <div class="col-md-6"></div>
        
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/combine/npm/chart.js@2.8.0/dist/Chart.min.js,npm/chart.js@2.8.0,npm/chart.js@2.8.0/dist/Chart.bundle.min.js,npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>

    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
    <script>
      function logout(){
        var status = confirm("確定要登出嗎?");

        if(status == true){
          window.location = "logout.php";
        }
      }
    </script>
  </body>
</html>