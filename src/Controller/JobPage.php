<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/27/18
 * Time: 5:35 PM
 */

namespace App\Controller;

use App\Document\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JobPage extends Controller
{
    /**
     * @Route("/job", name="job_index")
     */
    public function index()
    {
        $job = new Job();
        $job->setName('技术培训生');
        $job->setQuests('Quest 1');
        $dm = $this->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('App\\Document\\Job');
        $cursor = $qb->getQuery()->execute();
//        $res->find();
        foreach ($cursor as $user) { // queries for all users and data is held internally

        }$dm->persist($job);
        $dm->flush();
//        return new Response('Created product id '.$product->getId());
        return $this->render('job/job_index.html.twig', array());
    }
}