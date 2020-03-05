<?php

namespace khaledBundle\Controller;

use AlaaBundle\Entity\Orders;
use khaledBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\Date;

class DefaultController extends Controller
{
    /**
     * @Route("/shop",name="shop")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $p = $repo->findAll();
        return $this->render('khaledBundle:Shop:index.html.twig',[
            'products' => $p
        ]);
    }

    /**
     * @Route("/shop/{id}")
     */
    public function find($id)
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $p = $repo->find($id);
        return $this->render('khaledBundle:Shop:show_product.html.twig',[
            'product' => $p
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function Admin()
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        $hasAccess = $this->isGranted('ROLE_ADMIN');
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository(Product::class)->findAll();
        $orders = $em->getRepository(Orders::class)->findBy(['deliverd'=>1]);
        $torders = $em->getRepository(Orders::class)->findBy(['orderDate'=>new \DateTime()]);
        $i = 0;
        foreach ($orders as $o )
        {
            $idp[$i]=$o->getIdProduct();
            $i++;
        }
        $p = $em->getRepository(Product::class)->findBy(['id'=>$idp]);




        $mounths[0] = $this->getDoctrine()
        ->getRepository(Orders::class)
        ->getDays(new \DateTime('01-01-'.date("Y")), new \DateTime('31-01-'.date("Y")));
        $mounths[1] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-02-'.date("Y")), new \DateTime('29-02-'.date("Y")));
        $mounths[2] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-03-'.date("Y")), new \DateTime('31-03-'.date("Y")));
        $mounths[3] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-04-'.date("Y")), new \DateTime('30-04-'.date("Y")));
        $mounths[4] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-05-'.date("Y")), new \DateTime('31-05-'.date("Y")));
        $mounths[5] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-06-'.date("Y")), new \DateTime('30-06-'.date("Y")));
        $mounths[6] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-07-'.date("Y")), new \DateTime('31-07-'.date("Y")));
        $mounths[7] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-08-'.date("Y")), new \DateTime('31-08-'.date("Y")));
        $mounths[8] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-09-'.date("Y")), new \DateTime('30-09-'.date("Y")));
        $mounths[9] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-10-'.date("Y")), new \DateTime('31-10-'.date("Y")));
        $mounths[10] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-11-'.date("Y")), new \DateTime('30-11-'.date("Y")));
        $mounths[11] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-12-'.date("Y")), new \DateTime('31-12-'.date("Y")));

        if(  ! $hasAccess)
        { return $this->render('khaledBundle:Admin:404.html.twig');}
        else
            { return $this->render('khaledBundle:Admin:index.html.twig',["all"=>$all,"p"=>$p,"mounths"=>$mounths,'torders'=>$torders]); }


    }
    /**
     * @Route("/404", name="404")
     */
    public function error()
    {

         return $this->render('khaledBundle:Admin:404.html.twig');


    }
}
