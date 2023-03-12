var NewsService = {
    init: function() {
        $('#addNewsForm').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                NewsService.add(entity);

            }
        });
        NewsService.list();

    },

    list: function() {
        $.get("rest/news", function(data) {
            $("#news-list").html("");
            var html = "";
            for (let i = 0; i<data.length; i++) {
                html += `
                <tr>
                                <th scope="row">`+data[i].id+`</th>
                                <td>`+data[i].title+`</td>
                                <td>`+data[i].date+`</td>
                                <td><img style="width: 50px; height: 40px;" src="`+data[i].image+`" alt=""></td>
                                <td>`+data[i].description+`</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary news-button" onClick="NewsService.get(` + data[i].id + `)">Edit</button>
                                    <button type="button" class="btn btn-danger news-button" onClick="NewsService.delete(` + data[i].id + `)">Delete</button>
                                  </div>
                                </td>
                              </tr>
                `;
            }
            $("#news-list").html(html);
        })
    },


    get: function(id) {
        $('.news-button').attr('disabled', true);
        $.get('rest/news/' + id, function(data) {
            $("#id").val(data.id);
            $("#title").val(data.title);
            $("#image").val(data.image);
            $("#description").val(data.description);
            $("#date").val(data.date);
            $("#exampleModal").modal("show");
            $('.news-button').attr('disabled', false);
        });
    },

    add: function(news) {
        $.ajax({
            contentType: "application/json",
            url: 'rest/news',
            type: 'POST',
            data: JSON.stringify(news),
            dataType: "json",
            success: function(result) {
                $("#news-list").html(`
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                `)
                NewsService.list();
                $("#addNewsModal").modal("hide");
            }
        });
    },

    update: function() {
        $('.save-news-button').attr('disabled', true);
        var news = {};
        news.id = $('#id').val();
        news.title = $('#title').val();
        news.image = $('#image').val();
        news.description = $('#description').val();
        news.date = new Date($('#date').val()).toISOString().slice(0, 19).replace('T', ' '); // convert to ISO 8601 datetime format
    
        $.ajax({
            contentType: "application/json",
            url: 'rest/news/' + $('#id').val(),
            type: 'PUT',
            data: JSON.stringify(news),
            dataType: "json",
            success: function(result) {
                $("#exampleModal").modal("hide");
                $("#news-list").html();
                $('.save-news-button').attr('disabled', false);
                NewsService.list();
            }
        });
    },

    delete: function(id) {
        $('.news-button').attr('disabled', true);
        $.ajax({
            url: 'rest/news/' + id,
            type: 'DELETE',
            success: function(result) {
                $("#news-list").html();
                NewsService.list();
            }
        });
    }
}