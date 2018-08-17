<?php
namespace App\Controller;

use App\Forms\AccountType;
use App\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class RegistrationController extends AbstractController
{
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, Security $security)
    {
        $user = new Account();
        $form = $this->createForm(AccountType::class, $user, ['user' => $security->getUser()]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render(
            'Login/register.html.twig',
            ['form' => $form->createView()]
        );
    }
}
