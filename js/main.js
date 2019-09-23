
/**
 * Link handlers
 * - Creat new account
 * - reset password
 */

// Creat new acc
$("#link_register").on("click", function (e) {
    e.preventDefault();
    alert("click");
    $("body").load("html/register_form.html");
});

// reset password
$("#link_resetpwd").on("click", function (e) {
    e.preventDefault();
    $("body").load("html/resetpwd_form.html");
});


function encode_utf8(s) {
    return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
    return decodeURIComponent(escape(s));
}


/**
 * Register New Account
 */
/**
 * Check Nick alredy exists
 */
let nickNameIsAvailable = false;
$("body").on("submit", "#register_nick", function () {
    let nick = $(this).val();
    $.post("php/register.php",
        {
            nick: nick
        },
        function (data) {
            if (data == true) {
                $("#register_nick").css("border", "3px solid lightgreen");
                $(".register_msg").text(decode_utf8(""));
                nickNameIsAvailable = true;
            }
            else {
                $(".register_msg").text(decode_utf8("Nick alredy exists"));
                $("#register_nick").css("border", "3px solid #ff2f11");
                nickNameIsAvailable = false;
            }
        });

});

/**
 * set new user after check all inputs
 */
$("body").on("submit", "#usr_register", function (e) {
    e.preventDefault();
    if (nickNameIsAvailable == false) {
        return;
    }
    if ($("#register_nick").val() == null || $("#register_nick").val() == "") {
        $(".register_msg").text(decode_utf8("Nick can't be empty!"));
        return;
    }
    if ($("#register_pwd").val() != $("#register_pwdproof").val()) {
        $(".register_msg").text(decode_utf8("Password don't match!"));
        return;
    }
    else if ($("#register_pwd").val() == null ||
        $("#register_pwd").val() == "" ||
        $("#register_pwdproof").val() == null ||
        $("#register_pwdproof").val() == ""
    ) {
        $(".register_msg").text(decode_utf8("Password can't be empty!"));
        return;
    }


    $.post("php/register.php", {
        regNick: $("#register_nick").val(),
        regPwd: $("#register_pwd").val()
    }, function (data) {
        answer = JSON.parse(data);
        $(".register_msg").text("Your data has been saved. Welcome " + answer.nick + "!");
        $("#usr_register").hide();
    });

});

/**
 * Login
 */
$("body").on("submit", "#login_form", function (e) {
    e.preventDefault()
    $("#login_msg").text("");
    let nick = $("#login_nick").val();
    let pwd = $("#login_pwd").val();
    if (nick != "" && pwd != "") {
        $.post("php/login.php", {
            loginNick: nick,
            loginPwd: pwd
        }, function (data) {
            let res = JSON.parse(data);
            if (res.bool) {
                //$("body").load("php/logedin.php");
                $("#login_msg").text(res.msg);

            }
            else {
                $("#login_msg").text(res.msg);
            }
        });
    }
    else {
        $("#login_msg").text("Username or Password empty!");
    }
});

