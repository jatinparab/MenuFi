


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
    function chartsLoad(customers,gross_profit){
      var gross_profit_value = [];
      var customers_value = [];

      for(var index in gross_profit)
        gross_profit_value.push(gross_profit[index]);
      
      for(var index in customers)
        customers_value.push(customers[index]);
      const chart = document.getElementById("rest_grossSalesReport");
      Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
      console.log(chart);
      let lineChart = new Chart(chart, {
        type:'line',
        data: {
        labels: ["January", "Febrauary", "March", "April", "May", "June" , "July" , "August" , "September" , "October" , "November" , "December"],
        datasets: [{
                label: "Gross Sale",
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
                data: gross_profit_value,
              },
              
            ]
          }
        });
        
    
      const chart2 = document.getElementById("totalCustomers");
      Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
      console.log(chart2);
      let lineChart2 = new Chart(chart2, {
        type:'line',
        data: {
        labels: ["January", "Febrauary", "March", "April", "May", "June" , "July" , "August" , "September" , "October" , "November" , "December"],
        datasets: [{
                label: "Total Customers",
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
                data: customers_value,
              },
              
            ]
          }
        });
      }
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
                    <h1 class="page-header">Restaurant Sales Report</h1>
                </div>
               


           		 <div class="col-lg-12">
           		 	<div class="col-lg-6">
           		 		<div class="panel panel-info">
           		 			<div class="panel-heading">Gross Sale</div>
           		 			<div class="panel-body">
                      <div id="panel-body-inside">
           		 				<canvas id="rest_grossSalesReport" ></canvas>
                      </div>
           		 			</div>	  
                  </div>
                  
           		 		
           		 	</div>	 

           		 
           		 	<div class="col-lg-6">
           		 		<div class="panel panel-info">
           		 			<div class="panel-heading">Gross Sale &amp; Net Sale<br>
                      <span>

                      From : <input type="date" id="preweek" onchange="changedate()" value=<?php echo date('Y-m-d', strtotime('-30 days'))?>> 
                      To : <input type="date" disabled id="today" value=<?php echo date('Y-m-d')?>>
                      <input type="submit" id="go" value="Go"></input>

                      <span>
                    </div>
           		 			<div class="panel-body"> 
           		 		<table class="table table-striped table-dark">
  <thead class="thead-light" id="gross_sale">  
  </thead>
 
</table>
</div>
</div>
           		 		
           		 	</div>
</div>





             



                  <div class="col-lg-12">
                 
                  	<div class="col-lg-6">
           		 	 	<div class="panel panel-info">
           		 	 		<div class="panel-heading">Total Customers</div>
           		 	 		<div class="panel-body">
                      <div id="panel-body-inside1"> 
           		 	 			<canvas id="totalCustomers" ></canvas>
                      </div>
           		 	 		</div>	
                    </div>
    </div>
           		 
           		 	<!-- // 	<div class="panel panel-info">
           		 	// 		<div class="panel-heading">Table Turnaround Time</div>
           		 	// 		<div class="panel-body"> 
           		 	// 			<canvas id="turnaroundTime" ></canvas>
           		 	// 		</div>	
                //   </div>
           		 	// 	</div>
           	 -->
           		 
         <div class="col-lg-6">
                  <div class="panel panel-info">
                    <div class="panel-heading">Total Customers &amp; Turn Around Time</div>
                    <div class="panel-body"> 
                  <table class="table table-striped table-dark">
  <thead class="thead-light" id="total_customer">    
  </thead>
 
</table>

</div>
</div>
                  
                </div>
           		 		
           		 	</div>
                   
              







                 <!-- <div class="col-lg-12">
                 	<div class="col-lg-6">
           		 		<div class="panel panel-info">
           		 			<div class="panel-heading">Payment Method</div>
           		 			<div class="panel-body"> 
           		 				<canvas id="paymentMethod"  width="30" height="30"></canvas>
           		 			</div>	
           		 		</div>
           		 	</div>
           		 	<div class="col-lg-6">
                   <div class="panel panel-info">
                    <div class="panel-heading">Payment Method</div>
                    <div class="panel-body"> 
                  <table class="table table-striped table-dark">
  <thead class="thead-light">
   
     
   <tr><th>Payment Method</th>
    <th>Amount (Rs)</th> </tr>
      <tr><td>Cash</td><td>45</td><td>35</td></tr>      
      <tr><td>Credit/Debit Card</td><td>65</td><td>25</td></tr>   
    </thead>
  </table>
           		 		
           		 	</div>
                   
                </div> -->






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



<!--GROSS SALE LINE GRAPH -->



<!--NET SALES REPORT-->
<!-- <script> 
const chart1 = document.getElementById("rest_netSalesReport");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart1);
let lineChart1 = new Chart(chart1, {
  type:'line',
  data: {
  labels: ["January", "Febrauary", "March", "April", "May", "June" , "July" , "August" , "September" , "October" , "November" , "December"],
  datasets: [{
           label: "Net Sale",
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

             <?php foreach($net_profit as $k => $v){
               echo $v.",";
             } ?>
           ],
         },
        
       ]
     }
   })

