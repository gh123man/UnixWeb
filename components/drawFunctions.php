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
    <div id="loginBox">
		<div id="loginWrapper" style="float: left;">
			<form type="post" id="loginForm">
			<h3>If you are already registered:</h3>
			<table id="loginTable">
				<tr>
					<td><label for="email">Email:</label></td>
					<td><input onkeypress="handleKey(event,this)" type="email" name="username" id="username"></td>
				</tr>
				<tr>
					<td><label for="password">Password:</label></td>
					<td><input onkeypress="handleKey(event,this)" type="password" name="password" id="password"></td>
				</tr>
				<div id="credsOut"></div>
			</table>
			<p>
				<input type="submit" name="submit" id="submit" value="Log In">
			</p>
		</form></div>
		<div id="loginWrapper" style="float: right;">
		<form type="post" id="registerForm">
			<h3>Register as a new user:</h3>
			<table id="loginTable">
				<tr>
					<td><label for="textfield">First Name:</label></td>
					<td><input type="text" name="fname" id="fname"></td>
				</tr>
				<tr>
					<td><label for="textfield2">Last Name:</label></td>
					<td><input type="text" name="lname" id="lname"></td>
				</tr>
				<tr>
					<td><label for="email">Email:</label></td>
					<td><input type="email" name="email" id="newEmail"></td>
				</tr>
				<tr>
					<td><label for="password2">Password:</label></td>
					<td><input type="password" name="password" id="newpassword"></td>
				</tr>
				<tr>
					<td><label for="password3">Re-Enter Password:</label></td>
					<td><input type="password" name="password1" id="renewpassword"></td>
				</tr>
			</table>
			<p>
				<input type="submit" name="submit" id="submit" value="Register">
				<div id="regOut"></div>
			</p>
			</form>
		</div>
	</div>

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
