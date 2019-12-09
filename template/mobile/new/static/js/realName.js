// 认证页面
$("#submit").click(function (e) {
    if ($('#name').val() == "") {
        layer.msg('请输入真实姓名',{offset: ['100px', '30%']});
        return false;
    }
    if ($('#phone').val() == "") {
        layer.msg('请输入手机号',{offset: ['100px', '30%']});
        return false;
    }
    if ($('#check').val() == "") {
        layer.msg('请输入验证码',{offset: ['100px', '30%']});
        return false;
    }
    // $('#real-form').submit();
});
$("#sryzm").click(function (e) {
    console.log(1231);
    var phone = $("#phone").val();
    if (phone == "") {
        layer.msg('请输入手机号');
        return false;
    }
    if (!isPhone(phone)) {
        layer.msg('请输入正确的手机号');
        return false;
    }
    // $.ajax({
    //     type: 'POST',
    //     url: "{:U('User/realNameSms')}",
    //     data: {'phone': phone},
    //     dataType: 'JSON',
    //     success: function (res) {
    //         if (res.code == 1) {
    //             miao();
    //             layer.msg(res.data,{offset: ['100px', '30%']});
    //         } else {
    //             layer.msg(res.data,{offset: ['100px', '30%']});
    //         }
    //     }
    // })
})
function miao() {
    $(".sryzm").css("background", "#999")
    $(".sryzm").css("pointer-events", "none")
    var a = $(".sryzm")
    var i = 60
    var time = setInterval(function () {
        if (i == 0) {
            a[0].innerHTML = `获取验证码`
            $(".sryzm").css("background", "#E85B4D")
            $(".sryzm").css("pointer-events", "auto")
            clearInterval(time)
        } else {
            a[0].innerHTML = `重新获取${i}`
            --i;
        }
    }, 1000);
}

// 验证手机号
function isPhone(phone) {
    var pattern = /^1[3456789]\d{9}$/;
    return pattern.test(phone);
}