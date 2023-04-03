var ReportsService = {
    init: function() {
        $('#addReportsForm').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                ReportsService.add(entity);

            }
        });
        ReportsService.list();

    },

    list: function() {
        $.get("rest/reports", function(data) {
            $("#reports-list").html("");
            var html = "";
            
            
            for (let i = 0; i<data.length; i++) {
                html += `
                <tr>
                                <th scope="row">`+data[i].id+`</th>
                                <td>`+data[i].first_name+ " " +data[i].last_name+`</td>
                                <td>`+data[i].date_of_birth+`</td>
                                <td>`+data[i].city+ ", " +data[i].country+`</td>
                                <td>`+data[i].category+`</td>
                                <td>`+data[i].description+`</td>
                                <td>`+data[i].status+`</td>
                                <td>
                                    <button type="button" class="btn btn-warning reports-button" onClick="ReportsService.get(` + data[i].id + `)">Manage</button>
                                </td>
                            </tr>
                `;
                $("#reports-list").html(html);
            }
        })
    },


    get: function(id) {
        $('.reports-button').attr('disabled', true);
        $.get('rest/reports/' + id, function(data) {
            $("#id").val(data.id);
            $("#status").val(data.status);           
            $("#exampleModalR").modal("show");
            $('.reports-button').attr('disabled', false);
        });
    },

    add: function(reports) {
        $.ajax({
            contentType: "application/json",
            url: 'rest/reports',
            type: 'POST',
            data: JSON.stringify(reports),
            dataType: "json",
            success: function(result) {
                $("#reportMessage").html(`+                    
                <p class="text-success">Tip successfully submitted. We will take it into consideration soon.</p>
                +`);
            }
        });
    },

    update: function() {
        $('.save-reports-button').attr('disabled', true);
        var reports = {};
        reports.id = $('#id').val();
        reports.status = $('#status').val();
        
    
        $.ajax({
            contentType: "application/json",
            url: 'rest/reports/' + $('#id').val(),
            type: 'PUT',
            data: JSON.stringify(reports),
            dataType: "json",
            success: function(result) {
                $("#exampleModalR").modal("hide");
                $("#reports-list").html();
                $('.save-reports-button').attr('disabled', false);
                ReportsService.list();
            }
        });
    },
/*
    delete: function(id) {
        $('.reports-button').attr('disabled', true);
        $.ajax({
            url: 'rest/reports/' + id,
            type: 'DELETE',
            success: function(result) {
                $("#reports-list").html();
                ReportsService.list();
            }
        });
    }*/
}