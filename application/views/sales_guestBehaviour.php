
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
    <script>
function chartsLoad(bill,freq){
var avg_bill_amount =[];
var avg_visit_freq = [];
for(var index in bill)
    avg_bill_amount.push(bill[index]);
for(var index in freq)
    avg_visit_freq.push(freq[index]);

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
           data: avg_bill_amount,
         },
        
       ]
     }
   });

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
           data: avg_visit_freq,
         },
        
       ]
     }
   });
};
</script>

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
   
</body>


</head>

<body onload="chartsLoad()">

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
                    <div class="panel-heading">Gross Sale &amp; Net Sale<br>
                    <span>

                    From : <input type="date" id="preweek" onchange="changedate()" value=<?php echo date('Y-m-d', strtotime('-6 days'))?>> 
                    To : <input type="date" disabled id="today" value=<?php echo date('Y-m-d')?>>
                    <input type="submit" id="go" value="Go"></input>
                    
                    <span>
                    </div>
                    <div class="panel-body"> 
                  <table class="table table-striped table-dark">
  <thead class="thead-light">
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
    function changedate(){
        var date2 = document.getElementById("preweek").value;
        var date1 = new Date(date2);
        // date1.setDate(date1.getMonth()+1);
        date1.setDate(date1.getDate()+6);
        var month=0,date3=0;
        date1.getMonth()+1 < 10 ? month = "0"+(date1.getMonth()+1) : month = date1.getMonth()+1;
        date1.getDate() < 10 ? date3 = "0"+(date1.getDate()) : date3 = date1.getDate();
        console.log(date1);
        document.getElementById("today").value = date1.getFullYear()+"-"+month+"-"+date3;
    }
    var orders,avg_bill_amount,avg_freq_visit;
    $(document).ready(function(){
        $("#go").click(function(event){
            event.preventDefault();
            var from = $("#preweek").val();
            var to = $("#today").val();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>"+"index.php/admin/sales_guestBehaviour_ajax",
                dataType: 'JSON',
                data: {fromday: from,today: to},
                success: function(res){
                    orders = res[0];
                    avg_bill_amount = res[1];
                    avg_freq_visit = res[2];
                    chartsLoad(avg_bill_amount,avg_freq_visit);
                    var htmlString="<tr><th>Week</th><th>Card</th><th>Cash</th><th>Online</th></tr>";
                    for(var index in orders)
                    {
                        htmlString = htmlString+"<tr><td>"+index+"</td><td>"+orders[index]['Card']+"</td><td>"+orders[index]['Cash']+"</td><td>"+orders[index]['Online']+"</td></tr>"
                    }
                    $('.thead-light').html(htmlString);

                }
            });
        });
    });

    $(document).ready(function(){
        var today = new Date();

        
        var to = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        today.setDate(today.getDate()-6);
        var from = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>"+"index.php/admin/sales_guestBehaviour_ajax",
            dataType: 'JSON',
            data: {fromday: from,today: to},
            success: function(res){
                orders = res[0];
                avg_bill_amount = res[1];
                avg_freq_visit = res[2];
                chartsLoad(avg_bill_amount,avg_freq_visit);
                var htmlString="<tr><th>Week</th><th>Card</th><th>Cash</th><th>Online</th></tr>";
                for(var index in orders)
                {
                    htmlString = htmlString+"<tr><td>"+index+"</td><td>"+orders[index]['Card']+"</td><td>"+orders[index]['Cash']+"</td><td>"+orders[index]['Online']+"</td></tr>"
                }
                $('.thead-light').html(htmlString);

            }
        });
    });
    
</script>
    
</html>
