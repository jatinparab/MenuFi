<?php
$conn = mysqli_connect("localhost","root", "", "menufi");

?>

<?php foreach($orders as $order){ ?>
<table class="table table-responsive table-hover table-sm" id="MenuTable">
    <thead>
        <tr>
           
                <!-- <form method="post" action="served"> -->
                <h2>Order Number: <?php echo $odi = $order[0]->Order_id;?> 
                <?php 
                $sq = "SELECT * FROM order_status WHERE Order_id='$odi'";
                $re = $conn -> query($sq);
                $ro = $re -> fetch_assoc();
                if($ro['seen']){

                
                
                ?>
                <small>(Under Preparation)</small>

                <?php } ?>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="<?php echo base_url(); ?>index.php/Admin/served?oid=<?php echo $order[0]->Order_id;?>&tid=<?php echo $order[0]->Table_id; ?>">   
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> &nbsp Serve
                </button>
                <!-- </form> -->
               </a>
    <?php if(!$ro['seen']){ ?>
                  
                <button onclick="seen('<?php echo $odi ?>')" class="btn btn-info">
                    <span class="glyphicon glyphicon-eye-open"></span> &nbsp Seen
                </button>
                <!-- </form> -->
               
    <?php } ?>

                <a href="<?php echo base_url(); ?>index.php/Admin/refund?oid=<?php echo $order[0]->Order_id;?>">   
                <button type="submit" class="btn btn-default" style="background-color: grey ">
                    <span class="glyphicon glyphicon-record" style="color: white"></span> &nbsp <font color="white">Void</font>
                </button>
                <!-- </form> -->
               </a>
               
            <th> 
                <h3>Table No:<?php echo $order[0]->Table_id;?></h3>
            </th>
            <th colspan="5">
                <h3>Instructions:<?php echo $order[0]->comments=="comments"?" ":$order[0]->comments;?></h3>
            </th>
        </tr>
        <tr>
            <th>Sr.No</th>
            <th>Name </th>
            <th>Spice Level</th>
            <th>Quantity</th>
            <th>Addons</th>
             <th>Batter</th> 
            <th>Time Required</th>
            <th>Time Order Placed</th>
            <!--<th>Dish Serve</th>-->
        </tr>
    </thead>
    <tbody>
        <?php	foreach($order as $order_item) { ?>
        <tr class="
        <?php 
                        date_default_timezone_set("Asia/Kolkata");
                        $x = new DateTime($order_item->Timestamp);
                        
                        $now = new DateTime();
                        //print_r($now);
                         $y=$x->diff($now);
                         if($y->h>0 || $y->i>0){
                             echo "OverDue";
                         }
        ?>"
        
        name="<?php echo $order_item->Menu_Id;?>">
            <td><?php echo $order_item->Menu_Id;?>
        
        
        </td>
            <td><?php //echo $order_item->Quantity;?> <strong><?php echo $order_item->Name;?></strong></td>
            <td>
                <?php
                $spice_level = "";
                if (isset($order_item->co_spice_level) && !empty($order_item->co_spice_level)) {
                    $sl = $order_item->co_spice_level;
                    switch ($sl) {
                        case 1:$spice_level = "Low";
                        break;

                        case 2:$spice_level = "Medium";
                        break;

                        case 3:$spice_level = "High";
                        break;

                        default:$spice_level = "N/A";
                        break;
                    }
                }
                else{
                    $sl = $order_item->m_spice_level;
                    switch ($sl) {
                        case 1:$spice_level = "Low";
                        break;

                        case 2:$spice_level = "Medium";
                        break;

                        case 3:$spice_level = "High";
                        break;

                        default:
                        $spice_level = "N/A";
                        break;
                    } 
                }
                echo $spice_level;
                ?>
            </td>
            <?php
            if($order_item->Quantity) { ?>
            <td><?php echo $order_item->Quantity;?></td>
            <?php
        }
        else
            { ?>
                <!-- <td>None</td> -->
                <?php	}
		if($order_item->Addons != null) { ?>
                <td><?php 
                
                $y  = $order_item->Addons;
									$arr = explode(',', $y);
									foreach($arr as $a){
										$sql = "SELECT * FROM ingredients WHERE Ingredients_id='$a'";
										$res = $conn -> query($sql);
										$row = $res -> fetch_assoc();
										echo $row['Name']."<br>";
									}
                
                ?>
                </td>
                <?php
            }
            else
                { ?>
                    <td>"No Addons"</td>
                    <?php	}
                    ?>
				<!-- <td><i class="icon-inr"> </i><?php 
				$total = (float)$order_item->Price*(float)$order_item->Quantity;
				//echo $total+($total*0.18);
                ?></td> -->
                
                <td>
                    <?php 
                        $x = $order_item ->Batter;
                        $sql = "SELECT * FROM batter WHERE id='$x'";
                        $res = $conn -> query($sql);
                        $row = $res -> fetch_assoc();
                        echo $row['name'];
                    
                    ?>


                </td>
				<td>
                    <?php echo ($order_item->time)." Minutes";
                        //echo (print_r($order_item));
                        
                    ?>
                </td>
                <td>
                    <?php 
                    
                        
                        //print_r($x);
                        echo $y=date("H:i:s",strtotime($order_item->Timestamp));

        
         //echo "OVER:".$y;
         //if($y>0){
           //  echo "OverDue";
         //}
        
        
                    ?>

                </td>
                <!--
                <td><button href="#" class="btn btn-success btn-sm" onclick="document.getElementById('myImage').src='white.png'>
                <span class="glyphicon glyphicon-ok"></span> Served
                <img id="myImage" src="image.png" /> 
                 <script type="text/javascript">
                     
                 </script> 
                 </button>-->
                   
             </td>
			</tr>
                <?php	}
                ?>
                <?php
            }
        ?>
    </tbody>

</table>
