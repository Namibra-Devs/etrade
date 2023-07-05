    <!-- Start Header -->
    <header class="header axil-header header-style-5">
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <!-- <div class="header-top-dropdown">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    English
                                </button>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    USD
                                </button>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <!-- <li><a href="#">Help</a></li> -->

                                <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                    <li>
                                        <a href="my-account.php">Welcome, <?= !empty($_settings->userdata('lastname')) ? $_settings->userdata('lastname') : $_settings->userdata('email') ?>  </a>
                                    </li>
                                    <li>
                                        <a href="my-account.php">My Account</a>
                                    </li>
                                <?php else : ?>
                                    <li><a href="sign-up.php">Join Us</a></li>
                                    <li><a href="sign-in.php">Sign In</a></li>
                                <?php endif; ?>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="index.php" class="logo logo-dark">
                            <img src="assets/images/logo/logo.png" alt="Site Logo">
                        </a>
                        <a href="index.php" class="logo logo-light">
                            <img src="assets/images/logo/logo-light.png" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="index.php" class="logo">
                                    <img src="assets/images/logo/logo.png" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li class="menu-item-has-children">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="shop.php">Shop</a>
                                </li>
                                <li><a href="about-us.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2" id="search2" value="" maxlength="128" placeholder="What are you looking for?" autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <!-- <li class="wishlist">
                                <a href="wishlist.php">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li> -->

                            <li class="shopping-cart">
                                <?php $cart_count = 0; ?>
                                <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                    <?php
                                    $cart_count = $conn->query("SELECT sum(quantity) FROM `cart_list` where client_id = '{$_settings->userdata('id')}'")->fetch_array()[0];
                                    $cart_count = $cart_count > 0 ? $cart_count : 0;
                                    ?>
                                <?php endif; ?>
                                <a href="#" class="cart-dropdown-btn">
                                    <span class="cart-count"><?= format_num($cart_count) ?></span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">QUICKLINKS</span>
                                    <ul>
                                        <li>
                                            <a href="my-account.php">My Account</a>
                                        </li>
                                        <li>
                                            <a href="#">Initiate return</a>
                                        </li>
                                        <li>
                                            <a href="#">Support</a>
                                        </li>
                                        <li>
                                            <a href="#">Language</a>
                                        </li>
                                    </ul>

                                    <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3) : ?>
                                        <a class="axil-btn btn-bg-primary" href="<?= base_url . 'classes/Login.php?f=logout_client' ?>">Logout</a>
                                    <?php else : ?>
                                        <a href="sign-in.php" class="axil-btn btn-bg-primary">Login</a>
                                    <?php endif; ?>
                                    <div class="reg-footer text-center">No account yet? <a href="sign-up.php" class="btn-link">REGISTER HERE.</a></div>
                                </div>
                            </li>
                            <li class="my-account-dropdown">
                                <!-- <li class="sell-button neck"> -->
                                <a href="./vendor/register.php" class="sell-button">Sell</a>
                                <!-- <a href="./vendor/register.php" class="btn btn-primary btn-lg">Sell</a> -->
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
        <!-- <div class="header-top-campaign">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-10">
                        <div class="header-campaign-activation axil-slick-arrow arrow-both-side header-campaign-arrow">
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                            <div class="slick-slide">
                                <div class="campaign-content">
                                    <p>STUDENT NOW GET 10% OFF : <a href="#">GET OFFER</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </header>