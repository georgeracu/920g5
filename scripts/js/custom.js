$(() => {
    loadSPAPage('main');
    $('[data-toggle="popover"]').popover();
    $('.spa-nav').on('click', function () {
        var id = $(this).attr('data-spa-name');
        console.log("Loading SPA view with id " + id);
        loadSPAPage(id);
    })
    $('ul.footer-links > li').on('click', function () {
        var id = $(this).attr('data-action-url');
        console.log("Loading SPA view with id " + id);
        loadSPAPage(id);
    })
});

function loadSPAPage(pageName) {
    sendRequest("api/get-spa-page?" + pageName, replaceSPAContent);
    clearActiveMenuItems(pageName);
    setActiveMenuItem(pageName);
}

function setActiveMenuItem(itemName) {
    console.log("Adding CSS class");
    $("ul.navbar-nav > li").find("[data-spa-name='" + itemName + "']").addClass('active');
}

function clearActiveMenuItems() {
    console.log("Removing CSS class");
    $("ul.navbar-nav > li > a").removeClass('active');
}

function replaceSPAContent(newContent) {
    // clear the container first
    $('#spaContent').html('');
    // render inside the container the new content
    $('#spaContent').html(newContent);
}

function loadFragment(viewName) {
    sendRequest("api/get-fragment?" + viewName, replaceSPAContent);
}

function sendRequest(url, successCallback) {
    $.ajax({
        type: "GET",
        url: "index.php/" + url,
        dataType: "text",
        success: function (result, status, xhr) {
            successCallback(result);
        },
        error: function (xhr, status, error) {
            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
        }
    });
}

function toggleLight() {
    var currentState = $("#spot").attr("on");
    console.log(currentState);
}