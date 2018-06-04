<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/30/18
 * Time: 10:50 PM
 */

namespace App\Controller;

use App\Document\Answer;
use App\Document\Apply;
use App\Document\Job;
use App\Document\Quest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Admin extends Controller
{
    /**
     * 简历列表
     * @Route("/admin", name="apply_manage")
     * @return Response
     */
    public function index(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('App\\Document\\Apply');
        $cursor = $qb->getQuery()->execute();
        $index = 1;
        $content = '';
        foreach ($cursor as $apply) {
            $content .= $this->renderView('job/apply_item_box.html.twig', array(
                'row_number' => $index,
                'name' => $apply->getName(),
                'job_name' => $apply->getJob()->getName(),
                'tel' => $apply->getTele(),
                'apply_id' => $apply->getId(),
            ));
            $index ++;
        }
        return $this->render('job/admin_page.html.twig', array(
            'apply_list' => $content,
        ));
    }

    /**
     * 求职申请页面
     * @Route("/admin/apply/{apply_id}", name="apply_view", methods={"GET"})
     * @return Response
     */
    public function viewApply(Request $request, $apply_id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $apply = $dm->find('App\\Document\\Apply', $apply_id);
        $content = '';
        $index_number = 1;
        foreach ($apply->getAnswers() as $answer) { // queries for all users and data is held internally
//            动态的渲染可应聘的岗位，应该是结合一个后台的编辑岗位页面使用的，我这手工编辑数据库还有外键的问题
            $content .= $this->renderView('job/quest_item_box.html.twig', array(
                'quest_id' => $answer->getQuest()->getId(),
                'index_number' => $index_number,
                'description' => str_replace('\n', '</br>', $answer->getQuest()->getDescription()),
                'answer' => $answer->getAnswer(),
            ));
            $index_number++;
        }
        return $this->render('job/apply_edit.html.twig', array(
            'apply_id' => $apply->getId(),
            'name' => $apply->getName(),
            'tel' => $apply->getTele(),
            'quests' => $content,
            'education' => $apply->getEducation(),
            'gender' => $apply->getGender(),
        ));
    }

    /**
     * 删除求职申请
     * @Route("/admin/apply/{apply_id}", name="apply_delete", methods={"DELETE"})
     * @return Response
     */
    public function deleteApply(Request $request, $apply_id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $apply = $dm->find('App\\Document\\Apply', $apply_id);
        $dm->remove($apply);
        $dm->flush();
        return new Response('ok');
    }

    /**
     * @Route("/admin/apply/{apply_id}", name="apply_edit", methods={"POST"})
     * @return Response
     */
    public function editApply(Request $request, $apply_id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $apply = $dm->find('App\\Document\\Apply', $apply_id);

        $qb = $dm->createQueryBuilder('App\\Document\\Apply');
        $q = $qb->updateOne()
            ->field('name')->set($request->request->get('name'))
            ->field('gender')->set($request->request->get('gender'))
            ->field('tel')->set($request->request->get('tel'))
            ->field('education')->set($request->request->get('education'))
            ->field('id')->equals($apply_id)
            ->getQuery();
        $p = $q->execute();
        return new Response('ok');
    }
}