<?php
	class Get_menu Extends CI_Model {
		
		public function get_menu_items(){
			$query = $this->db->get('menu');
			return $query->result();
			
		}
                
                
		
	}
?>