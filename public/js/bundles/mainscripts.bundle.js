if ("undefined" == typeof jQuery) throw new Error("jQuery plugins need to be before this file");
$.AdminOreo = {}, $.AdminOreo.options = {
    colors: {
        red: "#ec3b57",
        pink: "#E91E63",
        purple: "#ba3bd0",
        deepPurple: "#673AB7",
        indigo: "#3F51B5",
        blue: "#2196f3",
        lightBlue: "#03A9F4",
        cyan: "#00bcd4",
        green: "#4CAF50",
        lightGreen: "#8BC34A",
        yellow: "#ffe821",
        orange: "#FF9800",
        deepOrange: "#f83600",
        grey: "#9E9E9E",
        blueGrey: "#607D8B",
        black: "#000000",
        blush: "#dd5e89",
        gold: "#f3b715",
        white: "#ffffff"
    },
    leftSideBar: {
        scrollColor: "rgba(0,0,0,0.5)",
        scrollWidth: "4px",
        scrollAlwaysVisible: !1,
        scrollBorderRadius: "0",
        scrollRailBorderRadius: "0"
    },
    dropdownMenu: {
        effectIn: "fadeIn",
        effectOut: "fadeOut"
    }
}, $.AdminOreo.leftSideBar = {
    activate: function () {
        var a = this,
            i = $("body"),
            r = $(".overlay");
        $(window).on("click", function (e) {
            var t = $(e.target);
            "i" === e.target.nodeName.toLowerCase() && (t = $(e.target).parent()), !t.hasClass("bars") && a.isOpen() && 0 === t.parents("#leftsidebar").length && (t.hasClass("js-right-sidebar") || r.fadeOut(), i.removeClass("overlay-open"))
        }), $.each($(".menu-toggle.toggled"), function (e, t) {
            $(t).next().slideToggle(0)
        }), $.each($(".menu .list li.active"), function (e, t) {
            var a = $(t).find("a:eq(0)");
            a.addClass("toggled"), a.next().show()
        }), $(".menu-toggle").on("click", function (e) {
            var t = $(this),
                a = t.next();
            if ($(t.parents("ul")[0]).hasClass("list")) {
                var i = $(e.target).hasClass("menu-toggle") ? e.target : $(e.target).parents(".menu-toggle");
                $.each($(".menu-toggle.toggled").not(i).next(), function (e, t) {
                    $(t).is(":visible") && ($(t).prev().toggleClass("toggled"), $(t).slideUp())
                })
            }
            t.toggleClass("toggled"), a.slideToggle(320)
        }), a.checkStatuForResize(!0), $(window).resize(function () {
            a.checkStatuForResize(!1)
        }), Waves.attach(".menu .list a", ["waves-block"]), Waves.init()
    },
    checkStatuForResize: function (e) {
        var t = $("body"),
            a = $(".navbar .navbar-header .bars"),
            i = t.width();
        e && t.find(".content, .sidebar").addClass("no-animate").delay(1e3).queue(function () {
            $(this).removeClass("no-animate").dequeue()
        }), i < 1170 ? (t.addClass("ls-closed"), a.fadeIn()) : (t.removeClass("ls-closed"), a.fadeOut())
    },
    isOpen: function () {
        return $("body").hasClass("overlay-open")
    }
}, $.AdminOreo.rightSideBar = {
    activate: function () {
        var a = this,
            i = $("#rightsidebar"),
            r = $(".overlay");
        $(window).on("click", function (e) {
            var t = $(e.target);
            "i" === e.target.nodeName.toLowerCase() && (t = $(e.target).parent()), !t.hasClass("js-right-sidebar") && a.isOpen() && 0 === t.parents("#rightsidebar").length && (t.hasClass("bars") || r.fadeOut(), i.removeClass("open"))
        }), $(".js-right-sidebar").on("click", function () {
            i.toggleClass("open"), a.isOpen() ? r.fadeIn() : r.fadeOut()
        })
    },
    isOpen: function () {
        return $(".right-sidebar").hasClass("open")
    }
}, $.AdminOreo.navbar = {
    activate: function () {
        var e = $("body"),
            t = $(".overlay");
        $(".bars").on("click", function () {
            e.toggleClass("overlay-open"), e.hasClass("overlay-open") ? t.fadeIn() : t.fadeOut()
        }), $('.nav [data-close="true"]').on("click", function () {
            var e = $(".navbar-toggle").is(":visible"),
                t = $(".navbar-collapse");
            e && t.slideUp(function () {
                t.removeClass("in").removeAttr("style")
            })
        })
    }
}, $.AdminOreo.select = {
    activate: function () {
        $.fn.selectpicker && $("select:not(.ms)").selectpicker('destroy');
        $('select').selectpicker('destroy');
    }
}, $(".boxs-close").on("click", function () {
    $(this).parents(".card").addClass("closed").fadeOut()
});
var edge = "Microsoft Edge",
    ie10 = "Internet Explorer 10",
    ie11 = "Internet Explorer 11",
    opera = "Opera",
    firefox = "Mozilla Firefox",
    chrome = "Google Chrome",
    safari = "Safari";

