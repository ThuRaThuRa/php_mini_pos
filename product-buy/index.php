<?php
require '../init.php';







if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $product_slug = $_GET['product-slug'];


    $product_buy_data = getOne("select * from product_buy where id=?", [$id]);
    $product_data = getOne("select * from product where slug=?", [$product_slug]);
    $total_quantity = $product_data->total_qty - $product_buy_data->total_qty;

    query("delete from product_buy where id=?", [$id]);
    query("update product set total_qty=? where slug=?", [$total_quantity, $product_slug]);
    setMsg("Product Buy Deleted Successfully");
    go("index.php?product-slug=" . $product_slug);
    die();
    // echo $total_quantity;
    // print_r($product_buy_data);
    // die();
    // $totla_qty = $product_data->total_qty - $product_buy_data->total_qty;




}

$product_slug = $_GET['product-slug'];
$product = getOne("select * from product where slug=?", [$product_slug]);
$buy = getAll("select * from product_buy where product_id=?", [$product->id]);




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
            <a href="create.php?product-slug=<?php echo $product_slug; ?>" class="btn btn-warning">Create</a>
            <form action="" method="POST">
                <table class="table table-striped">
                    <thead>
                        <th>Buy Price</th>
                        <th>Buy Quantity</th>
                        <th>Buy Date</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                        <?php foreach ($buy as $b) { ?>
                            <tr class="text-white">
                                <td><?= $b->buy_price; ?></td>
                                <td><?= $b->total_qty; ?></td>
                                <td><?= $b->buy_date; ?></td>
                                <td>
                                    <a href="index.php?action=delete&product-slug=<?php echo $product_slug ?>&id=<?php echo $b->id; ?>" onclick=" confirm('Are you sure')">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>