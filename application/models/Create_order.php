

<?php



	class Create_order Extends CI_Model {


public function saveFeedbackToDb($feedback){
    if(isset($feedback) && !empty($feedback)){
         return $this->db->insert('feedback',$feedback);
    }
}
		public function order($table_id){

			//$query = $this->db->get_where('menu',array('Menu_Id'=>$id));
			// $sql = $this->db->query('SELECT O.Order_id as Order_id,O.Table_id as Table_id, OS.status as status from orders O, order_status OS where O.Order_id = OS.status')->result_array();
			// //return $this->db->error();
			// return $sql;
			// if($sql){
			// 	foreach($sql as $val){
			// 		//return $this->db->error();
			// 		if($val['Table_id'] == $table_id && $val['status'] != 4){
			// 			$return_data['order_success']=TRUE;
			// 			$return_data['Order_id']= $val['Order_id'];
			// 			return $return_data;		
			// 		}
			// 	}
			// }else{
				//return $this->db->error();
				$data['Table_id'] = $table_id;

				$return_data['order_success'] = $this->db->insert('orders', $data);

				$return_data['Order_id'] = $this->db->insert_id();

				$order_status['Order_id'] = $return_data['Order_id'];

				$this->db->insert('order_status',$order_status);

				echo $return_data['Order_id'];

				return $return_data;
			
			//return $this->db->last_query();



		}


public function place_order_table_direct($data){
//    $customer_id = "";
//                    if(isset($_SESSION['mCustId']) && !empty($_SESSION['mCustId'])){
//                        $customer_id = $_SESSION['mCustId'];
//                    }
//                    else if(isset($_SESSION['gUserId']) && !empty($_SESSION['gUserId'])){
//                        $customer_id = $_SESSION['gUserId'];
//                    }

			//$query = $this->db->get_where('menu',array('Menu_Id'=>$id));

			//print_r($data);

			//echo $data['id'];

			//print_r($data['addons']);
$id = $data['id']; $Name = $data['Name']; $Quantity = $data['quantity'];



//$order['customer_id'] = $customer_id;
			$order['Menu_Id'] = $data['id'];

			$order['Order_id'] = $data['order'];

			$order['Quantity'] = $data['quantity'];

			$order['comments'] = $data['comments'];
                        
                        if (isset($data['addons']) && $data['addons'] != "")
                            $order['Addons'] = json_encode($data['addons']);
                        else {
                            $order['Addons'] = null;
                        }

                        if (isset($data['ingredients']) && $data['ingredients'] != "")
                            $order['Optional_ingredients'] = json_encode($data['ingredients']);
                        else {
                            $order['Optional_ingredients'] = null;
                        }


        $this->db->select('*');

			$this->db->from('customer_order');

			$this->db->where('Order_id', $order['Order_id']);

			$this->db->where('Menu_Id', $order['Menu_Id']);

			$query = $this->db->get();

			$rows = $query->num_rows();
                        
                        $order_id = $order['Order_id'];
                        $menu_id = $order['Menu_Id'];

			if($rows > 0)

			{
                            //order is present
                            
                            //check if order is placed
                            $check_itemStatus = $this->db->query("select * from customer_order where Order_id = $order_id and Menu_Id = $menu_id and item_status=2");
                            if($check_itemStatus->num_rows()>0){
                                //order is placed for this menuid
                                //check if any other row is present for this menu_id where item_status=1
                             $check_row = $this->db->query("select * from customer_order where Order_id = $order_id and Menu_Id = $menu_id and item_status=1");
                               if($check_row->num_rows()>0){
                                  //row present; update it
                                   $this->db->where('Order_id', $order['Order_id']);

				$this->db->where('Menu_Id', $order['Menu_Id']);
                                $this->db->where('item_status', '1');

				$order_added = $this->db->update('customer_order', $order);
                                foreach ($_SESSION['ar'] as $key => $value) {
                                   if($value['id']==$id)
                                   {
                                       $_SESSION['ar'][$key]['Quantity']=$Quantity;
                                   }
                                }
                                return $order_added;
                               }
                                //now insert new row with same menuId
                                $order_added = $this->db->insert('customer_order', $order);

                                $_SESSION['ar'][] = array(
                                   "id" => $id,
                                    "Name" => $Name, 
                                    "Quantity"=> $Quantity 
                                );
				return $order_added;
                            }
				$this->db->where('Order_id', $order['Order_id']);

				$this->db->where('Menu_Id', $order['Menu_Id']);

				$order_added = $this->db->update('customer_order', $order);

				//echo $order_added;
                                
                                foreach ($_SESSION['ar'] as $key => $value) {
                                   if($value['id']==$id)
                                   {
                                       $_SESSION['ar'][$key]['Quantity']=$Quantity;
                                   }
                                }
//                                exit();
//                                $_SESSION['ar'][0]['id'] =$id;
//                                $_SESSION['ar'][0]['Name'] =$Name;
//                                $_SESSION['ar'][0]['Quantity'] =$Quantity;

				return $order_added;

			}

			else {

				$order_added = $this->db->insert('customer_order', $order);

                                $_SESSION['ar'][] = array(
                                   "id" => $id,
                                    "Name" => $Name, 
                                    "Quantity"=> $Quantity 
                                );
				return $order_added;

			}







			//return $return_data;

			//return $this->db->last_query();



		}
		public function place_order_table($data){

			//$query = $this->db->get_where('menu',array('Menu_Id'=>$id));

			//print_r($data);

			//echo $data['id'];

			//print_r($data['addons']);





			$order['Menu_Id'] = $data['id'];

			$order['Order_id'] = $data['order'];

			$order['Quantity'] = $data['quantity'];

//			$order['comments'] = $data['comments'];

			$order['Addons'] = json_encode($data['addons']);

			$order['Optional_ingredients'] = json_encode($data['ingredients']);



			$this->db->select('*');

			$this->db->from('customer_order');

			$this->db->where('Order_id', $order['Order_id']);

			$this->db->where('Menu_Id', $order['Menu_Id']);

			$query = $this->db->get();

			$rows = $query->num_rows();

			if($rows > 0)

			{

				$this->db->where('Order_id', $order['Order_id']);

				$this->db->where('Menu_Id', $order['Menu_Id']);

				$order_added = $this->db->update('customer_order', $order);

				//echo $order_added;
                                foreach ($_SESSION['ar'] as $key => $value) {
					   if($value['id']==$order['Menu_Id'])
					   {
						   $_SESSION['ar'][$key]['Quantity']=$order['Quantity'];
					   }
					}

				return $order_added;

			}

			else {

				$order_added = $this->db->insert('customer_order', $order);
                                $_SESSION['ar'][] = array(
					   "id" => $order['Menu_Id'],
						"Name" => $Name, 
						"Quantity"=> $order['Quantity'] 
					);

				return $order_added;

			}







			//return $return_data;

			//return $this->db->last_query();



		}



		public function finalorder($order_id){

				$id = $order_id['order'];

				$this->db->select('*');

				$this->db->from('customer_order');

				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');

				$this->db->where('Order_id', $id);

				$this->db->where('item_status', 1);





				$query = $this->db->get();



				$row = $query->result();

				return $row;

		}



		public function pushorder($status_update){

			//$status_update['Order_id'] = 1;

			//return $this->db->insert('Order_status',$status_update);



			$sql = 'update `ingredients`

			JOIN `menu_ingridient_rel` ON `menu_ingridient_rel`.`Ingredients_id` = `ingredients`.`Ingredients_id`

			JOIN `customer_order` ON `customer_order`.`Menu_id` = `menu_ingridient_rel`.`Menu_id`



			set  `ingredients`.`quantity` = ((`ingredients`.`quantity`)-	 (customer_order.Quantity )* (`menu_ingridient_rel`.`quantity_rel`))

			WHERE `Order_id` = '.$this->db->escape_str($status_update['order']).'';

			$updated_result = $this->db->query($sql);







			$order_update = array(

					'item_status' => 2

				);

			$this->db->where('Order_id', $status_update['order']);

			$this->db->where('item_status', 1);

			$this->db->update('customer_order', $order_update);

			$data['Order_id'] = $status_update['order'];







			//$status_update['status'] = 1;

			$status = array(

               'status' => 1

            );



			$this->db->where('Order_id', $data['Order_id']);

			return $this->db->update('order_status', $status);

		}



		public function showorder($order_id){
                    //for show_order modal: to show only current items i.e. whose item_status = 1

//				$where = "(item_status = 1 OR item_status = 2)";
                    $where = "item_status = 1";

				$id = $order_id['order'];

				$this->db->select('*, customer_order.spice_level as CSPICE');

				$this->db->from('customer_order');

				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');

				$this->db->where('Order_id', $id);

				$this->db->where($where);





				$query = $this->db->get();



				//echo $this->db->last_query();



				$row = $query->result();

				return $row;

		}
                
                public function showorder1($order_id){
                    //for show_order modal: to show only current items i.e. whose item_status = 1

				$where = "(item_status = 1 OR item_status = 2)";
//                    $where = "item_status = 1";

				$id = $order_id['order'];

				$this->db->select('*, sum(customer_order.Quantity) as totalQ, customer_order.spice_level as CSPICE');

				$this->db->from('customer_order');

				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');

				$this->db->where('Order_id', $id);

				$this->db->where($where);
$this->db->group_by("customer_order.Menu_id");




				$query = $this->db->get();



				//echo $this->db->last_query();



				$row = $query->result();

				return $row;

		}

//                public function showorder1($order_id){
//                    //for show_order modal: to show only current items i.e. whose item_status = 1
//
//				$where = "(item_status = 1 OR item_status = 2)";
////                    $where = "item_status = 1";
//
//				$id = $order_id['order'];
//
//				$this->db->select('*, customer_order.spice_level as CSPICE');
//
//				$this->db->from('customer_order');
//
//				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');
//
//				$this->db->where('Order_id', $id);
//
//				$this->db->where($where);
//
//
//
//
//
//				$query = $this->db->get();
//
//
//
//				//echo $this->db->last_query();
//
//
//
//				$row = $query->result();
//
//				return $row;
//
//		}

		public function removeitems($order_id)

		{

			$data = array(

				'item_status' => 0

			);

			$this->db->where('Order_id', $order_id['order']);

			$this->db->where('Menu_id', $order_id['Menu_id']);

			$res= $this->db->delete('customer_order');

			return $res;

		}



		public function pay_bill($order_status)

		{
			$data = array(
				'status' => $order_status['order_status']
			);
			$this->db->where('Order_id', $order_status['order']);
			$res = $this->db->update('order_status', $data);

			return $res;

		}
		public function save_order($order_id){
                    $customer_id = "";
                    $login_type = "";
                    if(isset($_SESSION['mCustId']) && !empty($_SESSION['mCustId'])){
                        $customer_id = $_SESSION['mCustId'];
                        $login_type = "mobile";
                    }
                    else if(isset($_SESSION['gUserId']) && !empty($_SESSION['gUserId'])){
                        $customer_id = $_SESSION['gUserId'];
                        $login_type = "google";
                    }

				$where = "(item_status = 1 OR item_status = 2)";

				$id = $order_id['order'];

				$this->db->select('*');

				$this->db->from('customer_order');

				$this->db->join('menu', 'customer_order.Menu_id = menu.Menu_id');

				$this->db->where('Order_id', $id);

				$this->db->where($where);

				$query = $this->db->get();

				//echo $this->db->last_query();

				$row = $query->result();

				$total = 0.0;

				foreach($row as $item)
				{
					$total += (float)$item->Price*(int)$item->Quantity;
				}

				$cgst = ($total/200)*5;

				$sgst = ($total/200)*5;

				$net_total = $total + $cgst + $sgst;

				$data = array(

				   'Order_id' => $id ,

				   'cgst' => $cgst ,

				   'sgst' => $sgst,

				   'net_total' => $net_total,
                                    
                                    'customer_id'=>$customer_id,
                                    
                                    'login_type'=>$login_type

				);

				$this->db->insert('sales', $data);
				return $row;
		}
	}

?>