</script> -->


<!--TABLE TURNAROUND TIME-->
<!-- <script> 
const chart11 = document.getElementById("turnaroundTime");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart11);
let lineChart11 = new Chart(chart11, {
  type:'line',
  data: {
  labels: ["January", "Febrauary", "March", "April", "May", "June" , "July" , "August" , "September" , "October" , "November" , "December"],
  datasets: [{
           label: "Table Turnaround Time",
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
           data: [45,23,86,45,97,23,56,44,64,12,56,32],
         },
        
       ]
     }
   })

</script> -->




<!--TOTAL CUSTOMERS-->


<!--PAYMENT METHOD-->
<!-- <script>
const chart3 = document.getElementById("paymentMethod");
Chart.defaults.global.legend.fontColor = "rgba(23,56,98,1)";
console.log(chart3);
let pieChart3 = new Chart(chart3, {
  type:'doughnut',
  data: {
    labels: ['Cash','Credit/Debit Card'],
    datasets: [
      {
        backgroundColor: ['#07B5AF','#1A8783'],
        data:[38,12]
      }
    ]
  },

  options: {
    
    animation: {
      animateScale: true
    }
  }

});
</script> -->

   
</body>
<script>
  
</script>

<script>
  function changedate(){
        var date2 = document.getElementById("preweek").value;
        var date1 = new Date(date2);
        // date1.setDate(date1.getMonth()+1);
        date1.setDate(date1.getDate()+30);
        var month=0,date3=0;
        date1.getMonth()+1 < 10 ? month = "0"+(date1.getMonth()+1) : month = date1.getMonth()+1;
        date1.getDate() < 10 ? date3 = "0"+(date1.getDate()) : date3 = date1.getDate();
        console.log(date1);
        document.getElementById("today").value = date1.getFullYear()+"-"+month+"-"+date3;
    }
    $(document).ready(function(){
        $("#go").click(function(event){
            event.preventDefault();
            $('.panel-body #rest_grossSalesReport').remove();
            $('.panel-body #panel-body-inside').after("<canvas id='rest_grossSalesReport' ></canvas>");
            $('.panel-body #totalCustomers').remove();
            $('.panel-body #panel-body-inside1').after("<canvas id='totalCustomers' ></canvas>")
            var from = $("#preweek").val();
            var to = $("#today").val();
            jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>"+"index.php/admin/sales_restSales_ajax",
            dataType: 'JSON',
            data: {fromday: from,today: to},
            success: function(res){
                var customer = res[0];
                var gross_profit = res[1];
                var orders = res[2];
                chartsLoad(customer,gross_profit);
                var htmlString="<tr><th>Months</th><th>Card Sales</th><th>Cash Sales</th><th>Online Sales</th></tr>";
                for(var index in orders)
                {
                    htmlString = htmlString+"<tr><td>"+index+"</td><td>"+orders[index]['Card']+"</td><td>"+orders[index]['Cash']+"</td><td>"+orders[index]['Online']+"</td></tr>"
                }
                var htmlString1 = "<tr><td>Months</td><td>Total Customers</td></tr>"
                for(var index in customer)
                {
                  htmlString1 = htmlString1+"<tr><td>"+index+"</td><td>"+customer[index]+"</td></tr>";
                }
                $('#gross_sale').html(htmlString);
                $('#total_customer').html(htmlString1);

            }
        });
        });
    });


    $(document).ready(function(){
        var today = new Date();
        // $('#rest_grossSalesReport').empty();
        
        var to = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        today.setDate(today.getDate()-30);
        var from = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>"+"index.php/admin/sales_restSales_ajax",
            dataType: 'JSON',
            data: {fromday: from,today: to},
            success: function(res){
                var customer = res[0];
                var gross_profit = res[1];
                var orders = res[2];
                chartsLoad(customer,gross_profit);
                var htmlString="<tr><th>Months</th><th>Card Sales</th><th>Cash Sales</th><th>Online Sales</th></tr>";
                for(var index in orders)
                {
                    htmlString = htmlString+"<tr><td>"+index+"</td><td>"+orders[index]['Card']+"</td><td>"+orders[index]['Cash']+"</td><td>"+orders[index]['Online']+"</td></tr>"
                }
                var htmlString1 = "<tr><td>Months</td><td>Total Customers</td></tr>"
                for(var index in customer)
                {
                  htmlString1 = htmlString1+"<tr><td>"+index+"</td><td>"+customer[index]+"</td></tr>";
                }
                $('#gross_sale').html(htmlString);
                $('#total_customer').html(htmlString1);
                
            }
        });
    });
</script>
</html>
