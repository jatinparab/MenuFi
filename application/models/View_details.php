
<?php

	class View_details Extends CI_Model {

		public function details($id){
                    //$q = $this->db->query("select * from customer_order where Order_id = ".$_SESSION['order_id'])->result_array();
$q = $this->db->query("select * from customer_order where Order_id = ".$_SESSION['order_id']." and Menu_Id=".$id)->result_array();
			//$query = $this->db->get_where('menu',array('Menu_Id'=>$id));

			$this->db->select('*');

			$this->db->from('menu');

			$this->db->join('nutrition', 'nutrition.Menu_id = menu.Menu_id','left outer');

			$this->db->where('menu.Menu_Id', $id);
                        if(count($q)>0){
                           $this->db->join('customer_order', 'customer_order.Menu_id = menu.Menu_id','left outer');
                           $this->db->where('customer_order.Order_id', $_SESSION['order_id']);
}

			$query = $this->db->get();

			$row = $query->result();

			

			$this->db->select('Name, menu_ingridient_rel.addons');

			$this->db->from('ingredients');

			$this->db->join('menu_ingridient_rel', 'menu_ingridient_rel.Ingredients_id = ingredients.Ingredients_id');

			$this->db->where('menu_ingridient_rel.Menu_id', $id);

			$query = $this->db->get();

			$row_ingr = $query->result();



			$data = array(

				'data_nutrition' => $row,

				'data_ingredients' => $row_ingr

			);

			return $data;

			



			//return $this->db->last_query();

			

			 

			 

			

		}

                
                //original code commented on 06/11/17 3:14pm 
//		public function details($id){
//
//			//$query = $this->db->get_where('menu',array('Menu_Id'=>$id));
//
//			$this->db->select('*');
//
//			$this->db->from('menu');
//
//			$this->db->join('nutrition', 'nutrition.Menu_id = menu.Menu_id','left outer');
//
//			$this->db->where('menu.Menu_Id', $id);
//
//			$query = $this->db->get();
//
//			$row = $query->result();
//
//			
//
//			$this->db->select('Name, addons');
//
//			$this->db->from('ingredients');
//
//			$this->db->join('menu_ingridient_rel', 'menu_ingridient_rel.Ingredients_id = ingredients.Ingredients_id');
//
//			$this->db->where('menu_ingridient_rel.Menu_id', $id);
//
//			$query = $this->db->get();
//
//			$row_ingr = $query->result();
//
//
//
//			$data = array(
//
//				'data_nutrition' => $row,
//
//				'data_ingredients' => $row_ingr
//
//			);
//
//			return $data;
//
//			
//
//
//
//			//return $this->db->last_query();
//
//			
//
//			 
//
//			 
//
//			
//
//		}

		

	}

?>