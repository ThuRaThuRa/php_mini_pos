<?php
require '../init.php';
if (isset($_GET['slug']) and !empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $product = getOne("
    SELECT product.*,category.name as category_name,
     (select COUNT(id) from product_sale 
     where product.id=product_sale.product_id) as sale_count 
     FROM product left JOIN category ON 
     product.category_id=category.id
     where product.slug='$slug'
    ");
    if (!$product) {
        setError("Wrong Slug");
        go('index.php');
        die();
    }
} else {
    setError("Wrong Slug");
    go('index.php');
    die();
}
require '../include/header.php';
?>

<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Product</h4>
                > All
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- image -->
                <div class="col-3">
                    <img src="<?php echo $root . 'image/' . $product->image; ?>" class="img-thumbnail w-100" alt="">
                </div>
                <div class="col-9">
                    <div class="card bg-dark p-3">
                        <h4 class="text-white">ProducT Title</h4>
                        <div>
                            Category : <span class="badge bg-primary text-white">Category</span>
                        </div>
                        <div class="rounded bg-primary p-3 mt-3 text-white">
                            <table class="table  text-white">
                                <thead>
                                    <tr>
                                        <th>Sale Coutnt</th>
                                        <th>Sale Price</th>
                                        <th>Remain Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $product->sale_count; ?></td>
                                        <td><?php echo $product->sale_price; ?></td>
                                        <td><?php echo $product->total_qty; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 bg-primary p-3">
                            <p class="text-white">
                                <?php echo $product->description; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>