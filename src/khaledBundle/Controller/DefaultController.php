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
        $p = $em->getRepository(Product::class)->findBy(["state"=>1]);


        $mounths[0] = $this->getDoctrine()
        ->getRepository(Orders::class)
        ->getDays(new \DateTime('01-01-2020'), new \DateTime('31-01-2020'));
        $mounths[1] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-02-2020'), new \DateTime('29-02-2020'));
        $mounths[2] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-03-2020'), new \DateTime('31-03-2020'));
        $mounths[3] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-04-2020'), new \DateTime('30-04-2020'));
        $mounths[4] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-05-2020'), new \DateTime('31-05-2020'));
        $mounths[5] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-06-2020'), new \DateTime('29-06-2020'));
        $mounths[6] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-07-2020'), new \DateTime('31-07-2020'));
        $mounths[7] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-08-2020'), new \DateTime('29-08-2020'));
        $mounths[8] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-09-2020'), new \DateTime('31-09-2020'));
        $mounths[9] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-10-2020'), new \DateTime('29-10-2020'));
        $mounths[10] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-11-2020'), new \DateTime('30-11-2020'));
        $mounths[11] = $this->getDoctrine()
            ->getRepository(Orders::class)
            ->getDays(new \DateTime('01-12-2020'), new \DateTime('31-12-2020'));

        if(  ! $hasAccess)
        { return $this->render('khaledBundle:Admin:404.html.twig');}
        else
            { return $this->render('khaledBundle:Admin:index.html.twig',["all"=>$all,"p"=>$p,"mounths"=>$mounths]); }


    }
    /**
     * @Route("/404", name="404")
     */
    public function error()
    {

         return $this->render('khaledBundle:Admin:404.html.twig');


    }
}
