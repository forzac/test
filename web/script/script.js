/**
 * Created by Denis on 29.09.2016.
 */
function alertHide(){
    $('.alert').hide(300);
}
setTimeout(alertHide, 2000);

$('.panel-body > .btn').each(function(i,elem) {
    $(elem).bind('click', function(){
        var ta = $('#test'),
            p = ta[0].selectionStart,
            text = ta.val();
        if(p != undefined)
            ta.val(text.slice(0, p) + $(this).val() + text.slice(p));
        else{
            ta.trigger('focus');
            range = document.selection.createRange();
            range.text = $(this).val();
        }
    });
});

function handler(e) {
    e.preventDefault();
    $.ajax({
        url: "../guestbook/preview",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
            console.log(data.model.GuestbookForm);
            addPreviewField(data);
        },
    });
}

document.getElementById('add-form').addEventListener("submit", handler);
document.getElementById('add').addEventListener('click', function(){
    console.log('opened');
    document.getElementById('add-form').removeEventListener("submit", handler);
});

function addPreviewField(data)
{
    console.log(data.model);
    var value = data.model.GuestbookForm;
    for (var key in value) {
        document.getElementById(key).innerHTML = value[key];
        if(key == 'file') {
            console.log('opened');
            var el = document.getElementById(key);
            el.innerHTML = '<img src="' + '/' + value[key] + '" alt="upload image, please">';
        }
    }
}
