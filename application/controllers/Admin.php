<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Admin extends CI_Controller {

	 function __construct()

    {

        parent::__construct();

		$this->load->database();

//                redirect('./Admin/login', 'refresh');
    }
    
    public function v_editAddon($id){
        if(isset($id)){
            $res['ing_details']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
where mir.addons=1 and mir.id=$id")->result_array();
            $this->load->view("edit_menu_addon_mapping",$res);
			$this->load->view('footer');
        }
    }
    public function addItem_ajax(){
        $customer_id = $_GET['customer_id'];
        $menu_id = $_GET['id'];
        $res = $this -> db -> query("SELECT * FROM fake_order WHERE Menu_id='$menu_id'") -> result_array();
        if(count($res)>0){
            if($res[0]['addon'] == '' && $res[0]['batter'] == 0){
                $quantity = (int)$res[0]['Quantity'];
                $quantity+=1;
                $re = $this -> db -> query("UPDATE fake_order SET Quantity='$quantity' WHERE Menu_id='$menu_id'");
                if(isset($re)){
                    echo 'success';
                }
            }else{
                //echo "yes";
                $re = $this -> db -> query("INSERT into fake_order (Menu_id,Customer_id,Quantity,batter) VALUES ('$menu_id','$customer_id','1','0')");
                if(isset($re)){
                    echo 'success';
                }else{
                    $this -> db -> error();
                }
            }
        }else{
            $re = $this -> db -> query("INSERT into fake_order (Menu_id,Customer_id,Quantity,batter) VALUES ('$menu_id','$customer_id','1','0')");
                if(isset($re)){
                    echo 'success';
                }else{
                    $this -> db -> error();
            }
        }
    }
    public function changeBatter_ajax(){
        $id = $_GET['id'];
        $batter_id = $_GET['batter_id'];
        $re = $this -> db -> query("UPDATE fake_order SET batter = '$batter_id' WHERE id = '$id'");
        if(isset($re)){
            echo 'success';
        }
    }
    public function addAddon_ajax(){
        $id = $_GET['id'];
        $addon_id = $_GET['addon_id'];
        
            $res = $this -> db -> query("SELECT * FROM fake_order WHERE id='$id'")->result_array();
            $array = $res[0]['addon'];
            $array = explode(',', $array); 
            $array = array_filter($array);
            array_push($array,$addon_id);
            $str = implode (", ", $array);            
            $res2 = $this -> db -> query("UPDATE fake_order SET addon = '$str' WHERE id='$id'");
            if(isset($res2)){
                echo 'success';
            }
        
    }
    public function removeAddon_ajax(){
        $id = $_GET['id'];
        $res = $this -> db -> query("UPDATE fake_order SET addon = '' WHERE id='$id'");
        if(isset($res)){
            echo 'success';
        }
    }
    public function getFake(){
        $this->load->model('Admin_model');
        $fake = $this->Admin_model->get_fake();
        
        if(isset($fake) && !empty($fake)){
          //  print_r($fake);
            $response = '
            <thead>
																			<th class="hidden" >Item ID</th>
                                                                            <th>Item Name</th>
                                                                            
																			<th>Quantity</th>
                                                                            <th> Addons </th>
                                                                            <th > Add Addon </th>
                                                                            
                                                                            <th>Price</th>
                                                                            <th>Remove</th>
                                                                         
																		</thead>';
                                                                        
            foreach ($fake as $value) {
        
                              $response .= '<tr style="padding:100px;">
                                    <td class="hidden">
                                        
                                        <input type="hidden" name="Menu_id[]" value="'.$value['Menu_id'].'" class="form-control">'.$value['Menu_id'].'
                                    </td><td>';
                                    $x = $value['Menu_id'];
                                    $t = $this -> db -> query("SELECT * FROM menu WHERE Menu_Id='$x'")->result_array()[0];
                                    $base_price = $t['Price'];
                               $response .=       $value['name'].
                                        '<input type="hidden" name="name[]" value="'.$value['name'].'" class="form-control">
                                    </td>
                                    
                                    <td>';
                                     $response .=   '<div class="input-group">
                                            <input type="number" onchange="editItem(\''.$value['id'].'\',this.value)" id="quantity" name="quantity[]" class="form-control input-number" value="'.$value['quantity'].'"
                                            min="0" max="100">
                                        </div>
                                    </td>
                                    <td>';
                                         $he = $value['id'];
                    $v = $value['quantity'];
                    $raw = $this -> db -> query("SELECT * FROM fake_order WHERE id='$he' AND Quantity='$v'") -> result_array();
                    //print_r($raw[0]);
                    $response .= '
                
                                        <input type="hidden" name="addon[]" value="'.$raw[0]['addon'].'" class="form-control">';
                                        
                //$x = substr($raw['addon'], 0, -1);
                //echo $x;
                $arr = explode(',',$raw[0]['addon']);
                $arr = array_filter($arr);
                $addon_price = 0;
                if(count($arr)>0){
                    foreach($arr as $val){
                        
                        $ra = $this -> db -> query("SELECT * FROM ingredients WHERE Ingredients_id = '$val'") -> result_array();
                        $addon_price += $ra[0]['cost']; 
                        
                        $response .= $ra[0]['Name']."<br>";
                        
                    }
                    $response .= '<a onclick="removeAddon(\''.$value['id'].'\')" class="btn btn-xs btn-danger">Clear</a>';
                }
               
              $response .= '
                                    </td>
                                    <td><select onchange="addAddon(\''.$value['id'].'\',this.value)" style="max-width:75px;">
                                    ';
                                    
                                    $bha = $this -> db -> query("SELECT * FROM ingredients") -> result_array();
                                    $response .= '<option value="-1">None</option>';
                                    foreach($bha as $b){
                                        $response .= '<option value="'.$b['Ingredients_id'].'">'.$b['Name'].'</option>';
                                    }
                                    
                              
                                   
                                   
                                        
                                        
                                           
                                    //print_r($value);
                                   
            
                                    
                                    $xy  =(int)$base_price + (int) $addon_price;
                                    $response .=
                                    '</select>
                                    </td>
                                    <td>
                                        '.$xy.'
                                    </td>
                                    <td><a class="btn btn-sm btn-danger" onclick="removeItem(\''.$value['id'].'\')">X</a></td>
                                </tr>';
                                 }
                                 echo $response;
        }else{
            echo "No Item added Yet";
        }
    }
    public function refund(){
        $id = $_GET['oid'];
        $res = $this->db->query("update sales set refund='1' where Order_id='$id'");
        if($res){
            $res2 = $this->db->query("update order_status set status='4' where Order_id='$id'");
            if($res2){
                echo '<script>alert("Order reverted"); window.location.href="' . base_url() . 'index.php/Admin/kitchen_dashboard";</script>';
            }
        }
    }
    
    public function updateMenuAddonMapping(){
        if(isset($_POST['hd_mir_id']))
        {
            $hd_mir_id = $_POST['hd_mir_id'];
            
           
           $qty = $_POST['QtyRequired'];
           
           $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty where id=$hd_mir_id");
               if($update_mapping){
                   echo '<script>alert("Addon updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
               }
               else{
                echo '<script>alert("Error updating Addon! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

               }
           
        }
    }
    
    public function deleteAddon($id){
        if(isset($id)){
           $delete_mapping = $this->db->query("delete from menu_ingridient_rel where id=$id");
               if($delete_mapping){
                   echo '<script>alert("Addon removed from Menu!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
               }
               else{
                echo '<script>alert("Error removing Addon! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

               } 
        }
    }
	
	public function deleteBatter($id){
		
		
        if(isset($id)){
           $delete_mapping = $this->db->query("delete from menu_ingridient_rel where id=$id");
               if($delete_mapping){
                   echo '<script>alert("Batter removed from Menu!"); window.location.href="' . base_url() . 'index.php/Admin/manageBatter";</script>'; 
               }
               else{
                echo '<script>alert("Error removing Batter! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/manageBatter";</script>'; 

               } 
        }
    }


    public function v_editIng($id){
        if(isset($id)){
            $res['ing_details']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
where mir.addons!=1 and mir.id=$id")->result_array();
            $this->load->view("edit_menu_ing_mapping",$res);
			// echo $this->load->view('footer','',true);
        }
    }
    
    public function updateMenuIngMapping(){
        
        if(isset($_POST['hd_mir_id']))
        {
            $hd_mir_id = $_POST['hd_mir_id'];
            $ing_type=0;
           
           $qty = $_POST['QtyRequired'];
           $isOptional = !empty($_POST['isOptional'])?$_POST['isOptional']:false;
           if($isOptional){
               $ing_type = 2;
           }
           else{
               $ing_type = 0;
           }
           $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty, addons=$ing_type where id=$hd_mir_id");
               if($update_mapping){
                   echo '<script>alert("Ingredients updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
               }
               else{
                echo '<script>alert("Error updating Ingredients quantity! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

               }
           
        }
    }
    
    public function deleteIng($id){
		
        if(isset($id)){
           $delete_mapping = $this->db->query("delete from menu_ingridient_rel where id=$id");
               if($delete_mapping){
                   echo '<script>alert("Ingredient removed from Menu!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
               }
               else{
                echo '<script>alert("Error removing Ingredients! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

               } 
        }
    }
    
    public function v_menu_ing(){
            $res['ing'] = $this->db->query("select * from ingredients")->result_array();
    $res['menu'] = $this->db->query("select * from menu")->result_array();
    
    $res['mapped_ing']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
where mir.addons!=1")->result_array();
    
    $res['mapped_addons']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
where mir.addons=1")->result_array();
    $this->load->view("menu_ing_mapping",$res);
	$this->load->view('footer');

    }
	
	public function manageBatter(){
    $res['ing'] = $this->db->query("select * from ingredients")->result_array(); 
    $res['menu'] = $this->db->query("select * from menu")->result_array();
	$res['batters'] = $this->db->query("select * from batter")->result_array();
    
    $res['mapped_ing']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
where mir.addons!=1")->result_array();
    
    /* $res['mapped_batters']=$this->db->query("select m.Menu_Id,m.Name, i.Ingredients_id, mir.id, b.name as b_name,mir.quantity_rel,mir.batters from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join batter b on (mir.Ingredients_id = b.id)
where mir.addons=1")->result_array();  */
$res['mapped_addons']=$this->db->query("select mir.id as mirid,m.Menu_Id,m.Name, b.id,b.name as batters_name,mir.quantity_rel,mir.addons from
menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
join batter b on (mir.Ingredients_id = b.id)
where mir.addons=1")->result_array();
    $this->load->view("manageBatter",$res);
	$this->load->view('footer');

    }
	
    
    public function addMenuIngMapping(){
      // print_r($_POST);
      // echo $_POST['ddlMenu'];
      // echo $_POST['ddlIng'];

        // if(isset($_POST['ddlMenu']) && isset($_POST['ddlIng'])){
            // $ing_type => 0-mandatory, 2-optional, 1- set it as addon
          $return = FALSE;
            $ing_type=0;
           $ddlMenu = $_POST['ddlMenu'];

           $car = $_POST['car'];
           // $qty_all = $_POST['QtyRequired'];
           // $addonPrice_all = $_POST['addonPrice'];
           // $isOptional_all = $_POST['isOptional'];

           foreach ($car as $key => $value)
           {
                $ddlIng = $value['ddlIng'];
                $qty = $value['QtyRequired'];
                $addonPrice = $value['addonPrice'];
                $isOptional = isset($value['isOptional'])?$value['isOptional']:'';

                $isOptional = !empty($isOptional)?$isOptional:false;
                 if($isOptional){
                     $ing_type = 2;
                 }
                 else{
                     $ing_type = 0;
                 }
             
               $check_mapping = $this->db->query("select * from menu_ingridient_rel where Menu_id=$ddlMenu and Ingredients_id=$ddlIng");
               if($check_mapping->num_rows()>0){
                   //mapping is there; update it
                   $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty, addon_price=$addonPrice, addons=$ing_type where Menu_id=$ddlMenu and Ingredients_id=$ddlIng");
                   if($update_mapping){
                      $return = TRUE;
                       // echo '<script>alert("Ingredients updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
                   }
                   else{
                      $return = FALSE;
                    // echo '<script>alert("Error updating Ingredients quantity! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

                   }
               }
               else{
                   //add mapping;
                   $add_mapping = $this->db->query("insert into menu_ingridient_rel(Menu_id,Ingredients_id,quantity_rel,addons,addon_price) values($ddlMenu,$ddlIng,$qty,$ing_type,$addonPrice)");
                   if($add_mapping){
                      $return = TRUE;
                       // echo '<script>alert("Ingredients added for this Menu Item!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
                   }
                   else{
                      $return = FALSE;
                    // echo '<script>alert("Error adding Ingredients! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

                   }
               }
           }

          if($return)
          {
            echo '<script>alert("Ingredients updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
          }
          else
          {
            echo '<script>alert("Error adding Ingredients! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
          }
        // }
    }
    
    public function addMenuAddonMapping(){
		
        if(isset($_POST['ddlMenu']) && isset($_POST['ddlAddons'])){
			
            $flag=0;
            $ddlMenu = $_POST['ddlMenu'];
           $ddlAddons = $_POST['ddlAddons'];
		   $addonPrice = $_POST['addonPrice'];
           $qty = $_POST['QtyRequired'];
           
               $check_addons_mapping = $this->db->query("select * from menu_ingridient_rel where Menu_id=$ddlMenu and Ingredients_id=$ddlAddons and addons=1");
               if($check_addons_mapping->num_rows()>0){
                   //mapping found; update mapping;
                    $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty where Menu_id=$ddlMenu and Ingredients_id=$ddlAddons and addons=1 and addon_price=$addonPrice");
                    if($update_mapping)
                    {
                        echo '<script>alert("Addons updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
                    }
                    else{
                        echo '<script>alert("Error updating Addons! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
                    }
               }
               else{
                   //add mapping
				   /* $gsdfvgh = "insert into menu_ingridient_rel(Menu_id,Ingredients_id,quantity_rel,addons, addon_price) values($ddlMenu,$ddlAddons,$qty,1,$addonPrice)"; */
				   
                   $add_mapping = $this->db->query("insert into menu_ingridient_rel(Menu_id,Ingredients_id,quantity_rel,addons, addon_price) values($ddlMenu,$ddlAddons,$qty,1,$addonPrice)");
                    if($add_mapping)
                    {
                        echo '<script>alert("Addons added!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
                    }
                    else{
                        echo '<script>alert("Error adding Addons! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
                    }
               }
               
           
           
        }
    }
	
	
	public function addMenubatterMapping(){
        if(isset($_POST['ddlMenu']) && isset($_POST['ddlBatters'])){
            $flag=0;
            $ddlMenu = $_POST['ddlMenu'];
           $ddlBatters = $_POST['ddlBatters'];
           $ddlAddons = $_POST['ddlAddons'];
		   $qty = $_POST['QtyRequired'];
           
               $check_addons_mapping = $this->db->query("select * from menu_ingridient_rel where Menu_id=$ddlMenu and batters = $ddlBatters and Ingredients_id=$ddlAddons and addons=1");
               if($check_addons_mapping->num_rows()>0){
                   //mapping found; update mapping;
                    $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty where Menu_id=$ddlMenu and Ingredients_id=$ddlAddons and batters = $ddlBatters and addons=1");
                    if($update_mapping)
                    {
                        echo '<script>alert("Batters updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
                    }
                    else{
                        echo '<script>alert("Error updating Batters! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>';
                    }
               }
               else{
                   //add mapping
                   $add_mapping = $this->db->query("insert into menu_ingridient_rel(Menu_id,Ingredients_id,quantity_rel,addons) values($ddlMenu,$ddlAddons,$qty,1)");
                    if($add_mapping)
                    {
                        echo '<script>alert("Batters added!"); window.location.href="' . base_url() . 'index.php/Admin/manageBatter";</script>';
                    }
                    else{
                        echo '<script>alert("Error adding Batters! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/manageBatter";</script>';
                    }
               }
               
           
           
        }
    }
    
    public function sales_restSales()
    {
    	$this->load->view("sales_restSales");
    	$this->load->view('footer');
    }

    public function sales_restSales_ajax(){
        $from = $this->input->post('fromday');
        $to = $this->input->post('today');
        $gross_profit = array(
            "January" => 0,
            "February" => 0,
            "March" => 0,
            "April" => 0,
            "May" => 0,
            "June" => 0,
            "July" => 0,
            "August" => 0,
            "September" => 0,
            "October" => 0,
            "November" => 0,
            "December" => 0,
          );
        
          $net_profit = array(
            "January" => 0,
            "February" => 0,
            "March" => 0,
            "April" => 0,
            "May" => 0,
            "June" => 0,
            "July" => 0,
            "August" => 0,
            "September" => 0,
            "October" => 0,
            "November" => 0,
            "December" => 0,
          );
          $customers = array(
            "January" => 0,
            "February" => 0,
            "March" => 0,
            "April" => 0,
            "May" => 0,
            "June" => 0,
            "July" => 0,
            "August" => 0,
            "September" => 0,
            "October" => 0,
            "November" => 0,
            "December" => 0,
          );
        
          $orders = array(
            "January" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "February" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "March" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "April" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "May" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "June" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "July" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "August" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "September" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "October" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "November" => array("Card"=>0,"Cash"=>0,"Online"=>0),
            "December" => array("Card"=>0,"Cash"=>0,"Online"=>0),
          );
        
        //   $sql = "SELECT * FROM customers";
          $res = $this-> db -> query("SELECT * FROM customers WHERE Last_Visited BETWEEN '$from' AND '$to'");
          if($res){
            foreach($res->result_array() as $row){
              $r = $row['Last_Visited'];
              $month = date('F',strtotime($r));
              $customers[$month] += 1;
            }
          }
        
        
        //   $sql = "SELECT * FROM sales WHERE refund='0'";
          $res = $this-> db -> query("select * from sales where refund ='0' and Timestamp between '$from' and '$to'");
          if($res){
            foreach($res->result_array() as $row){
              $ro = $row['Timestamp']; 
              $month = date('F', strtotime($ro));
              $gross_profit[$month] += $row['net_total'];
            }
            
          }
        
        //   $sql = "SELECT * FROM payment_details";
          $res = $this -> db -> query("select * from payment_details where added_date between '$from' and '$to'");
          if($res){
            foreach($res->result_array() as $row){
              $ro = $row['added_date']; 
                $type = $row['payment_type'];
              $month = date('F', strtotime($ro));
              $orders[$month][$type] += 1;
            }
            
          }
        
          //print_r($orders);
        
        
        //   $sql = "SELECT * FROM ingredients";
          $res =$this->db->query("SELECT * FROM ingredients");
          $expenses = 0;
          if($res){
            foreach($res->result_array() as $row){
              $expenses += ($row['quantity'] * $row['cost']);
            }
          }
          foreach($gross_profit as $k => $v){
            if($v>0){
              $net_profit[$k] = $gross_profit[$k] - $expenses;
            }
        
          }

          $final_array = [$customers,$gross_profit,$orders];
          echo json_encode($final_array);
    }

    public function sales_execReport()
    {
    	$this->load->view("sales_execReport");
    	$this->load->view('footer');
    }

     public function sales_labourReports()
    {
    	$this->load->view("sales_labourReports");
    	$this->load->view('footer');
    }

     public function sales_pmr()
    {
    	$this->load->view("sales_pmr");
    	$this->load->view('footer');
    }

    public function sales_accReports(){
        $res['ing'] = $this->db->query("select * from ingredients")->result_array(); 
		$res['menu'] = $this->db->query("select * from menu")->result_array();
		$res['batters'] = $this->db->query("select * from batter")->result_array();
		
		$res['mapped_ing']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
		menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
		join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
		where mir.addons!=1")->result_array();
		
		$res['mapped_addons']=$this->db->query("select mir.id,m.Menu_Id,m.Name, i.Ingredients_id,i.Name as ing_name,mir.quantity_rel,mir.addons from
		menu m join menu_ingridient_rel mir on (m.Menu_Id = mir.Menu_id)
		join ingredients i on (mir.Ingredients_id = i.Ingredients_id)
		where mir.addons=1")->result_array();
		$this->load->view("sales_accReports",$res);
		$this->load->view('footer');

	}
	 public function saleexe_report_export()
     {
	    $res['ing'] = $this->db->query("select * from ingredients")->result_array(); 
		$this->load->view("saleexe_report_export");
		

     }


     public function sales_guestBehaviour()
    {
    	$this->load->view("sales_guestBehaviour");
    	$this->load->view('footer');
    }
    public function sales_guestBehaviour_ajax(){
        $from = $this->input->post('fromday');
        $to = $this->input->post('today');
        // $data = $this->db->query("select * from payment_details where added_date between '$from' and '$to'")->result_array();
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
        $orders = array(
            'Sunday'=>array('Cash'=>0,'Card'=>0,'Online'=>0),
            'Monday'=>array('Cash'=>0,'Card'=>0,'Online'=>0),
            'Tuesday'=>array('Cash'=>0,'Card'=>0,'Online'=>0),
            'Wednesday'=>array('Cash'=>0,'Card'=>0,'Online'=>0),
            'Thursday'=>array('Cash'=>0,'Card'=>0,'Online'=>0),
            'Friday'=>array('Cash'=>0,'Card'=>0,'Online'=>0),
            'Saturday'=>array('Cash'=>0,'Card'=>0,'Online'=>0)
        );
        $res = $this->db->query("select * from payment_details where added_date between '$from' and '$to'");
        if($res){
            foreach ($res->result_array() as $row) {
                $ro = $row['added_date'];
                $type = $row['payment_type'];
                $week = date('l', strtotime($ro));
                $orders[$week][$type] += 1;
            }
            
        }
        $res = $this->db->query("select * from sales where refund ='0' and Timestamp between '$from' and '$to'");

        $total = 0;
        $c = 0;
        if($res){
            // while($row = $res -> fetch_assoc()){
            // $ro = $row['Timestamp']; 
            // $day = date('l', strtotime($ro));
            // $avg_bill_amount_total[$day] += $row['net_total'];
            // $avg_bill_amount_number[$day] += 1;
            // }
            foreach($res->result_array() as $row)
            {
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
        $finalarray = [$orders,$avg_bill_amount,$avg_freq_visit];
        echo json_encode($finalarray);
    }
     public function sales_rewardsReport()
    {
    	$this->load->view("sales_rewardsReport");
    	$this->load->view('footer');
    }

    /* public function v_sr_yearly(){
        // sr = sales report
        $this->load->model('Admin_model');
        $data['salesByYear'] = $this->Admin_model->salesByYear();
        $this->load->view("sr_yearly",$data);
		$this->load->view('footer');
    }
    
    public function v_sr_half_yearly(){
        // sr = sales report
        $this->load->model('Admin_model');
        $data['salesByHalfYear'] = $this->Admin_model->salesByHalfYear();
        $this->load->view("sr_half_yearly",$data);
		$this->load->view('footer');
    }
    
    public function v_sr_quarterly(){
        // sr = sales report
        $this->load->model('Admin_model');
        $data['salesByQuarter'] = $this->Admin_model->salesByQuarter();
        $this->load->view("sr_quarterly",$data);
		$this->load->view('footer');
    }
    
    public function v_sr_monthly(){
        // sr = sales report
        $this->load->model('Admin_model');
        $data['salesByMonth'] = $this->Admin_model->salesByMonths();
        $this->load->view("sr_monthly",$data);
		$this->load->view('footer');
    }
    
    public function v_sr_weekly(){
        // sr = sales report
        $this->load->model('Admin_model');
        $data['salesByWeek'] = $this->Admin_model->salesByWeek();
        $this->load->view("sr_weekly",$data);
		$this->load->view('footer');
    }
     */
    public function staffView()
    {
        $data['staff_details'] = $this->db->query("select id, name, salary, shifts, chores, table_no from staff_management")->result(); 
    	$this->load->view("staffView",$data);
    	$this->load->view('footer');
    }

     public function staffAdd()
    {
    	$this->load->view("staffAdd");
    	$this->load->view('footer');
    }
    public function stfadd(){
        $data['name'] = $_POST['name'];
        $data['salary'] = $_POST['salary'];
        $data['shifts'] = $_POST['shift'];
        $data['chores'] = $_POST['chores'];
        //echo $name.'<br>'.$salary.'<br>'.$shifts.'<br>'.$chores;
        $this->load->model('Admin_model');
        $success = $this->Admin_model->insertIntoStaff($data);
        if($success){
            echo '<script>alert("Staff Added into the System.");window.location.href="'.base_url().'index.php/Admin/staffAdd";</script>';    
        }

    }

    public function ajax_Deliver(){
        $data['id'] = $_GET['id'];
        $this->load->view("ajax_senddelivery.php",$data);
    }

    public function ajax_removeItem(){
        $id = $_POST['id'];
        $this->load->model('Admin_model');
        $success = $this->Admin_model->removeItemF($id);
        if($success==1){
            echo 'success';
        }
    }
    public function ajax_editItem(){
        $id = $_POST['id'];
        $value = $_POST['value'];
        $this->load->model('Admin_model');
        $success = $this->Admin_model->editItemF($id,$value);
        if($success==1){
            echo 'success';
        }
    }
    public function stfUpdate(){
        $data['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['salary'] = $_POST['salary'];
        $data['shifts'] = $_POST['shift'];
        $data['chores'] = $_POST['chores'];
        $this->load->model('Admin_model');
        $success = $this->Admin_model->stfUpdate($data);
        if($success == 1){
            echo '<script>alert("Staff details Updated.");window.location.href="'.base_url().'index.php/Admin/staffEdit";</script>';
        }
    }

     public function staffDel()
    {
        $data['staff_details'] = $this->db->query("select id, name, salary, shifts, chores, table_no from staff_management")->result(); 
        $this->load->view("staffDel",$data);
    	$this->load->view('footer');
    }
    public function stfdelete(){
        $data['id'] = $_POST['id'];
        $this->load->model('Admin_model');
        $success = $this->Admin_model->stfdel($data);
        if($success){
            echo '<script>alert("Deleted staff Details!.");window.location.href="'.base_url().'index.php/Admin/staffDel";</script>';
        }
    }

     public function staffEdit()
    {
        $data['staff_details'] = $this->db->query("select id, name, salary, shifts, chores, table_no from staff_management")->result(); 	
        $this->load->view("staffEdit",$data);
    	$this->load->view('footer');
    }

   public function staffEdit1()
    {
        $data['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['salary'] = $_POST['salary'];
        $data['shifts'] = $_POST['shifts'];
        $data['chores'] = $_POST['chores'];
        $this->load->view("staffEdit1",$data);
        $this->load->view('footer');
    } 

    public function reset_settings(){
        $check = $this->db->query("SELECT * from fonts where is_active = 1");
        if($check->num_rows()>0){
            //make it 0
           $status1 = $this->db->query("update fonts set is_active = 0 where is_active=1"); 
        }
        
        $bg_check = $this->db->query("select * from background_image");
        if($bg_check->num_rows()>0){
            //make it table_bg
           $status1 = $this->db->query("update background_image set img_name = 'table_bg.png'"); 
        }
        echo '<script>alert("Settings has been reset.");window.location.href="'.base_url().'index.php/Admin/dashboard";</script>';
        
    }
    
    public function v_setFont(){
        $res['fonts'] = $this->db->query("select * from fonts")->result_array();
        $this->load->view("setFont",$res);
		// echo $this->load->view('footer','',true);
    }
    
    public function setFont(){
        if(isset($_POST['fonts'])){
           $fonts = $_POST['fonts'];
           $check = $this->db->query("select * from fonts where is_active = 1");
           if($check->num_rows()>0){
               //font is there; make its is_active =0 and set new font's is_active = 1
               $check = $check->result_array();
               $old = $check[0]['name'];
              $status1 = $this->db->query("update fonts set is_active = 0 where name='$old'");
              $status = $this->db->query("update fonts set is_active = 1 where name='$fonts'");
                if($status)
                {
                  $data['upload_data'] = 1;  
//                  $this->load->view('setFont', $data, 'refresh'); 
                    echo '<script>alert("Font updated.");window.location.href="'.base_url().'index.php/Admin/v_setFont";</script>';
                }
                else
                {
                   echo '<script>alert("Error updating Font. Please refresh the page & try again.");window.location.href="'.base_url().'index.php/Admin/v_setFont";</script>'; 
//                    $error = array('error' => 'Error updating Font. Please refresh the page & try again.');
//                    $this->load->view('setFont', $error);
                } 
           }
           else{
               //no active fonts found; update current font
                $status = $this->db->query("update fonts set is_active = 1 where name='$fonts'");
                if($status)
                {
//                  $data['upload_data'] = 1;  
//                  $this->load->view('setFont', $data, true); 
                    echo '<script>alert("Font updated.");window.location.href="'.base_url().'index.php/Admin/v_setFont";</script>';
                }
                else
                {
                   echo '<script>alert("Error updating Font. Please refresh the page & try again.");window.location.href="'.base_url().'index.php/Admin/v_setFont";</script>'; 
//                    $error = array('error' => 'Error updating Font. Please refresh the page & try again.');
//                    $this->load->view('setFont', $error);
                } 
           }
        }
        
    }
    
    public function v_updateLogo(){
        $this->load->view("updateLogo");
		// echo $this->load->view('footer','',true);
    }
    
    public function v_updateBackgroundImage(){
        $this->load->view("updateBgImage");
		// echo $this->load->view('footer','',true);
    }
    
    public function updateBackgroundImage(){
        $success = 0;
        if(!empty($_FILES['userfile']['name'])){
            $image = $_FILES['userfile']['name'];
        $config =  array(
                  'upload_path'     => "./images/background/",
                  'allowed_types'   => "gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG",
                  'overwrite'       => TRUE,
                  'max_size'        => "2048000"  // Can be set to particular file size 2MB
//                  'max_height'      => "768",
//                  'max_width'       => "1024"  
                );    
				$this->load->library('upload', $config);
				if($this->upload->do_upload())
				{
                                    $success = 1;
                                    $data = array('upload_data' => $this->upload->data());
//					$this->load->view('updateLogo',$data);
                                        
                                    $check = $this->db->query("select * from background_image");
                                    if ($check->num_rows() > 0) {
                                        //logo present; update it
                                        $status = $this->db->query("update background_image set img_name = '$image'");
                                        if($status)
                                        {
                                          $this->load->view('updateBgImage', $data);  
										  // echo $this->load->view('footer','',true);
                                        }
                                        else
                                        {
                                            $error = array('error' => 'Error updating Image');
                                            $this->load->view('updateBgImage', $error);
											// echo $this->load->view('footer','',true);
                                        }
                                        
                                    } 
                                    else 
                                    {
                                        //insert logo
                                        $status = $this->db->query("insert into background_image(img_name) values('$image')");
                                        if($status)
                                        {
                                          $this->load->view('updateBgImage', $data);  
                                        }
                                        else
                                        {
                                            $error = array('error' => 'Error inserting Image');
                                            $this->load->view('updateBgImage', $error);
                                        }
                                    }
                                }
				else
				{
                                    $success = 0;
                                    $error = array('error' => $this->upload->display_errors());
                                    $this->load->view('updateBgImage', $error);
				}
                                
                                
        }
    }
    
    public function file_view(){
    $this->load->view('updateLogo', array('error' => ' ' ));    
}

    public function updateLogo(){
        $success = 0;
        if(!empty($_FILES['userfile']['name'])){
            $image = $_FILES['userfile']['name'];
        $config =  array(
                  'upload_path'     => "./images/logo/",
                  'allowed_types'   => "gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG",
                  'overwrite'       => TRUE,
                  'max_size'        => "2048000"  // Can be set to particular file size 2MB
//                  'max_height'      => "768",
//                  'max_width'       => "1024"  
                );    
				$this->load->library('upload', $config);
				if($this->upload->do_upload())
				{
                                    $success = 1;
                                    $data = array('upload_data' => $this->upload->data());
//					$this->load->view('updateLogo',$data);
                                        
                                    $check = $this->db->query("select * from logo");
                                    if ($check->num_rows() > 0) {
                                        //logo present; update it
                                        $status = $this->db->query("update logo set img_name = '$image'");
                                        if($status)
                                        {
                                          $this->load->view('updateLogo', $data);  
                                        }
                                        else
                                        {
                                            $error = array('error' => 'Error updating logo');
                                            $this->load->view('updateLogo', $error);
                                        }
                                        
                                    } 
                                    else 
                                    {
                                        //insert logo
                                        $status = $this->db->query("insert into logo(img_name) values('$image')");
                                        if($status)
                                        {
                                          $this->load->view('updateLogo', $data);  
                                        }
                                        else
                                        {
                                            $error = array('error' => 'Error inserting logo');
                                            $this->load->view('updateLogo', $error);
                                        }
                                    }
                                }
				else
				{
                                    $success = 0;
                                    $error = array('error' => $this->upload->display_errors());
                                    $this->load->view('updateLogo', $error);
				}
                                
                                
        }
    }
    
    public function viewCustomers(){
        $data['cust_details_mobile'] = $this->db->query("select 
                                        max(maxCount)as MaxCount,
                                        max(total_quantity) as maxQ,
                                        Mobile,
                                        name,views,Last_Visited from 
                                        (select 
                                        s.Order_id, s.customer_id, s.login_type,
                                        co.Menu_Id, count(m.Menu_Id) as maxCount,sum(co.Quantity) as total_quantity,
                                        c.Last_Visited as Last_Visited,
                                        c.views as views,
                                        c.mobile as Mobile,
                                        m.Name as name
                                        from
                                        sales s 
                                        join customer_order co on (s.Order_id = co.Order_id)
                                        join customers c on (s.customer_id = c.customer_id)
                                        join menu m on (co.Menu_Id = m.Menu_Id)
                                        group by s.customer_id, m.Name
                                        order by maxCount desc,total_quantity desc) as tt
                                        group by Mobile
                                        order by MaxCount desc, maxQ desc")->result();
                                                
        // $data['cust_details_google'] = $this->db->query("select 
        //                                 max(maxCount)as MaxCount,
        //                                 max(total_quantity) as maxQ,
        //                                 Email,
        //                                 name from 
        //                                 (select 
        //                                 s.Order_id, s.customer_id, s.login_type,
        //                                 co.Menu_Id, count(m.Menu_Id) as maxCount,sum(co.Quantity) as total_quantity,
        //                                 c.email as Email,
        //                                 m.Name as name
        //                                 from
        //                                 sales s 
        //                                 join customer_order co on (s.Order_id = co.Order_id)
        //                                 join users c on (s.customer_id = c.id)
        //                                 join menu m on (co.Menu_Id = m.Menu_Id)
        //                                 where s.login_type = 'google'
        //                                 group by s.customer_id, m.Name

        //                                 order by maxCount desc,total_quantity desc) as tt
        //                                 group by Email
        //                                 order by MaxCount desc, maxQ desc")->result();
                                                
        $this->load->view("customers",$data);
		$this->load->view("footer");
    }



     public function viewstaff_management()
     {
        $data['staff_details'] = $this->db->query("select id, name, salary, shifts, chores, table_no from staff_management")->result();
        $this->load->view("staff_management",$data);
    }
     public function staff_management()
     {
      $this->load->view("staff_management");

     }
	 

     public function viewtimer()
     {
       $data['timer_init'] = $this->db->query("time from menu")->result();
       $data['timer_init'] = $timer_init;
       $this->load->view('dashboard',$data);
     }
    
    public function viewDetailFeedback(){
        $data['feedback_mobile']=$this->db->query("SELECT c.customer_id,c.mobile,f.* from customers c join feedback f on (c.customer_id = f.customer_id) and f.login_type = 'mobile' order by f.order_id desc")->result();
        $this->load->view("detailFeedback",$data);
        $this->load->view("footer");
        
    }

public function changePwd(){
    $this->load->view("changePassword");
}


public function addNewUser(){
	
	$Newusername = $_POST['Newusername'];
    $Newpassword = $_POST['Newpassword'];
    $confirmPassword = $_POST['confirmPassword'];
	$user_type = $_POST['user_type'];
	if(empty($Newusername)){
		echo '<script>alert("Please Enter User Name!");</script>'; 
		$this->load->view("changePassword");
		return false;
	}elseif(empty($Newpassword)){
		echo '<script>alert("Please Enter New Password!");</script>'; 
		$this->load->view("changePassword");
		return false;
		
	}elseif(empty($confirmPassword)){
		echo '<script>alert("Please Enter Confirm Password!");</script>';
		$this->load->view("changePassword");
		return false;
		
	}elseif($Newpassword != $confirmPassword ){
		echo '<script>alert("Both password must be same!");</script>';
		$this->load->view("changePassword");
		return false;
		
	}elseif(empty($user_type)){
		echo '<script>alert("Please select User Type!");</script>';
		$this->load->view("changePassword");
		return false;
	}else{
	
        
		$this->load->model('Admin_model');
        //$data['status']=$this->Admin_model->checkPassword($curPwd);
        //if($data['status']){
            $data['msg']=$this->Admin_model->addNewUser($Newusername,$Newpassword,$confirmPassword,$user_type);
            if($data['msg']){
               echo '<script>alert("User added Successfully!"); window.location.href="' . base_url() . 'index.php/Admin/dashboard";</script>'; 
            }
            else{
                echo '<script>alert("Failed to add User!"); window.location.href="' . base_url() . 'index.php/Admin/changePwd";</script>';
            }
        /* }
        else{
            echo '<script>alert("Invalid Existing Password!"); window.location.href="' . base_url() . 'index.php/Admin/changePwd";</script>';
        } */
	}
	
}


public function changePassword(){
    $curPwd = $_POST['curPwd'];
        $newPwd = $_POST['newPwd'];
        //$cnfPwd = $_POST['cnfPwd'];
        
        $this->load->model('Admin_model');
        $data['status']=$this->Admin_model->checkPassword($curPwd);
        if($data['status']){
            $data['msg']=$this->Admin_model->updatePassword($newPwd,$curPwd);
            if($data['msg']){
               echo '<script>alert("Password updated!"); window.location.href="' . base_url() . 'index.php/Admin/dashboard";</script>'; 
            }
            else{
                echo '<script>alert("Error updating Password!"); window.location.href="' . base_url() . 'index.php/Admin/changePwd";</script>';
            }
        }
        else{
            echo '<script>alert("Invalid Existing Password!"); window.location.href="' . base_url() . 'index.php/Admin/changePwd";</script>';
        }
}

    public function dashboard(){
if(!isset($_SESSION['admin_id']))
		{
			redirect('./Admin/login', 'refresh');
		}
//        $d = date('d-M-y');

//        $o = $this->db->query("select count(status) as totalOrders from order_status where Timestamp like '".date('d-m-Y')."%'");

//    $res = $o->result_array();

//    echo $res[0]['totalOrders'];

    redirect('./Admin/DineIn', 'refresh');

    $this->load->model('Admin_model');

    $data['todaysOrders'] = $this->Admin_model->total_orders();

    $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();

    $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
    
    $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
    $data['orders'] = $this->Admin_model->order_list();
    $data['total'] = $this->Admin_model->total_orders();
    $data['query'] = $this->Admin_model->getAllOrder();
    echo $this->load->view('take_order_dineIn', $data, true);   
	echo $this->load->view('footer','',true);
    } 
	
    public function kitchen_dashboard(){
    if(!isset($_SESSION['admin_id']))
	{
		redirect('./Admin/login', 'refresh');
    }
    

    $this->load->model('Admin_model');
    $data['orders'] = $this->Admin_model->order_list();
     echo $this->load->view('Admin_kitchen_orders', $data, true);   
	echo $this->load->view('footer','',true);
    } 

    public function ajax_Seen(){
        $data['id'] = $_GET['id'];
        $this->load->view('ajax_seen',$data);
    }

    public function ajax_getreturn(){
        $data['id'] = $_GET['id'];
        $data['given'] = $_GET['given'];
        $this->load->view('ajax_getR',$data);
    }
	
	public function check_live_order(){
		$this->load->model('Admin_model');
		$orders = $this->Admin_model->order_list();
		if(is_array($orders)){
			if(count($orders)>0){
				$dataLiveOrder = $this->load->view('live_order_view', array('orders'=>$orders), true);
				echo $dataLiveOrder;
			}else{
				echo 2;
			}
			// print_r($orders);
			// var_dump(($orders['order']));
			// var_dump(isset($orders['order']));
		}else{
			echo 3;
		}
	}

    public function ajx_cashOrders() {
//        if(isset($_SESSION['k']))
//        $_SESSION['k']+=1;
//        else
//          $_SESSION['k']=1;
        
        
        $q = $this->db->query("SELECT order_status.Order_id as Order_id,sales.net_total as net_total from order_status ,sales where day(order_status.TIMESTAMP)= day(curdate()) and (order_status.status=3 or order_status.status=1) and sales.Order_id = order_status.Order_id")->result_array();
        $pendingOrders = $q;
        $r = "";
//        $this->load->view('updateCashOrders',$data);
        if (!empty($pendingOrders)) {
            foreach ($pendingOrders as $value) {
//                $r.="<div class='col-lg-2 col-md-3 col-sm-4 col-xs-6'>
//                    <div class='panel panel-warning'>
//                        <div class='panel-heading'>
//                            <div class='row'>";
//                $r.="<div class='col-xs-12'>
//                                    <div class='huge'>Order No." . $value['Order_id'] . "</div>
//                                    <br>
//                                    <div>
//                                        <input type='submit' name='btnUpdateCashOrders' class='btn btn-success btnUpdateCashOrders' value='Paid' id='" . $value['id'] . "' data-id='btn_" . $value['id'] . "'>
//                                    </div>
//                                </div>
//                            </div>
//                        </div>
//                        
//                            
//                        
//                    </div>
//                </div>";
                
                $r.='<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">';
                $r.='<div class="col-xs-12">
                                    <h5>Order No.' . $value["Order_id"] . '</h5>
                                    <br>
                                    <div>
                                        <input type="submit" name="btnUpdateCashOrders" class="btn btn-success btnUpdateCashOrders" value="Paid" id="' . $value["id"] . '" data-id="btn_' . $value["id"] . '">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                ';
            }
            echo $r;
        } else {
            echo $r.='<div class="col-lg-12" style="color:white;"><h1>No Offline Orders.</h1></div>';
        }
    }

     
    public function addExpenses(){
        if(isset($_POST['start_date'])&&($_POST['type']!='1')){
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $type = $_POST['type'];
            echo $type;
            $expenses = $this->db->query("SELECT * FROM expenses where (date between '$start_date' and '$end_date' )AND type='$type'")->result_array();
            print_r($expenses);
        }else{
            $expenses = $this->db->query("SELECT * FROM expenses")->result_array();

        }
        //echo $start_date;
        //echo $end_date;
        $data['expensesList'] = $expenses;
        $totalAmount=0;
        foreach($expenses as $expense){
          $totalAmount+=$expense['amount'];
        }
        $data['totalAmount']=$totalAmount;
    
        $this->load->view("addExpenses", $data);
        $this->load->view('footer');
        }
    
        public function viewExpense(){
        
        $data['type'] = $_POST['type'];
        $data['name'] =  $_POST['name'];
        $data['amt'] =  $_POST['amt'];
        $data['nameOfPerson'] = $_POST['nameOfPerson'];
        $data['reason'] = $_POST['reason'];
        $data['date'] = $_POST['date'];
        $data['time'] = $_POST['time'];
        $this->load->model('Admin_model');
        $success = $this->Admin_model->addExpenses($data);
        //$rsultary = array();
        if($success == 1){
          $rsultary = '1';
          
        }else{
          
          $rsultary = '0';
        }
        
        $this->load->view("addExpenses");
        $this->load->view('footer');
        
        echo(json_encode($rsultary));die;
        
      }

    public function cashOrder(){
        
        $q = $this->db->query("SELECT order_status.Order_id as Order_id ,order_status.id as id , sales.net_total as net_total from order_status , sales where day(order_status.TIMESTAMP)= day(curdate()) and (order_status.status=3 or order_status.status=1) and sales.Order_id = order_status.Order_id")->result_array();
        $data['pendingOrders']=$q;
        // foreach($q as $val){
        //     echo $val['Order_id'].$val['net_total'];
        // }
        $this->load->view('updateCashOrders',$data);
		$this->load->view('footer');
    }
    public function ajax_payOrder(){
        $data['id'] = $_GET['id'];
        $this->load->view('ajax_payorder',$data);
        
    }
    
 public function updateCashOrders(){
//     if(!empty($_POST['ddlOrderNo'])){
//         $cashOrder_id =$_POST['ddlOrderNo'];
//         $res = $this->db->query("update order_status set status = 2 where id =".$cashOrder_id);
//         if($res){
//             echo '<script>alert("Order Status Updated."); window.location.href="' . base_url() . 'index.php/Admin/cashOrder";</script>';
//         }
//         else{
//             echo '<script>alert("Error updating Order Status."); window.location.href="' . base_url() . 'index.php/Admin/cashOrder";</script>';
//         }
//     }
     
     if(isset($_POST['id'])&& !empty($_POST['id'])){
         $cashOrder_id =$_POST['id'];
         $res = $this->db->query("UPDATE order_status set status = 4 where id =".$cashOrder_id."");
         if($res == TRUE){
            echo '<script>alert("Order Status Updated."); window.location.href="' . base_url() . 'index.php/Admin/cashOrder";</script>';
            echo '1';
        }
         else{
             //echo '<script>alert("Error updating Order Status."); window.location.href="' . base_url() . 'index.php/Admin/cashOrder";</script>';         
            //echo '2';
        }
     }
 }
	public function index()

	{
        if(!isset($_SESSION['admin_id']))
		{
			redirect('./Admin/login', 'refresh');
		}
        else{
            redirect('./Admin/DineIn', 'refresh'); 
        }
//		$this->load->model('Admin_model');
//		$data['orders'] = $this->Admin_model->order_list();
//		echo $this->load->view('Admin_live_orders', $data, true);

    }
    
    
    public function customers(){
         //any update on customer page will happen here
    }
    public function DineIn()
    {
         //Manual Order Details and changes will be here.
         if(!isset($_SESSION['admin_id']))
		{
			redirect('./Admin/login', 'refresh');
		}
//        $d = date('d-M-y');

//        $o = $this->db->query("select count(status) as totalOrders from order_status where Timestamp like '".date('d-m-Y')."%'");

//    $res = $o->result_array();

//    echo $res[0]['totalOrders'];

    

    $this->load->model('Admin_model');

    $data['todaysOrders'] = $this->Admin_model->total_orders();

    $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();

    $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
    
    $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
    $data['orders'] = $this->Admin_model->order_list();
    $data['total'] = $this->Admin_model->total_orders();
    $data['query'] = $this->Admin_model->getAllOrder();
         $_SESSION['order_id'] = null;
         $_SESSION['customer_id'] = null;
         if(isset($_GET['tid'])){
            $data['tid']=$_GET['tid'];
         }
         else{
             $data['tid'] = NULL;
         }
         $this->load->view('take_order_dineIn',$data);
         $this->load->view('footer');
    }
    public function create_orderD()
    {
        $this->load->model('Admin_model');
        
        $data['orderid'] =$this->Admin_model->get_orderid();
        $this->Admin_model->clearFake();
        $data['mobno'] = $_POST['mobno'];
        $data['tableno'] = $_POST['table'];
        
        $data['todaysOrders'] = $this->Admin_model->total_orders();
    
        $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
    
        $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
        
        $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
        $data['orders'] = $this->Admin_model->order_list();
        $data['total'] = $this->Admin_model->total_orders();
        $data['query'] = $this->Admin_model->getAllOrder();

            $_SESSION['order_id']=$data['orderid'];
            $this->load->view('take_order_dineIn',$data);
            $this->load->view('footer');
        
    }
    public function searchD()
    {   
        if(isset($_GET['oid'])){
            $_SESSION['order_id'] = $_GET['oid'];
        }
        if(isset($_GET['customer_id'])){
            $_SESSION['customer_id'] = $_GET['customer_id'];
        }
        $this->load->model('Admin_model');
        $data['query2'] = $this->Admin_model->get_search();
        $data['orderid'] = $_SESSION['order_id'];
        $data['fake'] = $this->Admin_model->get_fake();
        $this->load->model('Admin_model');

         $data['todaysOrders'] = $this->Admin_model->total_orders();
     
         $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $data['orders'] = $this->Admin_model->order_list();
         $data['total'] = $this->Admin_model->total_orders();
         $data['query'] = $this->Admin_model->getAllOrder();
        $this->load->view('take_order_dineIn', $data);
        $this->load->view('footer');
    }

    public function addOpeningAmt(){
  
        $opening_amount = $_GET['opening_amount'];
        
        $this->load->model('Admin_model');
        $success = $this->Admin_model->addOpeningAmt($opening_amount);   
        echo(json_encode($success));die;
      }


    public function addfakeD(){
        $data['menu_id'] = $_POST['Menu_id'];
        $data['order_id'] = $_SESSION['order_id'];
        $data['customer_id'] = $_SESSION['customer_id'];
        $data['quantity'] = $_POST['quantity'];
        $data['addon_list'] = $_POST['addon_list'];
        $data['batter'] = $_POST['batter'];
        $this->load->model('Admin_model');
        // print_r($data);
        $success = $this->Admin_model->intofakeOrder($data);
        //print_r($success);
        $this->load->model('Admin_model');

         $d['todaysOrders'] = $this->Admin_model->total_orders();
     
         $d['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $d['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $d['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $d['orders'] = $this->Admin_model->order_list();
         $d['total'] = $this->Admin_model->total_orders();
         $d['query'] = $this->Admin_model->getAllOrder();
         $d['query2'] = $this->Admin_model->get_search();
         $d['latest'] = $data['menu_id'];
        if($success){
            $d['fake'] = $this->Admin_model->get_fake();
            $d['query2'] = $this->Admin_model->get_search();
            $this->load->view('take_order_dineIn',$d);
            $this->load->view('footer');
        }
    }

    

    public function complete_orderD(){
        $data['Menu_id'] =  $_POST['Menu_id'];
        $data['Name'] =  $_POST['name'];
        $data['Quantity'] = $_POST['quantity'];
        $data['Customer_id'] = $_SESSION['customer_id'];
        $data['Order_id'] = $_SESSION['order_id'];
        $data['addon'] = $_POST['addon'];
        $data['batter'] = $_POST['batter'];
        $this->load->model('Admin_model');
        
        $suc = $this->Admin_model->completeOrder($data);
        echo $suc;
        if($suc == 1){
            
            echo '<script>alert("Order Placed!");'
                            . 'window.location.href="'.  base_url().'index.php/Admin/dashboard"</script>';
            
        }
        else{
            echo '<script>alert("Order Failed!")</script>';
        }    

    }

    public function ajax_payitaway(){
        $data['id'] = $_GET['id'];
        $data['type'] = $_GET['type'];
        $data['given_amt'] = $_GET['given_amt'];
        $data['return_amt'] = $_GET['return_amt'];
        $this->load->view('ajax_payItAway',$data);
        
    }

    public function ajax_deletepayment(){
        $id = $_GET['id'];
        $s = $this->db->query("DELETE FROM customer_order WHERE Order_id='$id'");
        //print_r($id);
        if(isset($s)){
            echo 'success';
        }else{
            echo 'error';
        }
    }
    public function ajax_deleteorderitem(){
        $id = $_GET['id'];
        $order_id = $_GET['order_id'];
        $amount = $_GET['amount'];
        $s = $this->db->query("DELETE FROM customer_order WHERE id='$id'");
        //print_r($id);
        if(isset($s)){
            $this->db->query("UPDATE `sales` SET `net_total`=`net_total`-".$amount." WHERE `Order_id`=".$order_id);
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function printafterOrder(){
        $Order_id = $_GET['Order_id'];
        //$Order_id='520';
        $this->load->model('Admin_model');
        $printData = $this->Admin_model->get_print_details($Order_id);
        //echo "<pre>";print_r($printData);echo "</pre>";
        
        $sq3 = $this->db->query("select * from hotel_name_addr")->result_array();
        $sq4 = $this->db->query("select * from orders where Order_id='".$Order_id."'")->result_array();
        $table_no = $sq4['0']['Table_id'];
        //echo $table_no;

        
        $abc['hoteladdr'] = $sq3;
        $result123 = $abc['hoteladdr'];
    
        $address = str_split($result123['0']['address'],25);
        $address1 = $address[0];
        $address2 = $address[1];
        date_default_timezone_set("Asia/Kolkata");
    
        $username = $this->session->userdata('User');
    
        $table= "<table  class='' style='font-size: 15px;'><tr><td colspan='4' align='center' style='font-weight:bold;font-size: 24px;'>".$result123['0']['name']."</td></tr>
          <tr><td colspan='4' style='font-weight:bold;font-size: 14px;' align='center'>".$address1."</td></tr>
          <tr><td colspan='4' style='font-weight:bold;font-size: 14px;' align='center'>".$address2."</td></tr>
          <tr ><td colspan='4' style='font-weight:bold;font-size: 14px;' align='center'>( ".$result123['0']['contact']." )</td></tr>
          <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr>  
              <td>Order No : ".$Order_id."</td><td>Name :</td><td>Captain</td>
            </tr>
            <tr>
              <td>Time : ".Date('h:i:s')."</td><td>Date :</td><td>".Date('d-m-Y')."</td>
            </tr>
            <tr>
              <td>Type : ".$printData[0]['order_type']."</td>
              <td>Table No: ".$table_no."</td>
            </tr>
            <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr style='font-weight:bold;'>
              <td style=''> Bill Details </td><td>Quantity</td><td>Amount</td>
            </tr><tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr>";
    
            $total=0;
          foreach($printData as $data ){

              $amount = $data['Quantity'] * $data['Price'];
              
              $table .= "<tr>
                <td width='30px'>".$data['Name']."</td><td>".$data['Quantity']."</td><td>".$amount."</td>
              </tr>";
              // $total += $amount;

            if($data['Addons']!='' && $data['Addons']!='0'){
              $Addons = explode(',',$data['Addons']);
              $Menu_Id = $data['Menu_Id'];
    
              $totalAddonCost = 0;
              foreach($Addons as $addn){
                // $addoncost= $this->db->query("SELECT * FROM menu_ingridient_rel WHERE Ingredients_id='$addn' AND Menu_id='$Menu_Id' ORDER BY id DESC");
                $addoncost= $this->db->query("SELECT * FROM ingredients WHERE Ingredients_id='$addn'");
                $res = $addoncost ->row_array();
                // $totalAddonCost += $res['addon_price'];
                $table .= "<tr>
                  <td width='30px'>".$res['Name']."</td><td>".$data['Quantity']."</td><td>".$res['cost']*$data['Quantity']."</td>
                </tr>";
                $totalAddonCost += $res['cost'];
              }
    
              $addonCost = $totalAddonCost;
            } else {
              $addonCost = 0;
            }

            $amount = $amount + $data['Quantity'] * $addonCost;
            $total += $amount;

          }

          if($printData['0']['coupon_apply']=='1'){
            $table .="
              <tr>
               <td style='padding-top:10px;'> Discount </td><td>".$printData['0']['c_value']." ".$printData['0']['c_type']."</td>
              </tr>
              <tr>
                <td> Coupon Code </td><td>".$printData['0']['c_code']."</td>
              </tr>";
          }
          
    	 $ds= $this->db->query("SELECT * FROM payment_details WHERE Order_id='$Order_id'");
                $res = $ds ->row_array();
                //print_r($printData);
          $table .="
            <tr><tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr>
              <td></td><td style='font-weight:bold'>Total</td><td>".floor((int)$res['total_amount']-((float)$printData['0']['cgst']*2))."</td>
            </tr>
            <tr><td></td><td style='font-weight:bold;font-size:10px;'>CGST (2.5%): </td><td>".$printData['0']['cgst']."</td></tr>
            <tr><td></td><td style='font-weight:bold;font-size:10px;'>SGST (2.5%): </td><td>".$printData['0']['sgst']."</td></tr>
            <tr>
              <td></td><td style='font-weight:bold'>Total</td><td>".$res['total_amount']."</td>
            </tr>
            <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr>";
          
         
    
          $table .="
            <tr><td colspan='4' style='font-weight:bold;font-size: 14px;padding-top:10px;' align='center'>
              GST Number: 27APJPP8922Q12W <br> 
              <span style=\"font-size:18px\">Thank you visit again!</span>
            </td>
            </tr>
        </table>";
        
        echo $table;
        
      }

      public function printkot(){
        $id = $_GET['id'];
        $res = $this->db->query("SELECT * FROM orders WHERE Order_id='$id'");
        $x = $res->result_array();
        //print_r($x);
        $table_id = $x[0]['Table_id'];
        if($table_id == '99' || $table_id == '-1'){
            $table_id = '0';
        }
        $re = $this->db->query("SELECT * FROM fake_order");
        $orders = $re->result_array();

        $table= "<table  class='' style='font-size: 16px;'><tr><td colspan='4' align='center' style='font-weight:bold;font-size: 24px;'></td></tr>
          
    
          <tr ><td colspan='4' style='font-weight:bold;font-size: 21px;' align='center'>(TABLE NO : ".$table_id." )</td></tr>
          ";
          foreach($orders as $r){
              $addons = $r['addon'];
              $addons = explode(',',$addons);
              $addons = array_filter($addons);
              $name = $r['Menu_id'];
              $quantity = $r['Quantity'];
              $res = $this->db->query("SELECT * FROM menu WHERE Menu_Id='$name'");
              $re = $res->result_array();
              $name = $re[0]['Name'];
            $table .="<tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr style='text-align:center'>
            <td colspan='4' style='font-size:25px;' align='center'>".$name." </td>
            </tr>
            <tr style='text-align:center'>
            <td colspan='4' style='font-size:23px;' align='center'>Quantity : ".$quantity." </td>
            </tr>";
            $batter = $r['batter'];
            $res = $this->db->query("SELECT * FROM batter WHERE id='$batter'");
            $re = $res->result_array();
            $batter = $re[0]['name'];
            if($batter != 'None'){
                $table .="
            <tr style='text-align:center'>
              <td colspan='4' align='center'>~~~~ Batter ~~~~</td>
            </tr>
            <tr style='text-align:center'>
              <td colspan='4' style='font-size:20px;' align='center'>".$batter."</td>
            </tr>";
            }
            

            if(sizeof($addons) > 0){
                $table .="
            <tr style='text-align:center'>
            <td colspan='4' align='center'>~~~ Addons ~~~</td>
            </tr>";
            foreach($addons as $addon){
                $res = $this->db->query("SELECT * FROM ingredients WHERE Ingredients_id='$addon'");
                $re = $res->result_array();
                $name = $re[0]['Name'];
                $table .= "
                <tr style='text-align:center'>
                  <td colspan='4' style='font-size:20px;' align='center'>".$name." </td>
                </tr>";
              }
            }
            
          
          
            
          
        }
        $table .=" <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            
        </table>";
            echo $table;



      }
      public function sales_daily_reports()
      {
      	date_default_timezone_set("Asia/Kolkata");
        $hour_arr = array(
                '1'=>array('start'=>'09','end'=>'10','hour'=>'09-10 AM'),
                '2'=>array('start'=>'10','end'=>'11','hour'=>'10-11 AM'),
                '3'=>array('start'=>'11','end'=>'12','hour'=>'11-12 PM'),
                '4'=>array('start'=>'12','end'=>'13','hour'=>'12-01 PM'),
                '5'=>array('start'=>'13','end'=>'14','hour'=>'01-02 PM'),
                '6'=>array('start'=>'14','end'=>'15','hour'=>'02-03 PM'),
                '7'=>array('start'=>'15','end'=>'16','hour'=>'03-04 PM'),
                '8'=>array('start'=>'16','end'=>'17','hour'=>'04-05 PM'),
                '9'=>array('start'=>'17','end'=>'18','hour'=>'05-06 PM'),
                '10'=>array('start'=>'18','end'=>'19','hour'=>'06-07 PM'),
                '11'=>array('start'=>'19','end'=>'20','hour'=>'07-08 PM'),
                '12'=>array('start'=>'20','end'=>'21','hour'=>'08-09 PM'),
                '13'=>array('start'=>'21','end'=>'22','hour'=>'09-10 PM'),
                '14'=>array('start'=>'22','end'=>'23','hour'=>'10-11 PM'),
                '15'=>array('start'=>'23','end'=>'00','hour'=>'11-12 PM'),
                '16'=>array('start'=>'00','end'=>'01','hour'=>'12-01 PM'),
        );
  
        $data_arr = array();
        if(isset($_POST['date_dt']) && $_POST['date_dt']!=''){
          $today_date = date('Y-m-d', strtotime($_POST['date_dt']));
        }else{
          $today_date = date('Y-m-d');
        }
        
        $last_total = '0';
        $final_avg_sales_total = 0;
        $final_total = 0;
        foreach($hour_arr as $key=> $hr ){
          $start = $hr['start'];
          $end   = $hr['end'];
          if($key=='15'){
            $start_date=$today_date;
            $end_date=date('Y-m-d', strtotime("+1 day", strtotime($today_date)));
          }else if($key=='16'){
            $start_date=date('Y-m-d', strtotime("+1 day", strtotime($today_date)));
            $end_date=date('Y-m-d', strtotime("+1 day", strtotime($today_date)));
          }else{
            $start_date=$today_date;
            $end_date=$today_date;
          }
          
          $q = "SELECT count(pd.payment_details_id) AS count,SUM(pd.total_amount) AS total_sales FROM payment_details pd WHERE pd.added_date>=str_to_date(concat('".$start_date."',' ".$start."'),'%Y-%m-%d %H') AND pd.added_date<=str_to_date(concat('".$end_date."',' ".$end."'),'%Y-%m-%d %H')";
         // echo $q;
          $query = $this->db->query($q);
            //print_r($this->db->error());
          $result = $query->row_array();
   
          $data_arr[$key]['hour'] = $hr['hour'];
          $data_arr[$key]['total_customer'] = $result['count'];
          $data_arr[$key]['sales_hour'] = round($result['total_sales'],2);
  
          if($result['count']>0){
            $avg_sales_hour = round($result['total_sales'], 2) / $result['count'];
            $data_arr[$key]['avg_sales_hour'] = round($avg_sales_hour,2);
          } else{
            $avg_sales_hour = 0;
            $data_arr[$key]['avg_sales_hour'] = '0';
          }
          
          $data_arr[$key]['total_sales'] = round($result['total_sales'], 2) + $last_total;
          $last_total = round($result['total_sales'], 2) + $last_total;
  
          $final_avg_sales_total += $avg_sales_hour;
          $final_total += round($result['total_sales'],2);
        }
        
        $data['date'] = date('d-m-Y', strtotime($today_date));
        $data['report_data'] = $data_arr;
        $data['final_avg_sales_total'] = round($final_avg_sales_total,2);
        $data['final_total'] = $final_total;
  
        $response = $this->load->view("sales_daily_reports",$data);
      }

      public function printafterOrderD(){
        $Order_id = $_GET['Order_id'];
        $addess = $_GET['address'];
        $name = $_GET['name'];
        $number = $_GET['number'];
        //$Order_id='520';
        $this->load->model('Admin_model');
        $printData = $this->Admin_model->get_print_details($Order_id);
        //echo "<pre>";print_r($printData);echo "</pre>";
        
        $sq3 = $this->db->query("select * from hotel_name_addr")->result_array();
        
        $abc['hoteladdr'] = $sq3;
        $result123 = $abc['hoteladdr'];
    
        $address = str_split($result123['0']['address'],24);
        $address1 = $address[0];
        $address2 = $address[1];
    
        $username = $this->session->userdata('User');
    
        $table= "<table class='' style='font-size: 16px;'><tr><td colspan='4' align='center' style='font-weight:bold;font-size: 24px;'>".$result123['0']['name']."</td></tr>
          <tr><td colspan='4' style='font-weight:bold;font-size: 14px;' align='center'>".$address1."</td></tr>
          <tr><td colspan='4' style='font-weight:bold;font-size: 14px;' align='center'>".$address2."</td></tr>
          <tr ><td colspan='4' style='font-weight:bold;font-size: 14px;' align='center'>( ".$result123['0']['contact']." )</td></tr>
          <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr>  
              <td>Order No : ".$Order_id."</td><td>Name :</td><td>".$username."</td>
            </tr>
            <tr>
              <td>Time : ".Date('h:i:s')."</td><td>Date :</td><td>".Date('d-m-Y')."</td>
            </tr>
            <tr>
              <td>Type : ".$printData[0]['order_type']."</td>
            </tr>
            <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            <tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            
              <td style=''> Bill Details </td><td>Quantity</td><td>Amount</td>
            </tr><tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            ";
    
            $total=0;
          foreach($printData as $data ){
            if($data['Addons']!='' && $data['Addons']!='0'){
              $Addons = explode(',',$data['Addons']);
              $Menu_Id = $data['Menu_Id'];
    
              $totalAddonCost = 0;
              foreach($Addons as $addn){
                $addoncost= $this->db->query("SELECT * FROM menu_ingridient_rel WHERE Ingredients_id='$addn' AND Menu_id='$Menu_Id' ORDER BY id DESC");
                $res = $addoncost ->row_array();
                $totalAddonCost += $res['addon_price'];
              }
    
              $addonCost = $totalAddonCost;
            } else {
              $addonCost = 0;
            }
    
            $amount = $data['Quantity'] * $data['Price'];
            $amount = $amount + $data['Quantity'] * $addonCost;
            $table .= "<tr>
              <td width='30px'>".$data['Name']."</td><td>".$data['Quantity']."</td><td>".$amount."</td>
            </tr>";
            $total += $amount;
          }
          
    
          $table .="<tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
           
            <tr>
              <td></td><td style='font-weight:bold'>Total</td><td>".$total."</td>
            </tr>";
          
          if($printData['0']['coupon_apply']=='1'){
            $table .="
              <tr>
               <td style='padding-top:10px;'> Discount </td><td>".$printData['0']['c_value']."</td>
              </tr>
              <tr>
                <td> Coupon Code </td><td>".$printData['0']['c_code']."</td>
              </tr>
              ";
              
          }
         
    
          $table .="<tr><td colspan='4' style='border-bottom-style: dotted;border-width: 1px;'></td></tr>
            
          <tr><td>Name: </td><td>".$name."</td></tr>
          <tr><td>Number: </td><td>".$number."</td></tr>
          <tr><td>Address: </td><td>".$addess."</td></tr>
            <tr><td colspan='4' style='font-weight:bold;font-size: 14px;padding-top:10px;' align='center'>
              Thank you visit again!
            </td>
            </tr>
        </table>";
        
        echo $table;
        
      }



    public function tableStatus(){
        $this->load->model('Admin_model');

        $data['todaysOrders'] = $this->Admin_model->total_orders();
    
        $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
    
        $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
        
        $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
        $data['orders'] = $this->Admin_model->order_list();
        $data['total'] = $this->Admin_model->total_orders();
        $data['query'] = $this->Admin_model->getAllOrder();
        $data['preparedList']=$this->Admin_model->preparationTimeout();
        $data['servedOrders']=$this->Admin_model->orderReady();
        $data['countNotifications']=sizeOf($data['todaysOrders']) + sizeOf($data['preparedList']) + sizeOf($data['servedOrders']); 
        $this->load->view('tablestatus',$data);
        //print_r($data['preparedList']);
    }

    public function ajax_notify(){
        $this->load->model('Admin_model');
        $data['todaysOrders'] = $this->Admin_model->total_orders();
        $data['preparedList']=$this->Admin_model->preparationTimeout();
        $data['servedOrders']=$this->Admin_model->orderReady();
        $data['countNotifications']=sizeOf($data['todaysOrders']) + sizeOf($data['preparedList']) + sizeOf($data['servedOrders']); 
        echo json_encode($data);
        
    }

    //Takeaway part
    public function TakeAway()
    {
         //Manual Order Details and changes will be here.
         
    $this->load->model('Admin_model');

    $data['todaysOrders'] = $this->Admin_model->total_orders();

    $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();

    $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
    
    $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
    $data['orders'] = $this->Admin_model->order_list();
    $data['total'] = $this->Admin_model->total_orders();
    $data['query'] = $this->Admin_model->getAllOrder();
         $_SESSION['order_id'] = null;
         $_SESSION['customer_id'] = null;

         $this->load->view('take_order_takeAway',$data);
         $this->load->view('footer');
    }
    public function create_orderT()
    {
        $this->load->model('Admin_model');
        $data['orderid'] =$this->Admin_model->get_orderid();
        $data['mobno'] = $_POST['mobno'];

        $data['todaysOrders'] = $this->Admin_model->total_orders();
    
        $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
    
        $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
        
        $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
        $data['orders'] = $this->Admin_model->order_list();
        $data['total'] = $this->Admin_model->total_orders();
        $data['query'] = $this->Admin_model->getAllOrder();
            $_SESSION['order_id']=$data['orderid'];
            $this->load->view('take_order_takeAway',$data);
            $this->load->view('footer');
        
    }
    public function searchT()
    {
        $this->load->model('Admin_model');
        $this->load->model('Admin_model');

         $data['todaysOrders'] = $this->Admin_model->total_orders();
     
         $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $data['orders'] = $this->Admin_model->order_list();
         $data['total'] = $this->Admin_model->total_orders();
         $data['query'] = $this->Admin_model->getAllOrder();
        $data['query2'] = $this->Admin_model->get_search();
        $data['orderid'] = $_SESSION['order_id'];
        $data['fake'] = $this->Admin_model->get_fake();
        $this->load->view('take_order_takeAway', $data);
        $this->load->view('footer');
    }
    public function addfakeT(){
        $data['menu_id'] = $_POST['Menu_id'];
        $data['order_id'] = $_SESSION['order_id'];
        $data['customer_id'] = $_SESSION['customer_id'];
        $data['quantity'] = $_POST['quantity'];
        $data['addon'] = $_POST['addon'];
        $this->load->model('Admin_model');

         $d['todaysOrders'] = $this->Admin_model->total_orders();
     
         $d['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $d['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $d['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $d['orders'] = $this->Admin_model->order_list();
         $d['total'] = $this->Admin_model->total_orders();
         $d['query'] = $this->Admin_model->getAllOrder();
        
        $this->load->model('Admin_model');
        $success = $this->Admin_model->intofakeOrder($data);
        $d['query2'] = $this->Admin_model->get_search();
        if($success){
            $d['fake'] = $this->Admin_model->get_fake();
            $d['query2'] = $this->Admin_model->get_search();
            
            $this->load->view('take_order_takeAway',$d);
            $this->load->view('footer');
        }
    }
    public function complete_orderT(){
        $data['Menu_id'] =  $_POST['Menu_id'];
        $data['Name'] =  $_POST['name'];
        $data['Quantity'] = $_POST['quantity'];
        $data['Customer_id'] = $_SESSION['customer_id'];
        $data['Order_id'] = $_SESSION['order_id'];
        $this->load->model('Admin_model');
        $suc = $this->Admin_model->completeOrder($data);
        echo $suc;
        if($suc == 1){
            echo '<script>alert("Order Placed!");'
                            . 'window.location.href="'.  base_url().'index.php/Admin/dashboard"</script>';
        }
        else{
            echo '<script>alert("Order Failed!");'
                            . 'window.location.href="'.  base_url().'index.php/Admin/dashboard"</script>';
        }    
    }
    //Home delivery


    public function manageDeliveries(){
        $this->load->view('delivery');
    }

    public function HomeDelivery()
    {
         //Manual Order Details and changes will be here.
         $this->load->model('Admin_model');

         $data['todaysOrders'] = $this->Admin_model->total_orders();
     
         $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $data['orders'] = $this->Admin_model->order_list();
         $data['total'] = $this->Admin_model->total_orders();
         $data['query'] = $this->Admin_model->getAllOrder();
         $_SESSION['order_id'] = null;
         $_SESSION['customer_id'] = null;
         $this->load->view('take_order_homeDelivery',$data);
         $this->load->view('footer');
    }

    public function orderHistory(){
        
        //$history = $this->db->query("SELECT cus.mobile, order_status.Order_id as Order_id,order_status.status,sales.cgst,sales.sgst,sales.net_total as net_total from order_status ,sales, customers cus where order_status.status=1 and sales.Order_id = order_status.Order_id and cus.customer_id = sales.customer_id")->result_array();
        
        if(isset($_POST['start_date']) && $_POST['start_date']!=''){
          $start_date = date('Y-m-d', strtotime($_POST['start_date']));
        }else{
          $start_date = date('Y-m-01');
        }

        if(isset($_POST['end_date']) && $_POST['end_date']!=''){
          $end_date = date('Y-m-d', strtotime($_POST['end_date']));
        }else{
          $end_date = date('Y-m-d');
        }

        $history = $this->db->query("SELECT o.*,s.*,os.status,p.payment_type,c.mobile
          FROM orders o 
          LEFT JOIN order_status os ON os.Order_id=o.Order_id 
          LEFT JOIN sales s ON s.Order_id=o.Order_id 
          LEFT JOIN payment_details p ON p.Order_id=o.Order_id 
          LEFT JOIN customers c ON c.customer_id=s.customer_id
          WHERE os.status=4 ORDER BY o.Timestamp DESC")->result_array();
          $history = array_map("unserialize", array_unique(array_map("serialize", $history)));

          
		      $data['pendingOrdershistory'] = $history;

          $data['start_date'] = date('d-m-Y', strtotime($start_date));
          $data['end_date'] = date('d-m-Y', strtotime($end_date));
          $this->load->view('orderHistory',$data);
		      $this->load->view('footer');
  }


  

  public function showOrderDetails( $order_id = "" ) {
    $pendingFakeOrders = $this->db->query("select M.Menu_id as Menu_id, M.Name as name,M.price,c.quantity as quantity,c.Addons,c.Batter from menu M,customer_order c where c.Menu_id = M.Menu_id and c.Order_id='$order_id'")->result_array();
      
    $data_arr = array();
    foreach ($pendingFakeOrders as $key => $value) {
      $data_arr[$key]['menu_id'] =$value['Menu_id'];
      $data_arr[$key]['menu_name'] =$value['name'];
      $data_arr[$key]['quantity'] =$value['quantity'];

      $menu_id =$value['Menu_id'];
      $addon = explode(',',$value['Addons']);
      if($value['Addons']!=''){
        $totalAddonCost = 0;
        foreach($addon as $addn){
          $addoncost= $this->db->query("SELECT * FROM menu_ingridient_rel WHERE Ingredients_id='$addn' AND Menu_id='$menu_id' ORDER BY id DESC");
          $res = $addoncost ->row_array();
          $totalAddonCost += $res['addon_price'];
        }
        
        $addoncost = $totalAddonCost; 
      }else{
        $addoncost = 0;
      }

      $data_arr[$key]['amount'] = ($value['price'] * $value['quantity']) + $value['quantity']*($addoncost);

      if(count($addon)>0){
          $ressAddonsArr = array();
          $ressNameArr = array();
          foreach($addon as $val){
            $sq= $this->db->query("SELECT * FROM ingredients WHERE Ingredients_id = '$val'");
            foreach($sq ->result_array() as $ress){
              $ressAddonsArr[] =$ress['Ingredients_id']; 
              $ressNameArr[] =$ress['Name'];
            }
          }
          if(count($ressAddonsArr)>0){
            $data_arr[$key]['addons_name']  = implode(',',$ressNameArr);
          } else{
            $data_arr[$key]['addons_name']   = "";
          }
        }

        $batter_id = $value['Batter'];
        $sql = "SELECT * FROM batter WHERE id='$batter_id'";
        $sqs= $this->db->query("SELECT * FROM batter WHERE id='$batter_id'");
        $batter_name ="";
        foreach($sqs ->result_array() as $btters){
          $batter_name = $btters['name'];
        }

        if($batter_name!=''){
          $data_arr[$key]['batter_name'] =$batter_name;
        } else{
          $data_arr[$key]['batter_name'] ='';
        }
      
    }
    
    $data['order_id'] = $order_id;
    $data['order_details'] = $data_arr;
    $this->load->view( 'showOrderDetails',$data);    
  }

    public function create_orderH()
    {
        $this->load->model('Admin_model');
        $data['orderid'] =$this->Admin_model->get_orderid();
        $data['address'] = $_POST['address'];
        $data['nameee'] = $_POST['nameee'];
        $data['mobno'] = $_POST['mobno'];
        $data['todaysOrders'] = $this->Admin_model->total_orders();
    
        $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
    
        $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
        
        $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
        $data['orders'] = $this->Admin_model->order_list();
        $data['total'] = $this->Admin_model->total_orders();
        $data['query'] = $this->Admin_model->getAllOrder();

            $_SESSION['order_id']=$data['orderid'];
            $this->load->view('take_order_homeDelivery',$data);
            $this->load->view('footer');
        
    }

    public function ajax_Mobile(){
        $data['mobile'] = $_GET['mobile'];
        $this->load->view('ajax_mobile',$data);
    }

    public function searchH()
    {
        $this->load->model('Admin_model');
        $data['query2'] = $this->Admin_model->get_search();
        $data['orderid'] = $_SESSION['order_id'];
        $data['fake'] = $this->Admin_model->get_fake();
        $this->load->model('Admin_model');

         $data['todaysOrders'] = $this->Admin_model->total_orders();
     
         $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $data['orders'] = $this->Admin_model->order_list();
         $data['total'] = $this->Admin_model->total_orders();
         $data['query'] = $this->Admin_model->getAllOrder();
        $this->load->view('take_order_homeDelivery', $data);
        $this->load->view('footer');
    }
    public function addfakeH(){
        $data['menu_id'] = $_POST['Menu_id'];
        $data['order_id'] = $_SESSION['order_id'];
        $data['customer_id'] = $_SESSION['customer_id'];
        $data['quantity'] = $_POST['quantity'];
        $this->load->model('Admin_model');

         $d['todaysOrders'] = $this->Admin_model->total_orders();
     
         $d['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
     
         $d['totalSaleOfDay'] = $this->Admin_model->total_sales();
         
         $d['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
         $d['orders'] = $this->Admin_model->order_list();
         $d['total'] = $this->Admin_model->total_orders();
         $d['query'] = $this->Admin_model->getAllOrder();
        $this->load->model('Admin_model');
        $success = $this->Admin_model->intofakeOrder($data);
        $d['query2'] = $this->Admin_model->get_search();
        if($success){
            $d['fake'] = $this->Admin_model->get_fake();
            $d['query2'] = $this->Admin_model->get_search();
            $this->load->view('take_order_homeDelivery',$d);
            $this->load->view('footer');
        }
    }
    public function complete_orderH(){
        $data['Menu_id'] =  $_POST['Menu_id'];
        $data['Name'] =  $_POST['name'];
        $data['Quantity'] = $_POST['quantity'];
        $data['Customer_id'] = $_SESSION['customer_id'];
        $data['Order_id'] = $_SESSION['order_id'];
        $this->load->model('Admin_model');
        $suc = $this->Admin_model->completeOrder($data);
        echo $suc;
        if($suc == 1){
            
            echo '<script>alert("Order Placed!");'
                            . 'window.location.href="'.  base_url().'index.php/Admin/dashboard"</script>';
            
        }
        else{
            echo '<script>alert("Order Failed!");'
                            . 'window.location.href="'.  base_url().'index.php/Admin/dashboard"</script>';
        }    

    }
    public function served(){
        //echo "we r here";
        if(isset($_GET['oid'])){
            $oid = $_GET['oid'];
            $tid = $_GET['tid'];
            echo $oid;
            $data['Order_id'] = $oid;
            $this->load->model('Admin_model');
            $success = $this->Admin_model->servedOrder($data);
            if($success == 1){
                if($tid== -1){
                    echo '<script>alert("Order Ready For Delivery!");'
                                . 'window.location.href="'.  base_url().'index.php/Admin/manageDeliveries"</script>';
                }else{
                echo '<script>alert("Order Completed!");'
                                . 'window.location.href="'.  base_url().'index.php/Admin/Dashboard"</script>';
                }
            }
            else{
                echo '<script>alert("Failed to Update! Retry");'
                                . 'window.location.href="'.  base_url().'index.php/Admin/Dashboard"</script>';
            }
        }

    }
    public function promotional()
    {
        $this->load->view('scheduleSMS_promotion');
        $this->load->view('footer');
    }
  
    public function coupons()
    {
        $this->load->view('scheduleSMS_coupon');
        $this->load->view('footer');
    }

    public function ajax_applyCode(){
        $data['id'] = $_GET['id'];
        $data['code'] = $_GET['code'];
        $this->load->view('ajax_applycode',$data);
    }
    
   public function coupon_add () {
      
      $c_data = array(
      'c_code'   => strtoupper($this->input->post('coupon_code')),
      'c_type'   => $this->input->post('coupon_type'),
      'c_value'  => $this->input->post('coupon_value'), 
      'c_status' => 'ON',
	  'c_minvalue' => $this->input->post('coupon_minvalue'),
      );
        
      $data = array('feedback' => 'empty');    
        
      $query = $this->db->query("Select * from coupons where c_code = '" . $c_data['c_code'] . "'");
        
      if($query->num_rows() > 0) {
         $data['feedback'] = 'Coupon already exists';
      }    
        
      else { 
        $this->db->insert('coupons', $c_data);
        $data['feedback'] = 'Success!';
      }
        
      $this->load->view('scheduleSMS_coupon', $data);
        
    }
    
    public function coupon_toggle () {
      
      $c_data = $_GET['code'];
        
      $this->db->select('c_status');
      $this->db->from('coupons');
      $this->db->where('id',$c_data);
      $quary = $this->db->get()->row('c_status');

      if($quary == 'ON') {
          $value = 'OFF';
          $this->db->set('c_status', $value); //value that used to update column  
          $this->db->where('id', $c_data); //which row want to upgrade  
          $this->db->update('coupons');  //table name
      }
        
      elseif ($quary == 'OFF') {
          $value = 'ON';
          $this->db->set('c_status', $value); //value that used to update column  
          $this->db->where('id', $c_data); //which row want to upgrade  
          $this->db->update('coupons');  //table name    
      }   
        
      $this->coupons();
        
    }
    
    public function coupon_delete () {
      
        $c_data = $_GET['code'];
        $this->db->where('id', $c_data);
        $this->db->delete('coupons');
        $this->coupons();
        
    }
    
	public function live_orders()
	{

		$this->load->model('Admin_model');

		$data['total'] = $this->Admin_model->total_orders();

		$data['sales'] = $this->Admin_model->total_sales();

		$this->load->view('Admin_panel', $data);
		$this->load->view('footer');

	}



	public function out_of_stock()

	{

		$this->load->model('Admin_model');
		$data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();

		echo $this->load->view('Admin_outofstock_items', $data, true);
		echo $this->load->view('footer','',true);

    }

    



	public function inventory()

	{

		$this->load->model('Admin_model');

		$data['inventory'] = $this->Admin_model->inventory_model();



		echo $this->load->view('inventory', $data, true);
		echo $this->load->view('footer','',true);

	}

public function inventorycategory()

  {

    $this->load->model('Admin_model');

    $data['inventorycategory'] = $this->Admin_model->all_inventory_category();
    echo $this->load->view('inventorycategory', $data, true);
    echo $this->load->view('footer','',true);

  }	

	public function sales_report()

	{

		$this->load->model('Admin_model');
		//$data['sales_reports'] = $this->Admin_model->sales_reports_month();
		//$data['sales_reports_daily'] = $this->Admin_model->sales_reports_daily();
		//$data['sales_reports_monthly_liquor'] = $this->Admin_model->sales_reports_monthly_liquor();
		//$data['sales_reports_daily_liquor'] = $this->Admin_model->sales_reports_daily_liquor();
		//$data['sales_reports_daily_food'] = $this->Admin_model->sales_reports_daily_food();
		//$data['mostOrderedItems'] = $this->Admin_model->getMostOrderedItems();
		
                
//		$data['salesByYear'] = $this->Admin_model->salesByYear();
//                $data['salesByHalfYear'] = $this->Admin_model->salesByHalfYear();
//                $data['salesByQuarter'] = $this->Admin_model->salesByQuarter();
//                $data['salesByMonth'] = $this->Admin_model->salesByMonths();
//		$data['salesByWeek'] = $this->Admin_model->salesByWeek();
		
		
		//$data['salesByCategory'] = $this->Admin_model->salesByCategory();
		//$data['grossSale']= $this->db->query("select sum(cgst)+sum(sgst)+sum(net_total) as grossSale from sales where month(sales.TIMESTAMP) = month(curdate())")->result();
		//$data['salary_expense'] = $this->db->query("select sum(salary) as total_salary from staff")->result();
		//$data['food_expense'] = $this->Admin_model->getFoodExpense();
		echo $this->load->view('Sales','', true);
		echo $this->load->view('footer','',true);

	}

 
        
public function addInventoryView(){
  $this->load->model('Admin_model');

    $data['inventorycategory'] = $this->Admin_model->all_inventory_category();
    $this->load->view('addInventory',$data);
	$this->load->view('footer');
}

public function addInventoryCategoryView(){
    $this->load->view('addInventoryCategory',true);
  $this->load->view('footer');
}

public function addInventory(){
    if(isset($_POST) && !empty($_POST) ){
        $data1['Name']=$_POST['name'];
        $data1['Quantity']=$_POST['Quantity'];
        $data1['inventorycategory']=$_POST['inventorycategory'];
        $data1['minQuantity']=$_POST['minQuantity'];
        $data1['addons']=$_POST['addons'];
        $data1['cost']=$_POST['cost'];
        
        $this->load->model('Admin_model');
        $this->Admin_model->addInventoryToDb($data1);
        
    }
}

public function addInventoryCategory(){
    if(isset($_POST) && !empty($_POST) ){
        $data1['Name']=$_POST['name'];

        
        $this->load->model('Admin_model');
        $this->Admin_model->addInventoryCategoryToDb($data1);
        
    }
}

public function editInventoryView($invID){
    if(isset($invID) && $invID!=""){
              $id = $invID;

         $data = $this->db->query('select * from ingredients where Ingredients_id = '.$id)->result_array();
             $data['inventorycategory'] = $this->db->query('SELECT * FROM `inventorycategory` WHERE isDeleted=0 ')->result();
         $data['inv_item'] = $data[0];
//         if(isset($data['menu_item']) && !empty($data['menu_item']))
         $this->load->view('editInventory',$data);
		$this->load->view('footer');
     }
}
public function editInventoryCategoryView($invID){
    if(isset($invID) && $invID!=""){
              $id = $invID;

         $data = $this->db->query('select * from inventorycategory where id = '.$id)->result_array();
         $data['inv_item'] = $data[0];
//         if(isset($data['menu_item']) && !empty($data['menu_item']))
         $this->load->view('editInventoryCategory',$data);
    $this->load->view('footer');
     }
}
public function updateInventory(){
    if(isset($_POST) && !empty($_POST) ){
        $data1['Name']=$_POST['name'];
        $data1['inventorycategory']=$_POST['inventorycategory'];
        $data1['Quantity']=$_POST['Quantity'];
        /* $data1['minQuantity']=$_POST['minQuantity'];
        $data1['addons']=$_POST['addons']; */
        $data1['Ingredients_id']=$_POST['inv_id'];
        $data1['cost']=$_POST['cost'];
        $this->load->model('Admin_model');
        $status = $this->Admin_model->updateInventoryToDb($data1);
        if ($status) {
                echo '<script>alert("Inventory updated."); window.location.href="' . base_url() . 'index.php/Admin/inventory";</script>';
            } else {
                echo '<script>alert("Error occured. Please try again."); window.location.href="' . base_url() . 'index.php/Admin/inventory";</script>';
            }
        }  
}

public function updateInventoryCategory(){
    if(isset($_POST) && !empty($_POST) ){
        $data1['Name']=$_POST['name'];
        $data1['Ingredients_id']=$_POST['inv_id'];
        
        $this->load->model('Admin_model');
        $status = $this->Admin_model->updateInventoryCategoryToDb($data1);
        if ($status) {
                echo '<script>alert("Inventory Category updated."); window.location.href="' . base_url() . 'index.php/Admin/inventorycategory";</script>';
            } else {
                echo '<script>alert("Error occured. Please try again."); window.location.href="' . base_url() . 'index.php/Admin/inventorycategory";</script>';
            }
        }  
}

public function deleteInventory($inv_id){
    if(isset($inv_id) && $inv_id!=""){
              $id = $inv_id;

         $data = $this->db->query('delete from ingredients where Ingredients_id = '.$id);
         
         if($data==1){
             echo '<script>alert("Inventory Deleted");'
        . 'window.location.href="'.  base_url().'index.php/Admin/inventory"</script>';
//         $this->load->view('all',$data);
         }
         else{
             echo '<script>alert("Error occured. Please try again.");'
        . 'window.location.href="'.  base_url().'index.php/Admin/inventory"</script>';
         }
}
}

public function deleteCategoryInventory($inv_id){
    if(isset($inv_id) && $inv_id!=""){
              $id = $inv_id;

         $data = $this->db->query('UPDATE `inventorycategory` SET `isDeleted`=1 WHERE `id`='.$id);
         
         if($data){
             echo '<script>alert("Inventory Category Deleted");'
        . 'window.location.href="'.  base_url().'index.php/Admin/inventorycategory"</script>';
        $this->load->view('all',$data);
           }
         else{
             echo '<script>alert("Error occured. Please try again.");'
        . 'window.location.href="'.  base_url().'index.php/Admin/inventorycategory"</script>';
         }
}
}
public function login(){
    
    $this->load->view('adminLogin',true);
}

public function addMenuItems(){
    if(!isset($_SESSION['admin_id']))
		{
//			redirect('adminLogin', 'refresh');
		}
//    $res['ing'] = $this->db->query("select * from ingredients")->result_array();
   $this->load->view('addMenu',true); 
   $this->load->view('footer');
}

public function addmenu(){
    if(isset($_POST)){
    
        
    $data1['Name']=$_POST['name'];
    $n = $_POST['name'];
    $data1['Price']=$_POST['Price'];
    $data1['Description']=$_POST['desc'];
    $data1['Type']=$_POST['ddlType'];
    $data1['Category']=$_POST['ddlCategory'];
//    $data['Image']=;
    $data1['time']=$_POST['time'];
    $data1['spice_level']=$_POST['ddlspiceLevel'];
    if(isset($_FILES['img']['name'])){
        $image = $_FILES['img']['name'];
        $data1['img']=$image;
        $conn = mysqli_connect("localhost","root", "", "menufi");
        $cwd= getcwd();
        $sql = "UPDATE menu SET Image='$image' WHERE Name='$n'";
        $res = $conn -> query($sql);
        $target = "images/food_images/".basename($image);
        if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
           echo "Image uploaded successfully";
        }
    }
    $photo =0;

                $this->load->model('Admin_model');
       
                    
                    $this->Admin_model->addMenuToDB($data1);
                
                
                   // $this->Admin_model->addMenuToDB($data1);
            
    }
    
}

 public function allMenu(){
     $r['menu'] = $this->db->query('select * from menu')->result_array();
     $leng=count($r['menu']);
     if($leng > 0){
         $this->load->view('allMenus',$r);
		 $this->load->view('footer');
     }
 }

 public function manageCategories(){
     $this->load->view('manageCategories');
 }

 /* public function manageBatter(){
    $this->load->view('manageBatter');
} */

 public function ajax_addCategory(){
     $data['name'] = $_GET['name'];
     $this->load->view('ajax_addcategory',$data);
 }

 public function ajax_addopening(){
    $data['amt'] = $_GET['amt'];
    $this->load->view('ajax_addOpen',$data);
}

 public function ajax_deleteCategory(){
    $data['id'] = $_GET['id'];
    $this->load->view('ajax_deletecategory',$data);
}

public function ajax_addBatter(){
    $data['name'] = $_GET['name'];
    $this->load->view('ajax_addbatter',$data);
}

public function ajax_deleteBatter(){
   $data['id'] = $_GET['id'];
   $this->load->view('ajax_deletebatter',$data);
}
 
 public function editMenu($menu_id){
if(isset($menu_id) && $menu_id!=""){
              $id = $menu_id;

         $data = $this->db->query('select * from menu where Menu_Id = '.$id)->result_array();
         $data['menu_item'] = $data[0];
//         if(isset($data['menu_item']) && !empty($data['menu_item']))
         $this->load->view('editMenu',$data);
		 $this->load->view('footer');
     }
 }
 
 public function deleteMenu($menu_id){
//     if(isset($_POST['menu_id']) && $_POST['menu_id']!=""){
if(isset($menu_id) && $menu_id!=""){
              $id = $menu_id;

         $data = $this->db->query('delete from menu where Menu_Id = '.$id);
         
         if($data==1){
             echo '<script>alert("Menu Deleted");'
        . 'window.location.href="'.  base_url().'index.php/Admin/allMenu"</script>';
//         $this->load->view('all',$data);
         }
         else{
             echo '<script>alert("Error occured. Please try again.");'
        . 'window.location.href="'.  base_url().'index.php/Admin/allMenu"</script>';
         }
     }
 }
 
public function updateMenu(){
    if(isset($_POST)){
        
    $data1['Name']=$_POST['name'];
    $data1['Price']=$_POST['Price'];
    $data1['Description']=$_POST['desc'];
    $data1['Type']=$_POST['ddlType'];
    $data1['Category']=$_POST['ddlCategory'];
//    $data['Image']=;
    $data1['time']=$_POST['time'];
    $data1['spice_level']=$_POST['ddlspiceLevel'];
    $hd = $_POST['prevImgName'];
    $data1['menu_id'] = $_POST['menu_id'];
    $photo =0;
    if (!empty($_FILES['img']['name'])) {
            
         $config['upload_path']          = './images/food_images/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 0;
                $config['max_height']           = 0;

                $this->load->library('upload', $config);
$this->upload->initialize($config);
                if ( $this->upload->do_upload('img'))
                    {
                        $data = array('img' => $this->upload->data());
                        $photo = 1;
                        $data1['Image']=$_FILES['img']['name'];
                    }
                    else
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('addMenu', $error);
						$this->load->view('footer');
                    }
                }
                $this->load->model('Admin_model');
                if($photo == 1){
                    
                    $status = $this->Admin_model->updateMenuToDB($data1);
                }
                else{
                    //img is not provided; set prev image name
                    $data1['Image'] = $hd;
                    $status = $this->Admin_model->updateMenuToDB($data1);
                } 
                if($status){
                    echo '<script>alert("Menu updated."); window.location.href="'.base_url().'index.php/Admin/allMenu";</script>';
                }
                else{
                    echo '<script>alert("Error occured. Please try again."); window.location.href="'.base_url().'index.php/Admin/allMenu";</script>';
                }
    }
} 
 


public function checkLogin(){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $query = $this->db->get_where('admin', array('username' => $username, 'password'=> $pwd));
    $r = $query->result();
    
    if(count($r)>0){
        
        $this->session->set_userdata('admin_id',$r[0]->id);
        $_SESSION['User'] = $username;
		$_SESSION['user_type'] = $r[0]->user_type;
		if($_SESSION['user_type'] == 'chef'){
			redirect(base_url('index.php/Admin/kitchen_dashboard'));
		}else{
			
			redirect(base_url('index.php/Admin/DineIn'));
		}
    }
    else{
        echo '<script>alert("Invalid Username and/or Password");</script>';
      $this->load->view('adminLogin','refresh');  
    }
    
}
 
public function netSale(){
    
    $this->load->model('Admin_model');
//    $data['sales_reports_daily'] = $this->Admin_model->sales_reports_daily();
    $ing_cost = $this->db->query("SELECT
menu_ingridient_rel.Menu_id,
  `ingredients`.`cost`,
  sum(`menu_ingridient_rel`.`quantity_rel`) as total_ing_each_menu,
sum(`menu_ingridient_rel`.`quantity_rel`*`ingredients`.`cost`) as ingredient_cost
FROM
 ingredients join
 menu_ingridient_rel on
 (ingredients.Ingredients_id = menu_ingridient_rel.Ingredients_id)
 group by 
 menu_ingridient_rel.Menu_id")->result_array();
    
//    $menu_items = $this->db->query("SELECT 
//  `customer_order`.`Menu_Id`,
//  
//  sum(`customer_order`.`Quantity`) as total_quantity
//  from
//  customer_order join
//  sales on (`customer_order`.`Order_id` = `sales`.`Order_id`)
//  group by
//  `customer_order`.Menu_Id")->result_array();
    
    $foodCost = array();
    foreach ($ing_cost as $menu) {
        $id = $menu['Menu_id'];
        $quant = $this->db->query("SELECT 
  `customer_order`.`Menu_Id`,
  sum(`customer_order`.`Quantity`) as total_quantity
 from
  customer_order join
  sales on (`customer_order`.`Order_id` = `sales`.`Order_id`)
  where `customer_order`.Menu_Id = ".$id."
  group by
  `customer_order`.Menu_Id")->result_array();
        if(count($quant)>0){
        $foodCost[] = $menu['ingredient_cost'] * $quant[0]['total_quantity'];  
        }
    }
      $final = array_sum($foodCost);      
    
                }

                public function logout(){
                    $this->session->unset_userdata('admin_id');
                    $this->session->sess_destroy();
                    redirect('./Admin/login','refresh');
                }
}

