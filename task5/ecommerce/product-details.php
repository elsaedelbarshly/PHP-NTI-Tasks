<?php

use app\database\models\Product;
use app\database\models\Review;

$title = "Product Details";
$links = "<link rel='stylesheet' href='assets/css/rating.css'>";
include_once "layouts/header.php";
include_once "layouts/nav.php";
include_once "layouts/bread-crumb.php";
if (isset($_GET['product']))
    {
        if (is_numeric($_GET['product']))
        {
            $productObject = new Product;
            $findProResult = $productObject->all("WHERE `products`.`status` = 1 AND `products`.`id` = {$_GET['product']}");
            if ($findProResult->num_rows == 1)
            {
                $product = $findProResult->fetch_object();
            }
            else
            {
                header('location:errors/404.php');
                die;
            }
        } else {
            header('location:errors/404.php');
            die;
        }

    } else {
        header('location:errors/404.php');
        die;
    }

if($_POST)    
{
    $rate = "";
    switch($_POST['rate']){
    case '1':
        $rate = 1;
        break;
    case '2':
        $rate = 2;
        break;
    case '3':
        $rate = 3;
        break;
    case "4":
        $rate = 4;
        break;
    default:
        $rate = 5;
    }
    $insertReveiw = new Review;
    $insertReveiw->setUser_id($_GET['user_id']);
    $insertReveiw->setProduct_id($_GET['poriduct_id']);
    $insertReveiw->setValue($rate);
    $insertReveiw->setComment($_POST['comment']);
    $insertReveiw->addReview();
}

?>
<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="assets/img/product/<?= $product->image ?>" data-zoom-image="assets/img/product/<?= $product->image ?>" alt="zoom" />
                </div>
            </div>
            
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $product->name_en ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php for ($i = 1; $i <= $product->reviews_avg; $i++) { ?>
                                <i class="ion-android-star-outline theme-star"></i>
                            <?php }
                            for ($i = 1; $i <= (5 - $product->reviews_avg); $i++) { ?>
                                <i class="ion-android-star-outline"></i>
                            <?php } ?>

                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?= $product->reviews_count ?> Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $product->price ?> EGP </span>
                    <div class="in-stock">
                        <?php
                        if ($product->quantity >= 1 && $product->quantity <= 5)
                        {
                            $message = "In Stock({$product->quantity})";
                            $color = "warning";
                        } elseif ($product->quantity > 5) {
                            $message = "In Stock";
                            $color = "success";
                        } else {
                            $message = "Outof Stock";
                            $color = "danger";
                        }
                        ?>
                        <p>Available: <span class="text-<?= $color ?>"><?= $message ?></span></p>
                    </div>
                    <p> <?= $product->des_en ?> </p>
                    <div class="quality-add-to-cart">
                        <?php if ($product->quantity >= 1) { ?>
                            <div class="quality">
                                <label>Qty:</label>
                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                            </div>
                            <div class="shop-list-cart-wishlist">
                                <a title="Add To Cart" href="#">
                                    <i class="icon-handbag"></i>
                                </a>
                                <a title="Wishlist" href="#">
                                    <i class="icon-heart"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>


                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title font-weight-bold">Tages:</li>
                            <li><a href="shop.php?cat=<?= $product->category_id ?>"> <?= $product->category_name_en ?>,</a></li>
                            <li><a href="shop.php?subcat=<?= $product->sub_category_id ?>"> <?= $product->subcategory_name_en ?>, </a></li>
                            <li><a href="shop.php?brand=<?= $product->brand_id ?>"> <?= $product->brand_name_en ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>
                            <?= $product->des_en ?>
                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">
                        <?php
                        $productObject->setId($_GET['product']);
                        $reviewsResult = $productObject->getProductReviews();
                        if ($reviewsResult->num_rows >= 1)
                        {
                            $reviews = $reviewsResult->fetch_all(MYSQLI_ASSOC);
                            foreach ($reviews as $review) { ?>
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++)
                                            {
                                                if ($i <= $review['value'])
                                                {
                                                    echo "<i class='ion-star theme-color'></i>";
                                                } else {
                                                    echo "<i class='ion-android-star-outline'></i>";
                                                }
                                            }
                                            ?>

                                            <span>(<?= $review['value'] ?>)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3> <?= $review['full_name'] ?></h3>
                                            <span> <?= $review['created_at'] ?> </span>
                                        </div>
                                    </div>
                                    <p><?= $review['comment'] ?></p>
                                </div>
                            <?php }
                        } else { 
                                $reviews = [];
                            ?>
                            <div class="sin-rattings">
                                <div class="alert-warning alert text-center"> No Reviews Found To This Product </div>
                            </div>
                        <?php } ?>

                    </div>
                    <?php
                    if (isset($_SESSION['user']) && !in_array( $_SESSION['user']->id,array_column($reviews,'user_id'))) { ?>
                        <div class="ratting-form-wrapper">
                            <h3>Add your Comments :</h3>
                            <div class="ratting-form">
                                <form method="POST">
                                    <div class="star-box">
                                        <h2>Rating:</h2>
                                        <div class="ratting-star rate">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="rating-form-style form-submit">
                                                <textarea name="comment" placeholder="Message"></textarea>
                                                <input type="submit" value="add review">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-white">Related Products</h3>
            </div>
        </div>
        <div class="featured-product-active hot-flower owl-carousel product-nav">
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.html">
                        <img alt="" src="assets/img/product/product-1.jpg">
                    </a>
                    <span>-30%</span>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.html">Le Bongai Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.html">
                        <img alt="" src="assets/img/product/product-2.jpg">
                    </a>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.html">Society Ice Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.html">
                        <img alt="" src="assets/img/product/product-3.jpg">
                    </a>
                    <span>-30%</span>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.html">Green Tea Tulsi</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.html">
                        <img alt="" src="assets/img/product/product-4.jpg">
                    </a>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.html">Best Friends Tea</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
            <div class="product-wrapper">
                <div class="product-img">
                    <a href="product-details.html">
                        <img alt="" src="assets/img/product/product-5.jpg">
                    </a>
                    <span>-30%</span>
                    <div class="product-action">
                        <a class="action-wishlist" href="#" title="Wishlist">
                            <i class="ion-android-favorite-outline"></i>
                        </a>
                        <a class="action-cart" href="#" title="Add To Cart">
                            <i class="ion-ios-shuffle-strong"></i>
                        </a>
                        <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                            <i class="ion-ios-search-strong"></i>
                        </a>
                    </div>
                </div>
                <div class="product-content text-left">
                    <div class="product-hover-style">
                        <div class="product-title">
                            <h4>
                                <a href="product-details.html">Instant Tea Premix</a>
                            </h4>
                        </div>
                        <div class="cart-hover">
                            <h4><a href="product-details.html">+ Add to cart</a></h4>
                        </div>
                    </div>
                    <div class="product-price-wrapper">
                        <span>$100.00 -</span>
                        <span class="product-price-old">$120.00 </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "layouts/footer.php";
include_once "layouts/footer-scripts.php";
?>