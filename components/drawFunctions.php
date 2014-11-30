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
                echo 'Login';
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
