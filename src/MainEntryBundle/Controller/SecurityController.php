<?php

namespace MainEntryBundle\Controller;

use SecureBundle\Entity\Account;
use SecureBundle\Form\Type\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->container->get('doctrine')->getManager();
            if ($user->isTrial()) {
                $accountRepo = $em->getRepository('SecureBundle:Account');

                $account = $accountRepo->findBy(array(
                    'type' => 'trial'
                ));

                if (!$account instanceof Account) {
                }

                $user->setAccount($account);
            }

            $em->persist($user);
            $em->flush();
        }

        return $this->container->get('templating')->renderResponse('::Component/Backend/Security/Form/registerForm.html.twig', array(
            'register_form' => $form->createView(),
        ));
    }
}