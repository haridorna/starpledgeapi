<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 6/24/2015
 * Time: 3:10 PM
 */
namespace Customer\V1\Model\GetSurveyAnss;

class Survey{
    private $serviceLocator;

    /**
     * Function: __construct
     * @author   Rajesh
     *
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    function getSurveyResultForCustomer($customer_id){
        $surveyQuestions = $this->getSurveryQuestions($customer_id);
        $questions = array();
        $i= 1;
        foreach($surveyQuestions as $question) {
            $questions['survey_questions'][$i]['question_id'] = $question['id'];
            $questions['survey_questions'][$i]['question'] = $question['name'];
            $questions['survey_questions'][$i]['order'] = $question['order'];
            $questions['survey_questions'][$i]['selected_options'] = $this->selectedAnswersNoptions($question['id'], $customer_id);
            $i++;
        }
        return $questions;
    }

    function getSurveryQuestions(){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql = "select * from survey_questions";
        $statement = $adapter->query($sql);
        $result = $statement->execute();
        $questions = array();
        foreach($result as $question) {
            $questions[] = $question;
        }
        return $questions;
    }

    function selectedAnswersNoptions($question_id, $customer_id){
        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $sql = "SELECT sa.`survey_option_id`,so.option
                FROM survey_answers AS sa JOIN survey_options AS so ON sa.survey_option_id=so.id WHERE sa.customer_id= ? and so.survey_question_id= ?";
        $statement = $adapter->createStatement($sql, array($customer_id, $question_id));
        $result    = $statement->execute();
        $ans = array();
        foreach($result as $selectedAns){
            $ans[] = $selectedAns;
        }
        return $ans;
    }
}