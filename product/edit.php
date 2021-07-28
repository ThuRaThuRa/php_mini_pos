<?php
require '../init.php';

?>
<?php

if (!isset($_SESSION['user'])) {
    setError('Please login first');
    go('login.php');
}
if (isset($_GET['slug']) and !empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $category = getAll("select * from category");
    $product = getOne("select * from product where slug = '$slug'");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = $_REQUEST;
        $name = $request['name'];
        $category_id = $request['category_id'];
        $sale_price = $request['sale_price'];
        $description = $request['description'];
        // die($name . $category_id . $sale_price . $description);
        $file = $_FILES['image'];
        if (isset($file) and !empty($file['name'])) {
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
            if ('../image/' . $product->image) {
                unlink('../image/' . $product->image);
            }
        } else {
            $file_name = $product->image;
        }
        $sql = "
        update product set name='$name',category_id=$category_id,description='$description',image='$file_name',sale_price=$sale_price where slug='$slug'
        ";
        $res = query($sql);
        if ($res) {
            setMsg("Product update success");
            go('edit.php?slug=' . $product->slug);
            die();
        } else {
            setMsg("Product update Fail");
            go('edit.php?slug=' . $product->slug);
            die();
        }
    }
    //update 

    //image upload

} else {
    setError("Wrong Slug");
    go("index.php");
    die();
}

// print_r($product);


//
require '../include/header.php';

?>
<!-- Breadcamp -->
<div class="container-fluid pr-5 pl-5">
    <div class="row mt-3">
        <div class="col-12">
            <span class="text-white">
                <h4 class="d-inline text-white">Category</h4>
                > Edit
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
            showMsg();
            ?>
            <form action="" class="mt-3 row" method="POST" enctype="multipart/form-data">
                <div class="col-12">
                    <h4 class="text-white">Product Info</h4>
                    <!-- category -->
                    <div class="form-group">
                        <label for="">Choose Category</label>
                        <select name="category_id" id="" class="form-control">
                            <?php
                            foreach ($category as $c) {
                                $selected = $c->id == $product->category_id ?  'selected' : '';
                                echo "<option value='{$c->id}' $selected>{$c->name}</option>";
                            }
                            ?>

                        </select>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $product->name; ?>">
                    </div>
                    <!-- file -->
                    <div class="form-group">
                        <label for="">Choose Image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="<?php echo $root . 'image/' . $product->image; ?>" width="200px"
                            class="img-thumbnail">
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description"
                            class=" form-control"><?php echo $product->description; ?>                        </textarea>


                    </div>
                    <div class="form-group">
                        <label for="">Sale Price</label>
                        <input type="number" value="<?php echo $product->sale_price ?>" name=" sale_price"
                            class="form-control">
                    </div>
                </div>
                <!-- Product Inventory -->

                <div class="col-12">
                    <input type="submit" value="Update" class="btn btn-warning">
                </div>
            </form>

        </div>

    </div>
</div>
<?php
require '../include/footer.php';
?>
<?php
require '../include/footer.php'
?>