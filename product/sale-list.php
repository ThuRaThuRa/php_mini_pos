<?php
require '../init.php';
if (isset($_GET['delete'])) {
    $product_slug = $_GET['product-slug'];
    $sale_id = $_GET['id'];
    $product_id = getOne("select product_id from product_sale where id=?", [$sale_id])->product_id;

    // print_r($sale);
    // die();
    query("update product set total_qty=product.total_qty+1 where id=?", [$product_id]);
    query("delete from product_sale where id=?", [$sale_id]);
    setMsg("Sale Delete successfully");
    go("sale-list.php?product-slug=" . $product_slug);
    die();
}
if (isset($_GET['product-slug']) and !empty($_GET['product-slug'])) {
    $slug = $_GET['product-slug'];
    $product = getOne("select * from product where slug=?", [$slug]);
    $sales = getAll("select * from product_sale where product_id=?", [$product->id]);
    // print_r($sales);
}
require '../include/header.php';
?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Product</h4>
                > <?php echo $product->name; ?>
                > Sale List
            </span>
        </div>
    </div>
</div>
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
        <div class="card-body">
            <?php
            showError();
            showMsg();

            ?>
            <table class="table table-striped">
                <tr>
                    <td>Sale Price</td>
                    <td>Date</td>
                    <td>
                        Option
                    </td>
                </tr>
                <?php
                foreach ($sales as $s) {
                ?>
                <tr>
                    <td><?= $s->sale_price; ?></td>
                    <td><?= $s->date; ?></td>
                    <td>
                        <a href="sale-list.php?delete=true&id=<?= $s->id; ?>&product-slug=<?php echo $slug; ?>"
                            class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php }
                ?>

            </table>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>