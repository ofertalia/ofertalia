<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $userLogged = false;
        $userName   = '';
        $csrfToken  = '';

        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            // authenticated REMEMBERED, FULLY will imply REMEMBERED (NON anonymous)
            $userLogged = true;
            $userName   = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        } else {
            $csrfToken = $this->has('security.csrf.token_manager')
                ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
                : null;
        }

        return $this->render(
            'Front/Profile/index.html.twig',
            [
                'pageTitle'     => 'Ofertalia',
                'description'   => 'Ofertalia page description',
                'author'        => 'Ofertalia team',
                'isUserLogged'  => $userLogged,
                'userName'      => $userName,
                'csrfToken'     => $csrfToken
            ]
        );
    }

    public function loadAction(Request $request)
    {
        if (!$request->query->has('name'))
        {
            return new Response('Missing parameter: email');
        }

        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');

        /** @var User $user */
        $user = $userRepository->findOneBy(['name' => $request->query->get('name')]);

        if ($user === null)
        {
            return new Response("User {$request->query->get('name')} does not exists");
        }

        return new Response("El email de {$user->getName()} es: {$user->getEmail()}");
    }

    public function createAction(Request $request)
    {
        if (!$request->query->has('name')) {
            return new Response('Missing parameter: name');
        }

        if (!$request->query->has('email')) {
            return new Response('Missing parameter: email');
        }

        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');

        $user = new User();
        $user->setName($request->query->get('name'));
        $user->setEmail($request->query->get('email'));

        /** @var User $user */
        try {
            $user = $userRepository->persist($user);
        } catch (UniqueConstraintViolationException $ex) {
            return new Response("User {$user->getName()} exists already");
        }

        return new Response("User {$user->getName()} with email {$user->getEmail()} created!");
    }
}
