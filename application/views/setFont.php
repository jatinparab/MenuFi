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
    <style>
        
        <?php 
        if(isset($fonts)){
            foreach ($fonts as $value) {
                echo '@font-face {';
                echo 'font-family: "'.$value["name"].'";';
                echo 'font-style: normal;
  font-weight: 400;';
                echo 'src: '.$value["src"].' format("woff2"); }';
            }
        }
        ?>
    </style>
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
                    <h1 class="page-header">Set Font</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php
            if(isset($upload_data)){
            ?>
            <div class="row">
                <div class="col-md-6">
                    <h3 style="color:green;">Your font has been applied successfully!</h3><br>
                    <p>Please refresh the Client side page using the following key combination:<br> <b>Control + Shift + R</b></p>

                </div>
            </div>
            <?php }
            ?>
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-6">
<!--                    <div class="alert alert-info">
                        <p>
                            <b>Note:</b> Logo Image Dimensions must be 100 x 100 px.
                        </p>
                    </div>-->
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            Set Font
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form method="post" action="<?php echo base_url(); ?>index.php/Admin/setFont" enctype="multipart/form-data">
                                    
                                    <div class="form-group" style="font-size:22px;line-height: 35px;">
                                        <label for="pwd">Select Font:</label><br>
                                        <?php 
                                        if(isset($fonts)){
                                            foreach ($fonts as $value) {?>
                                                <input type="radio"  id="fonts" name="fonts" required value='<?php echo $value['name'];?>'><span style="font-family: <?php echo $value['name'];?>;"><?php echo $value['name'];?></span><br>
                                           <?php }
                                        }
                                        
                                        ?>
<!--                                        <input type="radio"  id="fonts" name="fonts" required value='Arial, Helvetica, sans-serif'><span style="font-family: Arial, Helvetica, sans-serif;">Arial</span><br>
                                        <input type="radio"  id="fonts" name="fonts" required value='Times New Roman'><span style="font-family: 'Times New Roman', Times, serif;">Times New Roman</span><br>
                                        <input type="radio"  id="fonts" name="fonts" required value='Verdana, Geneva, sans-serif'><span style="font-family: Verdana, Geneva, sans-serif;">Verdana</span><br>
                                        <input type="radio"  id="fonts" name="fonts" required value='Courier New'><span style="font-family: 'Courier New', Courier, monospace;">Courier</span><br>-->
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div id="message"><?php echo isset($error)?"<font color='red'>$error</font>":"";?> <!-- Error Message will show up here --></div>
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
