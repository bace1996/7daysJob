function on_click_job(dataId) {
    document.getElementById('job_apply_page').style.display='block';
    // 加载岗位描述
    $.ajax({
        url: "/job/description/" + dataId,
        success: function( result ) {
            $( "#jobDescribe" ).html(result);
        }
    });
    //  加载岗位试题
    $.ajax({
        url: "/job/quest/" + dataId,
        success: function( result ) {
            $( "#questionsArea" ).html(result);
        }
    });

    // 顺便把最后的落款时间覆盖下
    var utc = new Date().toJSON().slice(0,10).replace(/-/g,'/');
    $( "#invoicing" ).html('西洋汇' + utc);
}

function to_step_1() {
    // 暴力步骤切换
    document.getElementById('step-1').style.display='block';
    document.getElementById('step-2').style.display='none';
    document.getElementsByClassName('tab-item-2')[0].style.background = '#565656';
    document.getElementsByClassName('tab-item-3')[0].style.background = '#565656';
    document.getElementsByClassName('tab-item-4')[0].style.background = '#565656';
};

function to_step_2() {
    document.getElementById('step-1').style.display='none';
    document.getElementById('step-2').style.display='block';
    document.getElementsByClassName('tab-item-2')[0].style.background = '#AA3333';
    document.getElementsByClassName('tab-item-3')[0].style.background = '#565656';
};

function to_step_3(){
    document.getElementById('step-2').style.display='none';
    document.getElementById('step-3').style.display='block';
    document.getElementsByClassName('tab-item-3')[0].style.background = '#AA3333';
    document.getElementsByClassName('tab-item-4')[0].style.background = '#565656';
};

function to_step_4(){
    document.getElementById('step-3').style.display='none';
    document.getElementById('step-4').style.display='block';
    document.getElementsByClassName('tab-item-4')[0].style.background = '#AA3333';
};


function submit_form(job_id) {
    //我看官网每个问题都单独用JQ保存了，便于修改和保存，这边菜鸡先“一把梭”合并form提交了
    $('#questions :input').not(':submit').clone().hide().appendTo('#resume');
    $.ajax({
        url:'/job/saveResume',
        type:'post',
        data:$('#resume').serialize(),
        success:function(){
            to_step_4();
        }
    });

}

function on_click_job_apply_page() {
    // 官网还有一个点击边缘隐藏div的效果，没弄明白怎么做的，先保证x能用了
    document.getElementById('job_apply_page').style.display='none';
}