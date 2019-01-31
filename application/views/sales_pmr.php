<?php 
      $conn = mysqli_connect("localhost","root", "", "menufi");
      $peak_day = array(
          'Sunday'=>0,
          'Monday'=>0,
          'Tuesday'=>0,
          'Wednesday'=>0,
          'Thursday'=>0,
          'Friday'=>0,
          'Saturday'=>0,
      );
      $sql = "SELECT * FROM sales WHERE refund='0'";
      $res = $conn -> query($sql);
      if($res){
        while($row = $res -> fetch_assoc()){
          $r = $row['Timestamp'];
          $day = date('l', strtotime($r));
          $peak_day[$day] += 1;
        }
      }
     // print_r($peak_day);
      $sql = "SELECT * FROM categories";
      $res = $conn -> query($sql);
      $categories = array();
      if($res){
        while($row = $res -> fetch_assoc()){
          array_push($categories, $row['name']);
        }
      }
      $top_menu = array();
      foreach($categories as $category){
        //$category = str_replace(' ', '', $category);
        $top_menu[$category] = 0;
      }
      // print_r($top_menu);
      $sql = "SELECT * FROM menu";
      $res = $conn -> query($sql);
      if($res){
        while($row = $res -> fetch_assoc()){
          $ra = $row['Category'];
         // $ra = str_replace(' ', '', $ra);
          //print_r($top_menu);
          $top_menu[$ra] += 1;
        }
      }
      //print_r($top_menu);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu Fi</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../assets/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Menu Fi</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url(); ?>index.php/Admin/changePwd"><i class="fa fa-sign-out fa-fw"></i> Change Password</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>index.php/Admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php include 'nav_links.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Mix and Menu Reports</h1>
                </div>
               




                 <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 		<div class="panel panel-info">
           		 			<div class="panel-heading">Top Menu Category</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="topMenu"  width="30" height="30"></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 	<div class="col-lg-6">
           		 		
           		 	</div>
                    
                </div>


                 <!-- <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 		<div class="panel panel-info">
           		 			<div class="panel-heading">Most Ordered Dish in a Category</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="mostOrderDish"  width="30" height="30"></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 	<div class="col-lg-6">
           		 		
           		 	</div>
                    
                </div> -->



                 <!-- <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 			<div class="panel panel-info">
           		 			<div class="panel-heading">Peak Time of Day</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="peakTimeDay" ></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 	<div class="col-lg-6">
           		 		
           		 	</div>
                  
                </div> -->

                  <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 			<div class="panel panel-info">
           		 			<div class="panel-heading">Peak day of Week</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="peakTimeWeek" ></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 	<div class="col-lg-6">
           		 		
           		 	</div>
                  
                </div>





            </div>
            <!-- /.row -->
         </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../assets/vendor/raphael/raphael.min.js"></script>
    <script src="../../assets/vendor/morrisjs/morris.min.js"></script>
    <script src="../../assets/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../assets/dist/js/sb-admin-2.js"></script>

    <!--Chart.JS Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



