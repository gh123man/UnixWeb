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
        <img class="homeImage" src="/static/images/homepage.png">
    </div>
    <p class="homeContent">UNIXWeb is a place for anyone to learn and reference everything UNIX. 
    <br/><br/>
    If you want to look up examples of commands as well as explanations, you can view them on the docs page. 
    <br/><br/>
    UNIXWeb provides a variety of tutorials and quizzes to expand and test your knowledge.
    <br/><br/>
    Head on over to the history page to get a glimpse of how UNIX was developed throughout time.
   <br/><br/>
    If you create an account with us, you will have the ability to track your progress and your results regarding quizzes.
    We will not use your information for anything other than logging in for the system.
    <br/><br/>

    <!--generate command of the day / top 10 with javascript queries-->
    <div id="command-of-day">
        <h3>Command of the day</h3>
        <?php

        $cmd = PageTracker::getCommandOfTheDay();
        echo '<h4><a href="' . $cmd->path() . '"><div class="localNavItemWrapper">' . $cmd->name() . '</div></a></h4>';

        ?>
    </div>

    <div id="top-ten-commands">
        <h3>Top 10 Commands</h3>
        <ol>
            <?php
            $topCommands = PageTracker::getTopCommands(10);

            foreach ($topCommands as $cmd) {
                echo '<li><a href="' . $cmd->path() . '"><div class="localNavItemWrapper">' . $cmd->name() . '</div></a></li>';
            }

            ?>
        </ol>
    </div>

</div>


<?php
}
?>
