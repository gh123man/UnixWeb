
$(window).resize(function() {
    correctBox();
});

$(window).scroll(function() {
    correctBox();
});

function correctBox() {
    if ($("#loginBox").hasClass('ui-dialog-content')) {
        var wHeight = $(window).height();
        var dHeight = wHeight - 20;
        $("#loginBox").dialog("option", "height", dHeight);
        $("#loginBox").dialog("option", "position", 'center');
    }
}

function accountWindow() {
$.extend($.ui.dialog.prototype.options.position, { collision: 'none' });
    $('#loginBox').dialog({
        title       : 'Register or Login',
        bgiframe    : true,
        draggable   : false,
        resizable   : false,
        width       : 900,
        height      : $(window).height() - 20,
        stack       : true,
        zIndex      : 99999,
        autoOpen    : true,
        modal       : true,
        position    : 'center',

        close: function(ev, ui) {

        },

    });
    $("#username").focus();

    $('#loginForm').on( "submit", function( event ) {
        event.preventDefault();
        console.log( $( this ).serialize() );

        var send = $(this).serialize();

        $.ajax({
            url: "/ajax/login.php?login=true",
            type: "post",
            async: false,
            data: send,
            dataType: 'json',
            success: function(result){
                if (result.result) {
                    document.location.reload(true);
                } else {
                    $("#credsOut").html(result.msg);
                    $("#username").select();
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(
                    "The following error occured: "+
                    textStatus, errorThrown
                );
            }
        });

    });

    $('#registerForm').on( "submit", function( event ) {
        event.preventDefault();
        console.log($(this).serialize());

        var send = $(this).serialize();

        $.ajax({
            url: "/ajax/login.php?register=true",
            type: "post",
            async: false,
            data: send,
            dataType: 'json',
            success: function(result){
                if (result.result) {
                    document.location.reload(true);
                } else {
                    document.getElementById("regOut").innerHTML=result.msg;
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(
                    "The following error occured: "+
                    textStatus, errorThrown
                );
            }
        });

    });


    return false;
}




function handleKey(e,data){
    if (document.getElementById("username").value.length > 0 && document.getElementById("password").value.length > 0) {
        var key=e.keyCode || e.which;
            if (key==13){
            checkCreds();
        }
    } else  if (data.id == "username") {
        var key=e.keyCode || e.which;
            if (key==13){
            $("#password").focus();
        }
    } else  if (data.id == "password") {
        var key=e.keyCode || e.which;
            if (key==13){
            checkCreds();
        }
    }
}


function logout() {

    window.location = "/logout.php";

}
