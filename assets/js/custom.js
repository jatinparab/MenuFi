checkTime();
setInterval(checkTime,(30*1000));
function readCookie(name) { 
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');  
	for(var i=0;i < ca.length;i++) {     
		var c = ca[i];      
		while (c.charAt(0)==' ')
			c = c.substring(1,c.length);    
		if (c.indexOf(nameEQ) == 0) 
			return c.substring(nameEQ.length,c.length); 
	}
	return null;
}
function checkTime(){ 
	var baseURL = readCookie("baseURL");   
	console.log("checking cookie "+ baseURL);  
	var data = readCookie("myOrder"); 
	if(data){    
		console.log("inside");   
		var b = data.split("|");   
		console.log(((Number(b[0])+Number(b[1]))-(new Date().getTime())));  
		if(((Number(b[0])+Number(b[1]))-(new Date().getTime()))<=0){  
			$.ajax({          
				url:baseURL+"index.php/Home/waitingTime/",   
				data:{"fromajax":1},       
				type:"POST",     
				async: false,     
				success: function(data){   
					document.write(data);      
					document.close();   

					console.log("cookie Deleted");    
				}      
			}); 
		}  
	}
}
function readCookie(name) { 
	var nameEQ = name + "=";  
	var ca = document.cookie.split(';');  
	for(var i=0;i < ca.length;i++) { 
		var c = ca[i];   
		while (c.charAt(0)==' ')
			c = c.substring(1,c.length); 
		if (c.indexOf(nameEQ) == 0) 
			return c.substring(nameEQ.length,c.length);
	}   
	return null;
}
$('.btn-number').click(function(e){ 
	e.preventDefault();    
	fieldName = $(this).attr('data-field'); 
	type      = $(this).attr('data-type');  
	var input = $("input[name='"+fieldName+"']"); 
	var currentVal = parseInt(input.val());   
	if (!isNaN(currentVal)) {     
		if(type == 'minus') {     
			if(currentVal > input.attr('min')) {  
				input.val(currentVal - 1).change();    
			}      
			if(parseInt(input.val()) == input.attr('min')) {  
				$(this).attr('disabled', true);       
			}  
		} else if(type == 'plus') {  
			if(currentVal < input.attr('max')) { 
				input.val(currentVal + 1).change();   
			}      
			if(parseInt(input.val()) == input.attr('max')) {  
				$(this).attr('disabled', true);   
			}  
		} 
	} else { 
		input.val(0);   
	}});
$('.input-number').focusin(function(){ 
	$(this).data('oldValue', $(this).val());});
$('.input-number').change(function() {    
	minValue =  parseInt($(this).attr('min'));  
	maxValue =  parseInt($(this).attr('max'));  
	valueCurrent = parseInt($(this).val());   
	name = $(this).attr('name');   
	if(valueCurrent >= minValue) {    
		$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')  
	} else {    
		alert('Sorry, the minimum value was reached');    
		$(this).val($(this).data('oldValue'));   
	} 
	if(valueCurrent <= maxValue) {   
		$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled') 
	} else {
		alert('Sorry, the maximum value was reached'); 
		$(this).val($(this).data('oldValue'));  
	}   
});
$(".input-number").keydown(function (e) {     
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {  return;  } if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) { 
		e.preventDefault();    
	} 
});