var MissingService = {
    init: function() {
        $('#addMissingForm').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                MissingService.add(entity);

            }
        });
        MissingService.list();

    },

    list: function() {
        $.get("rest/missing", function(data) {
            $("#missing-list").html("");
            var html = "";
            
            for (let i = data.length-1; i>=0; i--) {
                html += `
                <tr>
                                <th scope="row">`+data[i].id+`</th>
                                <td>`+data[i].first_name+" "+data[i].last_name+`</td>
                                <td><img style="width: 50px; height: 40px;" src="images/wanted/`+data[i].image+`" alt=""></td>
                                <td>`+data[i].description+`</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary wanted-button" onClick="WantedService.get(` + data[i].id + `)"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger wanted-button" onClick="WantedService.delete(` + data[i].id + `)"><i class="fas fa-trash"></i></button>
                                  </div>
                                </td>                            
                            </tr>
                `;
                $("#missing-list").html(html);
            }
        })
    },


    get: function(id) {
        $('.missing-button').attr('disabled', true);
        $.get('rest/missing/' + id, function(data) {
            $("#id").val(data.id);
            $("#first_name").val(data.first_name);
            $("#last_name").val(data.last_name);
            $("#description").val(data.description);
            $("#image").val(data.image);
            $("#exampleModalW").modal("show");
            $('.missing-button').attr('disabled', false);
        });
    },

    add: function(missing) {
        $.ajax({
            contentType: "application/json",
            url: 'rest/missing',
            type: 'POST',
            data: JSON.stringify(missing),
            dataType: "json",
            success: function(result) {
                console.log(result);
                $("#missing-list").html(`
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                `);
                MissingService.list();
                $("#addMissingModal").modal("hide");
            }
        });
    },

    update: function() {
        $('.save-missing-button').attr('disabled', true);
        var missing = {};
        missing.id = $('#id').val();
        missing.first_name = $('#first_name').val();
        missing.last_name = $('#last_name').val();
        missing.image = $('#image').val();
        missing.description = $('#description').val();
        console.log($('#description').val());

        $.ajax({
            contentType: "application/json",
            url: 'rest/missing/' + $('#id').val(),
            type: 'PUT',
            data: JSON.stringify(missing),
            dataType: "json",
            success: function(result) {
                console.log(result);

                $("#exampleModalM").modal("hide");
                $("#missing-list").html(`
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                `);
                $('.save-missing-button').attr('disabled', false);
                MissingService.list();
            }
        });
    },

    delete: function(id) {
        $('.missing-button').attr('disabled', true);
        $.ajax({
            url: 'rest/missing/' + id,
            type: 'DELETE',
            success: function(result) {
                $("#missing-list").html();
                MissingService.list();
            }
        });
    }
}