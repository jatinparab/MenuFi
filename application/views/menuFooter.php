
<style>
  /* scrol css */
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  left: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: #FF0000;
  color: white;
  cursor: pointer;
  width: 75px;
  height: 30px;
  border-radius: 5%;
}

#myBtn:hover {
  background-color: #191919;
}
</style>
<div class="scroll">
  <button onclick="topFunction()" type="submit" id="myBtn" onclick="final_order()" >Checkout</button>
</div>

<script>

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

function final_order(){
  //alert("test");
  $.ajax({
    type: 'GET',
     url: '<?php echo base_url();?>index.php/Orders/final_order/',
     cache: false,
     success: function (response) {
//       $('#final_item_details').html(response);
//       $('#myModal_final').modal('show');

       //$('#myModal').modal('toggle');
       //alert(response.Name);
       //alert(response.Name);
     }

  });
}

</script> 