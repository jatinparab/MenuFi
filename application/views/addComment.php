<div class="modal-header" style = "background-color :  rgb(51, 122, 183);">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = "color : #FFFFFF;" ><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" style = "color : #FFFFFF;" >Order No. : <?php echo $id; ?></h4>
</div>
<div class="modal-body" >
  <h2 class="text-center">Enter Comment</h2>
    <input id="comment" class="form-control" type="text">
    <br><br>
    <a onclick="addC('<?=$id?>')" class="btn btn-success btn-block">Add</a>
</div>

<script> 
function addC(id){
           
               comment = $('#comment').val();

             $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/Admin/ajax_addC',
                data : {
                    'id':id,
                    'comment':comment
                },
                cache:false,
                dataType:'html',
                success: function(resp){
                   if(resp == 'success'){
                       alert('Comment added');
                       $('body').load('<?=base_url()?>index.php/Admin/searchD');
                   }

            }
            });
          
        }
</script>
                