$(function() {

    $('.btn-browse').click(function(e){
        $('.categories').toggleClass('active');
        e.stopPropagation();
    });
    $(document).click(function(e){
        if ($(e.target).parents('.categories').length === 0) {
            $('.categories').removeClass('active');
        }
    });

    $('.btn-search').click(function(e){
        $('.search-sm').toggleClass('active');
        e.stopPropagation();
    });

    $(document).click(function(e){
        if ($(e.target).parents('.search-sm').length === 0) {
            $('.search-sm').removeClass('active');
        }
    });
/*
    $('.search-control').click(function(e){
        $('.search-autocomplete').toggleClass('active');
        e.stopPropagation();
    });*/

    /* Account Menu  */
    $('.account').click(function(e) {
        $('.account-menu').toggleClass('active');
        $('.store-title .fa-caret-down').toggleClass('rotate');
        e.stopPropagation();
    });
    $('.basket').click(function(e) {
        $('.basket-menu').toggleClass('active');
        $('.basket-menu .store-title .fa-caret-down').toggleClass('rotate');
        e.stopPropagation();
    });
/*
    $(document).click(function(e){
        if ($(e.target).parents('.search-autocomplete ul').length === 0) {
            $('.search-autocomplete').removeClass('active');
        }
    });*/

    $('.filters').click(function(f){
        $('.side-bar').toggleClass('filter-active');
        $('.side-bar').removeClass('category-active');
        f.stopPropagation();
    });

    $(document).click(function(f){
        if ($(f.target).parents('.side-bar').length === 0) {
            $('.side-bar').removeClass('filter-active');
        }
    });

    $('.categories').click(function(c){
        $('.side-bar').toggleClass('category-active');
        $('.side-bar').removeClass('filter-active');
        c.stopPropagation();
    });

    $(document).click(function(c){
        if ($(c.target).parents('.side-bar').length === 0) {
            $('.side-bar').removeClass('category-active');
        }
    });

    $('.side-menu').click(function(f){
        $('.side-bar').toggleClass('active');
        f.stopPropagation();
    });

    $(document).click(function(f){
        if ($(f.target).parents('.side-bar').length === 0) {
            $('.side-bar').removeClass('active');
        }
    });

    // Smooth Scrolling
    $('a[href^="#"].page-anchor').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });

    /* Promotion Box Heights */
    $('.promo-area.table-layout').each(function(){
        // Cache the highest
        var highestBox = 0;
        // Select and loop the elements you want to equalise
        $('.promo-box', this).each(function(){
            // If this box is higher than the cached highest then store it
            if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        });
        // Set the height of all those children to whichever was highest
        $('.promo-box',this).height(highestBox);

    });
});

/* Currency Select
$('.selectpicker').selectpicker({
    iconBase: 'fa'
});
*/
$(document).ready(function(){
    $('.add-to-basket').bind('inview', function (event, visible) {
        if (visible === true) {
            // element is now visible in the viewport
            $('.sticky-summary').removeClass('active');
        } else {
            // element has gone out of viewport
            $('.sticky-summary').addClass('active');
        }
    });
    checkSize();
    $(window).resize(checkSize);
});

/* Phone and Tablet Navigation */
function checkSize(){
    if ($('.categories').css('display') === 'none' ){
        $('.sub-nav > a').on('click touchstart', function(){
            if(!$(this).hasClass('active')){
                $('.mega-menu').removeClass('active');
                $('.sub-nav').removeClass('active');
            }
            $(this).next('.mega-menu').toggleClass('active');
        });

        $('.sub-nav > a').click(function(event){
            event.preventDefault();
        });

        $('.back').click(function(){
            $('.mega-menu').removeClass('active');
        });

        $('.btn-browse').click(function(){
            $('.sub-nav').removeClass('active');
            $('.mega-menu').removeClass('active');
        });
    }
}