<?php
function displayHome() {
?>

<?php
echo '<div class="sideBar">';
drawLogin();
echo '</div>';
?>
<div class="pageContent pannel pageContentHomePage">
    <div id="main">
        <img src="/static/images/homepage.png">
        <p>UnixWeb is a place for anyone to learn and reference everything Unix. If you want to look up examples of commands
            as well as explanations, you can view them under docs. UnixWeb provides a variety of tutorials and quizzes to expand
            and test your knowledge. Head on over to the History to get a glimspe how unix was developed throughout time.
        </p>
    </div>

    <!--generate command of the day / top 10 with javascript queries-->
    <div id="command-of-day">
        <h3>Command of the day</h3>
        <?php

        $cmd = PageTracker::getCommandOfTheDay();
        echo '<h4><a href="' . $cmd->path() . '">' . $cmd->name() . '</a></h4>';

        ?>
    </div>

    <div id="top-ten-commands">
        <h3>Top 10 Commands</h3>
        <ol>
            <?php
            $topCommands = PageTracker::getTopCommands(10);

            foreach ($topCommands as $cmd) {
                echo '<li><a href="' . $cmd->path() . '">' . $cmd->name() . '</a></li>';
            }

            ?>
        </ol>
    </div>

</div>


<?php
}
?>
