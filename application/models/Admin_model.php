<?php

class Admin_model Extends CI_Model {
            
            public function get_global_avg_feedback(){
                return $this->db->query("select 
				((avg_variety + avg_quality + avg_serving_portion+avg_presentation+avg_value_for_money+avg_speed+avg_staff_courtesy+avg_staff_knowledge)/8) as global_avg 
				from
					(select avg(variety) as avg_variety, 
					avg(quality) as avg_quality, 
					avg(serving_portion) as avg_serving_portion, 
					avg(presentation) as avg_presentation, 
					avg(value_for_money) as avg_value_for_money, 
					avg(speed) as avg_speed, 
					avg(staff_courtesy) as avg_staff_courtesy, 
					avg(staff_knowledge) as avg_staff_knowledge
				from feedback) as tt")->result();
            }

    public function checkPassword($curPwd){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('password',$curPwd);
        $query = $this->db->get();
        if($query->num_rows()<=0){
            return 0;
        }
        else{
            return 1;
        }
    }
    
    public function updatePassword($newPwd,$curPwd){
        $data['password'] = $newPwd;
        $this->db->where('password',$curPwd);
        return $this->db->update('admin',$data);
    }
            
public function addInventoryToDb($d){
   	$data['Name']=$d['Name'];
    $data['quantity']=$d['Quantity'];
    $data['min_quantity']=$d['minQuantity'];
    $data['addons']=$d['addons'];
    $data['cost']=$d['cost'];
    $this->db->insert('ingredients',$data);
    $last_id = $this->db->insert_id();
    if($last_id>0){
        echo '<script>alert("Inventory Added");'
        . 'window.location.href="'.  base_url().'index.php/Admin/inventory"</script>';
    }
}

public function addExpenses($d)
{  
		$type = $d['type'];  
		$name = $d['name'];
		$amt = $d['amt'];
		$nameOfPerson = $d['nameOfPerson'];
		$reason = $d['reason'];
		$date = $d['date'];
		$time = $d['time'];
		
		$var = "INSERT into expenses(`name`,`amount`,`type`,`nameOfPerson`,`reason`,`date`,`time`) values('$name','$amt','$type','$nameOfPerson','$reason','$date','$time')";
		$success = $this->db->query($var);	
		
		
	if($success)
	{   
			return 1;
	}else{

return 0;			
}		
}

public function updateInventoryToDb($d){
    $data['Name']=$d['Name'];
    $data['quantity']=$d['Quantity'];
    /* $data['min_quantity']=$d['minQuantity'];
    $data['addons']=$d['addons']; */
    $data['Ingredients_id'] = $d['Ingredients_id'];
    $data['cost']=$d['cost'];
    $this->db->where('Ingredients_id',$data['Ingredients_id']);
    
    $status = $this->db->update('ingredients',$data);
    return $status;
}
public function addMenuToDB($d){
    $data['Name']=$d['Name'];
    $data['Price']=$d['Price'];
    $data['Description']=$d['Description'];
    $data['Type']=$d['Type'];
    $data['Category']=$d['Category'];
   // $data['Image']=$d['Image'];
    $data['time']=$d['time'];
    $data['spice_level']=$d['spice_level'];
    
    $this->db->insert('menu',$data);
    $last_id = $this->db->insert_id();
    if($last_id>0){
        echo '<script>alert("Menu Added");'
        . 'window.location.href="'.  base_url().'index.php/Admin/addMenuItems"</script>';
    }
                 
}

public function updateMenuToDB($d){
    $data['Name']=$d['Name'];
    $data['Price']=$d['Price'];
    $data['Description']=$d['Description'];
    $data['Type']=$d['Type'];
    $data['Category']=$d['Category'];
    $data['Image']=$d['Image'];
    $data['time']=$d['time'];
    $data['spice_level']=$d['spice_level'];
    $data['menu_id'] = $d['menu_id'];
    $this->db->where('Menu_Id',$data['menu_id']);
    
    $status = $this->db->update('menu',$data);
    return $status;
}

		public function order_list(){

			//$query = $this->db->get('menu');

			$query = $this->db->get_where('order_status', array('status' => 1));

			$orders = $query->result();

			$i = 0;

			$row = array();

			foreach($orders as $order){

//				$this->db->select('*');
//
//				$this->db->from('customer_order');
//
//				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');
//
//				$this->db->join('order_status', 'customer_order.Order_id = order_status.Order_id');
//
//				$this->db->join('orders', 'orders.Order_id = order_status.Order_id','left outer');
//                                
//                                $this->db->where('order_status.Order_id', $order->Order_id);
//
//				$this->db->where('item_status', 2);
//
//				$this->db->where('order_status.Timestamp >= CURDATE()');
                            
                $this->db->select('*, co.spice_level as co_spice_level, m.spice_level as m_spice_level');

				$this->db->from('customer_order co');

				$this->db->join('menu m', 'co.Menu_id = m.Menu_id');

				$this->db->join('order_status os', 'co.Order_id = os.Order_id');

				$this->db->join('orders o', 'o.Order_id = os.Order_id','left outer');
                                
                $this->db->where('os.Order_id', $order->Order_id);

				$this->db->where('item_status', 2);

				$this->db->where('os.Timestamp >= CURDATE()');
//                                $this->db->order_by('co.Order_id', 'DESC');

				$query = $this->db->get();

				//echo $this->db->last_query();

				if($query->num_rows()!==0)
				{
					$row[$i] = $query->result();
				}

				$i++;

			}

			return $row;

		}
		function get_search() {
			$match = $this->input->post('search');
			$query = $this->db->query('select * from menu where Menu_id like "%'.$match.'%" or Name like "%'.$match.'%" or Category like "%'.$match.'%" ')->result_array();
			return $query;
		}
		public function get_fake(){
			$query = $this->db->query('select M.Menu_id as Menu_id, M.Name as name,f.quantity as quantity from menu M,fake_order f where f.Menu_id = M.Menu_id');
			$sql = $query->result_array();
			return $sql;
		}
		public function stfupdate($d){
			$id = $d['id'];
			$name = $d['name'];
        	$salary = $d['salary'];
        	$shifts = $d['shifts'];
			$chores = $d['chores'];
			
			$data['name']=$d['name'];
			$data['salary']=$d['salary'];
			$data['shifts']=$d['shifts'];
			$data['chores']=$d['chores'];
			$this->db->where('id',$id);
			
			$status = $this->db->update('staff_management',$data);
			// $this->db->where('id', $id);
			// $success = $this->db->update('staff_management');
			//$success = $this->db->query('UPDATE `staff_management` SET `name`= '.$name.',`salary`='.$salary.',`shifts`='.$shifts.',`chores`='.$chores.' WHERE `id` = '.$id.'');

			if($status){
				return 1;
			}
			else{
				show_error($success,1, $heading = 'An Error Was Encountered');
			}	
		}
		public function stfdel($d){
			$id = $d['id'];
			$this->db->where('id',$id);
			$status = $this->db->delete('staff_management');
			if($status){
				return 1;
			}
			else{
				show_error($success,1, $heading = 'An Error Was Encountered');
			}
		}
		public function total_orders()

		{
			//$date = date('y-m-d');
			//$data = date('Y-m-d');

			$this->db->select('*');

			$this->db->from('order_status');

			$this->db->where('Timestamp >= CURDATE() AND status = 1');

			$query = $this->db->get();
			$row = $query->result();
			//echo $this->db->last_query();
			return $row;
			//$query = "select * from table where DATE(emailsend)=CURDATE()";
		}
		public function getAllOrder(){
			$query = $this->db->query('SELECT O.Order_id as oid, O.Table_id as tid, S.status as status from orders O,order_status S where O.Order_id = S.Order_id')->result_array();
			return $query;
		}
		public function intofakeOrder($d){
			$cid = $d['customer_id'];
			$mid = $d['menu_id'];
			$quantity = $d['quantity'];
			$addon = $d['addon_list'];
			$batter = $d['batter'];
			$suc =$this->db->query('select * from fake_order')->result_array();
			foreach($suc as $val){
				if( $val['Customer_id'] == $cid && $val['Menu_id'] == $mid && $val['Quantity'] == $quantity && $val['addon'] == $addon && $val['batter'] == $batter ){
					return 1;
				}
			}
			$order_array = array('Customer_id'=> $cid , 'Menu_id' => $mid , 'Quantity'=>$quantity, 'addon' => $addon, 'batter' => $batter );
			$q = $this->db->insert('fake_order',$order_array);
			if($q){
				return 1;
			}
			else{
				return $this->db->error();
			}
		}
		public function deleteOrder(){
			
			$success = $this->db->query("DELETE FROM `fake_order` WHERE Menu_id = $mid AND Customer_id = $cid");
			if($success){
				return 1;
			}
			else{
				return 0;
			}
		}
		public function servedOrder($d){
			$oid = $d['Order_id'];
			$this->db->set('status', '3', FALSE);
			$this->db->where('Order_id', $oid);
			$success = $this->db->update('order_status');
			if($success){
				return 1;
			}
			else{
				return 0;
			}
		}
		public function completeOrder($d)
		{
			
				print_r($d);
			$name = $d['Name'];
			$quantity = $d['Quantity'];
			$mid = $d['Menu_id'];
			$addon = $d['addon'];
			$batter = $d['batter'];
			$myQuery = array();
			for($i = 0; $i<sizeof($name); $i++){
			/*     echo "|".$mid[$i];
			} */
				$data['Menu_id'] = $mid[$i];  
				$data['Quantity'] = $quantity[$i];
				$oid = $d['Order_id'];
				$qty = $quantity[$i];
				$is = 2;
				$cid = $d['Customer_id'];
				$login_type = 'Manual';
				$k = $addon[$i];
				$md = $batter[$i];
				echo $k;
				if($qty == 0){
					$sc = $this->db->query("DELETE FROM `fake_order` WHERE Menu_id = $mid[$i] AND Customer_id = $cid");
				}
				else{
					$sc = $this->db->query("DELETE FROM `fake_order` WHERE Menu_id = $mid[$i] AND Customer_id = $cid");				
					
					$var = "INSERT into customer_order(`Order_id`,`Menu_id`,`Quantity`,`Addons`,`Batter`,`comments`,`item_status`,`Customer_id`) values('$oid','$mid[$i]','$qty','$k','$md','comments','$is','$cid')";
					
					$success = $this->db->query($var);	
					print_r($this->db->error());
				
			}
		}
			if($success && $sc)
			{ 
				$where = "(item_status = 1 OR item_status = 2)";
				$id = $oid;
				$this->db->select('*');
				$this->db->from('customer_order');
				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');
				$this->db->where('Order_id', $id);
				$this->db->where($where);
				$query = $this->db->get();
				//echo $this->db->last_query();
				$row = $query->result();
				$sql = $this->db->query("SELECT * from sales");
				if($sql->num_rows() > 0)
				{
					$qwry = $sql->result_array();
					foreach($qwry as $val){
						if($id == $val['Order_id'] ){
							$sid = $val['Order_id'];
						//	$total = $val['net_total'];
						//	$cgst = $val['cgst'] ;
						//	$sgst = $val['sgst'];
						}
					}
					if(isset($sid)){
						$total = 0;
						foreach($row as $item){
							$addons = $item->Addons;
							$addons = explode(",",$addons);
							$addons = array_filter($addons);
							$b = $item->Menu_Id; 
							
							foreach($addons as $a){
								
								$sql3 = $this->db->query("SELECT * from menu_ingridient_rel WHERE Ingredients_id=$a AND Menu_id=$b");
								$rw = $sql3->result_array();
								$prce = $rw[0]['addon_price']; 
								$total += (int)$item->Quantity*(int)$prce;
							}
							
							$total += (float)$item->Price*(int)$item->Quantity;
						}
						$cgst = ($total/200)*5;
						$sgst = ($total/200)*5;
						$net_total = $total;
						$data = array(
								'cgst' => 0,
								'sgst' => 0,
								'net_total' => $net_total,	
								'customer_id'=>$cid,
								'login_type'=>$login_type
								);
						$this->db->where('Order_id',$sid);
						$success = $this->db->update('sales', $data);
					}
					else{
						$total = 0.0;
						$cgst = 0;
						$sgst = 0;
						foreach($row as $item){
							$addons = $item->Addons;
							$addons = explode(",",$addons);
							$addons = array_filter($addons);
							$b = $item->Menu_Id; 
							
							foreach($addons as $a){
								
								$sql3 = $this->db->query("SELECT * from menu_ingridient_rel WHERE Ingredients_id=$a AND Menu_id=$b");
								$rw = $sql3->result_array();
								$prce = $rw[0]['addon_price']; 
								$total += (int)$item->Quantity*(int)$prce;
							}
							$total += (float)$item->Price*(int)$item->Quantity;
						}
						//$cgst = ($total/200)*5;
						//$sgst = ($total/200)*5;
						$net_total = $total + $cgst + $sgst;
						$data = array(
								'Order_id' => $id ,
								'cgst' => $cgst ,
								'sgst' => $sgst,
								'net_total' => $net_total,	
								'customer_id'=>$cid,
								'login_type'=>$login_type
								);
						$success = $this->db->insert('sales', $data);
					}
				}
				
				if($success){
					return 1;
				}
			}
			else{
				return 0;
			} 
		}

		public function addOpeningAmt($opening_amount)
		{  
		//	$added_by = $this->session->userdata('admin_id');
			$added_date= date('Y-m-d H:i:s');
			
			$var = "INSERT into opening_amount(`opening_amount`,`added_date`) values('$opening_amount','$added_date')";
			$success = $this->db->query($var);		
			if($success)
			{   
				return 1;
			}else{
				return $this->db->error();
			}		
		}

		public function get_orderid()
		{
			$mobno = $this->input->post('mobno');
			if($this->input->post('table'))
			{
				$table = $this->input->post('table');
			}
			else{
				
				$table = 99;
			}
			$this->db->select('*');
			$this->db->from('customers');
			$this->db->where('mobile', $mobno);
			$query = $this->db->get();
			$rows = $query->num_rows();
			if($rows > 0)
			{
				$this->db->set('views', 'views+1', FALSE);
				$this->db->where('mobile', $mobno);
				$success = $this->db->update('customers');

				$r = $query->result_array();
				$cid = $r[0]['customer_id'];
				$_SESSION['customer_id']=$cid;
				
				$query = $this->db->query('SELECT s.status as status,o.Table_id as Table_id,o.Order_id as Order_id from order_status s,orders o where o.Order_id = s.Order_id')->result_array();
				// foreach($query as $val){
				// 	if($val['Table_id'] == $table && $val['status']!=4 && $val['Table_id'] != 99){
				// 		$order_id = $val['Order_id'];
				// 		echo '<script>alert("Order Continue....");'
				// 			. 'window.location.href="'.base_url().'index.php/Admin/searchD"</script>';
				// 		return $order_id;
				// 	}
				// }

				if(!empty($cid)){
					//get order id
					if($table ==  -1){
						$type = "Home Delivery";
					}else if($table == 99){
						$type = "Take Away";
					}
					else{
						$type = "Dine In";
					}
					$order_array = array(
						'Table_id'=> $table,
						'order_type' => $type
					);
					$success = $this->db->insert('orders',$order_array);
					
					if($success)
					{
						$last_id = $this->db->insert_id();
						//$success = $this->db->query("INSERT into order_status(Order_id,Table_id) values('.$last_id.','.$table.')");
						
						$order_status['Order_id'] = $last_id;
                        $order_status['status'] = 1;
						$this->db->insert('order_status',$order_status);

						if($success){
							echo '<script>'
							. 'window.location.href="'.base_url().'index.php/Admin/searchD"</script>';
						}
					
						return $last_id;
					}
					else{
						echo '<script>alert("Order Not Created! Error Encountered");'
							. 'window.location.href="'.base_url().'index.php/Admin/searchD"</script>';
						return 0;
					}
					
				}
			}
			else {
				$customer_array = array('mobile' =>$mobno,'views' => 1,'otp' => 0);

				$success = $this->db->insert('customers', $customer_array);
				$cid = $this->db->insert_id();
				$_SESSION['customer_id']=$cid;
				if($success){
					$cid = $this->db->insert_id();
					//get order id
					if($table ==  -1){
						$type = "Home Delivery";
					}else if($table == 99){
						$type = "Take Away";
					}
					else{
						$type = "Dine In";
					}
					$order_array = array(
						'Table_id'=> $table,
						'order_type' => $type
					);
                    $order_array = array('Table_id'=> $table,'order_type'=>$type);
					$succ = $this->db->insert('orders',$order_array);
					if($succ)
					{
						$last_id = $this->db->insert_id();
						$suc = $this->db->query("INSERT into order_status(Order_id,Table_id) values('.$last_id.','.$table.')");
						if($suc){
							echo '<script>'
							. 'window.location.href="'.  base_url().'index.php/Admin/searchD"</script>';
							return $last_id;
						}
					}
					else{
						echo '<script>alert("Order Not Created! Error Encountered");'
							. 'window.location.href="'.  base_url().'index.php/Admin/searchD"</script>';
					}
				}
			}
      		
		}
		public function insertIntoStaff($d)
		{

			//$success = $this->db->query("INSERT into staff_management(name,salary,shifts,chores) values($name,$salary,$shifts,$chores) ");
			$success = $this->db->insert('staff_management',$d);
			if($success){
				return 1;
			}
		}
		public function total_sales()
		{

			//$date = date('y-m-d');

			//$data = date('Y-m-d');

			$this->db->select('*');

			$this->db->from('sales');

			$this->db->where('Timestamp >= CURDATE()');

			$query = $this->db->get();

			$row = $query->result();

			//$this->db->last_query();

			return $row;

			//$query = "select * from table where DATE(emailsend)=CURDATE()";
		}

		public function out_of_stock_items()
		{

			$min_quantity ='min_quantity';

			$this->db->select('*');

			$this->db->from('ingredients');

			$this->db->where('quantity < min_quantity');


			$query = $this->db->get();

			$row = $query->result();

			return $row;

		}

		public function inventory_model()
		{

			$this->db->select('*');
			$this->db->from('ingredients');

			$query = $this->db->get();

			$row = $query->result();

			return $row;

		}

		public function addNewUser($username,$Newpassword,$confirmPassword,$user_type)
		{  
				$var = "INSERT INTO `admin`(`username`, `password`, `user_type`) VALUES ('$username','$Newpassword','$user_type')";
				return $success = $this->db->query($var);	
				
				
					
		}




		//sales report Mdofication needs to be done here from this place
                public function salesByCategory(){

                    $data = $this->db->query("select category,qty, cgst, sgst,total
 from 
 (select category, sum(Quantity) as qty,m.Menu_Id, sum(s.cgst) as cgst,sum(s.sgst) as sgst,sum(s.net_total) as total  
         FROM `customer_order` co join
          menu m on co.Menu_Id = m.Menu_Id
          join sales s on
          s.Order_id = co.Order_id 
          GROUP by m.menu_id, m.category) as tt 
          group by category")->result();
                    return $data;

                }

                public function salesByMonths(){

                    $data = $this->db->query("select DATE_FORMAT(sales.TIMESTAMP,'%b') as Month ,sum(cgst) cgst, sum(sgst) as sgst, sum(net_total) as total from sales 
where 
month(sales.TIMESTAMP)<= month(CURRENT_DATE())
group by 
month(sales.TIMESTAMP)")->result();
                    return $data;

                }
                
                public function salesByYear(){

                    $data = $this->db->query("select DATE_FORMAT(sales.TIMESTAMP,'%Y') as Year ,sum(cgst) cgst, sum(sgst) as sgst, sum(net_total) as total from sales 
where 
year(sales.TIMESTAMP)<= year(CURRENT_DATE())
group by 
year(sales.TIMESTAMP)")->result();
                    return $data;

                }
                
                public function salesByWeek(){

                    $data = $this->db->query("SELECT CONCAT('Week ', WEEK(`sales`.TIMESTAMP)) as week_number,
sum(cgst) cgst, sum(sgst) as sgst, sum(net_total) as total from sales

where 
WEEK(`sales`.TIMESTAMP)<= WEEK(CURRENT_DATE())
group by 
WEEK(`sales`.TIMESTAMP)")->result();
                    return $data;

                }
                
                public function salesByQuarter(){

                    $data = $this->db->query("select quarter(sales.TIMESTAMP) as Quarter ,sum(cgst) cgst, sum(sgst) as sgst, sum(net_total) as total from sales 
where 
YEAR(sales.TIMESTAMP) > YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))
group by 
Quarter")->result();
                    return $data;

                }
                
                public function salesByHalfYear(){

                    $data = $this->db->query("select CONCAT('Half: ',(floor((month(sales.TIMESTAMP))/6)+1)) as halfYear ,sum(cgst) cgst, sum(sgst) as sgst, sum(net_total) as total from sales 
where 
YEAR(sales.TIMESTAMP) > YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))
group by 
halfYear")->result();
                    return $data;

                }
                
                

		

		public function sales_reports_month()

		{

			$this->db->select('SUM(cgst) as cgst,sum(sgst) as sgst,sum(net_total) as total');

			$this->db->from('sales');

			$this->db->where('month(Timestamp) = month(CURRENT_DATE())');

			$query = $this->db->get();

			$row = $query->result();

			return $row;

			

		}

		public function get_print_details($Order_id){
			
			$this->db->select('co.Quantity,co.Addons,co.Menu_Id,m.Name,m.Price,s.cgst,s.sgst,s.net_total,s.coupon_apply,c.c_code,c.c_value,o.order_type');
			$this->db->from('customer_order co');
			$this->db->join('menu m', 'co.Menu_id = m.Menu_id');
			$this->db->join('sales s', 'co.Order_id = s.Order_id');
			$this->db->join('coupons c', 's.coupon_code = c.c_code','left');
			$this->db->join('orders o', 'co.Order_id = o.Order_id','left');
			$this->db->where('co.Order_id', $Order_id);
	
			$query = $this->db->get();
			$res = $query->result_array();
			//$res1 = 0;
			return $res;
	
		}

		public function sales_reports_daily()

		{

			$this->db->select('SUM(cgst) as cgst,sum(sgst) as sgst,sum(net_total) as total');

			$this->db->from('sales');

			$this->db->where('day(Timestamp) = day(CURRENT_DATE())');

			$query = $this->db->get();

			$row = $query->result();

			return $row;

			

		}

		public function sales_reports_monthly_liquor()

		{

				$this->db->select('menu.Name,sum(customer_order.Quantity) as total,menu.Price * sum(customer_order.Quantity) as Amount');

				$this->db->from('menu');

				$this->db->join('customer_order', 'menu.Menu_Id = customer_order.Menu_id');

				$this->db->join('sales', 'sales.Order_id = customer_order.Order_id');

				$this->db->where('menu.Type', 'Liquor');

				$this->db->where('customer_order.item_status', 2);

				$this->db->where('month(sales.Timestamp) = month(current_date())');

				$this->db->group_by('menu.Menu_Id'); 

				$this->db->order_by('total', 'desc'); 

				$query = $this->db->get();				 

				$row = $query->result();

				return $row;

			

		}

		

		public function sales_reports_daily_liquor()

		{

				$this->db->select('menu.Name,sum(customer_order.Quantity) as total,menu.Price * sum(customer_order.Quantity) as Amount');

				$this->db->from('menu');

				$this->db->join('customer_order', 'menu.Menu_Id = customer_order.Menu_id');

				$this->db->join('sales', 'sales.Order_id = customer_order.Order_id');

				$this->db->where('menu.Type', 'Liquor');

				$this->db->where('customer_order.item_status', 2);

				$this->db->where('day(sales.Timestamp) = day(current_date())');

				$this->db->group_by('menu.Menu_Id'); 

				$this->db->order_by('total', 'desc'); 

				$query = $this->db->get();				 

				$row = $query->result();

				return $row;

			

		}

		

		public function sales_reports_daily_food()

		{

				$this->db->select('menu.Name,sum(customer_order.Quantity) as total,menu.Price * sum(customer_order.Quantity) as Amount');

				$this->db->from('menu');

				$this->db->join('customer_order', 'menu.Menu_Id = customer_order.Menu_id');

				$this->db->join('sales', 'sales.Order_id = customer_order.Order_id');

				$this->db->where_in('menu.Type',array('Veg','Non-Veg'));

				$this->db->where('customer_order.item_status', 2);

				$this->db->where('day(sales.Timestamp) = day(current_date())');

				$this->db->group_by('menu.Menu_Id'); 

				$this->db->order_by('total', 'desc'); 

				$query = $this->db->get();				 

				$row = $query->result();

				return $row;

			

		}

               public function getFoodExpense(){
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
      and
  month(sales.TIMESTAMP) = month(curdate())
  group by
  `customer_order`.Menu_Id")->result_array();
        if(count($quant)>0){
        $foodCost[] = $menu['ingredient_cost'] * $quant[0]['total_quantity'];  
        }
    }
      $final = array_sum($foodCost);
      return $final;
               }
               
               
               public function getMostOrderedItems(){
                   $d = $this->db->query("select max(total_quantity) as maxQ, Category from(
select  
sales.TIMESTAMP, 
customer_order.Order_id, 
sum(customer_order.Quantity) as total_quantity, 
menu.Menu_Id, menu.Category, menu.Name
from sales 
inner join customer_order
on sales.Order_id = customer_order.Order_id
inner join menu on 
menu.Menu_Id = customer_order.Menu_Id

where month(sales.TIMESTAMP) = month(CURRENT_DATE())

GROUP BY 
menu.Name,
menu.Category

ORDER BY 
total_quantity desc ) as tt 
group by Category
order by maxQ desc")->result();
               return $d;
                   
               }

	}

?>

