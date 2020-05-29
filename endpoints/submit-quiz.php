<?php
require_once('../db.php');

$db = new DB();
$i = 0;
$questions = $db->getAnswers();
$missedQuestions = [];
$correctQuestions = [];
$questionData = [];

foreach($questions['id'] as $question) {
    $questionNumber = $questions['id'][$i];
    $correctQuestions[$questionNumber] = $questions['correctAnswer'][$i];
    if($_POST["question-$questionNumber"][0] !== $questions['correctAnswer'][$i]) {
        $missedQuestions[$questionNumber] = $_POST["question-$questionNumber"][0] === null ? 'N': $_POST["question-$questionNumber"][0];
        $missedQuestionCount[] = true;
    }
    $i++;
}

$questionData['missedQuestions'] = $missedQuestions;
$questionData['correctQuestions'] = $correctQuestions;
$questionData['quizScore'] = 100 - (count($missedQuestions) * 10);

echo json_encode($questionData);
?>