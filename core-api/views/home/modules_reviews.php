<div class="c-content-box c-size-md c-bg-grey-1">
    <div class="container">
        <div class="c-content-blog-post-card-1-slider" data-slider="owl">
            <div class="c-content-title-1">
                <h3 class="c-center c-font-uppercase c-font-bold" style="letter-spacing: 1px;"><?=$word->wordvar("Customer reviews of Narawadee Group's project");?></h3>
                <div class="c-line-center c-theme-bg"></div>
            </div>
            <div class="owl-carousel owl-theme c-theme c-owl-nav-center" data-items="3" data-slide-speed="8000" data-rtl="false">
                <?php echo $model->customerReviews();?>
            </div>
        </div>
    </div>
</div>
