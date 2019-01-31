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
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                    <h1 class="page-header">Edit/Update Menu</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php
            
            ?>
            
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Add Menu Item(s)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form method="post" action="<?php echo base_url();?>index.php/Admin/updateMenu/" enctype="multipart/form-data">
                                    <?php 
                                    if(isset($menu_item) && !empty($menu_item)){
                                        
                                    ?>
                                    <input type="hidden" name="menu_id" value="<?php echo $menu_item['Menu_Id']; ?>">
                                    <input type="hidden" name="prevImgName" value="<?php echo $menu_item['Image']; ?>">
                                    <div class="form-group">
                                        <label for="name">name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $menu_item['Name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Price:</label>
                                        <input type="text" class="form-control" id="Price" name="Price" required  value="<?php echo $menu_item['Price']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Description:</label>
                                        <textarea class="form-control" id="desc" name="desc" required rows="5" cols="10"><?php echo $menu_item['Description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Type:</label>
                                        <select name="ddlType" class="form-control">
                                            <option value="Veg" <?php if(!empty($menu_item['Type'])&&$menu_item['Type']=='Veg'){echo 'Selected';} ?>>Veg</option>
                                            <option value="Non-Veg" <?php if(!empty($menu_item['Type'])&&$menu_item['Type']=='Non-Veg'){echo 'Selected';} ?>>Non-Veg</option>
                                            <option value="Liquor" <?php if(!empty($menu_item['Type'])&&$menu_item['Type']=='Liquor'){echo 'Selected';} ?>>Liquor</option>
                                        </select>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Category:</label>
                                        <select name="ddlCategory" class="form-control">
                                        <?php
                                            while($row = $res -> fetch_assoc() ){
                                                $x = $row['name'];
                                                echo "<option value=".$row['name'];
                                                if(!empty($menu_item['Category'])&&$menu_item['Category']=='$x'){echo 'Selected';}
                                                echo ">".$row['name']."</option>";
                                            }

                                            ?>
                                        

                                        </select>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Image:</label>
                                        <input type="file" class="form-control" id="img" name="img">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Time Required:</label>
                                        <input type="text" class="form-control" id="time" name="time" required  value="<?php echo $menu_item['time']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Spice Level:</label>
                                        <select name="ddlspiceLevel" class="form-control">
                                            <option value="1" <?php if(!empty($menu_item['spice_level'])&&$menu_item['spice_level']=='1'){echo 'Selected';} ?>>Low(1)</option>
                                            <option value="2" <?php if(!empty($menu_item['spice_level'])&&$menu_item['spice_level']=='2'){echo 'Selected';} ?>>Medium(2)</option>
                                            <option value="3" <?php if(!empty($menu_item['spice_level'])&&$menu_item['spice_level']=='3'){echo 'Selected';} ?>>High(3)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                
                                <?php }
                                    ?>
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
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

</body>

</html>
