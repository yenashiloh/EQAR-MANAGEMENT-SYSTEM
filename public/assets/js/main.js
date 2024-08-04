$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});

//Pagination
$(document).ready(function() {
    $('#dataTable').DataTable({
        paging: true,
        searching: true,
        info: true,
    });
});

