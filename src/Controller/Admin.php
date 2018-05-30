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
     * @Route("/admin", name="job_manage")
     * @return Response
     */
    public function index(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('App\\Document\\Apply');
        $cursor = $qb->getQuery()->execute();
        foreach ($cursor as $apply) {
            $apply;
        }
        return new Response('ok');
    }
}