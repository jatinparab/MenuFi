<?php

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
        if(isset($_POST['ddlMenu']) && isset($_POST['ddlIng'])){
            // $ing_type => 0-mandatory, 2-optional, 1- set it as addon
            $ing_type=0;
           $ddlMenu = $_POST['ddlMenu'];
           $ddlIng = $_POST['ddlIng'];
           $qty = $_POST['QtyRequired'];
           $isOptional = !empty($_POST['isOptional'])?$_POST['isOptional']:false;
           if($isOptional){
               $ing_type = 2;
           }
           else{
               $ing_type = 0;
           }
           
           $check_mapping = $this->db->query("select * from menu_ingridient_rel where Menu_id=$ddlMenu and Ingredients_id=$ddlIng");
           if($check_mapping->num_rows()>0){
               //mapping is there; update it
               $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty, addons=$ing_type where Menu_id=$ddlMenu and Ingredients_id=$ddlIng");
               if($update_mapping){
                   echo '<script>alert("Ingredients updated!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
               }
               else{
                echo '<script>alert("Error updating Ingredients quantity! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

               }
           }
           else{
               //add mapping;
               $add_mapping = $this->db->query("insert into menu_ingridient_rel(Menu_id,Ingredients_id,quantity_rel,addons) values($ddlMenu,$ddlIng,$qty,$ing_type)");
               if($add_mapping){
                   echo '<script>alert("Ingredients added for this Menu Item!"); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 
               }
               else{
                echo '<script>alert("Error adding Ingredients! Please try again."); window.location.href="' . base_url() . 'index.php/Admin/v_menu_ing";</script>'; 

               }
           }
        }
    }
    
    public function addMenuAddonMapping(){
        if(isset($_POST['ddlMenu']) && isset($_POST['ddlAddons'])){
            $flag=0;
            $ddlMenu = $_POST['ddlMenu'];
           $ddlAddons = $_POST['ddlAddons'];
           $qty = $_POST['QtyRequired'];
           
               $check_addons_mapping = $this->db->query("select * from menu_ingridient_rel where Menu_id=$ddlMenu and Ingredients_id=$ddlAddons and addons=1");
               if($check_addons_mapping->num_rows()>0){
                   //mapping found; update mapping;
                    $update_mapping = $this->db->query("update menu_ingridient_rel set quantity_rel=$qty where Menu_id=$ddlMenu and Ingredients_id=$ddlAddons and addons=1");
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
                   $add_mapping = $this->db->query("insert into menu_ingridient_rel(Menu_id,Ingredients_id,quantity_rel,addons) values($ddlMenu,$ddlAddons,$qty,1)");
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
        
        
        $q = $this->db->query("SELECT order_status.Order_id as Order_id,sales.net_total as net_total from order_status ,sales where day(order_status.TIMESTAMP)= day(curdate()) and order_status.status=3 and sales.Order_id = order_status.Order_id")->result_array();
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

    public function cashOrder(){
        
        $q = $this->db->query("SELECT order_status.Order_id as Order_id ,order_status.id as id , sales.net_total as net_total from order_status , sales where day(order_status.TIMESTAMP)= day(curdate()) and order_status.status=3 and sales.Order_id = order_status.Order_id")->result_array();
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


    public function addfakeD(){
        $data['menu_id'] = $_POST['Menu_id'];
        $data['order_id'] = $_SESSION['order_id'];
        $data['customer_id'] = $_SESSION['customer_id'];
        $data['quantity'] = $_POST['quantity'];
        $data['addon_list'] = $_POST['addon_list'];
        $data['batter'] = $_POST['batter'];
        $this->load->model('Admin_model');
        $success = $this->Admin_model->intofakeOrder($data);
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

    public function tableStatus(){
        $this->load->model('Admin_model');

        $data['todaysOrders'] = $this->Admin_model->total_orders();
    
        $data['outOfStockItems'] = $this->Admin_model->out_of_stock_items();
    
        $data['totalSaleOfDay'] = $this->Admin_model->total_sales();
        
        $data['avg_feedback']= $this->Admin_model->get_global_avg_feedback();
        $data['orders'] = $this->Admin_model->order_list();
        $data['total'] = $this->Admin_model->total_orders();
        $data['query'] = $this->Admin_model->getAllOrder();
        $this->load->view('tablestatus',$data);
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

    public function create_orderH()
    {
        $this->load->model('Admin_model');
        $data['orderid'] =$this->Admin_model->get_orderid();
        $data['address'] = $_POST['address'];
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
    $this->load->view('addInventory',true);
	$this->load->view('footer');
}

public function addInventory(){
    if(isset($_POST) && !empty($_POST) ){
        $data1['Name']=$_POST['name'];
        $data1['Quantity']=$_POST['Quantity'];
        $data1['minQuantity']=$_POST['minQuantity'];
        $data1['addons']=$_POST['addons'];
        $data1['cost']=$_POST['cost'];
        
        $this->load->model('Admin_model');
        $this->Admin_model->addInventoryToDb($data1);
        
    }
}

public function editInventoryView($invID){
    if(isset($invID) && $invID!=""){
              $id = $invID;

         $data = $this->db->query('select * from ingredients where Ingredients_id = '.$id)->result_array();
         $data['inv_item'] = $data[0];
//         if(isset($data['menu_item']) && !empty($data['menu_item']))
         $this->load->view('editInventory',$data);
		$this->load->view('footer');
     }
}

public function updateInventory(){
    if(isset($_POST) && !empty($_POST) ){
        $data1['Name']=$_POST['name'];
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
			
			redirect(base_url('index.php/Admin/dashboard'));
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

