
$(window).resize(function() {
    correctBox();
});

$(window).scroll(function() {
    correctBox();
});

function correctBox() {
    var wHeight = $(window).height();
    var dHeight = wHeight - 20;
    $("#loginBox").dialog("option", "height", dHeight);
    $("#loginBox").dialog("option", "position", 'center');
}

function accountWindow() {
$.extend($.ui.dialog.prototype.options.position, { collision: 'none' });
    $('<div id="loginBox"><form type="post" id="loginForm"> \
        <h3>If you are already registered:</h3> \
        <p> \
            <label for="email">Email or Username:</label> \
            <input onkeypress="handleKey(event,this)" type="email" name="username" id="username"> \
            <label for="password">Password:</label> \
            <input onkeypress="handleKey(event,this)" type="password" name="password" id="password"> \
            <div id="credsOut"></div> \
        </p> \
        <p> \
            <input type="submit" name="submit" id="submit" value="Submit"> \
        </p> \
    </form>\
    <form type="post" id="registerForm"> \
        <h3>Register as a new user:</h3> \
        <p> \
            <label for="textfield">First Name:</label> \
            <input type="text" name="fname" id="fname"> \
            <label for="textfield2">Last Name:</label> \
            <input type="text" name="lname" id="lname"> \
        </p> \
        <p> \
            <label for="email">Email:</label> \
            <input type="email" name="email" id="newEmail"> \
        </p> \
        <p> \
            <label for="password2">Password:</label> \
            <input type="password" name="password" id="newpassword"> \
        </p> \
        <p> \
            <label for="password3">Re-Enter Password:</label> \
            <input type="password" name="password1" id="renewpassword"> \
        </p> \
        <p> \
            <input type="submit" name="submit" id="submit" value="Submit"> \
            <div id="regOut"></div> \
        </p> \
    </form></div>').dialog({
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
