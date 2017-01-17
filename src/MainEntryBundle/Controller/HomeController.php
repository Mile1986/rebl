<?php

namespace MainEntryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Using classes from SecureBundle
 */
use SecureBundle\Form\Type\LoginType;
use SecureBundle\Entity\User;

class HomeController extends Controller
{
    public function homeAction()
    {
        $formFactory = $this->container->get('form.factory');

        $user = new User();

        $form = $formFactory->create(LoginType::class, $user);

        return $this->container->get('templating')->renderResponse('::Component/Frontend/Home/home.html.twig', array(
            'login_form' => $form->createView(),
        ));
    }
}
