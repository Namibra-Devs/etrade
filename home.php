     <?php $title = "Home"; ?>
     <!-- Include Header -->
     <?php include "./inc/header.php"; ?>

     <main class="main-wrapper">

         <!-- Start Slider Area -->
         <div class="axil-main-slider-area main-slider-style-2 main-slider-style-8">
             <div class="container">
                 <div style="margin-left: auto;" class="slider-offset-left">
                     <div class="row row--20">
                         <div class="col-lg-12">
                             <div class="slider-box-wrap">
                                 <div class="slider-activation-one axil-slick-dots">
                                     <div class="single-slide slick-slide">
                                         <div class="main-slider-content">
                                             <span class="subtitle"><i class="fal fa-badge-percent"></i> ITP</span>
                                             <h1 class="title">Welcome to International Trade Properties</h1>
                                             <div class="shop-btn">
                                                 <a href="shop.php" class="axil-btn">Shop Now <i class="fal fa-long-arrow-right"></i></a>
                                             </div>
                                         </div>
                                         <div class="main-slider-thumb">
                                             <img src="assets/images/bg/bg-image-15.png"  alt="Product">
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
         <!-- End Slider Area -->


         <!-- Start Expolre Product Area  -->
         <div class="axil-product-area bg-color-white axil-section-gap">
             <div class="container">
                 <div class="section-title-wrapper">
                     <span class="title-highlighter highlighter-primary"> <i class="fal fa-store"></i> Our Products</span>
                     <h2 class="title">Explore our Products</h2>
                 </div>
                 <div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                     <div class="slick-single-layout">
                         <div class="row row--15">
                             <?php
                                $products = $conn->query("SELECT p.*, v.shop_name as vendor, c.name as `category` FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.`status` =1 order by RAND() limit 4");
                                while ($row = $products->fetch_assoc()) :
                                ?>
                                 <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                                     <div class="axil-product product-style-one">
                                         <div class="thumbnail">
                                             <a href="./single-product.php?id=<?= $row['id'] ?>">
                                                 <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" class="main-img" src="<?= validate_image($row['image_path']) ?>" alt="Product Images">
                                                 <img class="hover-img" src="<?= validate_image($row['image_path']) ?>" alt="Product Images">
                                             </a>

                                             <div class="product-hover-action">
                                                 <ul class="cart-action">

                                                     <li class="select-option">
                                                         <a id="add_to_cart" onclick="add_to_cart(<?= $row['id'] ?>)">
                                                             Add to Cart
                                                         </a>
                                                     </li>
                                                     <li class="quickview"><a onclick="openQuickViewModal(<?= $row['id'] ?>)" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                                     <!-- <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li> -->
                                                 </ul>
                                             </div>
                                         </div>
                                         <div class="product-content">
                                             <div class="inner">

                                                 <h5 class="title"><a href="single-product.php"><?= $row['name'] ?></a></h5>
                                                 <div class="product-price-variant">
                                                     <span class="price current-price">$<?= format_num($row['price']) ?></span>
                                                     <!-- <span class="price old-price">$49.99</span> -->
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             <?php endwhile; ?>

                         </div>
                     </div>

                 </div>
                 <div class="row">
                     <div class="col-lg-12 text-center mt--20 mt_sm--0">
                         <a href="shop.php" class="axil-btn btn-bg-lighter btn-load-more">View All Products</a>
                     </div>
                 </div>

             </div>
         </div>
         <!-- End Expolre Product Area  -->

         <!-- Start Axil Newsletter Area  -->
         <!-- <div class="axil-newsletter-area axil-section-gap pt--0">
            <div class="container">
                <div class="etrade-newsletter-wrapper bg_image bg_image--12">
                    <div class="newsletter-content">
                        <span class="title-highlighter highlighter-primary2"><i class="fas fa-envelope-open"></i>Newsletter</span>
                        <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                        <div class="input-group newsletter-form">
                            <div class="position-relative newsletter-inner mb--15">
                                <input placeholder="example@gmail.com" type="text">
                            </div>
                            <button type="submit" class="axil-btn mb--15">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div> -->
         <!-- End .container -->
         </div>
         <!-- End Axil Newsletter Area  -->

     </main>


     <!-- Include footer -->
     <?php include "./inc/footer.php"; ?>