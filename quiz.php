<?php
require_once("inclues/header.php");
require_once("models/Question.php");

session_start();

// Check if get quiz isset otherwise return the user to the home page.
if (!isset($_GET['quiz'])) {
    header('location: /');
}

// POST REQUEST HANDLER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // If the session variable is not set, create an empty array.
    if (!isset($_SESSION['answers'])) $_SESSION['answers'] = array();

    if (isset($_POST['questions'])) {
        // For every answer sent in post-request check if that question has that answer.
        foreach ($_POST['questions'] as $question_id => $answer_id) {
            $querystring = 'SELECT COUNT(*) FROM `question_answere` WHERE `question_id` = :QUESTION_ID AND `id` = :ANSWER_ID';
            $stmt = connectToDatabase()->prepare($querystring);
            $stmt->bindParam(':QUESTION_ID', $question_id);
            $stmt->bindParam(':ANSWER_ID', $answer_id);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count == 1) {
                // Save the answer to session storage.
                $_SESSION['answers'][$question_id] = $answer_id;
            }
        }
    }
}

// Get total pages.
$querystring = 'SELECT COUNT(*) FROM `question` WHERE `quiz_name` = :QUIZ_NAME';
$stmt = connectToDatabase()->prepare($querystring);
$stmt->bindParam(':QUIZ_NAME', $_GET['quiz']);
$stmt->execute();
$number_of_quiz_question = $stmt->fetchColumn();
$total_pages = ceil($number_of_quiz_question / QUESTIONS_PER_PAGE);

if (isset($_POST['last_page'])) {
    if (isset($_POST['action'])) {

        $current_page = $_POST['last_page'];

        if ($_POST['action'] == "Next") {
            if ($current_page == $total_pages && sizeof($_SESSION['answers']) == $number_of_quiz_question) $current_page = $total_pages + 1;
            else if (sizeof($_SESSION['answers']) >= $current_page * QUESTIONS_PER_PAGE) $current_page++;
        } else if ($_POST['action'] == "Previous" && $current_page != 0)
            $current_page--;
    }
} else $current_page = 1;


?>
<body>
<div class="h-100 d-flex align-items-center justify-content-center container">
    <div class="col-md-4 col-sm-6 col-12 card">
        <div id="card-body">
            <?php

            if ($current_page <= $total_pages) {
                echo $current_page . " / " . $total_pages;

                //Get the questions for the $current_page.
                $number_of_questions = QUESTIONS_PER_PAGE;
                $start_index = ($current_page - 1) * $number_of_questions;
                $querystring = 'SELECT id, title FROM `question` WHERE `quiz_name` = :QUIZ_NAME LIMIT :START_INDEX, :LIMIT_AMOUNT';
                $stmt = connectToDatabase()->prepare($querystring);
                $stmt->bindParam(':QUIZ_NAME', $_GET['quiz']);
                $stmt->bindParam(':START_INDEX', $start_index, PDO::PARAM_INT);
                $stmt->bindParam(':LIMIT_AMOUNT', $number_of_questions, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Question");

                echo '<form action="quiz.php?quiz=' . $_GET['quiz'] . '" method="post">';
                echo '<input type="number" name="last_page" value="' . $current_page . '" hidden>';

                if (isset($error)) echo '<p class="error">' . $error . '</p>';
                foreach ($result as $question) {
                    echo '<fieldset>';
                    echo '<p>' . $question->title . '</p>';

                    foreach ($question->answers as $answer) {
                        echo '<div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text">';
                        echo '<input type="radio" ';
                        if ($question->answer == $answer->id) echo 'checked';
                        echo ' name="questions[' . $question->id . ']" value="' . $answer->id . '">';
                        echo '</div></div>';
                        echo '<p type="text" class="form-control">' . $answer->title . '</p></div>';
                    }
                    echo '</fieldset>';
                }

                echo '</div>';
                echo '<div id="quiz-buttons">';

                if ($current_page == 1) echo '<input type="submit" name="action" class="btn btn-secondary" disabled value="Previous">';
                else echo '<input type="submit" name="action" class="btn btn-secondary" value="Previous">';

                echo '<input type="submit" name="action" class="btn btn-primary" value="Next">';

                echo '</form>';
            } else {

                require_once('inclues/submit.php');
            }

            ?>

        </div>
    </div>
</div>
</body>
</html>