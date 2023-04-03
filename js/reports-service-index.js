var ReportsServiceIndex = {
    init: function() {

        $('#addReportsForm').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                ReportsServiceIndex.add(entity);

            }
        });

    },

    add: function(reports) {
        console.log(reports);
        $.ajax({
            contentType: "application/json",
            url: 'rest/reports',
            type: 'POST',
            data: JSON.stringify(reports),
            dataType: "json",
            success: function(result) {
                $("#addReportsModal").modal("hide");

            }
        });
    }
}