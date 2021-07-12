/*
 *  Javascript to be ran on every page REG: 1801459
 */

$(function() {

    /*
     * Initial setup of the theme - ensures we can just toggleClass later
     * Because some implementations of localStorage store always a string,
     * we use == to ensure both string & boolean will pass the check
     */
    var bIsDark = window.localStorage.getItem('isDark');
    if (bIsDark == "true") {
        $("body").addClass("theme__dark");
        $("#isDarkTheme").attr("checked", true);
    }

    //Setup the navbar dropdown event listener
    $(".navbar__toggle").on("click", function() {
        $(".navbar__item").toggleClass("active");
    });

    //Setup the dark theme toggle event listener
    $("#isDarkTheme").change(function() {
        $("body").toggleClass("theme__dark");
        window.localStorage.setItem('isDark', this.checked);
    });
});
