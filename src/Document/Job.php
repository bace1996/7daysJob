<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/28/18
 * Time: 1:46 PM
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;

/**
 * @MongoDB\Document
 */
class Job
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * 一句话描述
     * @MongoDB\Field(type="string")
     */
    protected $slogan;

    /**
     * 岗位概述
     * @MongoDB\Field(type="string")
     */
    protected $topic;

    /**
     * 岗位要求
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * 关联的问题
     * @MongoDB\ReferenceMany(targetDocument="Quest", mappedBy="job")
     */
    protected $quests = Array();

    /**
     * @return mixed
     */
    public function getQuests()
    {
        return $this->quests;
    }

    /**
     * @param mixed $quests
     * @return Job
     */
    public function setQuests($quests)
    {
        $this->quests = $quests;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Job
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * @param mixed $slogan
     * @return Job
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     * @return Job
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


}