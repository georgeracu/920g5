$(() => {
    loadSPAPage('main');
    $('[data-toggle="popover"]').popover();
    $('.spa-nav').on('click', function () {
        var id = $(this).attr('data-spa-name');
        console.log("Loading SPA view with id " + id);
        loadSPAPage(id);
    })
});

function loadSPAPage(pageName) {
    $.ajax({
        type: "GET",
        url: "index.php/api/get-spa-page?" + pageName,
        dataType: "text",
        success: function (result, status, xhr) {
            replaceSPAContent(result);
        },
        error: function (xhr, status, error) {
            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
        }
    });
}

function replaceSPAContent(newContent) {
    // clear the container first
    $('#spaContent').html('');
    // render inside the container the new content
    $('#spaContent').html(newContent);
}

function loadFragment(viewName) {
    // call the server to load the new data
    $.ajax({
        type: "GET",
        url: "index.php/api/get-fragment?" + viewName,
        dataType: "text",
        success: function (result, status, xhr) {
            replaceSPAContent(result);
        },
        error: function (xhr, status, error) {
            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
        }
    });
}