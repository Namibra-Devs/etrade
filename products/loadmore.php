<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['pg']) && isset($_GET['lim'])) {
    $page = $_GET['pg'];
    $limit = $_GET['lim'];

    // Calculate the offset based on the current page and limit
    $offset = ($page - 1) * $limit;

    // Prepare and execute the database query
    $stmt = $conn->prepare("SELECT * FROM product_list LIMIT ?, ?");
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Loop through the fetched products and generate the HTML markup for each product
    while ($row = $result->fetch_assoc()) {
?>
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <div class="axil-product product-style-one has-color-pick mt--40">
            <div class="thumbnail">
                <a href="single-product.php">
                    <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" class="main-img sal-animate" src="<?= validate_image(isset($row['image_path']) ? $row['image_path'] : ""); ?>" alt="Product Images">
                </a>

                <div class="product-hover-action">
                    <ul class="cart-action">
                        <!-- <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li> -->
                        <li class="select-option">
                            <a id="add_to_cart" onclick="add_to_cart(<?= $row['id']; ?>)">
                                Add to Cart
                            </a>
                        </li>
                        <li class="quickview"><a onclick="openQuickViewModal(<?= $row['id']; ?>)" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="product-content">
                <div class="inner">
                    <h5 class="title"><a href="single-product.php"><?= $row['name']; ?></a></h5>
                    <div class="product-price-variant">
                        <span class="price current-price">$<?= format_num($row['price']); ?></span>
                        <!-- <span class="price old-price">$30</span> -->
                    </div>
                    <div class="color-variant-wrapper">
                        <!-- <ul class="color-variant">
                            <li class="color-extra-01 active"><span><span class="color"></span></span>
                            </li>
                            <li class="color-extra-02"><span><span class="color"></span></span>
                            </li>
                            <li class="color-extra-03"><span><span class="color"></span></span>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}
?>
