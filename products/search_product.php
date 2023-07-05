<?php
if (isset($_GET['search_term'])) {
    $search_term = $_GET['search_term'];

    // Prepare and execute the database query
    $sql = "SELECT * FROM product_list WHERE name LIKE '%$search_term%'";
    $result = $conn->query($sql);

    $response = array();
    if ($result->num_rows > 0) {
        $numResults = $result->num_rows;

        // Construct the response array
        $response['numResults'] = $numResults;
        $response['results'] = array();

        // Loop through the fetched products and generate the HTML markup for each product
        while ($row = $result->fetch_assoc()) {
            $search_results = '
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="axil-product product-style-one has-color-pick mt--40">
                    <div class="thumbnail">
                        <a href="single-product.php">
                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" class="main-img sal-animate" src="' . validate_image(isset($row['image_path']) ? $row['image_path'] : '') . '" alt="Product Images">
                        </a>
    
                        <div class="product-hover-action">
                            <ul class="cart-action">
                                <!-- <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li> -->
                                <li class="select-option">
                                    <a id="add_to_cart" onclick="add_to_cart(' . $row['id'] . ')">
                                        Add to Cart
                                    </a>
                                </li>
                                <li class="quickview"><a onclick="openQuickViewModal(' . $row['id'] . ')" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="single-product.php">' . $row['name'] . '</a></h5>
                            <div class="product-price-variant">
                                <span class="price current-price">$' . format_num($row['price']) . '</span>
                            </div>
                            <div class="color-variant-wrapper">
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';

            $response['results'][] = $search_results;
        }
    } else {
        // No results found
        $response['results'] = array("<p>&nbsp;</p>");
        $response['numResults'] = 0;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
