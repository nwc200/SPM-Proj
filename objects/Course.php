<?php
class Course implements JsonSerializable
{
    private $CourseID;
    private $CourseName;
    private $CourseDescription;
    //allow a course to have multiple classes and prereq
    private $Class1 = array();
    private $CoursePrereq = array();
 
    public function __construct($CourseID, $CourseName, $CourseDescription)
    {
        $this->CourseID = $CourseID;
        $this->CourseName = $CourseName;
        $this->CourseDescription = $CourseDescription;
    }

    public function addClass1($ClassID, $ClassSize, $TrainerUserName, $StartDate, $EndDate, $StartTime, $EndTime, $SelfEnrollmentStart, $SelfEnrollmentEnd)
    {
        $this->Class1[] = new Class1($ClassID, $ClassSize, $TrainerUserName, $StartDate, $EndDate, $StartTime, $EndTime, $SelfEnrollmentStart, $SelfEnrollmentEnd);
    }

    public function getClass1()
    {
        return $this->Class1;
    }

    public function addCoursePrereq($CoursePrereq)
    {
        $this->CoursePrereq[] = new CoursePrereq($CoursePrereq);
    }

    public function getCoursePrereq()
    {
        return $this->CoursePrereq;
    }

    public function getCourseID()
    {
        return $this->CourseID;
    }

    public function getCourseName()
    {
        return $this->CourseName;
    }

    public function getCourseDescription()
    {
        return $this->CourseDescription;
    }

    public function jsonSerialize()
    {
        return [
            $this->CourseID,
            $this->CourseName,
            $this->CourseDescription,
            $this->Class1,
            $this->CoursePrereq
        ];
    }
}

class CoursePrereq implements JsonSerializable
{
    private $CoursePrereq;

    public function __construct($CoursePrereq)
    {
        $this->CoursePrereq = $CoursePrereq;
    }

    public function jsonSerialize()
    {
        return [
            $this->CoursePrereq
        ];
    }
}

class Class1 implements JsonSerializable
{
    private $ClassID;
    private $ClassSize;
    private $TrainerUserName;
    private $StartDate;
    private $EndDate;
    private $StartTime;
    private $EndTime;
    private $SelfEnrollmentStart;
    private $SelfEnrollmentEnd;
    private $Section = array();

    public function __construct($ClassID, $ClassSize, $TrainerUserName, $StartDate, $EndDate, $StartTime, $EndTime, $SelfEnrollmentStart, $SelfEnrollmentEnd)
    {
        $this->ClassID = $ClassID;
        $this->ClassSize = $ClassSize;
        $this->TrainerUserName = $TrainerUserName;
        $this->StartDate = $StartDate;
        $this->EndDate = $EndDate;
        $this->StartTime = $StartTime;
        $this->EndTime = $EndTime;
        $this->SelfEnrollmentStart = $SelfEnrollmentStart;
        $this->SelfEnrollmentEnd = $SelfEnrollmentEnd;
    }

    public function addSection($SectionNum, $SectionName)
    {
        $this->Section[] = new Section($SectionNum, $SectionName);
    }

    public function getSection()
    {
        return $this->Section;
    }

    public function getClassID()
    {
        return $this->ClassID;
    }

    public function getClassSize()
    {
        return $this->ClassSize;
    }

    public function getTrainerUserName()
    {
        return $this->TrainerUserName;
    }
    
    public function getStartDate()
    {
        return $this->StartDate;
    }

    public function getEndDate()
    {
        return $this->EndDate;
    }

    public function getStartTime()
    {
        return $this->StartTime;
    }

    public function getEndTime()
    {
        return $this->EndTime;
    }

    public function getSelfEnrollmentStart()
    {
        return $this->SelfEnrollmentStart;
    }

    public function getSelfEnrollmentEnd()
    {
        return $this->SelfEnrollmentEnd;
    }

    public function jsonSerialize()
    {
        return [
            $this->ClassID,
            $this->ClassSize,
            $this->TrainerUserName,
            $this->StartDate,
            $this->EndDate,
            $this->StartTime,
            $this->EndTime,
            $this->SelfEnrollmentStart,
            $this->SelfEnrollmentEnd,
            $this->Section
            ];
    }
}

class Section implements JsonSerializable
{
    private $SectionNum;
    private $SectionName;
    private $SectionMaterial = array();
    private $Quiz = array();

    public function __construct($SectionNum, $SectionName)
    {
        $this->SectionNum = $SectionNum;
        $this->SectionName = $SectionName;
    }

    public function addSectionMaterial($newSectionMaterial)
    {
        $this->SectionMaterial[] = $newSectionMaterial;  //newSectionMaterial is a SectionMaterial class
    }

    public function getSectionMaterial()
    {
        return $this->SectionMaterial;
    }

    public function addQuiz($newQuiz)
    {
        $this->Quiz[] = $newQuiz; //newQuiz is a Quiz class
    }

    public function getQuiz()
    {
        return $this->Quiz;
    }

    public function getSectionNum()
    {
        return $this->SectionNum;
    }

    public function getSectionName()
    {
        return $this->SectionName;
    }

    public function jsonSerialize()
    {
        return [
            $this->SectionNum,
            $this->SectionName,
            $this->SectionMaterial,
            $this->Quiz
        ];
    }
}


class SectionMaterial implements JsonSerializable
{
    private $MaterialNum;
    private $MaterialType;
    private $Link;

    public function __construct($MaterialNum, $MaterialType, $Link)
    {
        $this->MaterialNum = $MaterialNum;
        $this->MaterialType = $MaterialType;
        $this->Link = $Link;
    }

