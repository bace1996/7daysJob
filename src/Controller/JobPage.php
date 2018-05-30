<?php
/**
 * Created by PhpStorm.
 * User: cykrt
 * Date: 5/27/18
 * Time: 5:35 PM
 */

namespace App\Controller;

use App\Document\Job;
use App\Document\Quest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class JobPage extends Controller
{
//    不忍直视的初始化数据方法
    /**
     * @param Request $request
     * @Route("/init", name="init_db")
     * @return Response
     */
    public function init()
    {
        $job1 = new Job();
        $job1->setName('技术培训生');
        $job1->setDescription('-----------------------------------------------------------------------------------------------------------\n岗位职责：\n1、	帮助我们的中级/高级工程师及项目组长完成项目开发目标。\n2、	快速成长，成为公司其中一名不可或缺的核心开发人员。\n-----------------------------------------------------------------------------------------------------------\n岗位要求：\n1、靠谱，非常靠谱。对计算机/互联网编程狂热爱好，并认为自己天生就是干这行的。\n2、极端懒惰，厌恶一切重复劳动，想尽办法让机器帮你和其它同事干活。\n3、不惜一切代价甚至推倒重来，只为完美的代码。\n4、可能或者已经精通：PHP、JavaScript、Mongo、Linux、GIT、Python、MySQL、Redis、Elastic Search...同时非常愿意学习和接受其它技术栈。\n5、想和牛逼的团队一起创造牛逼的产品。\n-----------------------------------------------------------------------------------------------------------\n最后最后：\n你很好奇，想认识或知道来自华南理工80后师兄的草根创业经历？\n或者你想证明自己的毕业生里面最优秀的程序员/工程师潜力股，甚至没有之一？\n欢迎来我们招聘官网挑战在线笔试题，赢取面试机会，我们等你。');
        $job1->setSlogan('有潜力的技术小飞鸟');
        $job1->setTopic('学历：本科以上\n地点：广东 广州\n经验：不限，但我们希望你的项目经验或写码年资已经是同龄人里面的佼佼者\n------------------------------------------------------------------------------------------------------------\n关于团队：\n西洋汇(http://xiyanghui.com)，一个工程师文化特别浓厚的团队，我们5年来一直没有市场部，也一直没有投放推广，只因使用技术驱动商业。\n我们玩的是：NoSQL、ElasticSearch、PHP7、Phython、GoLang、Vue、React、主+从+仲裁云服务器、分布式爬虫系统、翻译系统、图片分析算法、人工智能研究、新一代搜索引擎系统...\n我们的技术和研发人员精挑细选，只留下最优秀的各位。我们拥有最优秀的团队：来自华南理工/中山大学/网易/腾讯的80后创始人、CEO、技术总监、设计总监、首席运营…\n我们注重沟通，善于激励团队，给工程师“赋能”。\n我们鼓励你既可以成为一个优秀的全栈工程师，也可以专注于成为卓越的前端/后端/安全/算法工程师，如果你的沟通和商业感觉很棒，还可以成为优秀的产品经理或管理人员。\n是的，我们正是要成为像Google那样的公司。\n人生需要有一款代表作。加入西洋汇，我们一起实现梦想。');
        $quest1 = new Quest();
        $quest1->setJob($job1);
        $quest1->setDescription('PHP例程如下：
<pre>class User
{
    public $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }
}

$users = [
    new User(\'user 1\'),
    new User(\'user 2\'),
    new User(\'user 3\'),
];

$usernames = array_column($users, \'username\');</pre>
上面代码只有在PHP7才能执行成功。在PHP5下，试使用array_map函数来代替array_column函数来实现上面的功能从而得到相同的$usernames返回值。');
        $dm = $this->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('App\\Document\\Quest');
        $job1->getQuests()[] = $quest1;
        $dm->persist($job1);
        $dm->persist($quest1);
        $dm->flush();
        return new Response('ok');


    }
    /**
     * @param Request $request
     * @Route("/job", name="job_index")
     * @return Response
     */
    public function index()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $qb = $dm->createQueryBuilder('App\\Document\\Job');
        $cursor = $qb->getQuery()->execute();
        $content = '';
        foreach ($cursor as $job) { // queries for all users and data is held internally
//            动态的渲染可应聘的岗位，应该是结合一个后台的编辑岗位页面使用的，我这手工编辑数据库还有外键的问题
            $content .= $this->renderView('job/job_item_box.html.twig', array(
                'name' => $job->getName(),
                'data_id' => $job->getId(),
                'slogan' => $job->getSlogan(),
            ));
        }
//        return new Response('Created product id '.$product->getId());
        return $this->render('job/job_index.html.twig', array(
            'jobs' => $content,
        ));
    }

    /**
     * @param Request $request
     * @Route("/job/saveResume", name="submit_apply")
     * @return Response
     */
    public function saveResume(Request $request)
    {
        // build the form ...
        $dm = $this->get('doctrine_mongodb')->getManager();
        return new Response('ok');
        // render the template
    }

    /**
     * @param Request $request
     * @Route("/job/description/{job_id}")
     * @return Response
     */
    public function getDescription(Request $request, $job_id)
    {
        // build the form ...
        $dm = $this->get('doctrine_mongodb')->getManager();
        $repository = $dm->getRepository('App\\Document\\Job');
        $job = $repository->find($job_id);
        return $this->render('job/job_description_area.html.twig', array(
            'topic' => str_replace('\n', '</br>', $job->getTopic()),
            'descript' => str_replace('\n', '</br>', $job->getDescription()),
        ));
        // render the template
    }

    /**
     * @param Request $request
     * @Route("/job/quest/{job_id}")
     * @return Response
     */
    public function getQuestForm(Request $request, $job_id)
    {
        // build the form ...
        $dm = $this->get('doctrine_mongodb')->getManager();
        $repository = $dm->getRepository('App\\Document\\Job');
        $repository2 = $dm->getRepository('App\\Document\\Quest');
        $job = $repository->find($job_id);
        $content = '';
        $index_number = 1;
        $job->getQuests()->initialize();
        foreach ($job->getQuests() as $quest) { // queries for all users and data is held internally
//            动态的渲染可应聘的岗位，应该是结合一个后台的编辑岗位页面使用的，我这手工编辑数据库还有外键的问题
            $content .= $this->renderView('job/quest_item_box.html.twig', array(
                'quest_id' => $quest->getId(),
                'index_number' => $index_number,
                'description' => str_replace('\n', '</br>', $quest->getDescription()),
            ));
            $index_number++;
        }
        return new Response($content);
        // render the template
    }
}