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
     * 回答
     * @MongoDB\Field(type="string")
     */
    protected $answer;
}