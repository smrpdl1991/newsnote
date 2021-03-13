(function ($) {
  "use strict";

  $('.slides-tab article .entry-title a').on('click', function(e){
    e.preventDefault();
  }); 
  /*responsive menu*/
  $(
    ".top-header-menu  > div > ul, .midle-header-right .widget_nav_menu > div > ul, .footer-bottom-right ul"
  ).flexMenu({
    showOnHover: true,
  });
  $(".flexMenu-viewMore .menu-item-has-children").append("<span></span>");
  $(".flexMenu-viewMore .menu-item-has-children > ul").hide();
  $(".menu-item-has-children > span").on("click", function () {
    $(this).siblings("ul").slideToggle(400);
  });

  if (matchMedia) {
    var mq = window.matchMedia("(min-width: 781px)");
    mq.addListener(WidthChange);
    WidthChange(mq);
  }

  function WidthChange(mq) {
    if (mq.matches) {
      $(".main-navigation > ul").flexMenu({
        showOnHover: true,
      });
      $(".toggle-menu").hide();
      $(".main-navigation .flexMenu-viewMore .menu-item-has-children").append(
        "<span></span>"
      );
      $(
        ".main-navigation .flexMenu-viewMore .menu-item-has-children ul"
      ).hide();
      $(
        ".main-navigation .flexMenu-viewMore .menu-item-has-children > span"
      ).on("click", function () {
        $(this).siblings("ul").slideToggle(400);
      });
    } else {
      $(".toggle-menu").show();
      $(".main-navigation").hide();
      $(".toggle-menu").on("click", function () {
        $(".main-navigation").slideToggle(400);
      });

      $(".main-navigation .menu-item-has-children").append("<span></span>");
      $(".main-navigation .menu-item-has-children ul").hide();
      $(".main-navigation .menu-item-has-children > span").on(
        "click",
        function () {
          $(this).siblings("ul").slideToggle(400);
        }
      );
    }
  }

  $(".follow-us").on("click", function () {
    $(this).toggleClass("open");
  });

  $(".site-header .search-toggle").on("click", function () {
    $(this).toggleClass("open");
    $(this)
      .closest(".header-icons-wrap")
      .find(".search-header")
      .toggleClass("open");
  });

  $(".layout1 .news-ticker-content ul").newsTicker({
    max_rows: 1,
    direction: "up" /*up and down option*/,
  });

  $(window).load(function () {
    $(".layout2 .news-ticker-content ul").marquee({
      //duration in milliseconds of the marquee
      duration: 12000,
      //gap in pixels between the tickers
      gap: 0,
      //time in milliseconds before the marquee will start animating
      delayBeforeStart: 0,
      //'left' / 'right' / 'up' / 'down'
      direction: "left",
      //true or false - should the marquee be duplicated to show an effect of continues flow
      duplicated: true,

      pauseOnHover: true,
      startVisible: true,
    });
  });

  var tickerWrapper = $(".news-ticker-wrap").outerWidth();
  var tickerCaption = $(".layout1 .news-ticker-caption").outerWidth();
  var tickerWidth = tickerWrapper - tickerCaption;

  $(".news-ticker-content").css("width", tickerWidth);

  /* back-to-top button */
  $(".back-to-top").hide();
  $(".back-to-top").on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      "slow"
    );
  });

  $(window).scroll(function () {
    var scrollheight = 400;
    if ($(window).scrollTop() > scrollheight) {
      $(".back-to-top").fadeIn();
    } else {
      $(".back-to-top").fadeOut();
    }
  });

  /*main slider*/
  $(".slides-post").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: ".slides-tab",
  });

  $(".slides-tab").slick({
    slidesToShow: 4,
    vertical: true,
    slidesToScroll: 1,
    asNavFor: ".slides-post",
    centerMode: false,
    focusOnSelect: true,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 1240,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 1141,
        settings: {
          slidesToShow: 2,
          vertical: false,
        },
      },
      {
        breakpoint: 1041,
        settings: {
          slidesToShow: 1,
          vertical: false,
        },
      },
    ],
  });

  /*carousel-news*/
  var $carousel_smallarea = $(".small-news-area .carousel-news-wrap");
  if ($carousel_smallarea.length) {
    $carousel_smallarea.slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: true,
    });
  }

  var carousel_largearea = $(".block-news-area .carousel-news-wrap");
  carousel_largearea.each(function () {
    var single_carousel = $(this);
    var no_of_column = single_carousel.data("column");
    var args = {
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: no_of_column,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: no_of_column > 3 ? 3 : no_of_column > 2 ? 2 : 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 841,
          settings: {
            slidesToShow: no_of_column > 3 ? 2 : 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 540,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    };
    single_carousel.slick(args);
  });

  /*sticky sidebar*/
  jQuery(
    ".news-with-sidebar .block-news-area ,.news-with-sidebar .small-news-area ,#primary, #left-sidebar , #right-sidebar"
  ).theiaStickySidebar({
    additionalMarginTop: 30,
  });

  /*news on tab*/

  $(".tab-section .tab-link").on("click", function (event) {
    var tab_id = $(this).attr("data-tab");
    $(this).parents(".tab-section").find(".tab-link").removeClass("current");

    $(this).parents(".tab-section").find(".tab-content").removeClass("current");

    $(this).addClass("current");
    var video_wrap = $(this).closest(".tab-section");
    video_wrap.find("." + tab_id).addClass("current");
  });

  $(".news-on-tab .tab").on("click", function (event) {
    var tab_id = $(this).attr("data-tab");
    $(this).parents(".news-on-tab").find(".tab").removeClass("current");

    $(this).parents(".news-on-tab").find(".tab-content").removeClass("current");

    $(this).addClass("current");
    var video_wrap = $(this).closest(".news-on-tab");
    video_wrap.find("." + tab_id).addClass("current");
  });

  /* video gallery section */

  $(".video-titles .title").on("click", function (event) {
    var tab_id = $(this).attr("data-tab");
    $(this)
      .parents(".video-gallery-section")
      .find(".title")
      .removeClass("current");

    $(this)
      .parents(".video-gallery-section")
      .find(".tab-content")
      .removeClass("current");

    $(this).addClass("current");
    var video_wrap = $(this).closest(".video-tabs");
    video_wrap.find("." + tab_id).addClass("current");
  });

  if (matchMedia) {
    var mediaHeight = window.matchMedia("(min-width: 769px)");
    mediaHeight.addListener(equalheight);
    equalheight(mediaHeight);
  }

  function equalheight(mediaHeight) {
    if (mediaHeight.matches) {
      $(".video-gallery-section").each(function (index) {
        var maxHeight = 0;
        $(this).find("article").height("auto");
        $(this)
          .find("article")
          .each(function (index) {
            if ($(this).height() > maxHeight) maxHeight = $(this).height();
          });
        $(this).find(".video-titles").height(maxHeight);
        $(this).find("article").height(maxHeight);
      });
    }
  }

  /* video gallery section end */
  $(window).on("load", function () {
    // For Masonery layout section
    var $container = $(".masonery-layout .news-layout-wrap");

    if ($container.length) {
      $container.isotope({
        itemSelector: "article",
        layoutMode: "masonry",
        percentPosition: true,
        columnWidth: "article",
        isFitWidth: true,
      });
      //image loaded
      if ($.fn.imagesLoaded) {
        $container.imagesLoaded(function () {
          $container.isotope("layout");
        });
      }
    }

    /*for masonery archieve or category page*/
    var $masoneryArchieve = $(".post-item-wrapper.masonery-layout ");

    if ($masoneryArchieve.length) {
      $masoneryArchieve.isotope({
        itemSelector: "article",
        layoutMode: "masonry",
        percentPosition: true,
        columnWidth: "article",
        isFitWidth: true,
      });
      //image loaded
      if ($.fn.imagesLoaded) {
        $masoneryArchieve.imagesLoaded(function () {
          $masoneryArchieve.isotope("layout");
        });
      }
    }
  });
})(jQuery);
