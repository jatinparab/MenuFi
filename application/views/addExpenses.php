<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu Fi</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    <h1 class="page-header">Expenses List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

             <div class="row">
                
                <div class="col-lg-12"> 
                <div class="panel panel-danger">
                  <div class="panel-heading">Search</div>
                  <div class="panel-body"> 
                    <form action = "<?=base_url()?>index.php/Admin/addExpenses" method = "post">
                      <div class="row">
                        <div class="col-md-1"><label>From</label></div>
                        <div class="col-md-3">
                          <input type = "text" class = "form-control datepicker"  id = "start_date" name = "start_date" value = "<?php
                          
                          if(!isset($_POST['start_date'])){
                            echo date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 5, date("Y")));

                          }else{
                              echo $_POST['start_date'];
                          }
                          
                          
                          ?>" placeholder="Start Date">
                        </div>
                        <div class="col-md-1"><label>To</label></div>
                        <div class="col-md-3">
                          <input type = "text" class = "form-control datepicker"  id = "end_date" name = "end_date" value = "<?php 
                          if(!isset($_POST['end_date'])){
                            echo date("Y-m-d");

                          }else{
                              echo $_POST['end_date'];
                          }
                           ?>" placeholder="End Date">
                        </div>
                        <select name="type">
                        <option value="1">All</option>
                          <option value="General">General</option>
                          <option value="Grocery">Grocery</option>
                          <option value="Salary">Salary</option>
                        </select>
                        <div class="col=md-2">
                            <input type = "submit" class = "btn btn-success" value = "Search">
                        </div>
                      </div>    
                    </form>
                  </div>
                </div>
              </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
            
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Expense
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name of person</th>
                                        <th>Expense Name</th>
                                        <th>Expense Amount</th>
                                        <th>Expense Type</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                    <?php if(!empty($expensesList)){
										
									 $i=1;
                                     foreach ($expensesList as $value) {
										 
										echo"<tr>";
                                        echo "<td>".$i."</td>";
                                        echo "<td>".$value['nameOfPerson']."</td>";
										echo "<td>".$value['name']."</td>";
										echo "<td>".$value['amount']."</td>";
                                        echo "<td>".$value['type']."</td>";
                                        echo "<td>".$value['reason']."</td>";
                                        echo "<td>".$value['date']."</td>";
                                        echo "<td>".$value['time']."</td>";
										$i++; }
										}
                                        echo "<tr><td></td><td></td><td></td><td>Total: ".$totalAmount."</td></tr>";
                                    ?>

                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                
                <!-- /.col-lg-6 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Expenses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php
            
            ?>
            
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Add Expenses
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form method="POST" action="javascript:;" name="addExpenseForm">
                                   <div class="form-group">
                                        <label for="pwd">Name of person:</label>
                                        <input type="text" class="form-control" id="nameOfPerson" name="nameOfPerson" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Reason:</label>
                                        <input type="text" class="form-control" id="reason" name="reason" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Date:</label>
                                        <input type="text" value="<?php echo date("Y-m-d") ?>" class="form-control" id="datepicker" name="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Time:</label>
                                        <input type="time" value="now" class="form-control" id="time" name="time" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Type:</label>
                                        <select name="type" id="type" class="form-control">
											<option value="">Select</option>
											<option value="grossary">Grossary</option>
                                            <option value="general">General</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                      
                                    <div class="form-group">
                                        <label for="pwd">Amount:</label>
                                        <input type="text" class="form-control" id="amt" name="amt" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" onclick="addExpenses()">Submit</button>
                                </form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

          
        </div>
        <!-- /#page-wrapper -->
        

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

    <script>
	function addExpenses(){
		
		var type = $('#type').val();
		var name = $('#name').val();
		var amt = $('#amt').val();
        var nameOfPerson = $('#nameOfPerson').val();
        var reason = $('#reason').val();
        var date = $('#datepicker').val();
        var time = $('#time').val();
		$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/Admin/viewExpense',
				data:{
					'type':type,
					'name':name,
					'amt':amt,
                    'nameOfPerson':nameOfPerson,
                    'reason':reason,
                    'date':date,
                    'time':time
				},
				cache:false,
				dataType:'json',
				success: function(resp){
					if(resp == '1'){
						 alert('expense Added');
						 window.location.href='<?php echo base_url(); ?>index.php/Admin/addExpenses';					
					 
					}else{
						
						alert('Failed to expense Added');
						window.location.href='<?php echo base_url(); ?>index.php/Admin/addExpenses';					
					}
				}
		});	 
	}

    $( function() {
    $("#datepicker").datepicker({
        dateFormat:"yy-mm-dd"    
    });
  } );

  $(function(){  
  $('input[type="time"][value="now"]').each(function(){    
    var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $(this).attr({
      'value': h + ':' + m
    });
  });
});
  

	</script>
</body>

</html>
