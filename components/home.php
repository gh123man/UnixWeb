<?php
function displayHome() {
?>

<script>
    //this can be removed and placed in a different file and needs to be rewritten
    //since i don't have access to the database, I am writing it with an array of basic commands
    var command = ["pwd", "cd", "mkdir", "rm", "ls"];
    var description =  ["prints the working directory that you are in. <br/> just type 'pwd'",
                          "changes the directory to a new directory<br/> just type 'cd (name of directory)' <br/> Example: cd 330/Links",
                          "makes a new directory <br/> just type 'mkdir (directory name)' <br/> Example: mkdir Links",
                          "removes/deletes a directory or file <br/> just type 'rm (directory / file name)' <br/> Example: rm Links",
                          "lists the contents of the current directory. add -a for all or -l for a long detailed listing <br/> just type 'ls' or 'ls -a' or 'ls -l'"];
    var topTen = ["pwd", "cd", "mkdir", "rm", "ls", "gzip", "history", "df", "tar", "echo"];

    function generateCommand(){
        var number = Math.floor(Math.random() * 4);
        var insertHTML = "<h3>Command of the Day:</h3><h4>" + command[number] + "</h4><p>" + description[number] + "</p>";
        document.getElementById("command-of-day").innerHTML = insertHTML;

        var insertHTML2 = "<h3>Top Ten Commands:</h3><ul>";
        //var i = 0;
        for(var i = 0; i < 10; i++){
            insertHTML2 += "<li><a href='#'>"
            insertHTML2 +=topTen[i];
            insertHTML2 += "</a></li>"
        }

        insertHTML2 += "</ul>";
        document.getElementById("top-ten-commands").innerHTML = insertHTML2;

    }
    $(function() {
        generateCommand();
    });

</script>

<?php
echo '<div class="sideBar">';
drawLogin();
echo '</div>';
?>
<div class="pageContent pannel pageContentHomePage">
    <div id="main">
        <h1>Welcome!</h1>
        <p>UnixWeb is a place for anyone to learn and reference everything Unix. If you want to look up examples of commands
            as well as explanations, you can view them under docs. UnixWeb provides a variety of tutorials and quizzes to expand
            and test your knowledge. Head on over to the History to get a glimspe how unix was developed throughout time.
        </p>
    </div>

    <!--generate command of the day / top 10 with javascript queries-->
    <div id="command-of-day"></div>

    <div id="top-ten-commands"></div>

</div>


<?php
}
?>
