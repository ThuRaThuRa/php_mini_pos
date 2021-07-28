<?php
require '../init.php';
require '../include/header.php';
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Product Buy</h4>
                > Create
            </span>
        </div>
    </div>
</div>
<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label for="">Enter Buy Price</label>
                    <input type="number" name="buy_price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Enter Total Quantity</label>
                    <input type="number" name="total_quantity" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Enter Buy Date</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="total_quantity" class="form-control">
                </div>
                <input type="submit" name="create" value="Create">
                <input type="submit" name="create" value="Create">
            </form>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>