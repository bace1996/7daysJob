<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/29/18
 * Time: 11:31 PM
 */


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;


/**
 * @MongoDB\Document
 */
class Quest
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * 文字描述
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 关联的岗位
     * @MongoDB\ReferenceOne(targetDocument="Job", inversedBy="quests")
     */
    protected $job;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Quest
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param mixed $job
     * @return Quest
     */
    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }


}