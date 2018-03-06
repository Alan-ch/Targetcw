<?php
/*
Challenge 3: Use reflection to get access to Question::$answer from $e->getAnswer
*/
class Question
{
    private $answer = 42;
    public function __construct($e)
    {
        try {
            throw $e;
        } catch (Exception $e) {
            echo $e->getAnswer($this) . PHP_EOL;
        }
    }
}
// start editing here
class customException extends ReflectionException {
  public function getAnswer($question){
     $r = new ReflectionProperty('Question', 'answer');
     $r->setAccessible(true);
     return $r->getValue($question);
  }
}
  $e = new customException();
 new Question($e);
