<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setError('Please login first');
    go('login.php');
}

$category = getAll("select * from category");




// $image = $file['name'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_REQUEST['category_id'];
    $slug = slug($_REQUEST['name']);
    $name = $_REQUEST['name'];
    $description = $_REQUEST['description'];
    $total_qty = $_REQUEST['total_quantity'];
    $sale_price = $_REQUEST['sale_price'];
    $buy_price = $_REQUEST['buy_price'];
    $buy_date = $_REQUEST['buy_date'];
    // print_r($_REQUEST);
    if (empty($category_id)) {
        setError("Choose Category");
    }
    if (empty($name)) {
        setError("Enter name");
    }
    if (empty($description)) {
        setError("description");
    }
    if (empty($total_qty)) {
        setError("Choose Total Qty");
    }
    if ($total_qty <= 0) {
        setError("Total Qty must be greater than 0");
    }
    if ($buy_price <= 0) {
        setError("Buy price must be greater than 0");
    }
    if ($sale_price <= 0) {
        setError("Sale Price must be greater than 0");
    }
    if (empty($sale_price)) {
        setError("Choose sale price");
    }
    $file = $_FILES['image'];
    if (empty($file['name'])) {
        setError("Please Choose Image");
    } else {
        $file_limit_size = 1024 * 1024 * 2;
        $file_size = $file['size'];
        if ($file_limit_size < $file_size) {
            setError("Image must be below 2mb");
        }
        //image uploaded
        $file_name = slug($file['name']);
        $file_path = "../image/" . $file_name;
        $tmp_name = $file['tmp_name'];
        move_uploaded_file($tmp_name, $file_path);
        // save product
        if (!hasError()) {
            query(
                'insert into product (category_id,slug,name,image,description,total_qty,sale_price) values (?,?,?,?,?,?,?)',
                [$category_id, $slug, $name, $file_name, $description, $total_qty, $sale_price]
            );
            $product_id = $conn->lastInsertId();
            //save product buy
            query(
                '
            insert into product_buy(product_id,buy_price,total_qty,buy_date) values
            (?,?,?,?)',
                [$product_id, $buy_price, $total_qty, $buy_date]
            );
            setMsg('Product Created success');
            go('index.php');
        }
    }
}
require '../include/header.php';

?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Category</h4>
                > All
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid pr-5 pl-5 mt-3">
    <div class="card">
        <div class="card-body">
            <a href="index.php" class="btn btn-success btn-sm">All</a>
            <?php
            showError();
            // showMsg(); 
            ?>
            <form action="" class="mt-3 row" method="POST" enctype="multipart/form-data">
                <div class="col-6">
                    <h4 class="text-white">Product Info</h4>
                    <!-- category -->
                    <div class="form-group">
                        <label for="">Choose Category</label>
                        <select name="category_id" id="" class="form-control">
                            <?php
                            foreach ($category as $c) {
                                echo "<option value='{$c->id}'>{$c->name}</option>";
                            }
                            ?>

                        </select>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <!-- file -->
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <!-- Product Inventory -->
                <div class="col-6">
                    <h4 class="text-white"> Inventory</h4>
                    <span class="text-primary">
                        <span class="fas fa-info-circle text-primary"></span>
                        For Sale Info
                    </span>

                    <div class="form-group">
                        <label for="">Sale Price</label>
                        <input type="number" name="sale_price" class="form-control">
                    </div>
                    <span class="text-primary">
                        <span class="fas fa-info-circle text-primary"></span>
                        For Buy Info
                    </span>
                    <!-- totol qty -->
                    <div class="form-group">
                        <label for="">Total Qty</label>
                        <input type="number" name="total_quantity" class="form-control">
                    </div>
                    <!-- buy price -->
                    <div class="form-group">
                        <label for="">Buy Price</label>
                        <input type="number" name="buy_price" class="form-control">
                    </div>
                    <!-- buy date -->
                    <div class="form-group">
                        <label for="">Buy Date</label>
                        <input type="date" name="buy_date" value="<?= date('Y-m-d'); ?>" class="form-control">
                    </div>

                </div>
                <div class="col-12">
                    <input type="submit" value="Create" class="btn btn-warning">
                </div>
            </form>

        </div>

    </div>
</div>
<?php
require '../include/footer.php';
?>