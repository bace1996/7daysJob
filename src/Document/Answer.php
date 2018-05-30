<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/29/18
 * Time: 11:33 PM
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;

/**
 * @MongoDB\Document
 */
class Answer
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * 关联的问题
     * @MongoDB\ReferenceOne(targetDocument="Quest")
     */
    protected $quest;

    /**
     * 关联的求职申请
     * @MongoDB\ReferenceOne(targetDocument="Apply", inversedBy="answers")
     */
    protected $apply;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Answer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuest()
    {
        return $this->quest;
    }

    /**
     * @param mixed $quest
     * @return Answer
     */
    public function setQuest($quest)
    {
        $this->quest = $quest;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * @param mixed $apply
     * @return Answer
     */
    public function setApply($apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     * @return Answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * 回答
     * @MongoDB\Field(type="string")
     */
    protected $answer;
}