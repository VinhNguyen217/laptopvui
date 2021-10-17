$(document).ready(function () {
    $(".Login-click").click(function (e) { 
        $('.Login').removeClass('after-onclick-exit-login')
        
    });
    $(" .exit-login").click(function (e) { 
        $('.Login').addClass('after-onclick-exit-login')
        
    });
    $(".Register-click").click(function (e) { 
        $('.Resgiter').removeClass('after-onclick-exit-login')
        
    });
    $(" .exit-login").click(function (e) { 
        $('.Resgiter').addClass('after-onclick-exit-login')
        
    });
    $(".Info-click").click(function (e) { 
        $('.Infor').removeClass('after-onclick-exit-login')
        
    });
    $(" .exit-login").click(function (e) { 
        $('.Infor').addClass('after-onclick-exit-login')
        
    });
    $(".cart").click(function (e) { 
        $('.Cart').removeClass('after-onclick-exit-login')
        
    });
    $(" .exit-login").click(function (e) { 
        $('.Cart').addClass('after-onclick-exit-login')
        
    });
});