    public function jsonSerialize()
    {
        return [
            $this->MaterialNum,
            $this->MaterialType,
            $this->Link,
        ];
    }
    public function getMaterialNum()
    {
        return $this->MaterialNum;
    }
    public function getMaterialType()
    {
        return $this->MaterialType;
    }
}

class Quiz implements JsonSerializable
{
    private $QuizID;
    private $SectionNum;
    private $QuizName;
    private $QuizNum;
    private $QuizDuration;
    private $Type;
    private $PassingMark;
    private $QuizQuestion = array();

    public function __construct($QuizID, $QuizName, $QuizNum, $QuizDuration, $Type, $PassingMark)
    {
        if ($Type != "Graded" && $Type!= "Ungraded") {
            throw new Exception("Invalid quiz type entered.");
        }
        $this->QuizID = $QuizID;
        $this->QuizName = $QuizName;
        $this->QuizNum = $QuizNum;
        $this->QuizDuration = $QuizDuration;
        $this->Type = $Type;
        $this->PassingMark = $PassingMark;
    }

    public function addQuizQuestion($QuestionNum, $Question, $QuestionType, $Marks)
    {
        $this->QuizQuestion[] = new QuizQuestion($QuestionNum, $Question, $QuestionType, $Marks);
        $checkarr = [];
        foreach ($this->QuizQuestion as $question) {
            if (in_array($question->getQuestionNum(), $checkarr)) {
                array_pop($this->QuizQuestion);
                throw new Exception("Duplicated Quiz Question Added.");
            } else {
                array_push($checkarr, $question->getQuestionNum());
            }
        }
    }

    public function getQuizName()
    {
        return $this->QuizName;
    }

    public function getQuizQuestion()
    {
        return $this->QuizQuestion;
    }

    public function getQuizDuration()
    {
        return $this->QuizDuration;
    }

    public function jsonSerialize()
    {
        return [
            $this->QuizID,
            $this->QuizName,
            $this->QuizNum,
            $this->QuizDuration,
            $this->Type,
            $this->PassingMark,
            $this->QuizQuestion
        ];
    }

    public function getTotalMarks()
    {
        if (count($this->QuizQuestion)==0) {
            throw new Exception("There are no quiz questions.");
        }
        $sumTotal=0;
        foreach ($this->QuizQuestion as $question) {
            $sumTotal = $sumTotal + $question->getQuestionMark();
        }
        if ($sumTotal<0) {
            throw new Exception("Score cannot be negative.");
        }
        return $sumTotal;
    }

    public function getNumberOfQuestions()
    {
        return count($this->QuizQuestion);
    }
}

class QuizQuestion implements JsonSerializable
{
    private $QuestionNum;
    private $Question;
    private $QuestionType;
    private $Marks;
    private $QuizAnswer = array();

    public function __construct($QuestionNum, $Question, $QuestionType, $Marks)
    {
        if ($QuestionType != "MCQ" && $QuestionType!= "TF") {
            throw new Exception("Invalid quiz type entered.");
        }
        $this->QuestionNum = $QuestionNum;
        $this->Question = $Question;
        $this->QuestionType = $QuestionType;
        $this->Marks = $Marks;
    }

    public function addQuizAnswer($AnswerNum, $Answer, $Correct)
    {
        $this->QuizAnswer[] = new QuizAnswer($AnswerNum, $Answer, $Correct);
        $checkarr = [];

        foreach ($this->QuizAnswer as $answer) {
            array_push($checkarr, $answer->getAnswerCorrect());
            if (count(array_keys($checkarr, 1))>1) {
                array_pop($this->QuizAnswer);
                throw new Exception("Correct Answer Already Added.");
            }
        }
        
    }

    public function getQuizAnswer()
    {
        return $this->QuizAnswer;
    }
    
    public function getQuestion()
    {
        return $this->Question;
    }

    public function getQuestionNum()
    {
        return $this->QuestionNum;
    }

    public function getQuestionType()
    {
        return $this->QuestionType;
    }

    public function getQuestionMark()
    {
        return $this->Marks;
    }

    public function addMarks($val)
    {
        if (gettype($val) != "integer") {
            throw new Exception("Input must be integer.");
        }
        $this->Marks = $this->Marks +$val;
    }

    public function minusMarks($val)
    {
        if (gettype($val) != "integer") {
            throw new Exception("Input must be integer.");
        }
        if (($this->Marks - $val) < 0) {
            throw new Exception("Marks cannot be less than 0.");
        }
        $this->Marks = $this->Marks - $val;
    }

    public function getNumberOfAnswers()
    {
        return count($this->QuizAnswer);
    }

    public function jsonSerialize()
    {
        return [
            $this->QuestionNum,
            $this->Question,
            $this->QuestionType,
            $this->Marks,
            $this->QuizAnswer
        ];
    }
}

class QuizAnswer implements JsonSerializable
{
    private $AnswerNum;
    private $Answer;
    private $Correct;

    public function __construct($AnswerNum, $Answer, $Correct)
    {
        $this->AnswerNum = $AnswerNum;
        $this->Answer = $Answer;
        $this->Correct = $Correct;
    }

    public function getAnswerNum()
    {
        return $this->AnswerNum;
    }

    public function getAnswer()
    {
        return $this->Answer;
    }

    public function getAnswerCorrect()
    {
        return $this->Correct;
    }

    public function jsonSerialize()
    {
        return [
            $this->AnswerNum,
            $this->Answer,
            $this->Correct,
        ];
    }
}