<!--MOST ORDERED DISH-->
<script> 
new Chart(document.getElementById("mostOrderDish"), {
    type: 'bar',
    data: {
      labels: ["January", "Febrauary", "March", "April", "May", "June" , "July" , "August" , "September" , "October" , "November" , "December"],
      datasets: [
        {
          label: "Vegetable Pakora",
          backgroundColor: "#3e95cd",
          data: [33,21,83,78,99,92,52,10,10,12,91,87]
        }, {
          label: "Tuborg",
          backgroundColor: "#8e5ea2",
          data: [08,47,75,34,87,67,78,65,67,56,68,89]
        }
         {
          label: "King Prawn Rosun",
          backgroundColor: "#3e25cd",
          data: [33,21,83,78,99,92,42,10,64,12,91,87]
        }, {
          label: "Tandoori Deluxe",
          backgroundColor: "#8e56a2",
          data: [18,47,75,34,87,67,78,65,67,56,68,89]
        },
         {
          label: "Bombay Aloo",
          backgroundColor: "#8e5e12",
          data: [18,47,75,34,87,67,78,65,97,56,68,19]
        } ,
         {
          label: "Boiled Rice",
          backgroundColor: "#8e5ea5",
          data: [48,97,75,34,87,67,78,65,67,56,68,89]
        },
         {
          label: "Rasmalai",
          backgroundColor: "#4e5ea2",
          data: [18,47,75,34,87,67,78,65,67,56,68,89]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Most Oredered Dish in a Category'
      }
    }
});
</script>


<!--TOP MENU CATEGORY-->
<script>
const chart5 = document.getElementById("topMenu");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart5);
let pieChart5 = new Chart(chart5, {
  type:'doughnut',
  data: {
    
    labels: [<?php
      foreach($top_menu as $k => $v){
        echo "'".$k."',";
      }

      ?>],
    datasets: [
      {
        backgroundColor: ['#07B5AF','#1A8783' ,'#21E4DD','#9FF9F6','#69A5A3','#4A7D7B','#336261'],
        data:[<?php
      foreach($top_menu as $k => $v){
        echo $top_menu[$k].",";
      }
    
      ?>],
      }
    ]
  },

  options: {
    
    animation: {
      animateScale: true
    }
  }

});
</script>


<!--PEAK TIME DAY-->
<script> 
const chart6 = document.getElementById("peakTimeDay");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart6);
let lineChart6 = new Chart(chart6, {
  type:'line',
  data: {
  labels: ["11AM", "12PM", "01PM", "02PM", "03PM", "04PM" , "05PM" , "06PM" , "07PM" , "08PM" , "09PM" , "10PM" , "11PM" , "12PM"],
  datasets: [{
           label: "Peak Time of DAY",
           fill: true,
           lineTension: 0.1,
           backgroundColor:"rgba(75, 192, 192, 0.4)",
           borderColor:"rgba(75,192,192,1)",
           borderCapStyle: 'butt',
           borderWidth:1.5,
           borderDash:[],
           borderDashOfset: 0.0,
           borderJoinStyle: 'miter',
           pointBorderColor: "rgba(75,192,192,1)",
           pointBackgroundColor: "#fff",
           pointBorderWidth: 1,
           pointHoverRadius: 5,
           pointHoverBackgroundColor:"rgba(75,192,192,1)",
           pointHoverBorderColor: "rgba(220,220,220,1)",
           pointHoverBorderWidth: 2,
           pointRadius: 1,
           pointHitRadius: 10,
           data: [67,37,8,23,45,99,12,77,45,98,56,34,23,76],
         },
        
       ]
     }
   })

</script>



<!--PEAK TIME WEEK-->
<script> 
const chart7 = document.getElementById("peakTimeWeek");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart7);
let lineChart7 = new Chart(chart7, {
  type:'line',
  data: {
  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday" , "Saturday" ],
  datasets: [{
           label: "Peak day of WEEK",
           fill: true,
           lineTension: 0.1,
           backgroundColor:"rgba(75, 192, 192, 0.4)",
           borderColor:"rgba(75,192,192,1)",
           borderCapStyle: 'butt',
           borderWidth:1.5,
           borderDash:[],
           borderDashOfset: 0.0,
           borderJoinStyle: 'miter',
           pointBorderColor: "rgba(75,192,192,1)",
           pointBackgroundColor: "#fff",
           pointBorderWidth: 1,
           pointHoverRadius: 5,
           pointHoverBackgroundColor:"rgba(75,192,192,1)",
           pointHoverBorderColor: "rgba(220,220,220,1)",
           pointHoverBorderWidth: 2,
           pointRadius: 1,
           pointHitRadius: 10,
           data: [
             <?php 
              foreach($peak_day as $p){
                echo $p.',';
              }
             ?>
           ],
         },
        
       ]
     }
   })

</script>


   
</body>
 <script>
     jQuery.ready(function(){
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [<?php //echo $chartData; ?>],
        xkey: 'MonthYear',
        ykeys: ['Sales'],
        labels: 'Sales',
        hideHover: 'auto',
        resize: true
    });
    });
    </script>
</html>
