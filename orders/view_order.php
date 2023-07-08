<?php
require_once('./../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT o.*,v.shop_name,v.code as vcode from `order_list` o inner join vendor_list v on o.vendor_id = v.id where o.id = '{$_GET['id']}' ");
    // var_dump($qry->num_rows);
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        // var_dump( $$k);
    }else{
?>
		<center>Unknown order</center>
		<!-- <style>
			#uni_modal .modal-footer{
				display:none
			}
		</style>
		<div class="text-right">
			<button class="btn btndefault bg-gradient-dark btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
		</div> -->
		<?php
		exit;
		}
}
?>
<style>
  .modal-title,
  .product-title,
  .description {
    font-size: 16px;
    font-weight: bold;
  }

  .modal-title{
    font-size: 24px;
  }

  .price-amount{
    font-size: 16px !important;
    color: #777777 !important;
  }

  .total-amount {
    font-size: 16px;
    font-weight: bold;
    color: black;
  }

  .btn-danger,
  .btn-secondary {
    font-size: 1.2rem;
    font-weight: bold;
  }

  .modal-content {
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-size: 24px;
    color: black;
    font-weight: bold;
  }

  .single-product-content {
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 10px;
    background-color: #f5f5f5;
  }

  .thumbnail {
    border-radius: 10px;
    overflow: hidden;
  }

  .thumbnail img {
    object-fit: cover;
    object-position: center;
  }

  .order-details {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
    color: black;
  }
</style>
<div class="modal-header">
  <h5 class="modal-title" id="viewItemModalLabel">View Ordered Item <?= $id ?></h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <div class="single-product-thumb">
    <div class="row">
      <?php 
        $gtotal = 0;
        $products = $conn->query("SELECT o.*, p.name as `name`, p.price,p.image_path FROM `order_items` o inner join product_list p on o.product_id = p.id where o.order_id='{$id}' order by p.name asc");
        while($prow = $products->fetch_assoc()):
            $total = $prow['price'] * $prow['quantity'];
            $gtotal += $total;
      ?>
        <div class="col-lg-7 mb-4">
          <div class="row">
            <div class="col-lg-12">
              <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                <div class="thumbnail">
                  <a href="./?page=products/view_product&id=<?= $prow['product_id'] ?>"><img src="<?= validate_image($prow['image_path']) ?>" alt="<?= $prow['name'] ?>" alt="Product Images"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 mb-4">
          <div class="single-product-content">
            <div class="inner">
              <h3 class="product-title"><?= $prow['name'] ?></h3>
              <span class="price-amount">Price: $<?= format_num($prow['price']) ?></span>
            </div>
            <p class="description"><strong>Quantity:</strong> <?= format_num($prow['quantity']) ?></p>
            <p class="description"><strong>Status:</strong>
              <?php
              $status = isset($status) ? $status : '';
              switch ($status) {
                case 0:
                  echo '<span class="badge btn btn-info badge-secondary bg-gradient-secondary px-3 rounded-pill">Pending</span>';
                  break;
                case 1:
                  echo '<span class="badge btn btn-primary badge-primary bg-gradient-primary px-3 rounded-pill">Confirmed</span>';
                  break;
                case 2:
                  echo '<span class="badge btn btn-info badge-info bg-gradient-info px-3 rounded-pill">Packed</span>';
                  break;
                case 3:
                  echo '<span class="badge btn btn-warning badge-warning bg-gradient-warning px-3 rounded-pill">Out for Delivery</span>';
                  break;
                case 4:
                  echo '<span class="badge btn btn-success badge-success bg-gradient-success px-3 rounded-pill">Delivered</span>';
                  break;
                case 5:
                  echo '<span class="badge btn btn-danger badge-danger bg-gradient-danger px-3 rounded-pill">Cancelled</span>';
                  break;
                default:
                  echo '<span class="badge btn btn-light badge-light bg-gradient-light border px-3 rounded-pill">N/A</span>';
                  break;
              }
              ?>
            </p>
            <p class="description"><strong>Reference Code:</strong> <?= isset($code) ? $code : '' ?></p>
            <p class="description"><strong>Address:</strong> <?= isset($delivery_address) ? $delivery_address : '' ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<div class="modal-footer">
  <p class="total-amount"><strong>Total:</strong> $<?= format_num($gtotal) ?></p>
  <?php if (isset($status) && $status == 0): ?>
    <button type="button" class="btn btn-danger" id="cancel_order">Cancel Order</button>
  <?php endif; ?>
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>












<script>
        const _conf = function($msg = '', $func = '', $params = []) {
            $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
  
        }

    $(function(){
        $('#cancel_order').click(function(){
            _conf("Are you sure to cancel this order?","cancel_order",['<?= isset($id) ? $id : '' ?>'])
            $(".modal.fade.rounded-0").css("display", "block");
        })
    })
    function cancel_order($id){
        start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=cancel_order",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
    }
</script>
