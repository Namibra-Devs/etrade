<?php if (isset($_GET['category_id']) && $_GET['category_id'] > 0 && isset($_GET['price_range']) && $_GET['price_range'] > 0) : ?>

    <?php
    $category_id = $_GET['category_id'];
    $price_range = $_GET['price_range'];

switch ( $price_range) {
    case "1":
        $price_range = array(
            "min" => "1000",
            "max" => "20000"
        );
        break;
    case "2":
        $price_range = array(
            "min" => "20000",
            "max" => "100000"
        );
        break;

    case "3":
        $price_range = array(
            "min" => "100000",
            "max" => "500000"
        );
        break;

    case "4":
        $price_range = array(
            "min" => "500000",
            "max" => "1000000"
        );
        break;

    default:
    $price_range = array(
        "min" => "1000000",
        "max" => "1000000000000"
    );
    break;

}

    $sql = "SELECT * FROM product_list WHERE category_id = ? AND price BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $category_id, $price_range['min'], $price_range['max']);
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();
    ?>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="axil-product product-style-one has-color-pick mt--40">
                    <div class="thumbnail">
                        <a href="single-product.php">
                            <!-- <img src="<?= validate_image(isset($row['image_path']) ? $row['image_path'] : ""); ?>" alt="<?= $row['name']; ?>" alt="Product Images"> -->
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
        <?php endwhile; ?>
    <?php else: ?>
        <center>No products found for the given category ID and price range.</center>
    <?php endif; ?>

<?php endif; ?>
