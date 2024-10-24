$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $("#tblData").DataTable({
        responsive: true,
        ajax: "/users/permissions",
        columns: [
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            { data: "guard_name", name: "guard_name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
});

$("body").on("click", "#btnDel", function () {
    // confirmation
    var id = $(this).data("id");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            var route = "permissions/:id";
            route = route.replace(":id", id);
            $.ajax({
                url: route,
                type: "delete",
                success: function (res) {
                    $("#tblData").DataTable().ajax.reload();
                    Swal.fire("Deleted!", res.message, "success");
                },
                error: function (res) {
                    Swal.fire("Error!", res.message, "error");
                },
            });
        }
    });
});
