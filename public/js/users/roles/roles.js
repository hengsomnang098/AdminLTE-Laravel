$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// get rule data
$(document).ready(function () {
    $("#tblroles").DataTable({
        reponsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: "/users/roles",
        columns: [
            { data: "id", name: "id" },
            { data: "name", name: "name" },
            {
                data: "users_count",
                name: "users_count",
                className: "text-center",
            },
            {
                data: "permissions_count",
                name: "permissions_count",
                className: "text-center",
            },
            {
                data: "action",
                name: "action",
                bSortable: false,
                className: "text-center",
            },
        ],
    });
    $("body").on("click", "#btnDel", function () {
        //confirmation
        var id = $(this).data("id");
        if (confirm("Delete Data " + id + "?") == true) {
            var route = "{{route('users.roles.destroy', ':id')}}";
            route = route.replace(":id", id);
            $.ajax({
                url: route,
                type: "delete",
                uccess: function (res) {
                    $("#tblData").DataTable().ajax.reload();
                    Swal.fire("Deleted!", res.message, "success");
                },
                error: function (res) {
                    Swal.fire("Error!", res.message, "error");
                },
            });
        } else {
            //do nothing
        }
    });
});

// get permission data
$(document).ready(function () {
    //check uncheck all function
    $('[name="all_permission"]').on("click", function () {
        if ($(this).is(":checked")) {
            $.each($(".permission"), function () {
                if ($(this).val() != "dashboard") {
                    $(this).prop("checked", true);
                }
            });
        } else {
            $.each($(".permission"), function () {
                if ($(this).val() != "dashboard") {
                    $(this).prop("checked", false);
                }
            });
        }
    });
    $("#tblPermissions").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        bFilder: true,
        autoWidth: false,
        bPaginate: false,
        ajax: "/users/permissions",
        columns: [
            {
                data: "chkBox",
                name: "chkBox",
                orderable: false,
                searchable: false,
            },
            { data: "name", name: "name" },
            { data: "guard_name", name: "guard_name" },
        ],
    });
});
