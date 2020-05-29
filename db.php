<?php
class DB {
    public $conn;
    
    function __construct() {
        $conn = new mysqli('localhost', 'root', '', 'cricketQuiz');
        $this->conn = $conn;
    }

    public function getQuestionData() {
        $questionData = [];
        $stmt = "SELECT id, questionText, optionA, optionB, optionC, optionD FROM questions LIMIT 10";
        $query = mysqli_query($this->conn, $stmt);
        if(!$query){
            echo mysqli_error($this->conn) . "<br /><br />" . $stmt;
        } else {
            while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $questionData['id'][] = $row['id'];
                $questionData['questionText'][] = $row['questionText'];
                $questionData['optionA'][] = $row['optionA'];
                $questionData['optionB'][] = $row['optionB'];
                $questionData['optionC'][] = $row['optionC'];
                $questionData['optionD'][] = $row['optionD'];
            }
            return $questionData;
        }
    }

    public function getAnswers() {
        $questionData = [];
        $stmt = "SELECT id, correctAnswer FROM questions LIMIT 10";
        $query = mysqli_query($this->conn, $stmt);
        if(!$query){
            echo mysqli_error($this->conn) . "<br /><br />" . $stmt;
        } else {
            while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $questionData['id'][] = $row['id'];
                $questionData['correctAnswer'][] = $row['correctAnswer'];
            }
            return $questionData;
        }
    }

}

?>