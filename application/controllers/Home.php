<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		$this->load->database();
//		if((!isset($_SESSION['id'])) && ($_SESSION['isLoggedIn'] != True))
//		{
////			redirect('login', 'refresh');
//		}
    }

	public function index()
	{
//            foreach ($_SESSION['ar'] as $key => $value) {
//                                    echo "key:".$key."<br>";
//                                    echo "value:".$value['Name']."<br>";
//                                }
        $data['ctrlr'] = $this;

        //get background Image
        $bg = $this->db->query("select * from background_image");
            if($bg->num_rows()>0){
                $bg = $bg->result_array();
                $data['bg'] = $bg[0]['img_name'];
            }
            
            $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $data['fontName'] = $font[0]['name'];
                $data['fontSrc'] = $font[0]['src'];
            }
            
            
            
		        $this->load->model('Get_menu');
		        $data['menu_items'] = $this->Get_menu->get_menu_items();
                
                $data1 = array();
                $m = $this->db->query("select distinct(Category) from menu");
                foreach($m->result_array() as $res)
                {
                    $data1[]=$res;       
                }
                $data["categories"]= $data1;
                if(!empty($_SESSION['order_id'])){$order_id =$_SESSION['order_id']; }
                $items = $this->db->query("select count(Menu_Id) as TotalMenuItems from customer_order where Order_Id = ".$order_id." and item_status=1")->result_array();
		        $data['TotalMenuItems'] = $items[0]['TotalMenuItems'];
                //unset($_SESSION['ar']);
                $this->load->view('Main_menu', $data);
                // $this->load->view('menuFooter');
	}
        
        public function getQuantity($menu_id){
             $r = $this->db->query("SELECT Quantity
                                    FROM `customer_order` 
                                    WHERE `customer_order`.Order_id = ".$_SESSION['order_id']." and  customer_order.Menu_Id =".$menu_id." and item_status=1")->result_array();
             if(count($r))
             return $r[0]['Quantity'];
        }
        
        public function vegNonvegFilter(){
            $mode=$_POST['mode'];
            
            if ($mode=='true') //mode is true when button is enabled 
                {
                    //Retrive the values from database you want and send using json_encode
                    //example
                $data=array();
                $result1 = $this->db->query("select * from menu where type = 'Veg'");
                    $leng=$result1->num_rows();
		        foreach($result1->result_array() as $res)
                {
                    $data[]=$res;       
                }
                $r = '<thead>
				<th style="display:none;">Sr.No</th>
				<th>Name</th>
				<th>Price</th>
                <th>Qty</th>

			</thead>
			<tbody>';
                foreach($data as $row){ 
                    $r.='<tr name="'.$row['Menu_Id'].'"><td style="display:none;">'.$row['Menu_Id'].''
                            . '</td><td class="itemName" name="'.$row['Menu_Id'].'">'.$row['Name'].'</td>'
                            . '<td><i class="icon-inr"> </i>'.$row['Price'].'</td>'
                            . '<td><span class="input-group-btn">

							  <button type="button" data-id="'.$row['Menu_Id'].'" name="'.$row['Name'].'" id="btn'.$row['Menu_Id'].'" class="btn btn-default btn-number_on_menu" data-type="minus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-minus"></span>

								</button>

								</span>
';$Q = $this->getQuantity($row['Menu_Id']);
if(!empty($Q)){
                    
								$r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="'.$Q.'" min="0" max="10">';
}else{
    $r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="0" min="0" max="10">';
}
								$r.='<span class="input-group-btn">

							  <button type="button" data-id="'.$row['Menu_Id'].'" name="'.$row['Name'].'" id="btn'.$row['Menu_Id'].'" class="btn btn-default btn-number_on_menu" data-type="plus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-plus"></span>

								</button>

								</span> 
 
                    </td>
				</tr>';
				}
                                $r.="<script>$('.btn-number_on_menu').click(function(e){
    e.preventDefault();
    
var id = $(this).prop('id');
var menuId = $(this).attr('data-id');
var menu_name = $(this).attr('name');
//alert(id);
var btn = document.getElementById(id);
//alert(btn);
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $('input[id=quantity'+menuId+']');
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
                 remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
               
            }
                add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number_on_menu').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number_on_menu').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(\".btn-number_on_menu[data-type='minus'][data-field='\"+name+\"']\").removeAttr('disabled');
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(\".btn-number_on_menu[data-type='plus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$('.input-number_on_menu').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    


    $('#MenuTable .itemName').click(function (event) {
          //alert($(this).attr('name')); //trying to alert id of the clicked row
		  var menu_id = $(this).attr('name');

		  $.ajax({
			  type: 'POST',
			  url: '".base_url()."index.php/Orders/Item_details',
			  data: {menu_id : menu_id},
			 // dataType: 'string',
			  cache: false,
			  success: function (response) {
				  //console.log(response);
				  //alert(response.Name);
				  //alert(response.Name);
				 $('#item_details').html(response);
				 $('#myModal').modal('show');


$('.btn-number').click(function(e){
    e.preventDefault();
//var id = $(this).prop('id');
//var menuId = $(this).attr('data-id');
//var menu_name = $(this).attr('name');

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $(\"input[name='quantity_from_details_view']\");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
//                $(this).attr('disabled', true);
            }
//remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
//add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(\".btn-number[data-type='minus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(\".btn-number[data-type='plus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$('.input-number').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


				}

					// populate data that returned from CI(yourFunction)
					// here `msg` is a returned data from your controller
					// see console.log to see the data
					//console.log(msg);

		  })

     });

</script>";
                $data=$r;
                    echo json_encode($data);
                }

                else if ($mode=='false')  //mode is false when button is disabled
                {
                    //Retrive the values from database you want and send using json_encode
                    //example
//                    $message='Hey my button is disabled!!';
//                    $success='Disabled';
//                    echo json_encode(array('message'=>$message,'success'=>$success));
                    $data=array();
                    $result1 = $this->db->query("select * from menu where type = 'Non-Veg'");
                    $leng=$result1->num_rows();
		foreach($result1->result_array() as $res)
                {
                    $data[]=$res;       
                }
                
                $r = '<thead>
				<th style="display:none;">Sr.No</th>
				<th>Name</th>
				<th>Price</th>
                <th>Qty</th>

			</thead>
			<tbody>';
                foreach($data as $row){ 
                    $r.='<tr name="'.$row['Menu_Id'].'"><td style="display:none;">'.$row['Menu_Id'].''
                            . '</td><td class="itemName" name="'.$row['Menu_Id'].'">'.$row['Name'].'</td>'
                            . '<td><i class="icon-inr"> </i>'.$row['Price'].'</td>'
                            . '<td><span class="input-group-btn">

							  <button type="button" data-id="'.$row['Menu_Id'].'" name="'.$row['Name'].'" id="btn'.$row['Menu_Id'].'" class="btn btn-default btn-number_on_menu"  data-type="minus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-minus"></span>

								</button>

								</span>
';$Q = $this->getQuantity($row['Menu_Id']);
//								$r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="'.!empty($Q)?$Q:"0".'" min="0" max="10">
if(!empty($Q)){
                    
								$r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="'.$Q.'" min="0" max="10">';
}else{
    $r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="0" min="0" max="10">';
}
								$r.='<span class="input-group-btn">

							  <button type="button" data-id="'.$row['Menu_Id'].'" name="'.$row['Name'].'" id="btn'.$row['Menu_Id'].'" class="btn btn-default btn-number_on_menu" data-type="plus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-plus"></span>

								</button>

								</span> 
 
                    </td>
				</tr>';
				}
                                $r.="<script>$('.btn-number_on_menu').click(function(e){
    e.preventDefault();
    
var id = $(this).prop('id');
var menuId = $(this).attr('data-id');
var menu_name = $(this).attr('name');
//alert(id);
var btn = document.getElementById(id);
//alert(btn);
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $('input[id=quantity'+menuId+']');
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
                 remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
               
            }
                add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number_on_menu').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number_on_menu').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(\".btn-number_on_menu[data-type='minus'][data-field='\"+name+\"']\").removeAttr('disabled');
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(\".btn-number_on_menu[data-type='plus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$('.input-number_on_menu').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
$('#MenuTable .itemName').click(function (event) {
          //alert($(this).attr('name')); //trying to alert id of the clicked row
		  var menu_id = $(this).attr('name');

		  $.ajax({
			  type: 'POST',
			  url: '".base_url()."index.php/Orders/Item_details',
			  data: {menu_id : menu_id},
			 // dataType: 'string',
			  cache: false,
			  success: function (response) {
				  //console.log(response);
				  //alert(response.Name);
				  //alert(response.Name);
				 $('#item_details').html(response);
				 $('#myModal').modal('show');


$('.btn-number').click(function(e){
    e.preventDefault();
//var id = $(this).prop('id');
//var menuId = $(this).attr('data-id');
//var menu_name = $(this).attr('name');

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $(\"input[name='quantity_from_details_view']\");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
//                $(this).attr('disabled', true);
            }
//remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
//add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(\".btn-number[data-type='minus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(\".btn-number[data-type='plus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$('.input-number').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


				}

					// populate data that returned from CI(yourFunction)
					// here `msg` is a returned data from your controller
					// see console.log to see the data
					//console.log(msg);

		  })

     });

</script>";
                $data=$r;
   
                    echo json_encode($data);
                }
                
        }

public function getItems(){
    $a = $this->db->query("select * from menu where Category = '".$_POST['cat']."'");
    $data1 = array();
    foreach($a->result_array() as $res)
                {
                    $data1[]=$res;       
                }
                $r = '<thead>
				<th style="display:none;">Sr.No</th>
				<th>Name</th>
				<th>Price</th>
                <th>Qty</th>

			</thead>
			<tbody>';
                foreach($data1 as $row){ 
                    $r.='<tr name="'.$row['Menu_Id'].'"><td style="display:none;">'.$row['Menu_Id'].''
                            . '</td><td class="itemName" name="'.$row['Menu_Id'].'">'.$row['Name'].'</td>'
                            . '<td><i class="icon-inr"> </i>'.$row['Price'].'</td>'
                            . '<td><span class="input-group-btn">

							  <button type="button" data-id="'.$row['Menu_Id'].'" name="'.$row['Name'].'" id="btn'.$row['Menu_Id'].'" class="btn btn-default btn-number_on_menu"  data-type="minus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-minus"></span>

								</button>

								</span>

								';$Q = $this->getQuantity($row['Menu_Id']);
//								$r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="'.!empty($Q)?$Q:"0".'" min="0" max="10">
if(!empty($Q)){
                    
								$r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="'.$Q.'" min="0" max="10">';
}else{
    $r.='<input id="quantity'.$row['Menu_Id'].'" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="0" min="0" max="10">';
}
								$r.='<span class="input-group-btn">

							  <button type="button" data-id="'.$row['Menu_Id'].'" name="'.$row['Name'].'" id="btn'.$row['Menu_Id'].'" class="btn btn-default btn-number_on_menu" data-type="plus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-plus"></span>

								</button>

								</span> 
 
                    </td>
				</tr>';
				}
                                
                                $r.="<script>$('.btn-number_on_menu').click(function(e){
    e.preventDefault();
    
var id = $(this).prop('id');
var menuId = $(this).attr('data-id');
var menu_name = $(this).attr('name');
//alert(id);
var btn = document.getElementById(id);
//alert(btn);
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $('input[id=quantity'+menuId+']');
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
                 remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
               
            }
                add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number_on_menu').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number_on_menu').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(\".btn-number_on_menu[data-type='minus'][data-field='\"+name+\"']\").removeAttr('disabled');
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(\".btn-number_on_menu[data-type='plus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$('.input-number_on_menu').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
$('#MenuTable .itemName').click(function (event) {
          //alert($(this).attr('name')); //trying to alert id of the clicked row
		  var menu_id = $(this).attr('name');

		  $.ajax({
			  type: 'POST',
			  url: '".base_url()."index.php/Orders/Item_details',
			  data: {menu_id : menu_id},
			 // dataType: 'string',
			  cache: false,
			  success: function (response) {
				  //console.log(response);
				  //alert(response.Name);
				  //alert(response.Name);
				 $('#item_details').html(response);
				 $('#myModal').modal('show');


$('.btn-number').click(function(e){
    e.preventDefault();
//var id = $(this).prop('id');
//var menuId = $(this).attr('data-id');
//var menu_name = $(this).attr('name');

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $(\"input[name='quantity_from_details_view']\");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
//                $(this).attr('disabled', true);
            }
//remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
//add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(\".btn-number[data-type='minus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(\".btn-number[data-type='plus'][data-field='\"+name+\"']\").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$('.input-number').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


				}

					// populate data that returned from CI(yourFunction)
					// here `msg` is a returned data from your controller
					// see console.log to see the data
					//console.log(msg);

		  })

     });

</script>";
                $data=$r;
                    echo json_encode($data);
}

public function waitingTime(){
    
    
            
            
    $order_id = $this->session->userdata('order_id');
    $table_id = $this->session->userdata('table_id');	
    $fromajax = 0;	
    if(isset($_POST["fromajax"]))	$fromajax = $_POST["fromajax"];
    
//    $order_id = 6;
//    $table_id = 3;
    //get orders from table
    
    if($order_id != false || $table_id != false){
    $q = "SELECT 
  `sales`.`Order_id`,
  `menu`.`Menu_Id`,
  `menu`.`time`,
  `customer_order`.`Order_id`,
  `customer_order`.`Menu_Id`,
  `orders`.`Table_id`,
  `orders`.`Order_id`,
  `orders`.`Timestamp`
FROM
  `customer_order`
  left JOIN `menu` ON (`customer_order`.`Menu_Id` = `menu`.`Menu_Id`)
  left JOIN `sales` ON (`customer_order`.`Order_id` = `sales`.`Order_id`)
  left JOIN `orders` ON (`customer_order`.`Order_id` = `orders`.`Order_id`)
WHERE
  `orders`.`Order_id` = ".$order_id." and orders.Table_id = ".$table_id."";
    $o = $this->db->query($q);
    $data = array();
    foreach ($o->result_array() as $v) {
        $data[]=$v;
    }
    $len = count($data);
    $time = array();
    for($i=0;$i<$len;$i++){
        $time[$i] = $data[$i]['time'];
    }
    $max = max($time);	$data["waitingTime"]= $max;    
    $data["fromajax"]= ($fromajax)? $fromajax:0;	
    $data["Order_id"]=$order_id;
    // echo "asdfkk abhi";
    $data['order_id'] = $order_id;
    
    
    $bg = $this->db->query("select * from background_image");
            if($bg->num_rows()>0){
                $bg = $bg->result_array();
                $data['bg'] = $bg[0]['img_name'];
            }
            
            $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $data['fontName'] = $font[0]['name'];
                $data['fontSrc'] = $font[0]['src'];
            }
    
		$this->load->view('timer', $data);
    }
    else{
        $bg = $this->db->query("select * from background_image");
            if($bg->num_rows()>0){
                $bg = $bg->result_array();
                $data['bg'] = $bg[0]['img_name'];
            }
            
            $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $data['fontName'] = $font[0]['name'];
                $data['fontSrc'] = $font[0]['src'];
            }
            
        $data["waitingTime"] = "N/A";
        $this->load->view('timer', $data);
//        redirect('login', 'refresh');
    }
}

public function toHome()
{
//    redirect('login');
    $data = array();
            $res=$this->db->query("select * from logo");
            if($res->num_rows()>0){
                $res = $res->result_array();
                $data['logo'] = $res[0]['img_name'];
            }
            $bg = $this->db->query("select * from background_image");
            if($bg->num_rows()>0){
                $bg = $bg->result_array();
                $data['bg'] = $bg[0]['img_name'];
            }
            $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $data['fontName'] = $font[0]['name'];
                $data['fontSrc'] = $font[0]['src'];
            }
    
    $this->load->view('login',$data);


}

public function getCurrentArray(){
    if(!empty($_SESSION['ar'])){
        echo json_encode($_SESSION['ar']);
    }
}
}
?>
