<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController 
{
    /**
     * @Route("/home",name="home")
     */
    public function home()
    {
        return $this->render('admin/index.html.twig');
    }
}