/* var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
var USER_AUTH_STATE_ROUTE = document.querySelector('meta[name="user-auth-state-url"]').getAttribute("content");
var DATE_FORMAT = document.querySelector('meta[name="date-format"]').getAttribute("content"); */
var METHOD_GET = "GET";
var METHOD_POST = "POST";
var KEYWORDS_EXTRACTION_SERVER_URL = "http://127.0.0.1:5000/keywords";

/************UTILS FUCTIONS ***********/
function exist(variable) {
    return (variable !== null && "" + variable !== "undefined") ? true : false;
}

function existInDOM(element) {
    return ("" + element.html() !== "undefined") ? true : false;
}

function collapse(element) {
    element.removeClass("collapse").removeClass("show");
}

function show(element, scrollToElement = false) {
    element.removeClass("d-none");
    element.addClass("show");
    if (scrollToElement) {
        $('html, body').animate({
            scrollTop: element.offset().top
        }, 500);
    }
}

function hide(element) {
    element.addClass("d-none");
    element.removeClass("show");
}

function ajaxRequest(url, method, data, success, error) {
    //alert($(".loading-modal").html());
    //alert(url);
    show($(".loading-modal"));
    var ajaxData = {
        url: url.trim(),
        data: data,
        type: method.trim(),
        beforeSend: function() {
            //                        $('.ajax-load').show();
        }
    };
    // alert(JSON.stringify(ajaxData));
    $.ajax(ajaxData)
        .done(function(data) {
            //alert(data);
            //                alert(JSON.stringify(data));
            //                    alert(data);
            //                    if (data.indexOf("CSRF token mismatch") >= 0) {
            //                        location.reload();
            //                    } else {
            if (success !== null)
                success(data);
            hide($(".loading-modal"));
            //                    }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            hide($(".loading-modal"));
            //alert(JSON.stringify(jqXHR));
            console.log(jqXHR.responseText)
            if (JSON.stringify(jqXHR).indexOf("CSRF token mismatch") >= 0) {
                //                    if (JSON.stringify(jqXHR).toLowerCase().indexOf("csrf_token") > 0) {
                //                        alert("Reloading...");
                location.reload();
            } else {
                //                        alert("An error occurred. Please try again.");
            }
            if (error !== null)
                error(jqXHR);
        });
}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function snackbar(text, colorClass, duration) {
    var snackbar = document.getElementsByClassName("snackbar")[0];
    snackbar.innerHTML = text;
    var arr = snackbar.className.split(" ");
    if (arr.indexOf(name) == -1) {
        snackbar.className += " show";
        snackbar.className += " " + colorClass;
    }
    duration = exist(duration) ? duration : 5000;

    // After n seconds, remove the show class from DIV
    setTimeout(function() {
        snackbar.className = snackbar.className.replace(" show", "");
        snackbar.className = snackbar.className.replace(" " + colorClass, "");
    }, duration);

    // Show toast too
    toast(text, colorClass, duration)
}

function toast(text, colorClass, duration) {
    duration = exist(duration) ? duration : 5000;
    show($(".toast-container"));
    var toast = $(".message-toast");
    toast.find(".toast-body").html(text);
    toast.addClass(colorClass);

    toast.toast("show");
    // After n seconds, remove the color class from DIV
    setTimeout(function() {
        toast.removeClass(colorClass);
        hide($(".toast-container"));
    }, duration);
}

function initMomentDate(elmt) {
    elmt = exist(elmt) ? elmt.find('.moment-date') : $('.moment-date');
    if (elmt.length) {
        elmt.each(function(e) {
            var displayFormat = elmt.attr("data-moment-display");
            if (displayFormat == "fromNow") {
                $(this).html(moment($(this).attr("data-moment"), DATE_FORMAT).fromNow());

            } else if (displayFormat == "calendar") {
                $(this).html(moment($(this).attr("data-moment"), DATE_FORMAT).calendar());

            } else {
                $(this).html(moment($(this).attr("data-moment"), DATE_FORMAT).format("llll"));
            }
        });
    }
}

function initLibraries(elmt) {
    initMomentDate(elmt);
}

function money_format(money, currency, currenciesArray, displayFormat) {
    /* var currenciesArray = JSON.parse(currenciesArray);
    var formattedMoney = "";
    var currencySymbol = "";
    if (!currenciesArray[currency]) {
        formattedMoney = number_format($money, 2);
        currencySymbol = $currency;
    } else {

    } */

    // Create our number formatter.
    var formatter = new Intl.NumberFormat(undefined, { //undefined to take the system locale
        // var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency,

        // These options are needed to round to whole numbers if that's what you want.
        //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
        //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    });

    return formatter.format(money); /* $2,500.00 */

}


// Get all events on an element
function getEvents(element) {
    var elemEvents = $._data(element, "events");
    var allDocEvnts = $._data(document, "events");
    for (var evntType in allDocEvnts) {
        //alert(JSON.stringify(allDocEvnts));
        if (true) {
            //if (allDocEvnts.prototype.hasOwnProperty(evntType)) {
            var evts = allDocEvnts[evntType];
            for (var i = 0; i < evts.length; i++) {
                //alert("yes");
                if ($(element).is(evts[i].selector)) {
                    if (elemEvents == null) {
                        elemEvents = {};
                    }
                    if (!elemEvents.hasOwnProperty(evntType)) {
                        elemEvents[evntType] = [];
                    }
                    elemEvents[evntType].push(evts[i]);
                }
            }
        }
    }
    return elemEvents;
}
// Check if event exists on an element
function hasEvent(element, eventName) {
    var elemEvents = getEvents(element);
    for (var evntType in elemEvents) {
        //alert(JSON.stringify(evntType));
        if (evntType == eventName) {
            return true;
        }
    }
    return false;
}

/************UTILS FUCTIONS END ***********/