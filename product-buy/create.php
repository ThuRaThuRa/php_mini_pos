<?php
require '../init.php';
$product_slug = $_GET['product-slug'];
$product = getOne("select id,total_qty from product where slug=?", [$product_slug]);




// print_r($product);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $req = $_REQUEST;
    $buy_price = $req['buy_price'];
    $total_quantity = $req['total_quantity'];
    $buy_date = $req['buy_date'];


    query("insert into product_buy (product_id,buy_price,total_qty,buy_date) values(?,?,?,?)", [
        $product->id, $buy_price, $total_quantity, $buy_date
    ]);
    $total_qty = $product->total_qty  + $total_quantity;

    query("update product set total_qty=$total_qty  where slug='$product_slug'");
    setMsg("Product Add Success");
    go('create.php?product-slug=' . $product_slug);
    die();
}
// print_r($product_buy);
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
            <?php
            showError();
            showMsg();
            ?>
            <form action="" method="POST">
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
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" name="buy_date" class="form-control">
                </div>
                <input type="submit" name="create" value="Create" class="btn btn-warning">

            </form>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>