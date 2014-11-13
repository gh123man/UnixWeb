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

function drawSearch() {
?>
    <div id="Search" class="">
        <input id="searchField" type="text" name="q" placeholder="search"/>
        <div id="searchResults" class="searchResults"></div>
    </div>
<?php
}
?>
