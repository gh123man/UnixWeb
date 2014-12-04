<?php

include_once './components/LocalNavBuilder.php';
include_once './src/QuizTracker.php';
include_once 'PageBuilder.php';

class Quiz extends PageBuilder {

    function getPageTypePath() {
        return './content/quizzes/%s.php';
    }

    function getPageHeader($page) {
        echo "$page Quiz!";
        if (isset($_SESSION['userid'])) {
            $quiz = QuizTracker::getQuiz($_SESSION['userid'], "/quizzes/" . urlencode($page));
            if ($quiz != null) {
                echo '<div class="lastScore"> My Last Score: ' . 100 * ($quiz->score() / $quiz->points()) . '%</div>';
            }
        }

    }

    function getDefaultPage() {
        include_once './content/quizzes/index.php';
    }

    function getLocalNav() {
        return new LocalNavBuilder('content/quizzes', 'quizzes');
    }

}
?>
