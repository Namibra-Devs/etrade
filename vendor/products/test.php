<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * FROM `product_list` WHERE id = '{$_GET['id']}' AND delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k = $v;
        }
    } else {
        ?>
        <center>Unknown Shop Type</center>
        <style>
            #uni_modal .modal-footer{
                display:none
            }
        </style>
        <div class="text-right">
            <button class="btn btndefault bg-gradient-dark btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
        <?php
        exit;
    }
}

$categories = $conn->query("SELECT * FROM `category_list` WHERE delete_flag = 0 AND `status` = 1 AND vendor_id = '{$_settings->userdata('id')}' ORDER BY `name` ASC");
?>

<div class="container-fluid">
    <form action="" id="product-form">
        <!-- Rest of the form code remains the same -->

        <div class="row">
            <div class="col-md-6">
                <!-- Rest of the form fields -->
                <div class="form-group">
                    <label for="category_id" class="control-label">Category</label>
                    <select type="text" id="category_id" name="category_id" class="form-control form-control-sm form-control-border select2" required>
                        <option value="" disabled <?= !isset($category_id) ? 'selected' : "" ?>></option>
                        <?php while($row = $categories->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? 'selected': '' ?>><?= $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <!-- Rest of the form fields -->
            </div>
            <div class="col-md-6">
                <!-- Rest of the form fields -->
            </div>
        </div>
        
    </form>
</div>
