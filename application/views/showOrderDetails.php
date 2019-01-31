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
        <th>Addons</th>
        <th>Batter</th>
        <th>Amount</th>
      </tr>  
    </thead>
    <tbody>
      <?php if(!empty($order_details)){
       foreach ($order_details as $value) { ?>
          <tr>
              <td><?=$value[ 'menu_id' ]?></td>
              <td><?=$value[ 'menu_name' ]?></td>
              <td><?=$value[ 'quantity' ]?></td>
              <td><?=$value[ 'addons_name' ]?></td>
              <td><?=$value[ 'batter_name' ]?></td>
              <td><?=$value[ 'amount' ]?></td>
          </tr>
      <?php 
          } }
      ?>
  </tbody>
  </table>
</div>
                