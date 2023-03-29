(function () {
  "use strict";

  if (document.getElementById("gtn-header").classList.contains("fixed-top")) {
    if (!document.getElementsByClassName("gtn-homepage")[0]) {
      document.getElementById("gtn-main").style.marginTop =
        document.getElementById("gtn-header").offsetHeight + "px";
    }
  }
})();
// Custom JavaScript
$(document).ready(function () {
  "use strict";

  // Template Lama

  // sticky header
  function headerSticky() {
    var windowPos = $(window).scrollTop();
    if (windowPos > 20) {
      $(".fixed-top").addClass("on-scroll");
      $(".light-nav-on-scroll")
        .addClass("gtn-menu-light")
        .removeClass("gtn-menu-dark");
      $(".dark-nav-on-scroll")
        .addClass("gtn-menu-dark")
        .removeClass("gtn-menu-light");
    } else {
      $(".fixed-top").removeClass("on-scroll");
      $(".light-nav-on-load")
        .addClass("gtn-menu-light")
        .removeClass("gtn-menu-dark");
      $(".dark-nav-on-load")
        .addClass("gtn-menu-dark")
        .removeClass("gtn-menu-light");
    }
  }
  headerSticky();
  $(window).scroll(headerSticky);

  // main menu
  $(".main-navigation .sf-menu").superfish({
    delay: 100,
    animation: { opacity: "show", height: "show" },
    speed: 300,
  });

  // menudropdown auto align
  var wapoMainWindowWidth = $(window).width();
  $(".sf-menu ul li").mouseover(function () {
    // checks if third level menu exist
    var subMenuExist = $(this).find(".sub-menu").length;
    if (subMenuExist > 0) {
      var subMenuWidth = $(this).find(".sub-menu").width();
      var subMenuOffset =
        $(this).find(".sub-menu").parent().offset().left + subMenuWidth;

      // if sub menu is off screen, give new position
      if (subMenuOffset + subMenuWidth > wapoMainWindowWidth) {
        var newSubMenuPosition = subMenuWidth;
        $(this).find(".sub-menu").css({
          left: -newSubMenuPosition,
          top: "0",
        });
      }
    }
  });

  // nav scroll
  if ($("#gtn-header-global").length) {
    var navoffset = $("#gtn-header-global").height();
    $('.gtn-nav a[href^="#"], .gtn-scroll-link').on("click", function (e) {
      event.preventDefault();
      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top - navoffset - 25,
        },
        "slow",
        "easeInSine"
      );
    });
  } else {
    $(".gtn-scroll-link").on("click", function (e) {
      event.preventDefault();
      $("html, body").animate(
        {
          scrollTop: $($(this).attr("href")).offset().top,
        },
        "slow",
        "easeInSine"
      );
    });
  }

  // scrollspy
  var win = $(window);
  $("section").each(function () {
    if (win.scrollTop() >= $(this).offset().top - 140) {
      $(".gtn-nav li a[href='#" + $(this).attr("id") + "']")
        .addClass("active")
        .parent()
        .siblings()
        .find("a")
        .removeClass("active");
    }
  });
  win.on("scroll", function () {
    $("section").each(function () {
      if (win.scrollTop() >= $(this).offset().top - 140) {
        $(".gtn-nav a[href='#" + $(this).attr("id") + "']")
          .addClass("active")
          .parent()
          .siblings()
          .find("a")
          .removeClass("active");
      }
    });
  });

  // sectionAnchor - link to section from another page
  function sectionAnchor() {
    var navoffset = $("#gtn-header-global").height();
    var hash = window.location.hash;
    if (hash !== "") {
      setTimeout(function () {
        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: $(hash).offset().top - navoffset - 25,
            },
            800,
            "easeInSine"
          );
        history.pushState("", document.title, window.location.pathname);
      }, 500);
    }
  }
  sectionAnchor();

  // responsive menu
  $(".main-navigation .gtn-nav").slicknav({
    label: "",
    prependTo: ".gtn-responsive-header-menu",
    closedSymbol: "",
    openedSymbol: "",
    allowParentLinks: "true",
    menuButton: "#gtn-menu-button",
    closeOnClick: true,
  });

  // responsive menu button
  $("#gtn-menu-button").on("click", function (e) {
    $(".slicknav_nav").slideToggle();
  });

  // responsive menu hamburger
  var $hamburger = $("#gtn-menu-button");
  $hamburger.on("click", function (e) {
    $hamburger.toggleClass("is-active");
  });

  // responsive header nav scroll
  var mnavoffset = $(".gtn-responsive-header").height();
  var scroll = new SmoothScroll(".gtn-responsive-header-menu a", {
    speed: 500,
    speedAsDuration: true,
    offset: mnavoffset + 40,
  });

  // scrollspy for responsive
  var smallwin = $(window);
  $("section").each(function () {
    if (smallwin.scrollTop() >= $(this).offset().top - 140) {
      $(".slicknav_menu li a[href='#" + $(this).attr("id") + "']")
        .addClass("active")
        .parent()
        .siblings()
        .find("a")
        .removeClass("active");
    }
  });
  smallwin.on("scroll", function () {
    $("section").each(function () {
      if (smallwin.scrollTop() >= $(this).offset().top - 140) {
        $(".slicknav_menu a[href='#" + $(this).attr("id") + "']")
          .addClass("active")
          .parent()
          .siblings()
          .find("a")
          .removeClass("active");
      }
    });
  });

  // responsiveAnchor - link to section from another page
  function responsiveAnchor() {
    var windowWidth = $(window).width();
    if (windowWidth < 992) {
      var mnavoffset = $(".gtn-responsive-header").height();
      var hash = window.location.hash;
      if (hash !== "") {
        setTimeout(function () {
          $("html, body")
            .stop()
            .animate(
              {
                scrollTop: $(hash).offset().top - mnavoffset - 40,
              },
              800,
              "easeInSine"
            );
          history.pushState("", document.title, window.location.pathname);
        }, 500);
      }
    }
  }
  responsiveAnchor();

  // wow animations
  if ($(window).outerWidth() >= 767) {
    new WOW().init({
      mobile: false,
    });
  }

  // parallax
  if ($(window).outerWidth() >= 767) {
    $(".parallax").parallaxie({
      speed: 0.6,
      size: "auto",
    });
    $(".parallax.parallax-slow").parallaxie({
      speed: 0.3,
    });
  }

  // video popup
  $(".gtn-video-popup").venobox();

  //Contact form
  $(function () {
    var v = $("#contactform").validate({
      submitHandler: function (form) {
        $(form).ajaxSubmit({
          target: "#contactresult",
          clearForm: true,
        });
      },
    });
  });

  // counter
  $(".gtn-counter").appear(function () {
    $(".counting-number").countTo();
  });

  // Sroll to top
  var offset = 800;
  var duration = 400;
  $(window).scroll(function () {
    if ($(this).scrollTop() > offset) {
      $("#take-to-top.gtn-fade-scroll").fadeIn(duration);
    } else {
      $("#take-to-top.gtn-fade-scroll").fadeOut(duration);
    }
  });
  $("#take-to-top.gtn-fade-scroll").on("click", function (event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, duration);
    return false;
  });
});
// document ready end

