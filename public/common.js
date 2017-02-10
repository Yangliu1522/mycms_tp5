/**
 * Created by liu on 1/9/17.
 */
function tip_error(content,element){
    msg = "<span style='font-size:16px;font-weight: bold;'>"+content+"</span>";
    layer.tips(msg,element,{
        tips:[3,"red"]
    })
}

function show_errors(content,element) {

    layer.msg(content, {icon: 2,time:2000},function () {
        element.focus();
    });
}