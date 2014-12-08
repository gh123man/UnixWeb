<?php
	include_once './src/QuizTracker.php';

	// Load in questions, answer choices, and the actual answers

	$questions = array("What part of the operating system allocates memory to programs and handles system calls?",
			"What element of an operating system represents a collection of static data?",
			"What element of an operating system represents a executing program?",
			"What part of the operating system is the interface between the user and the core system?");
	$answerlist = array("shell", "file", "kernel", "process");
	$answers = array("kernel", "file", "process", "shell");

	// When submitted check the answers

	if(!empty($_POST)){
		$questionresults = array("","","","");
		$submittedanswers = array("","","","");

		$i = 0;

		$correctCount = 0;

		// For each answer, check if it's correct and save the result so we can populate the individual question results
		foreach($_POST as $val){
			if ($val != "Submit Quiz!") { //ignores the submit button so it keeps the error log clean
				$submittedanswers[$i] = $val;
				if($val == $answers[$i]){
					$questionresults[$i] = "CORRECT";
					$correctCount++;
				}
				else{
					$questionresults[$i] = "INCORRECT";
				}
				$i++;
			}
		}


		$submitted = true;
	}
	else {
		$submitted = false;
	}

	$fileName = basename(__FILE__, '.php');
?>

<form class="quiz" id="quiz" name="quiz" action="/quizzes/<?php echo $fileName ;?>" method="post">
	<?php
		// Print out the results of the quiz if it has been submitted
		if($submitted){
			if (isset($_SESSION['userid'])) {
				QuizTracker::track($_SESSION['userid'], 'Unix Intro', '/quizzes/Unix+Intro', $correctCount, sizeof($questions));
			}
			echo '<div style="font-weight:bold;font-size: 200%;color:green;">RESULTS: ' . $correctCount . ' out of ' . sizeof($questions) . ' correct!</div>';
		}
	?>
    <ol id="questions">
	<?php
		// Go through each of the questions and make a new list item for each one
		foreach($questions as $i=>$value){
			$questionbuilder = '<li><label for="question' . $i . '">' . $value . '</label><br>';


			// Populate the results of this question if we have submitted
			if ( isset($questionresults) && $questionresults[$i] != ""){ //isset here keeps the error log clean
				$questionbuilder .= '<div style="font-weight:bold;' . ($questionresults[$i] == "CORRECT" ? 'color:green;' : 'color:red;') . '">' . $questionresults[$i] . "</div>";
			}

			// Populate the choices for this, if we are on the submitted quiz - choices are greyed out, the correct one highlighted in green and the user's choice preserved.
			foreach($answerlist as $j=>$answer){
				$questionbuilder .= '<input type="radio" name="question' . $i . '" id="q' . $i . "a" . $j . '" value="' . $answer . '"' . ($submitted ? "disabled" : "") . ($submitted && $submittedanswers[$i] == $answer ? ' checked' : '') . '>' . '<label ' . 'for="q' . $i . 'a' . $j . '"' . ($submitted && $answers[$i] == $answer ? ' style="color:green;font-weight:bold;background-color:#EFE;">' : '>' ) . $answer . '</label><br />';
			}

			$questionbuilder .= '</li>';
			echo $questionbuilder;
		}
	?>

    </ol>

<input type="submit" id="submitbutton" name="btnSubmit" value="Submit Quiz!" <?php if($submitted) echo 'disabled';?>/>
<?php if($submitted){ echo '<button onclick="location.href=\'' . $_SERVER['REQUEST_URI'] . '\'">Reset Quiz</button>';}?>
</form>
