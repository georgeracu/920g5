$(() => {
    $('[data-toggle="popover"]').popover();
    $('.spa-nav').on('click', function () {
        var id = $(this).attr('data-spa-name');
        console.log("Loading SPA view with id " + id);
        loadView(id);
    })
});

function loadView(viewName) {
    // call the server to load the new data
    $.ajax({
        type: "GET",
        url: "index.php/api/get-fragment?" + viewName,
        dataType: "text",
        success: function (result, status, xhr) {
            $('#spaContent').html('');
            // render inside the container the new content
            $('#spaContent').html(result);
        },
        error: function (xhr, status, error) {
            alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
        }
    });
}