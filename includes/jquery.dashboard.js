// Global Variables
var SideBarWidth;
var AppBaseColor;
var AppTextColor;
var AppIcon;

$(window).load(function() {
    ViewportResize();
    $("body").fadeIn(2000);
});

$(window).resize(function() {
    ViewportResize();
});

$(document).ready(function() {
    ViewportResize();

    $(".APP-BACK-BUTTON").click(function() {

        window.location.href = "../dashboard";
    });
});

function ViewportResize() {

    var viewportWidth = $(this).width();
    var viewportHeight = $(this).height();

    var headerHeight = $(".header").height();
    var footerHeight = $(".footer").height();
    var contentHeight = $(".content").height();

    var spacerHeight = (viewportHeight - (headerHeight + footerHeight + contentHeight)) / 2;

    $('#spacer-1').css('height', spacerHeight);
    $('#spacer-2').css('height', spacerHeight);

};


function TabSelector() {

    var openID = "LANDINGDiv";

    $(".tab-button").click(function() {

        var button = $(this).attr('id');

        if (openID != button) {
            $('.containers').fadeOut(300);
            $('.tab-button').animate({
                backgroundColor: "#EEE",
                "color": "#000"
            }, 100);
            $("#" + button + "Div").show();
            $("#" + button).animate({
                backgroundColor: AppBaseColor,
                "color": AppTextForegroundColor
            }, 100);
            openID = button;
        } else {
            //Do nothing
        }

    });

};

function AppStyler() {

    $("div.APP-COLOR-BAR").css("background", AppBaseColor);
    $("div.APP-SIDEBAR").css("width", SideBarWidth);
    $("div.APP-CONTENT-CONTAINER").css("width", "calc(100% - " + SideBarWidth + ")");
    $("div.APP-ICON").css({
        "background": AppIcon,
        "background-size": "80% 80%"
    });
    $("div.APP-COLOR-BAR").css("background", AppBaseColor);
    $("text.APP-SIDEBAR-TITLE").css("color", AppTextColor);
    $("text.APP-CONTENT-TITLE").css("color", AppTextColor);
    $("#LANDING").css("background", AppBaseColor);

};