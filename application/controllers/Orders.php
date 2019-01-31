<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Orders extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		$this->load->database();
//		if(!isset($_SESSION['id']) || !isset($_SESSION['isLoggedIn']))
//		{
//			redirect('login', 'refresh');
//		}
    }

	public function index()
	{

	}
        
        public function addOfflineOrder()
        {
            if(!empty($_SESSION['order_id']))
                {
                    $order_id =$_SESSION['order_id'];
                    echo $res = $this->db->query("UPDATE order_status set status = 3 where Order_id = $order_id");
                }
            
        }
        
        public function getItemCount(){
            if(!empty($_SESSION['order_id'])){$order_id =$_SESSION['order_id']; }
                $items = $this->db->query("select count(Menu_Id) as TotalMenuItems from customer_order where Order_Id = ".$order_id." and item_status=1")->result_array();
		$data = $items[0]['TotalMenuItems'];
                echo $data;
        }


        public function saveFeedback(){
            $data['variety'] = $_POST['optradio'];
            $data['quality'] = $_POST['optradioquality'];
            $data['serving_portion'] = $_POST['serving_portion'];
            $data['presentation'] = $_POST['presentation'];
            $data['value_for_money'] = $_POST['vfm'];
            
            $data['speed'] = $_POST['speed'];
            $data['staff_courtesy'] = $_POST['courtsey'];
            $data['staff_knowledge'] = $_POST['knowledge'];
            
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
                    
                    $data['customer_id'] = $customer_id;
                    $data['login_type'] = $login_type;
                    $data['order_id'] = $_SESSION['order_id'];
                    $data['timestamp'] = date("Y-m-d H:i:s");
            
            $this->load->model('Create_order');
            $status = $this->Create_order->saveFeedbackToDb($data);
        }

	public function Item_details(){
		$id = $_POST['menu_id'];
		$this->load->model('View_details');
		$data['row'] = $this->View_details->details($id);

		 echo  $this->load->view('ajax_modal_view', $data,true);
	}

	public function Table_select(){

		$table_id  = $_POST['table_id'];
		$this->session->set_userdata('table_id', $table_id);
		$this->load->model('Create_order');
	 	$data = $this->Create_order->order($table_id);

		$this->session->set_userdata('order_id', $data['Order_id']);


		if($data['order_success'] == 1){
			redirect('/Home');
		}


	}

        
        public function Add_order_item_direct(){
//		$data['id'] = $_POST['menu_id'];
//		$data['addons'] = $_POST['arr'];
//		$data['ingredients'] = $_POST['arr_ing'];
//		$data['quantity'] = $_POST['quantity'];
//		$data['comments'] = $_POST['comments'];
//		//$data['table'] = $this->session->userdata('table_id');
//		$data['order'] = $this->session->userdata('order_id');
//		$data['table'] = $this->session->userdata('table_id');
//		//print_r($data);
//		$this->load->model('Create_order');
//		$order_placed = $this->Create_order->place_order_table($data);
//		if($order_placed == 1){
//				echo $order_placed;
//		}

            
                $data['ar'] = $_POST['ar'];
                
                $data['comments'] = $_POST['comments'];
                //var_dump($data['ar']);
                $data['order'] = $this->session->userdata('order_id');
                                $data['table'] = $this->session->userdata('table_id');
                //		//print_r($data);
                                $this->load->model('Create_order');

                //		if($order_placed == 1){
                //				echo $order_placed;
                //		}
                $i=0;$success = array();
                        foreach ($data['ar'] as $value) {
                            $data['id']= $value['id'];
                            $data['quantity']= $value['Quantity'];
                            
                            $data['Name']= $value['Name'];
                            
                           $order_placed = $this->Create_order->place_order_table_direct($data);
                           if($order_placed == 1){
                //				echo $order_placed;
                               $success[$i]=$order_placed;
                                }
                                $i++;
                        }
            
//    ----------------------below show_order(): added 27/10 11.25 to refresh your_order modal -----------------------------------
        
        $this->load->model('Create_order');
		$bill_order['items'] = $this->Create_order->showorder($data);
                echo $this->load->view('show_order',$bill_order,true);
//                $this->load->view('show_order',$bill_order,true);
//                if(!empty($_SESSION['order_id'])){$order_id =$_SESSION['order_id']; }
//                $items = $this->db->query("select count(Menu_Id) as TotalMenuItems from customer_order where Order_Id = ".$order_id)->result_array();
//		$data = $items[0]['TotalMenuItems'];
//                echo $data;

	}
        
	public function Add_order_item(){
		$data['id'] = $_POST['menu_id'];
		$data['addons'] = $_POST['arr'];
		$data['ingredients'] = $_POST['arr_ing'];
		$data['quantity'] = $_POST['quantity'];
//		$data['comments'] = !empty($_POST['comments'])?$_POST['comments']:"No comments";
		//$data['table'] = $this->session->userdata('table_id');
		$data['order'] = $this->session->userdata('order_id');
		$data['table'] = $this->session->userdata('table_id');
		//print_r($data);
		$this->load->model('Create_order');
		$order_placed = $this->Create_order->place_order_table($data);
		if($order_placed == 1){
				echo $order_placed;
		}



	}
        
        public function tempShowOrder(){
//            $data['id'] = $_POST['menu_id'];
            $data =array();
            if(isset($_POST['arr'])){
		$data['items'] = $_POST['arr'];
            //---------code below for adding spice_levels to data[items]-------
		$d = array();
            foreach ($data['items'] as $value) {
                $d[] = $this->db->query('select Menu_Id, spice_level, Price, Image from menu where Menu_Id = '.$value['id'])->row_array();
            }
            
            $i=0;
            $NewArray = array();
            foreach($data['items'] as $value) {
                $NewArray[] = array_merge($value,$d[$i]);
                $i++;
            }
            $a['items'] = (object)$NewArray;
            }
                echo $this->load->view('show_order',$a,true);//json_encode($data);

        }

	public function final_order(){
            $data['order'] = $this->session->userdata('order_id');
            
            if(isset($_POST['comments']) && $_POST['comments']!=""){
                $data1['comments'] = $_POST['comments'];
                $this->db->where('Order_id', $data['order']);
                $comment_updated = $this->db->update('customer_order', $data1);

//				echo $comment_updated;
            }
		
		$this->load->model('Create_order');
		$final_order_items['items'] = $this->Create_order->finalorder($data);
		echo  $this->load->view('ajax_modal_view_finalorder', $final_order_items,true);
		//echo $final_order_items;
	}

	public function push_order(){
		$data['order'] = $this->session->userdata('order_id');
		$data['table'] = $this->session->userdata('table_id');
		$this->load->model('Create_order');

		echo $this->Create_order->pushorder($data);

	}
        
	public function show_order(){
             //$this->load->view('show_order');
//                return "i m here";
                //echo json_encode("orders");
//                exit;
//            $data['order'] = $this->session->userdata('order_id');
//		$this->load->model('Create_order');
//		$show_order['items'] = $this->Create_order->showorder($data);
//                exit('ffff');
//		echo  $this->load->view('show_order', $show_order,true);
		//echo $final_order_items;
                
                //------------------------below code commented on 26oct 9:36am to check generate_bill func here
//            $data =array();
//            if(isset($_POST['arr']))
//		$data['items'] = $_POST['arr'];
//            $d = array();
//            foreach ($data['items'] as $value) {
//                $d[] = $this->db->query('select Menu_Id, spice_level from menu where Menu_Id = '.$value['id'])->row_array();
//            }
//            
//            $i=0;
//$NewArray = array();
//foreach($data['items'] as $value) {
//    $NewArray[] = array_merge($value,$d[$i]);
//    $i++;
//}
//$data['items'] = $NewArray;
            $data['order'] = $this->session->userdata('order_id');
		$this->load->model('Create_order');
		$bill_order['items'] = $this->Create_order->showorder($data);
                
                $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $bill_order['fontName'] = $font[0]['name'];
                $bill_order['fontSrc'] = $font[0]['src'];
            }
                $bg = $this->db->query("select * from background_image");
            if($bg->num_rows()>0){
                $bg = $bg->result_array();
                $bill_order['bg'] = $bg[0]['img_name'];
            }
                echo $this->load->view('show_order',$bill_order,true);
	}

        public function generate_bill(){
		$data['order'] = $this->session->userdata('order_id');
		$this->load->model('Create_order');
		$bill_order['items'] = $this->Create_order->showorder1($data); //changed on 30Nov
		echo  $this->load->view('bill', $bill_order,true);
		//echo $final_order_items;
	}
	public function remove_item()
	{
		$data['order'] = $this->session->userdata('order_id');
		$data['Menu_id'] = $_POST['Menu_id'];
                $id = $data['Menu_id'];
                foreach ($_SESSION['ar'] as $key => $value) {
                        if($value['id']==$id)
                        {
                            unset($_SESSION['ar'][$key]);
                            $_SESSION["ar"] = array_values($_SESSION["ar"]);
                        }
                     }
                
                
		$this->load->model('Create_order');
//		echo $this->Create_order->removeitems($data); //commented 0n 27/10 9.48 to refresh your_order modal
                $this->Create_order->removeitems($data);
//                $data['order'] = $this->session->userdata('order_id');
                // ----------below show_order(): added 0n 27/10 9.48 ---------------------
		$this->load->model('Create_order');
		$bill_order['items'] = $this->Create_order->showorder($data);
                echo $this->load->view('show_order',$bill_order,true);
	}

	public function addons()
	{
		$data['order'] = $this->session->userdata('order_id');

	}
        
        public function save_offline_order(){
            $data['order'] = $this->session->userdata('order_id');
		
		$this->load->model('Create_order');
		echo $bill_order['items'] = $this->Create_order->save_order($data);
        }
        
	public function pay_bill()
	{
		$data['order'] = $this->session->userdata('order_id');
		$data['order_status'] = $_POST['order_status'];
		$this->load->model('Create_order');
		$bill_order['items'] = $this->Create_order->save_order($data);
		echo $this->Create_order->pay_bill($data);

	}
        
        public function update_spice_level(){
            $r="";
            $data['order'] = $this->session->userdata('order_id');
            $data['Menu_id'] = $_POST['menu_id'];
            $d = $_POST['spice_level'];
            $res = $this->db->query("update customer_order set spice_level = ".$d." where Order_id=".$data['order']." and Menu_Id = ".$data['Menu_id']." and item_status=1");
        if($res==1){
            $data['order'] = $this->session->userdata('order_id');
		$this->load->model('Create_order');
//		$bill_order['items'] = $this->Create_order->showorder($data);
//                echo $this->load->view('show_order',$bill_order,true);
//                ------------------------------------ new code for response : below------------------------------------------
                
                
                $items['item'] = $this->Create_order->showorder($data);
$total = 0.0;


	  $i = 1;

if(isset($items) && count($items)>0){
			foreach($items['item'] as $item){


          $total += (float)$item->Price*(int)$item->Quantity;
                $r.='<div class="row s-bg">
                <!--removed image from here-->
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 width-sr">
				<h3>'.$item->Name.'</h3>
                                <div class="chill-icon">
					<ul>';
                if(isset($item->CSPICE) && $item->CSPICE != ""){
                                    $spice = $item->CSPICE;
                                }
                                else{
                                $spice = $item->spice_level;
                                
                                }
                                if($spice>0){
                                    for($i=0;$i<$spice;$i++) {
                                        $j=$i+1;
                                    
                                        $r.='<li><a href="JavaScript:void(0)" data-id="'.$item->Menu_Id.'" id="ch'.$j.'" class="Achilly" value="'.$j.'"><img src="'.base_url().'images/redchillie.png" alt="" class="img-responsive chilly" id="imgch'.$j.'"/></a></li>';
                                    }
                                    $whiteCH = 3-$spice;
                                        if($whiteCH != 0){
                                            for($i=($spice+1);$i<=3;$i++) {
                                                $r.='<li><a href="JavaScript:void(0)" data-id="'.$item->Menu_Id.'"  id="ch'.$i.'" class="Achilly" value="'.$i.'"><img src="'.base_url().'images/whitechillie.png" alt="" class="img-responsive chilly" id="imgch'.$i.'"/></a></li>';
                                            }
                                        }
                                }
                                
                                $r.='</ul>
				</div>
                                <div class="quantityCounters">
                                    <span class="input-group-btn">

							  <button type="button" data-id="'.$item->Menu_Id.'" name="'.$item->Name.'" id="btn'.$item->Menu_Id.'" class="btn btn-default btn-number_on_order" data-type="minus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-minus"></span>

								</button>

								</span>

								<input id="quanti'.$item->Menu_Id.'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_order" value="'.$item->Quantity.'" min="0" max="10">

								<span class="input-group-btn">

							  <button type="button" data-id="'.$item->Menu_Id.'" name="'.$item->Name.'" id="btn'.$item->Menu_Id.'" class="btn btn-default btn-number_on_order" data-type="plus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-plus"></span>

								</button>

								</span> 
                                </div>
				<div class="rs">
					<p><i class="fa fa-rupee fa-rupee-sc"></i><span>'. (float)$item->Price*(float)$item->Quantity.'</span></p>
				</div>
			</div>
		</div>';
                                $i++;


		}


		$cgst = ($total/200)*5;


		$sgst = ($total/200)*5;


		$net_total = $total + $cgst + $sgst;
                if($net_total >= 100.0){
                    $temp = $net_total/10;
                    $net_total = $net_total - $temp;
                }
                $r.='<div class="row  r-margin">
			<table class="table table-swidth">
                 <tbody>
                                              <tr>
                                                <td>SGST :</td>
                                                <td>2.5%</td>
                                              </tr>
                                              <tr>
                                                <td>CGST :</td>
                                                <td>2.5%</td>
                                              </tr>
                                              <tr class="total">
                                                <td>TOTAL :</td>
                                                <td><p><i class="fa fa-rupee"></i><span> '.$net_total.'</span></p></td>
                                              </tr>

                                            </tbody>
                                          </table>                           
		</div>
		<div class="row  r-margin comment-section">
			<div class="col-md-12">
				  <textarea rows="6" cols="50" placeholder="Special Instruction For the Chef" name="txtComments" id="txtComments"></textarea> 
			</div>
		</div>
		<div class="row  r-margin place-order">
			<div class="col-md-12">
				  <button class="bth bth-placeorder" onclick="final_order()">Place Order</button>
			</div>
		</div>';
}
                $r.='<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $("document").ready(function(){
    var comments = "";
    $(".Achilly").click(function(){
           var spice = $(this).attr("value");
           var menu_id =  $(this).attr("data-id"); 

$.ajax({
			 type: "POST",
			  url: "'.base_url().'index.php/Orders/update_spice_level",

			  data: {"spice_level":spice, "menu_id":menu_id},
                          dataType: "html",
			  cache: false,
			  success: function (response) {
                              $("#divShowOrder").html(response);      
			  }

		 });
       }); 
    });
    

