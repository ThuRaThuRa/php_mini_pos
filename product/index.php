<?php
require '../init.php';
if (!isset($_SESSION['user'])) {
    setError('Please login first');
    go('login.php');
}
if (isset($_GET['sale']) and !empty($_GET['sale'])) {
    $slug = $_GET['product-slug'];
    $product = getOne("select * from product where slug=?", [$slug]);


    $product_id = $product->id;
    $sale_price = $product->sale_price;
    $update_total_qty = $product->total_qty - 1;

    $date = date('Y-m-d');
    query("update product set total_qty=? where slug=?", [$update_total_qty, $slug]);
    query("insert into product_sale (product_id,sale_price,date) values(?,?,?)", [$product_id, $sale_price, $date]);
    setMsg("Sale Created Successfully");
    go("index.php");
    die();
}
if (isset($_GET['page'])) {
    paginateProduct(2);
    die();
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $product = getAll("select * from product where name like '%$search%' order by id desc limit 2");
} else {
    $search = '';
    $product = getAll("select * from product order by id desc limit 2");
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
            <a href="create.php" class="btn btn-sm btn-warning">Create</a>
            <form action="" class="mt-5">
                <input type="text" name="search" value="<?php echo $search; ?>" class="btn bg-white">
                <button type="submt" class="btn btn-primary">
                    <span class="fa fa-search"></span></button>
                <?php
                if (!empty($search)) {
                    echo '<a href="index.php" class="btn btn-danger">Clear Search</a>';
                }
                ?>
            </form>
            <?php
            showMsg();
            showError();
            ?>
            <table class="table table-striped text-white mt-2">

                <thead>
                    <th>name</th>
                    <th>Qty</th>
                    <th>Sale Price</th>
                    <th>option</th>
                </thead>
                <tbody id="tblData">
                    <?php
                    foreach ($product as $p) { ?>
                    <tr>
                        <td><?= $p->name; ?></td>
                        <td><?= $p->total_qty; ?></td>
                        <td><?= $p->sale_price; ?></td>
                        <td>
                            <!-- view -->
                            <a href="detail.php?slug=<?php echo $p->slug; ?>" class="btn btn-sm btn-success">
                                <span class="fa fa-eye"></span>
                            </a>
                            <!-- edit -->
                            <a href="edit.php?slug=<?php echo $p->slug; ?>" class="btn btn-sm btn-primary">
                                <span class="fa fa-edit"></span>
                            </a>

                            <!-- destory -->
                            <a href="" class="btn btn-sm btn-danger">
                                <span class="fa fa-trash"></span>
                            </a>
                            |
                            <a href="<?php echo $root . 'product-buy/index.php?product-slug=' . $p->slug; ?>"
                                class="btn btn-outline-danger btn-sm">
                                Buy
                            </a>
                            <a href="index.php?product-slug=<?php echo $p->slug; ?>&sale=true"
                                class="btn btn-outline-success btn-sm">
                                Sale
                            </a>
                            <a href="sale-list.php?product-slug=<?php echo $p->slug; ?>&sale=true"
                                class="btn btn-outline-success btn-sm">
                                Sale List
                            </a>
                        </td>


                    </tr>
                    <?php
                    }
                    ?>

                </tbody>

            </table>
            <div class="text-center">
                <button class="btn btn-sm btn-warning" id="btnFetch">
                    <span class="fas fa-arrow-down"></span>
                </button>
            </div>


        </div>
    </div>
</div>
<?php
require '../include/footer.php';
?>
<script>
$(function() {
    // alert('nice');
    var page = 1;
    var tblData = $('#tblData');
    var btnFetch = $('#btnFetch');
    btnFetch.click(function() {
        page += 1;
        var search = "<?php echo $search; ?>";
        var url = `index.php?page=${page}`;
        if (search) {
            url += `&search=${search}`;
        }
        // console.log(url);
        // return;

        $.get(url)
            .then(function(data) {
                const d = JSON.parse(data);
                var htmlString = '';
                if (!d.length) {
                    btnFetch.attr('disabled', 'disabled')
                }
                d.map(function(d) {
                    htmlString += `
                <tr>
                        <td>${d.name}</td>
                        <td>${d.total_qty}</td>
                        <td>${d.sale_price}</td>
                        <td>
                            <!-- view -->
                            <a href="detail.php?slug=${d.slug}" class="btn btn-sm btn-success">
                                <span class="fa fa-eye"></span>
                            </a>
                            <!-- edit -->
                            <a href="edit.php?slug=${d.slug}" class="btn btn-sm btn-primary">
                                <span class="fa fa-edit"></span>
                            </a>
                            
                            <!-- destory -->
                            <a href="" class="btn btn-sm btn-danger">
                                <span class="fa fa-trash"></span>
                            </a>
                            |
                            <a href="<?= $root; ?>product-buy/index.php?product-slug=${d.slug}" class="btn btn-outline-danger btn-sm">
                                Buy
                            </a>
                            
                            <a href="index.php?product-slug=${d.slug}&sale=true" class="btn btn-outline-success btn-sm">
                                Sale
                            </a>
                            <a href="sale-list.php?product-slug=${d.slug}&sale=true" class="btn btn-outline-success btn-sm">
                                Sale List
                            </a>
                        </td>

                    
                    </tr>
                `;
                })
                tblData.append(htmlString);
            })

    });
});
</script>