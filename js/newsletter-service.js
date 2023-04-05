var NewsletterService = {
    init: function() {
        $('#addNewsletterForm').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                NewsletterService.add(entity);

            }
        });
        NewsletterService.list();

    },

    list: function() {
        $.get("rest/newsletter", function(data) {
            $("#newsletter-list").html("");
            var html = "";
            for (let i = 0; i<data.length; i++) {
                html += `
                <tr>
                                <th scope="row">`+data[i].id+`</th>
                                <td>`+data[i].email+`</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger news-button" onClick="NewsletterService.delete(` + data[i].id + `)">Delete</button>
                                  </div>
                                </td>
                              </tr>
                `;
            }
            $("#newsletter-list").html(html);
        })
    },


    get: function(id) {
        $('.newsletter-button').attr('disabled', true);
        $.get('rest/newsletter/' + id, function(data) {
            $("#id").val(data.id);
            $("#email").val(data.email);
            $('.newsletter-button').attr('disabled', false);
        });
    },

    add: function(news) {
        $.ajax({
            contentType: "application/json",
            url: 'rest/newsletter',
            type: 'POST',
            data: JSON.stringify(news),
            dataType: "json",
            success: function(result) {
                alert("You are now subscribed to out newsletter!");
            }
        });
    },

    delete: function(id) {
        $('.newsletter-button').attr('disabled', true);
        $.ajax({
            url: 'rest/newsletter/' + id,
            type: 'DELETE',
            success: function(result) {
                $("#newsletter-list").html();
                NewsletterService.list();
            }
        });
    }
}