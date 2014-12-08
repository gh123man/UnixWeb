<h2>
Quizzes
</h2>
<p>Use the navigation bar on the left side to select a quiz and test your knowledge of Unix!</p>
<p>We recommend these either as a quick refresher/affirmation if you're coming back to Unix or to be used concurrently with our tutorials to reinforce what you're learning!</p>
<p>They are organized by tutorial, but we have a quiz that takes a random selection of questions from all available! So try that one out if you want a real challenge of your Unix knowledge.</p>

<?php
    include_once './src/QuizTracker.php';

    if (isset($_SESSION['userid'])) {
        $results = QuizTracker::getAllForUser($_SESSION['userid']);

        ?>
        <div><strong>My Quiz Results</strong></div>
        <?php
        echo '<table>';
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td><a href="' . $result->path() . '">' . $result->name() . '</a></td>';
            echo '<td>' . 100 * ($result->score() / $result->points()) . '%</td>';
            echo '</tr>';
        }
        echo '</table>';
    }


?>
