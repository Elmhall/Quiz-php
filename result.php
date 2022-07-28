<?php
require_once("inclues/header.php");
session_start();

// Get correct answers
$querystring = 'SELECT id, correct_answere_id FROM `question` WHERE `quiz_name` = :QUIZ_NAME';
$stmt = connectToDatabase()->prepare($querystring);
$stmt->bindParam(':QUIZ_NAME', $_GET['quiz']);
$stmt->execute();
$result = $stmt->fetchAll();

if (isset($_SESSION['answers'])) {
//Calc score
    $sum = 0;
    foreach ($result as $question) {
        $question_id = $question['id'];
        $correct_answer = $question['correct_answere_id'];
        $user_answer = $_SESSION['answers'][$question_id];

        if ($correct_answer == $user_answer) $sum++;
    }

// Insert score
    $querystring = 'INSERT INTO RESULT (QUIZ, USER_NAME, USER_EMAIL, SCORE) VALUES(:QUIZ_NAME,:USER_NAME,:USER_EMAIL,:SCORE);';
    $stmt = connectToDatabase()->prepare($querystring);
    $stmt->bindParam(':QUIZ_NAME', $_GET['quiz']);
    $stmt->bindParam(':USER_NAME', $_SESSION['name']);
    $stmt->bindParam(':USER_EMAIL', $_SESSION['email']);
    $stmt->bindParam(':SCORE', $sum, PDO::PARAM_INT);
    $stmt->execute();
    unset($_SESSION['answers']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);

    $_SESSION['last_score'] = $sum;

}

?>
<body>
<div class="h-100 d-flex align-items-center justify-content-center container">
    <div class="col-md-4 col-sm-6 col-12 card">
        <div id="card-body">
            <h2 class="center">Result</h2>
            <h3>Your score: <?php echo $_SESSION['last_score'] . '/' . sizeof($result) ?></h3>
            <h3><?php echo ($_SESSION['last_score'] / sizeof($result)) * 100 ?>%</h3>
            <a class="btn btn-primary" href="/index.php">Home</a>
        </div>
    </div>
</body>
</html>
