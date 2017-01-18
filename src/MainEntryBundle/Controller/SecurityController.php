<?php

namespace MainEntryBundle\Controller;

use SecureBundle\Entity\Account;
use SecureBundle\Exception\InvalidAccountException;
use SecureBundle\Form\Type\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use SecureBundle\Entity\User;

class SecurityController extends Controller
{
    public function registerAction(Request $request)
    {
        $user = new User();
        $formFactory = $this->container->get('form.factory');

        $form = $formFactory->create(RegisterType::class, $user);

        $form->handleRequest($request);

        if (
            $form->isSubmitted() and
            $form->isValid() and
            strtolower($request->getMethod()) === 'post')
        {
            try {
                $userRepo = $this->container->get('doctrine')->getRepository('SecureBundle:User');
                $userRepo->createUser($this->container->get('security.password_encoder'), $user);
            } catch (InvalidAccountException $e) {
                $form->addError(new FormError('Invalid account type. Please, choose a valid account and continue'));

                return $this->container->get('templating')->renderResponse('::Component/Backend/Security/Form/registerForm.html.twig', array(
                    'register_form' => $form->createView(),
                ));
            }

            return new RedirectResponse($this->container->get('router')->generate('rebl_homepage'));
        }

        return $this->container->get('templating')->renderResponse('::Component/Backend/Security/Form/registerForm.html.twig', array(
            'register_form' => $form->createView(),
        ));
    }
}