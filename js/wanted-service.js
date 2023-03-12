var WantedService = {
    init: function() {
        $('#addWantedForm').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                WantedService.add(entity);

            }
        });
        WantedService.list();

    },

    list: function() {
        $.get("rest/wanted", function(data) {
            $("#wanted-list").html("");
            var html = "";
            
            for (let i = 0; i<data.length; i++) {
                html += `
                <tr>
                                <th scope="row">`+data[i].id+`</th>
                                <td>`+data[i].first_name+`</td>
                                <td>`+data[i].last_name+`</td>
                                <td><img style="width: 50px; height: 40px;" src="`+data[i].image+`" alt=""></td>
                                <td>`+data[i].description+`</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary wanted-button" onClick="WantedService.get(` + data[i].id + `)">Edit</button>
                                    <button type="button" class="btn btn-danger wanted-button" onClick="WantedService.delete(` + data[i].id + `)">Delete</button>
                                  </div>
                                </td>                            
                            </tr>
                `;
                $("#wanted-list").html(html);
            }
        })
    },


    get: function(id) {
        $('.wanted-button').attr('disabled', true);
        $.get('rest/wanted/' + id, function(data) {
            $("#id").val(data.id);
            $("#first_name").val(data.first_name);
            $("#last_name").val(data.last_name);
            $("#description").val(data.description);
            $("#image").val(data.image);
            $("#exampleModalW").modal("show");
            $('.wanted-button').attr('disabled', false);
        });
    },

    add: function(wanted) {
        $.ajax({
            contentType: "application/json",
            url: 'rest/wanted',
            type: 'POST',
            data: JSON.stringify(wanted),
            dataType: "json",
            success: function(result) {
                $("#wanted-list").html(`
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                `);
                WantedService.list();
                $("#addWantedModal").modal("hide");
            }
        });
    },

    update: function() {
        $('.save-wanted-button').attr('disabled', true);
        var wanted = {};
        wanted.id = $('#id').val();
        wanted.first_name = $('#first_name').val();
        wanted.last_name = $('#last_name').val();
        wanted.image = $('#image').val();
        wanted.description = $('#description').val();
    
        $.ajax({
            contentType: "application/json",
            url: 'rest/wanted/' + $('#id').val(),
            type: 'PUT',
            data: JSON.stringify(wanted),
            dataType: "json",
            success: function(result) {
                $("#exampleModalW").modal("hide");
                $("#wanted-list").html();
                $('.save-wanted-button').attr('disabled', false);
                WantedService.list();
            }
        });
    },

    delete: function(id) {
        $('.wanted-button').attr('disabled', true);
        $.ajax({
            url: 'rest/wanted/' + id,
            type: 'DELETE',
            success: function(result) {
                $("#wanted-list").html();
                WantedService.list();
            }
        });
    }
}