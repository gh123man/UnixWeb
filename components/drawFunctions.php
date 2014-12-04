<?php
function drawLogo() {
?>
    <a href="/">
        <div class="logo">
            <img src="/static/images/logo.png" />
        </div>
    </a>
<?php
}

function drawRightNavContent() {
    drawSearch();
}

function drawLogin() {
?>
    <div class="localNavWrapper pannel">
        <div class="localNavContainer">
            <?php

            if (!checkLogin()) {
                echo '<div onclick="accountWindow()" class=" clickable localNavItemWrapper">';
                echo '<div class="localNavItem">';
                echo 'Login or Register';
                echo '</div>';
                echo '</div>';
            } else {
                $acc = new Account($_SESSION['userid']);
                echo '<div onclick="logout()" class=" clickable localNavItemWrapper">';
                echo '<div class="localNavItem">';
                echo 'Logout ' . $acc->fname();
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div id="loginBox"><form type="post" id="loginForm">
        <h3>If you are already registered:</h3>
        <p>
            <label for="email">Email or Username:</label>
            <input onkeypress="handleKey(event,this)" type="email" name="username" id="username">
            <label for="password">Password:</label>
            <input onkeypress="handleKey(event,this)" type="password" name="password" id="password">
            <div id="credsOut"></div>
        </p>
        <p>
            <input type="submit" name="submit" id="submit" value="Submit">
        </p>
    </form>
    <form type="post" id="registerForm">
        <h3>Register as a new user:</h3>
        <p>
            <label for="textfield">First Name:</label>
            <input type="text" name="fname" id="fname">
            <label for="textfield2">Last Name:</label>
            <input type="text" name="lname" id="lname">
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" id="newEmail">
        </p>
        <p>
            <label for="password2">Password:</label>
            <input type="password" name="password" id="newpassword">
        </p>
        <p>
            <label for="password3">Re-Enter Password:</label>
            <input type="password" name="password1" id="renewpassword">
        </p>
        <p>
            <input type="submit" name="submit" id="submit" value="Submit">
            <div id="regOut"></div>
        </p>
    </form></div>

<?php
}

function drawSearch() {
?>
    <div id="Search" class="">
        <input id="searchField" type="text" name="q" placeholder="search"/>
        <div id="searchResults" class="searchResults"></div>
    </div>
<?php
}
?>
