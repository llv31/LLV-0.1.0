$(document).ready(function () {
    $('td.actions a.jq-delete').click(function () {
        return confirm('Do you really want to delete this element ?');
    });
});
