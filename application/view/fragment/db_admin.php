<?php if (isset($alertMessage)) {
    echo "<div class='alert alert-dark' role='alert'>{$alertMessage}'</div>";
} ?>
<script>
    $(() => {
        $("div.db-admin-buttons > button").on('click', function() {
            var actionUrl = $(this).attr('data-action-url');
            sendRequest(actionUrl);
        });
    });

    function sendRequest(actionUrl) {
        $.ajax({
            type: "GET",
            url: "index.php/api/db/" + actionUrl,
            dataType: "text",
            success: function(result, status, xhr) {
                replaceSPAContent(result);
            },
            error: function(xhr, status, error) {
                alert("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
            }
        });
    }
</script>
<h2>Database available actions</h2>
<div class="list-group db-admin-buttons">
    <button type="button" class="list-group-item list-group-item-action" data-action-url="truncate">Truncate all tables</button>
    <button type="button" class="list-group-item list-group-item-action" data-action-url="seed">Seed data</button>
    <button type="button" class="list-group-item list-group-item-action" data-action-url="drop">Drop all tables</button>
    <button type="button" class="list-group-item list-group-item-action" data-action-url="create">Create all tables</button>
</div>