function initSparkline() {
    $(".sparkline").each(function () {
        var e = $(this);
        e.sparkline("html", e.data())
    })
}

function initCounters() {
    $(".count-to").countTo()
}

function skinChanger() {
    $(".right-sidebar .choose-skin li").on("click", function () {
        var e = $("body"),
            t = $(this),
            a = $(".right-sidebar .choose-skin li.active").data("theme");
        $(".right-sidebar .choose-skin li").removeClass("active"), e.removeClass("theme-" + a), t.addClass("active"), e.addClass("theme-" + t.data("theme"))
    })
}

function CustomScrollbar() {
    $(".sidebar .menu .list").slimscroll({
        height: "calc(100vh - 60px)",
        color: "rgba(0,0,0,0.2)",
        position: "left",
        size: "2px",
        alwaysVisible: !1,
        borderRadius: "3px",
        railBorderRadius: "0"
    }), $(".navbar-left .dropdown-menu .body .menu").slimscroll({
        height: "300px",
        color: "rgba(0,0,0,0.2)",
        size: "3px",
        alwaysVisible: !1,
        borderRadius: "3px",
        railBorderRadius: "0"
    }), $(".chat-widget").slimscroll({
        height: "300px",
        color: "rgba(0,0,0,0.4)",
        size: "2px",
        alwaysVisible: !1,
        borderRadius: "3px",
        railBorderRadius: "2px"
    }), $(".right-sidebar .slim_scroll").slimscroll({
        height: "calc(100vh - 60px)",
        color: "rgba(0,0,0,0.4)",
        size: "2px",
        alwaysVisible: !1,
        borderRadius: "3px",
        railBorderRadius: "0"
    })
}
$.AdminOreo.browser = {
    activate: function () {
        "" !== this.getClassName() && $("html").addClass(this.getClassName())
    },
    getBrowser: function () {
        var e = navigator.userAgent.toLowerCase();
        return /edge/i.test(e) ? edge : /rv:11/i.test(e) ? ie11 : /msie 10/i.test(e) ? ie10 : /opr/i.test(e) ? opera : /chrome/i.test(e) ? chrome : /firefox/i.test(e) ? firefox : navigator.userAgent.match(/Version\/[\d\.]+.*Safari/) ? safari : void 0
    },
    getClassName: function () {
        var e = this.getBrowser();
        return e === edge ? "edge" : e === ie11 ? "ie11" : e === ie10 ? "ie10" : e === opera ? "opera" : e === chrome ? "chrome" : e === firefox ? "firefox" : e === safari ? "safari" : ""
    }
}, $(function () {
    $.AdminOreo.browser.activate(), $.AdminOreo.leftSideBar.activate(), $.AdminOreo.rightSideBar.activate(), $.AdminOreo.navbar.activate(), $.AdminOreo.select.activate(), setTimeout(function () {
        $(".loader-wrapper").fadeOut('slow');
    }, 50)
}), $(function () {
    "use strict";
    skinChanger(), CustomScrollbar(), initSparkline(), initCounters()
}), $(".theme-light-dark .t-light").on("click", function () {
    $("body").removeClass("menu_dark")
}), $(".theme-light-dark .t-dark").on("click", function () {
    $("body").addClass("menu_dark")
}), $(".m_img_btn").on("click", function () {
    $("body").toggleClass("menu_img")
}), $(".ls-toggle-btn").on("click", function () {
    $("body").toggleClass("ls-toggle-menu")
}), $(function () {
    $(".chat-launcher").on("click", function () {
        $(".chat-launcher").toggleClass("active"), $(".chat-wrapper").toggleClass("is-open pullUp")
    })
}), $(".form-control").on("focus", function () {
    $(this).parent(".input-group").addClass("input-group-focus")
}).on("blur", function () {
    $(this).parent(".input-group").removeClass("input-group-focus")
});