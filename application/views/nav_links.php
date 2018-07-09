<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
					<?php if($_SESSION['user_type'] != 'chef'){ ?>
                        <li class="sidebar-search">
                            <!-- <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div> -->
                            <!-- /input-group -->
                            <h3 style="color:white;"><?php $uname = $_SESSION['User']; echo 'Hello ,'.$uname;?></h3>
                        </li>
						
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/DineIn"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/tableStatus"><i class="fa fa-dashboard fa-fw"></i> Table Status</a>
                        </li>
                         <?php }?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/kitchen_dashboard"><i class="fa fa-dashboard fa-fw"></i> Kitchen Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/addExpenses"><i class="fa fa-money fa-fw"></i> Add Expenses</a>
                        </li>
						<?php if($_SESSION['user_type'] != 'chef'){ ?>
                     
                        
                        <!-- <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Manual Order<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>index.php/Admin/DineIn">Dine In</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>index.php/Admin/TakeAway">Take Away</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url();?>index.php/Admin/HomeDelivery">Home Delievery</a>
                                </li>
                            </ul>
                        </li> -->
                        
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Inventory<span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>index.php/Admin/inventory">View Inventory</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>index.php/Admin/out_of_stock">Out Of Stock Items</a>
                                </li>
                            </ul>
                        </li>
						<?php if($_SESSION['user_type'] != 'Manager'){ ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Menu<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/addMenuItems">Add Menu</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/allMenu">Edit/Update Menu</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/allMenu">Delete Menu</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/manageCategories">Manage Categories</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/manageBatter">Manage Batter</a>
                                </li>

                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/v_menu_ing">Manage Ingredients in Menu</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/v_menu_ing">Manage Addons in Menu</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php } ?>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Sales Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sales_execReport"><i class="fa fa-edit fa-fw"></i> Sales Execution Report</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sales_daily_reports"><i class="fa fa-edit fa-fw"></i> Daily Sales Report</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sr_weekly"><i class="fa fa-edit fa-fw"></i> Weekly Sales Reports</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sr_monthly"><i class="fa fa-edit fa-fw"></i> Monthly Sales Reports</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sales_labourReports"><i class="fa fa-edit fa-fw"></i> Labour Reports</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sales_pmr"><i class="fa fa-edit fa-fw"></i> Product mix and menu Reports</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sales_accReports"><i class="fa fa-edit fa-fw"></i> Accounting Reports</a>
                                </li>
                                
                                 <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/sales_rewardsReport"><i class="fa fa-edit fa-fw"></i> Gift Cards and Rewards Report</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/staffView"><i class="fa fa-edit fa-fw"></i> Staff Management<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/staffAdd">Add Staff</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/staffEdit">Edit/Update Staff Info</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/staffDel">Remove Staff</a>
                                </li>
                             
                            </ul>
                            <!-- /.nav-second-level -->

                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/cashOrder"><i class="fa fa-fw fa-mobile-phone"></i>Order Payments</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/viewDetailFeedback"><i class="fa fa-edit fa-fw"></i> View Detail Feedback</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/orderHistory"><i class="fa fa-fw fa-mobile-phone"></i>Order History</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/viewCustomers"><i class="fa fa-edit fa-fw"></i> Customers</a>
                        </li>
                        <!-- lol-->

                                                
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/promotional"><i class="fa fa-send-o fa-fw"></i> Promotional SMS</a>
                        </li>
                              
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Admin/coupons"><i class="fa fa-send-o fa-fw"></i> Coupon Generator</a>
                        </li>
                        
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/v_updateLogo">Add/Update Logo</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/v_updateBackgroundImage">Add/Update Background Image</a>
                                </li>
                                 <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/v_setFont">Set Font</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/Admin/reset_settings" onclick="return confirm('Are you sure you want to reset the font and background image setting?')">Reset Settings</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->

                        </li>
						<?php }?>
<!--                        <li>
                            <a href="<?php //echo base_url(); ?>/index.php/Admin/inventory"><i class="fa fa-edit fa-fw"></i> Customers</a>
                        </li>-->
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                <br><br>
            </div>