//-----------------------------------------below: added 27/10 11.18 to set response-----------------------------------------

$(".btn-number_on_order").click(function(e){
    e.preventDefault();
//    console.log("in button");
var id = $(this).prop("id");
var menuId = $(this).attr("data-id");
var menu_name = $(this).attr("name");
//console.log(menu_name);
//alert(id);
var btn = document.getElementById(id);
//alert(btn);
    fieldName = $(this).attr("data-field");
    type      = $(this).attr("data-type");
    var input = $("input[id=quanti"+menuId+"]");
    var currentVal = parseInt(input.val());
//    console.log("currentVal:"+currentVal);
    if (!isNaN(currentVal)) {
        if(type == "minus") {

            if(currentVal > input.attr("min")) {
//               console.log("min:"+input.attr("min")); 
                input.val(currentVal - 1).change();
                
            }
            if(parseInt(input.val()) == input.attr("min")) {
                $(this).attr("disabled", true);
            }
                remove_items_from_yourorder(menuId,$(this),input,currentVal,menu_name);
        } else if(type == "plus") {

            if(currentVal < input.attr("max")) {
//                console.log("max:"+input.attr("max"));
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr("max")) {
                $(this).attr("disabled", true);
               
            }
                add_items_from_yourorder(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$(".input-number_on_order").focusin(function(){
   $(this).data("oldValue", $(this).val());
});
$(".input-number_on_order").change(function() {

    minValue =  parseInt($(this).attr("min"));
    maxValue =  parseInt($(this).attr("max"));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr("name");
    if(valueCurrent >= minValue) {
        $(".btn-number_on_order[data-type=\'minus\'][data-field=\'"+name+"\']").removeAttr("disabled")
    } else {
        alert("Sorry, the minimum value was reached");
        $(this).val($(this).data("oldValue"));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number_on_order[data-type=\'plus\'][data-field=\'"+name+"\']").removeAttr("disabled")
     } else {
        alert("Sorry, the maximum value was reached");
        $(this).val($(this).data("oldValue"));
    }


});
$(".input-number_on_order").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don"t do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
        function add_items_from_yourorder(menuId,control,input,currentVal,menu_name){

        //-------------------------------------------------------------    
          comments = $("#txtComments").val().trim();
         if(comments == ""){
             comments = "No comments";
         }  
         var menu_id = menuId;
//                                console.log("control:"+control);

//                console.log("menu_id:"+menu_id);
                
		var quantity = $("#quanti"+menuId).val();
                console.log("quantity:"+quantity);
//                        console.log("length:"+ar.length);

		if(ar.length > 0){
                    
  var x = ar.some(function(el) {
    return el.id === menu_id;
  }); 
//console.log("found:"+x);
if(x){

                    var foundAt = ar.map(function(o) { return o.id; }).indexOf(menu_id);
//                        console.log("foundAt:"+foundAt);

  
                ar[foundAt].Quantity = quantity;
            }
            else{
                ar.push({"id":menu_id,"Name":menu_name, "Quantity":quantity});

            }
                                    

            }
            else{
                ar.push({"id":menu_id, "Name":menu_name, "Quantity":quantity});
            }   

//    console.log(r)
           
//                        
console.log(ar);
//-------------------------below: commented to add ar to db instead of array-------------------------------------------------
//		 $.ajax({
//			 type: "POST",
//			  url: "'.base_url().'index.php/Orders/tempShowOrder",
//			  data: {"arr" : ar},
//			  //data: "menu_id="+menu_id+"&quantity="+quantity+"&arr="+arr,
//			 // dataType: "string",
//			  cache: false,
////                                  dataType:"json",
//			  success: function (response) {
////                              console.log(response);
//                              $(".main").html(response);
////                              $("#myModal_show_order").modal("show");
//
////			 $("#myModal").modal("toggle");
//			  }
//
//		 });

$.ajax({
			 type: "POST",
			  url: "'.base_url().'index.php/Orders/Add_order_item_direct/",
			  data: {"ar" : ar, "comments":comments},
			  //data: "menu_id="+menu_id+"&quantity="+quantity+"&arr="+arr,
			  dataType: "html",
			  cache: false,
                          
			  success: function (response) {
//window.location = "<?php echo base_url();?>index.php/Home/redirectToMyOrders"; //commented on 26oct 9.55
//				  $("#myModal").modal("toggle");
				  //alert(response.Name);
				  //alert(response.Name);
                                  $("#show_order").html(response);
			  }

		 });

	}
        
        function remove_items_from_yourorder(menuId,control,input,currentVal,menu_name){
comments = $("#txtComments").val().trim();
         if(comments == ""){
             comments = "No comments";
         }

var menu_id = menuId;
//                                console.log("control:"+control);

                console.log("menu_id:"+menu_id);
                
		var quantity = $("#quanti"+menuId).val();
                console.log("quantity:"+quantity);
                        console.log("length:"+ar.length);

		if(ar.length > 0){
                    var foundAt = ar.map(function(o) { return o.id; }).indexOf(menu_id);
                        console.log("foundAt:"+foundAt);

                  if(foundAt > -1){
                      if(quantity > 0){
                ar[foundAt].Quantity = quantity;
                $.ajax({
			 type: "POST",
			  url: "'.base_url().'index.php/Orders/Add_order_item_direct/",
			  data: {"ar" : ar, "comments":comments},
			  //data: "menu_id="+menu_id+"&quantity="+quantity+"&arr="+arr,
			  dataType: "html",
			  cache: false,
			  success: function (response) {
                                $("#show_order").html(response);
			  }

		 });
                }
            else{
//                delete ar[foundAt];
    ar.splice(foundAt, 1);
//---------------------code added on 27/10 9.10-----------------------------------------------------
$.ajax({
			 type: "POST",
			  url: "'.base_url().'index.php/Orders/remove_item",
			  data: {"ar" : ar, "Menu_id":menu_id},
			  dataType : "html",
			  cache: false,
			  success: function (response) {
//------------------------------------------below: added on 27/10 9.46 to refresh your_order modal to reflect valid items and their current quantities--------------------
				$("#show_order").html(response);  
			  }

		 });
                 }
//                 -----------------------------------------------------------------
            }
            else{


            }
              console.log(ar);                      

            }

                        

	}
</script>';
                        }
                        echo $r;
        }
            
         public function myOrders(){
             $id = $_POST['customer_id'];
             $login_type = $_POST['login_type'];
             
             $q = $this->db->query("select sales.*, customer_order.*,menu.* 
                                    from 
                                    sales join
                                    customer_order on (sales.Order_id = customer_order.Order_id) join
                                    menu on (customer_order.Menu_Id = menu.Menu_Id) 
                                    where sales.customer_id =".$id."  and sales.login_type = '".$login_type."' group by menu.Menu_Id order by sales.`Timestamp` desc")->result_array();
             
             
             $r = "<table class='table table-bordered'>
                <thead>
                <th>Sr. No.</th>
                <th>Name</th>
                
                </thead>
                <tbody>";
             $i=1;
             foreach ($q as $value) {
                 $r.='<tr><td>'.$i.'</td>';
                 $r.='<td>'.$value["Name"].'</td></tr>';
                 $i++;
             }  
                $r.= "</tbody>
            </table>";
                
//                ----------------------------show current orders------------------------------------------
                if(isset($_SESSION['order_id'])&& !empty($_SESSION['order_id'])){
                   $order_id = $this->session->userdata('order_id');
                $curOrder = $this->db->query("select co.Order_id,sum(co.Quantity) as totalQ,m.Name,os.STATUS
                                                from customer_order co 
                                                join menu m on (co.Menu_Id = m.Menu_Id)
                                                join order_status os on (co.Order_id = os.Order_id)
                                                where co.Order_id = $order_id
                                                group by co.Menu_Id");
                $r.="<h3 class='text-center'>Current Orders</h3>";
                if($curOrder->num_rows() > 0){
                    $res = $curOrder->result_array();
                    if($res[0]['STATUS']!=0){
                    $r.="<table class='table table-bordered'>
                <thead>
                <th>Sr. No.</th>
                <th>Item</th>
                
                </thead>
                <tbody>";
                    $i=1;
                    foreach ($curOrder->result_array() as $value) {
                 $r.='<tr><td>'.$i.'</td>';
                 $r.='<td>'.$value["totalQ"].' * '.$value["Name"].'</td></tr>';
                 $i++;
             } 
             if($res[0]['STATUS']==1){
                 $r.="<tr><td colspan='2' style='text-align:right;'><button type='button' class='btn btn-primary' onclick='before_generate_bill()'>Checkout</button></td></tr>";
             }
             else if($res[0]['STATUS']==2){
                 $r.="<tr><td colspan='2' style='color:green;'>Order Status: Paid</td></tr>";
             }
             
                $r.= "</tbody>
            </table>";
                }
                else{
                    $r.= '<br>There are no current orders.';
                }
                }
                else{
                    $r.= '<br>There are no current orders.';
                }
                
                }
                
//                $r.="<script>function generate_bill(){
                //	
                //	//eraseCookie('myOrder');
                //	$.ajax({
                //		type: 'POST',
                //		url: '".base_url()."index.php/Orders/generate_bill/',
                //		cache: false,
                //		success: function (response) {
                //			$('#myOrders_modal').modal('toggle');
                //			$('#bill').html(response);
                //			$('#myModal_bill').modal('show');
                //
                //			
                //			
                //		}
                //
                //	});
                //}
                //
                //
                //</script>";
                echo $r;
         }

          public function askAss(){    
             $r = "<font> Your request is accepted!!!<font>";
            //$r.="<script>function generate_bill(){ 
            //  eraseCookie('myOrder');
            //  $.ajax({
            //      type: 'POST',
            //      url: '".base_url()."index.php/Orders/generate_bill/',
            //      cache: false,
            //      success: function (response) {
            //          $('#myOrders_modal').modal('toggle');
            //          $('#bill').html(response);
            //          $('#myModal_bill').modal('show');
            //      }
            //  });
            //}
            //</script>";
                echo $r;
         }
        }
?>
