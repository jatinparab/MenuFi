<?php
$conn = mysqli_connect("localhost","root", "", "menufi");
$sql = "SELECT * FROM categories";
$res = $conn -> query($sql);


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
                    <h1 class="page-header">Add Menu</h1>
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
                            Add Menu Item(s)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form method="post" action="<?php echo base_url(); ?>index.php/Admin/addMenu" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Price:</label>
                                        <input type="text" class="form-control" id="Price" name="Price" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Description:</label>
                                        <textarea class="form-control" id="desc" name="desc" required rows="5" cols="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Type:</label>
                                        <select name="ddlType" class="form-control">
                                            <option value="Veg">Veg</option>
                                            <option value="Non-Veg">Non-Veg</option>
                                            <option value="Liquor">Liquor</option>
                                        </select>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Category:</label>
                                        <select name="ddlCategory" class="form-control">
                                            <?php
                                            while($row = $res -> fetch_assoc() ){
                                                echo "<option value=".$row['name'].">".$row['name']."</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Image:</label>
                                        <input type="file" class="form-control" id="img" name="img" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Time Required:</label>
                                        <input type="text" class="form-control" id="time" name="time" required>
                                    </div>
                                    <div class="form-group" >
                                        <label for="pwd">Spice Level:</label>
                                        <select name="ddlspiceLevel" class="form-control">
                                            <option value="1">Low(1)</option>
                                            <option value="2">Medium(2)</option>
                                            <option value="3">High(3)</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    
</body>

</html>
