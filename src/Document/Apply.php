<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/29/18
 * Time: 11:50 PM
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;

/**
 * 求职申请
 * @MongoDB\Document
 */
class Apply
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * 姓名
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * 性别
     * @MongoDB\Field(type="string")
     */
    protected $gender;

    /**
     * 出生日期
     * @MongoDB\Field(type="string")
     */
    protected $birth;

    /**
     * 电话
     * @MongoDB\Field(type="string")
     */
    protected $tele;

    /**
     * 学历
     * @MongoDB\Field(type="string")
     */
    protected $education;

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param mixed $education
     * @return Apply
     */
    public function setEducation($education)
    {
        $this->education = $education;
        return $this;
    }

    /**
     * 申请的岗位
     * @MongoDB\ReferenceOne(targetDocument="Job")
     */
    protected $job;

    /**
     * 关联的回答
     * @MongoDB\ReferenceMany(targetDocument="Answer", mappedBy="apply", cascade="DELETE")
     */
    protected $answers = Array();

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Apply
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Apply
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return Apply
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $birth
     * @return Apply
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTele()
    {
        return $this->tele;
    }

    /**
     * @param mixed $tele
     * @return Apply
     */
    public function setTele($tele)
    {
        $this->tele = $tele;
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
     * @return Apply
     */
    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     * @return Apply
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
        return $this;
    }

}