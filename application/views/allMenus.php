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
    <link href="../../assets/DataTables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/DataTables/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
        
        <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js">
	</script>
        <script type="text/javascript" class="init">
	


//$(document).ready(function() {
//	$('#tblMenu').DataTable( {
//		dom: 'Bfrtip',
//		buttons: [
//			'copy', 'csv', 'excel', 'pdf', 'print'
//		]
//	} );
//} );



	</script>
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
                    <h1 class="page-header">All Menus</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php
            
            ?>
            
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            All Menu Item(s)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form method="post" action="#" enctype="multipart/form-data">
                                    <table class="table table-bordered display nowrap" id="tblMenu" name="tblMenu">
                                    <thead>
                                        <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Time Required</th>
                                        <th>Spice Level</th>
                                        <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($menu) && count($menu)>0){
                                            $i=1;
                                    foreach ($menu as $item) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $item['Name']; ?></td>
                                            <td><?php echo $item['Price']; ?></td>
                                            <td><?php echo $item['Type']; ?></td>
                                            <td><?php echo $item['Category']; ?></td>
                                            <td><?php echo $item['Image']; ?></td>
                                            <td><?php echo $item['time']; ?></td>
                                            <td><?php echo $item['spice_level']; ?></td>
                                            <td><button type="button" class="btn btn-primary btn-sm btnEdit" title="Edit" id="<?php echo $item['Menu_Id']; ?>" name="btnEdit"><span class="glyphicon glyphicon-pencil"></span></button>
                                            &nbsp;&nbsp ;<button type="button"  class="btn btn-danger btn-sm btnDelete" title="Delete" id="<?php echo $item['Menu_Id']; ?>" name="btnDelete"><span class="glyphicon glyphicon-trash"></span></button>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    
                                    }
                                        }
                                            
                                            ?>
                                    </tbody>  
                                    </table>
                                    
                                </form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <br><br><br><br>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../assets/vendor/metisMenu/metisMenu.min.js"></script>

<!--     Morris Charts JavaScript 
    <script src="../../assets/vendor/raphael/raphael.min.js"></script>
    <script src="../../assets/vendor/morrisjs/morris.min.js"></script>
    <script src="../../assets/data/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="../../assets/dist/js/sb-admin-2.js"></script>

</body>
<script>
    $('document').ready(function(){
        $('.btnEdit').click(function(e){
            e.preventDefault();
            var menu_id = $(this).attr('id');
            
            window.location.href = '<?php echo base_url(); ?>index.php/Admin/editMenu/'+menu_id;
//            $.ajax({
//                type: 'POST',
//                url:'<?php echo base_url(); ?>index.php/Admin/editMenu/',
//                data: {'menu_id':menu_id},
//                cache: false,
//                success: function(resp){
//                }
//            });
        });
        
        $('.btnDelete').click(function(){
            var menu_id = $(this).attr('id');
            window.location.href = '<?php echo base_url(); ?>index.php/Admin/deleteMenu/'+menu_id;
        });
        
    });
</script>
</html>
