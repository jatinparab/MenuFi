<?php 
      $conn = mysqli_connect("localhost","root", "", "menufi");
      $avg_bill_amount = array(
          'Sunday'=>0,
          'Monday'=>0,
          'Tuesday'=>0,
          'Wednesday'=>0,
          'Thursday'=>0,
          'Friday'=>0,
          'Saturday'=>0,
          
      );
      $avg_bill_amount_number = array(
        'Sunday'=>0,
        'Monday'=>0,
        'Tuesday'=>0,
        'Wednesday'=>0,
        'Thursday'=>0,
        'Friday'=>0,
        'Saturday'=>0,
        
    );
    $avg_bill_amount_total = array(
        'Sunday'=>0,
        'Monday'=>0,
        'Tuesday'=>0,
        'Wednesday'=>0,
        'Thursday'=>0,
        'Friday'=>0,
        'Saturday'=>0,
        
    );
    $avg_freq_visit = array(
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
        $total = 0;
        $c = 0;
        if($res){
            while($row = $res -> fetch_assoc()){
            $ro = $row['Timestamp']; 
            $day = date('l', strtotime($ro));
            $avg_bill_amount_total[$day] += $row['net_total'];
            $avg_bill_amount_number[$day] += 1;
            }
            foreach($avg_bill_amount as $k => $v){
                if($avg_bill_amount_number[$k] != 0 && $avg_bill_amount_number[$k] !=0){
                $avg_bill_amount[$k] = $avg_bill_amount_total[$k]/$avg_bill_amount_number[$k];
                }
            }
            $total_visits = 0;
            foreach($avg_bill_amount_number as $k => $v){
                $total_visits += $v;
            }
            foreach($avg_freq_visit as $k => $v){
                
                $avg_freq_visit[$k] = $avg_bill_amount_number[$k]/7;
            }

            
        }

        //print_r($avg_bill_amount);
        // print_r($avg_bill_amount_number);
        // print_r($total_visits);
        // print_r($avg_freq_visit);
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
                    <h1 class="page-header">Guest Behaviour Report</h1>
                </div>
               



                  <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 			<div class="panel panel-info">
           		 			<div class="panel-heading">Average Bill Amount</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="avgBillAmount" height="207px" ></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 <div class="col-lg-6">
                  <div class="panel panel-info">
                    <div class="panel-heading">Gross Sale & Net Sale</div>
                    <div class="panel-body"> 
                  <table class="table table-striped table-dark">
  <thead class="thead-light">
   
      
   <tr><th>Week</th>
    <th>Avg Bill Amount</th>   <th>Avg Freq of Visit</th></tr>
    <?php 
        foreach($avg_bill_amount as $k => $v){
      ?>
      <tr><td><?php echo $k; ?></td><td><?php echo (int)($v); ?></td><td><?php echo number_format($avg_freq_visit[$k],2,'.',''); ?></td></tr>
    <?php 
        }
    ?>
  </thead>
 
</table>
</div>
</div>
                  
                </div>
                  
                </div>

                  <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 			<div class="panel panel-info">
           		 			<div class="panel-heading">Average Frequency of Visit</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="avgFreqVisit" height="207px"></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 	<div class="col-lg-6">
           		 		
           		 	</div>
                  
                </div>

 		




            </div> <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <!-- /.row -->
         </div>
    <!-- /#wrapper -->
</div>
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





<!--AVERAGE BILL AMOUNT-->
<script> 
const chart9 = document.getElementById("avgBillAmount");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart9);
let lineChart9 = new Chart(chart9, {
  type:'line',
  data: {
  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thurseday", "Friday" , "Saturday" ],
  datasets: [{
           label: "Average Bill Amount",
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
            <?php foreach($avg_bill_amount as $k => $v){
               echo $v.",";
             } ?>
           ],
         },
        
       ]
     }
   })

</script>


<!--TOTAL CUSTOMERS-->
<script> 
const chart10 = document.getElementById("avgFreqVisit");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart10);
let lineChart10 = new Chart(chart10, {
  type:'line',
  data: {
  labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thurseday", "Friday" , "Saturday" ],
  datasets: [{
           label: "Average Frequency of Visit",
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
            <?php foreach($avg_freq_visit as $k => $v){
               echo $v.",";
             } ?>
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
        data: [<?php echo $chartData; ?>],
        xkey: 'MonthYear',
        ykeys: ['Sales'],
        labels: 'Sales',
        hideHover: 'auto',
        resize: true
    });
    });
    </script>
</html>
