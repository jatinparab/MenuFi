<div class="modal-header" style = "background-color :  rgb(51, 122, 183);">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = "color : #FFFFFF;" ><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" style = "color : #FFFFFF;" >Order No. : <?php echo $order_id; ?></h4>
</div>
<div class="modal-body" >
  <table class="table table-striped table-dark">
    <thead class="thead-light">
      <tr>
        <th>Menu Id</th>
        <th>Menu</th>   
        <th>Quantity</th>
      
 
        <th>Amount</th>
        <th>Print</th>
      </tr>  
    </thead>
    <tbody>
      <?php if(!empty($order_details)){
       foreach ($order_details as $value) { ?>
          <tr>
              <td><?=$value[ 'menu_id' ]?></td>
              <td><?=$value[ 'menu_name' ]?></td>
              <td><?=$value[ 'quantity' ]?></td>
              <td><?=$value[ 'amount' ]?></td>
              <td><button onclick="print('<?=$order_id?>')" class="btn btn-sm btn-success">Print</button></td>
          </tr>
      <?php 
          } }
      ?>
  </tbody>
  </table>
</div>

<script> 
function print(id){
           
               var printWindow = window.open('', '', 'height=300,width=600');

             $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/Admin/printafterOrder',
                data : {
                    'Order_id':id
                },
                cache:false,
                dataType:'html',
                success: function(resp){
                    printWindow.document.write(resp);
                    printWindow.print();

            }
            });
          
        }
</script>
                