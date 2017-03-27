$(function () {
    $("#todoForm").on('submit', function(){
        if($("#content").val() == '')
        {
            $("#errorSpan").text('Invalid item, item must contain at least 1 character');
            return false;
        }
    });

    $("button[id^='editItem-']").one('click', function () {
        var id = $(this).attr('id').replace(/editItem-/, '');
        var itemContent = $("#itemContent-" + id), url = $("#deleteItem-" + id).attr('href').replace(/delete/, 'update');
        var content = itemContent.html();
        $("#editItemInput").val(content);
        $("#updateForm").attr('action', url);
    });

    $("#updateForm").on('submit', function () {
        if($("#editItemInput").val() == '')
        {
            $("label[for='editItemInput']").css('color', 'red');
            return false;
        }
    });

    $("input[type='checkbox']").on('click', function () {
        var url = $(this).data().url;
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
            },
            error: function () {
                console.log('error');
            }
        });
    });
});