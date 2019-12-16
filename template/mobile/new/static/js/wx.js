
        var ua = navigator.userAgent.toLowerCase();
        var isWeixin = ua.indexOf('micromessenger') != -1;
        if (!isWeixin) {
            window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=888"
        }
