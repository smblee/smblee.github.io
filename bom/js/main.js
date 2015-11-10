/*Hide the sub menus*/
//$('.subitem-7').css('display', 'none');
$('.subitem-9').css('display', 'none');
$('.row-3 .arrow-img').css('display', 'none');
$('.row-5 .arrow-img').css('display', 'none');
$('.row-5 .subitem-11 .main').css('display', 'none');

$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");
});

// retrieve the element
element = document.getElementById("logo");

// reset the transition by...
element.addEventListener("click", function(e) {
    e.preventDefault;
    element.classList.remove("run-flip-animation");
    element.offsetWidth = element.offsetWidth;
    element.classList.add("run-flip-animation");
}, false);

$(' .item-9 a').click(function (e) {
    fullScreen();
});

$(' .item-10 a').click(function (event) {
    $(this).toggleClass('opened');
    //$(this).children('.icon').toggleClass('opened');
    //$(this).children('.icon').toggleClass('closed');
    var $divIsClosed = $(this).hasClass('opened');

    $(this).animate({
        'bottom': $divIsClosed ? '100%' : 0
    })
});

$('.item-4 a').click(function () {
    $(this).toggleClass('activated');
});

$('.item-7 a').click(function (e) {
    e.preventDefault();
    var $mainDiv = $('.item-7');
    var $divIsClosed = parseInt($mainDiv.css('left'), 10) == 0;
    // arrow animation
    if ($divIsClosed) {
        $('.row-3 .arrow-img').show('slow');
    }
    else {
        $('.row-3 .arrow-img').hide('slow');
    }
    // toggle close/open
    $(this).children('.icon').toggleClass('opened');
    $(this).children('.icon').toggleClass('closed');

    $mainDiv.animate({
        left: $divIsClosed ? "-85%" : 0
    }, 600, "easeOutBounce", function() {
        if ($divIsClosed) $('.row-3 .subitem-7').css('display', '');
    });
    $('.item-6').animate({
        left: $divIsClosed ? "-85%" : 0
    }, 600, "easeOutBounce", function() {
    });

    $('.row-3 .subitem-7').animate({
        left: $divIsClosed ? "15%" : '100%'
    }, 600, "easeOutBounce", function() {
    });
    //$mainDiv.animate({
    //    left: $divIsClosed ? "-85%" : 0
    //}, 600, "easeOutBounce", function () {
    //    // if submenu is not opened
    //    if ($('.row-3 .subitem-7').css('display') == 'block' && $('.item-7 a').children('.icon').hasClass('closed')) {
    //        $('.row-3 .subitem-7').css('display', 'none');
    //    }
    //    //document.location = $('.item-7 a').attr('href');
    //
    //
    //});
});

$('.item-6 a').click(function (e) {
    e.preventDefault();
    var $mainDiv = $('.row-3 .item-6');
    var $divIsClosed = parseInt($(this).children('.bom-img').css('left'), 10) == 0;

    $(this).children('.bom-img').animate({
        left: $divIsClosed ? "100%" : 0
    })

})

$('.item-11 a').click(function (e) {
    e.preventDefault();
    var $mainDiv = $('.row-5 .item-11');
    var $divIsClosed = parseInt($mainDiv.css('left'), 10) == 0;

    if ($divIsClosed) {
        $('.row-5 .arrow-img').show('slow');
    }
    else {
        $('.row-5 .arrow-img').hide('slow');
    }

    $(this).children('.icon').toggleClass('opened');
    $(this).children('.icon').toggleClass('closed');
    $mainDiv.animate({
        left: $divIsClosed ? "82%" : 0
    }, 600, "easeInQuint", function() {
        if ($divIsClosed) $('.row-5 .subitem-11 .main').css('display', '');

    });
    $('.row-5 .subitem-11').animate({
        left: $divIsClosed ? "8%" : 0
    }, 1000, "easeInQuint", function() {
        if (! $divIsClosed) $('.row-5 .subitem-11 .main').css('display', 'none');
    });
});

var isFullScreen = false;

function fullScreen() {
    var menuAnimation = {};
    var subAnimation = {};
    var speed = 300;
    if (!isFullScreen) { // MAXIMIZATION
        menuAnimation.right = "28%";
        //menuAnimation.opacity = "0.7";
        subAnimation.right = "40%";
        subAnimation.height = '260%';
        subAnimation.width = '72%';
        subAnimation.opacity = '1';
        isFullScreen = true;
    }
    else { // MINIMIZATION
        menuAnimation.right = "0%";
        //menuAnimation.opacity = "1";
        subAnimation.right = "0%";
        subAnimation.height = '0%';
        subAnimation.width = '0%';
        subAnimation.opacity = '0';
        isFullScreen = false;
    }
    $('.item-9 a').animate(menuAnimation, {
        duration: speed, complete: function () {
            if ( isFullScreen ) $('.subitem-9').toggleClass('opened');
            $(this).children('.other-img').toggleClass('rotated');
            $('.subitem-9').css('z-index', '11').animate(subAnimation, {
                duration: speed, complete: function () {
                    if ( ! isFullScreen ) $('.subitem-9').toggleClass('opened');
                }
            });
        }
    });
}

function fullScreen2() {
    var menuAnimation = {};
    var subAnimation = {};
    var speed = 300;
    if (!isFullScreen) { // MAXIMIZATION
        menuAnimation.right = "28%";
        //menuAnimation.opacity = "0.7";
        subAnimation.right = "40%";
        subAnimation.height = '260%';
        subAnimation.width = '72%';
        subAnimation.opacity = '1';
        isFullScreen = true;
    }
    else { // MINIMIZATION
        menuAnimation.right = "0%";
        //menuAnimation.opacity = "1";
        subAnimation.right = "0%";
        subAnimation.height = '0%';
        subAnimation.width = '0%';
        subAnimation.opacity = '0';
        isFullScreen = false;
    }
    $('.item-9 a').animate(menuAnimation, {
        duration: speed, complete: function () {
            if ( isFullScreen ) $('.subitem-9').toggleClass('opened');
            $(this).children('.other-img').toggleClass('rotated');
            $('.subitem-9').css('z-index', '11').animate(subAnimation, {
                duration: speed, complete: function () {
                    if ( ! isFullScreen ) $('.subitem-9').toggleClass('opened');
                }
            });
        }
    });
}