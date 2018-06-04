$(document).ready(function(){
    $('textarea').attr("readonly","readonly");
});

function edit_apply(apply_id) {
    location.href = "/admin/apply/" + apply_id;
}

function delete_apply(apply_id) {
    $.ajax({
        url:'/admin/apply/' + apply_id,
        type:'delete',
        success:function(){
            location.href = "/admin";
        }
    });
}