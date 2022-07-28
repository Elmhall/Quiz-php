<?php

require_once ("Answer.php");

class Question
{
    public $id;
    public $quiz_name;
    public $title;
    public $correct_answere;
    public $answers;
    public $answer;

    function __construct()
    {
        // Get all answers.
        $querystring = 'SELECT id, title FROM `question_answere` WHERE `question_id` = :QUESTION_ID';
        $stmt = connectToDatabase()->prepare($querystring);
        $stmt->bindParam(':QUESTION_ID', $this->id);
        $stmt->execute();

        $this->answers = $stmt->fetchAll(PDO::FETCH_CLASS, "Answer");

        // If this question has been answered.
        if (isset($_SESSION['answers']) && isset($_SESSION['answers'][$this->id])){
            $this->answer = $_SESSION['answers'][$this->id];
        }
    }

}