// on load
$(window).on("load", function () {
  "use strict";

  // preloader
  $(".gtn-preloader").delay(400).fadeOut(500);
});
// on load end

$(document).ready(function ($) {
  ("use strict");

  $('.navbar-nav .nav-link:not([href="#"])').on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });

  $(".gtn-img-into-bg").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).find("img").attr("src") + ")"
    );
  });

  //  Background

  $("[data-bg-color], [data-bg-image], [data-bg-pattern]").each(function () {
    var $this = $(this);

    if ($this.hasClass("gtn-separate-bg-element")) {
      $this.append('<div class="gtn-background">');

      // Background Color

      if ($("[data-bg-color]")) {
        $this
          .find(".gtn-background")
          .css("background-color", $this.attr("data-bg-color"));
      }

      // Background Image

      if ($this.attr("data-bg-image") !== undefined) {
        $this
          .find(".gtn-background")
          .append('<div class="gtn-background-image">');
        $this
          .find(".gtn-background-image")
          .css("background-image", "url(" + $this.attr("data-bg-image") + ")");
        $this
          .find(".gtn-background-image")
          .css("background-size", $this.attr("data-bg-size"));
        $this
          .find(".gtn-background-image")
          .css("background-position", $this.attr("data-bg-position"));
        $this
          .find(".gtn-background-image")
          .css("opacity", $this.attr("data-bg-image-opacity"));

        $this
          .find(".gtn-background-image")
          .css("background-size", $this.attr("data-bg-size"));
        $this
          .find(".gtn-background-image")
          .css("background-repeat", $this.attr("data-bg-repeat"));
        $this
          .find(".gtn-background-image")
          .css("background-position", $this.attr("data-bg-position"));
        $this
          .find(".gtn-background-image")
          .css("background-blend-mode", $this.attr("data-bg-blend-mode"));
      }

      // Parallax effect

      if ($this.attr("data-bg-parallax") !== undefined) {
        $this.find(".gtn-background-image").addClass("gtn-parallax-element");
      }
    } else {
      if ($this.attr("data-bg-color") !== undefined) {
        $this.css("background-color", $this.attr("data-bg-color"));
        if ($this.hasClass("btn")) {
          $this.css("border-color", $this.attr("data-bg-color"));
        }
      }

      if ($this.attr("data-bg-image") !== undefined) {
        $this.css(
          "background-image",
          "url(" + $this.attr("data-bg-image") + ")"
        );

        $this.css("background-size", $this.attr("data-bg-size"));
        $this.css("background-repeat", $this.attr("data-bg-repeat"));
        $this.css("background-position", $this.attr("data-bg-position"));
        $this.css("background-blend-mode", $this.attr("data-bg-blend-mode"));
      }

      if ($this.attr("data-bg-pattern") !== undefined) {
        $this.css(
          "background-image",
          "url(" + $this.attr("data-bg-pattern") + ")"
        );
      }
    }
  });

  $(".gtn-password-toggle").on("click", function () {
    var $parent = $(this).closest(".gtn-has-password-toggle");
    var $this = $(this);
    var $password = $parent.find("input");
    if ($password.attr("type") === "password") {
      $password.attr("type", "text");
      $this.find("i").removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
      $password.attr("type", "password");
      $this.find("i").removeClass("fa-eye-slash").addClass("fa-eye");
    }
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  $("select")
    .each(function () {
      isSelected($(this));
    })
    .on("change", function () {
      isSelected($(this));
    });

  if ($(".gtn-video").length > 0) {
    $(this).fitVids();
  }

  // Owl Carousel

  var $owlCarousel = $(".owl-carousel");

  if ($owlCarousel.length) {
    $owlCarousel.each(function () {
      var items = parseInt($(this).attr("data-owl-items"), 10);
      if (!items) items = 1;

      var nav = parseInt($(this).attr("data-owl-nav"), 2);
      if (!nav) nav = 0;

      var dots = parseInt($(this).attr("data-owl-dots"), 2);
      if (!dots) dots = 0;

      var center = parseInt($(this).attr("data-owl-center"), 2);
      if (!center) center = 0;

      var loop = parseInt($(this).attr("data-owl-loop"), 2);
      if (!loop) loop = 0;

      var margin = parseInt($(this).attr("data-owl-margin"), 2);
      if (!margin) margin = 0;

      var autoWidth = parseInt($(this).attr("data-owl-auto-width"), 2);
      if (!autoWidth) autoWidth = 0;

      var navContainer = $(this).attr("data-owl-nav-container");
      if (!navContainer) navContainer = 0;

      var autoplay = parseInt($(this).attr("data-owl-autoplay"), 2);
      if (!autoplay) autoplay = 0;

      var autoplayTimeOut = parseInt(
        $(this).attr("data-owl-autoplay-timeout"),
        10
      );
      if (!autoplayTimeOut) autoplayTimeOut = 5000;

      var autoHeight = parseInt($(this).attr("data-owl-auto-height"), 2);
      if (!autoHeight) autoHeight = 0;

      var fadeOut = $(this).attr("data-owl-fadeout");
      if (!fadeOut) fadeOut = 0;
      else fadeOut = "fadeOut";

      if ($("body").hasClass("rtl")) var rtl = true;
      else rtl = false;

      if (items === 1) {
        $(this).owlCarousel({
          navContainer: navContainer,
          animateOut: fadeOut,
          autoplayTimeout: autoplayTimeOut,
          autoplay: 1,
          autoheight: autoHeight,
          center: center,
          loop: loop,
          margin: margin,
          autoWidth: autoWidth,
          items: 1,
          nav: nav,
          dots: dots,
          rtl: rtl,
          navText: [],
        });
      } else {
        $(this).owlCarousel({
          navContainer: navContainer,
          animateOut: fadeOut,
          autoplayTimeout: autoplayTimeOut,
          autoplay: autoplay,
          autoheight: autoHeight,
          center: center,
          loop: loop,
          margin: margin,
          autoWidth: autoWidth,
          items: 1,
          nav: nav,
          dots: dots,
          rtl: rtl,
          navText: [],
          responsive: {
            1368: {
              items: items,
            },
            992: {
              items: 3,
            },
            450: {
              items: 2,
            },
            0: {
              items: 1,
            },
          },
        });
      }

      if ($(this).find(".owl-item").length === 1) {
        $(this).find(".owl-nav").css({ opacity: 0, "pointer-events": "none" });
      }
    });
  }

  // Magnific Popup

  var $popupImage = $(".popup-image");

  if ($popupImage.length > 0) {
    $popupImage.magnificPopup({
      type: "image",
      fixedContentPos: false,
      gallery: { enabled: true },
      removalDelay: 300,
      mainClass: "mfp-fade",
      callbacks: {
        // This prevents pushing the entire page to the right after opening Magnific popup image
        open: function () {
          $(".page-wrapper, .navbar-nav").css(
            "margin-right",
            getScrollBarWidth()
          );
        },
        close: function () {
          $(".page-wrapper, .navbar-nav").css("margin-right", 0);
        },
      },
    });
  }

  var $videoPopup = $(".video-popup");

  if ($videoPopup.length > 0) {
    $videoPopup.magnificPopup({
      type: "iframe",
      removalDelay: 300,
      mainClass: "mfp-fade",
      overflowY: "hidden",
      iframe: {
        markup:
          '<div class="mfp-iframe-scaler">' +
          '<div class="mfp-close"></div>' +
          '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
          "</div>",
        patterns: {
          youtube: {
            index: "youtube.com/",
            id: "v=",
            src: "//www.youtube.com/embed/%id%?autoplay=1",
          },
          vimeo: {
            index: "vimeo.com/",
            id: "/",
            src: "//player.vimeo.com/video/%id%?autoplay=1",
          },
          gmaps: {
            index: "//maps.google.",
            src: "%id%&output=embed",
          },
        },
        srcAction: "iframe_src",
      },
    });
  }

  $(".gtn-form-email [type='submit']").each(function () {
    var text = $(this).text();
    $(this)
      .html("")
      .append("<span>" + text + "</span>")
      .prepend(
        "<div class='status'><i class='fas fa-circle-notch fa-spin spinner'></i></div>"
      );
  });

  $(".gtn-form-email .btn[type='submit']").on("click", function () {
    var $button = $(this);
    var $form = $(this).closest("form");
    var pathToPhp = $(this).closest("form").attr("data-php-path");
    $form.validate({
      submitHandler: function () {
        $button.addClass("processing");
        $.post(pathToPhp, $form.serialize(), function (response) {
          $button
            .addClass("done")
            .find(".status")
            .append(response)
            .prop("disabled", true);
        });
        return false;
      },
    });
  });

  if ($("input[type=file].with-preview").length) {
    $("input.file-upload-input").MultiFile({
      list: ".file-upload-previews",
    });
  }

  // if( $(".gtn-has-bokeh-bg").length ){

  //     $("#gtn-main").prepend("<div class='gtn-bokeh-background'><canvas id='gtn-canvas'></canvas></div>");
  //     var canvas = document.getElementById("gtn-canvas");
  //     var context = canvas.getContext("2d");
  //     var maxRadius  = 50;
  //     var minRadius  = 3;
  //     var colors = ["#5c81f9",  "#66d3f7"];
  //     var numColors  =  colors.length;

  //     for(var i=0;i<50;i++){
  //         var xPos       =  Math.random()*canvas.width;
  //         var yPos       =  Math.random()*10;
  //         var radius     =  minRadius+(Math.random()*(maxRadius-minRadius));
  //         var colorIndex =  Math.random()*(numColors-1);
  //         colorIndex     =  Math.round(colorIndex);
  //         var color      =  colors[colorIndex];
  //         drawCircle(context, xPos, yPos, radius, color);
  //     }
  // }

  function drawCircle(context, xPos, yPos, radius, color) {
    context.beginPath();
    context.arc(xPos, yPos, radius, 0, 360, false);
    context.fillStyle = color;
    context.fill();
  }

  heroPadding();

  var $scrollBar = $(".scrollbar-inner");
  if ($scrollBar.length) {
    $scrollBar.scrollbar();
  }

  initializeSly();
  hideCollapseOnMobile();
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// On RESIZE actions

var resizeId;
$(window).on("resize", function () {
  clearTimeout(resizeId);
  resizeId = setTimeout(doneResizing, 250);
});

// Do after resize

function doneResizing() {
  //heroPadding();
  hideCollapseOnMobile();
}

function isSelected($this) {
  if ($this.val() !== "") $this.addClass("gtn-selected");
  else $this.removeClass("gtn-selected");
}

function initializeSly() {
  $(".gtn-sly-frame").each(function () {
    var horizontal = parseInt($(this).attr("data-gtn-sly-horizontal"), 2);
    if (!horizontal) horizontal = 0;

    var scrollbar = $(this).attr("data-gtn-sly-scrollbar");
    if (!scrollbar) scrollbar = 0;

    $(this).sly(
      {
        horizontal: horizontal,
        smart: 1,
        elasticBounds: 1,
        speed: 300,
        itemNav: "basic",
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        scrollBar: $(scrollbar),
        dragHandle: 1,
        scrollTrap: 1,
        clickBar: 1,
        scrollBy: 1,
        dynamicHandle: 1,
      },
      {
        load: function () {
          $(this.frame).addClass("gtn-loaded");
        },
      }
    );
  });
}

function heroPadding() {
  var $header = $("#gtn-header");
  var $hero = $("#gtn-hero");

  if ($header.hasClass("fixed-top")) {
    if ($hero.find(".gtn-full-screen").length) {
      $hero
        .find(".gtn-full-screen")
        .css("padding-top", $(".fixed-top").height());
    } else {
      $hero.css("padding-top", $(".fixed-top").height());
    }
  } else {
    if ($hero.find(".gtn-full-screen").length) {
      $hero
        .find(".gtn-full-screen")
        .css("min-height", "calc( 100vh - " + $header.height() + "px");
    }
  }
}

// Smooth Scroll

$(".gtn-scroll").on("click", function (event) {
  if (
    location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") &&
    location.hostname === this.hostname
  ) {
    var target = $(this.hash);
    var headerHeight = 0;
    var $fixedTop = $(".fixed-top");
    target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
    if ($fixedTop.length) {
      headerHeight = $fixedTop.height();
    }
    if (target.length) {
      event.preventDefault();
      $("html, body").animate(
        {
          scrollTop: target.offset().top - headerHeight,
        },
        1000,
        function () {
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) {
            return false;
          } else {
            $target.attr("tabindex", "-1");
            $target.focus();
          }
        }
      );
    }
  }
});

function hideCollapseOnMobile() {
  if ($(window).width() < 575) {
    $(".gtn-xs-hide-collapse.collapse").removeClass("show");
  }
}
