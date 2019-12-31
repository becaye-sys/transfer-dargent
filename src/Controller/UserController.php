<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


      /**
     * @Route("/user", name="index")
     */
class UserController extends AbstractController
{
      /**
     * @Route("/", name="user_index", methods={"GET"})
     */
 
    public function index(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $user = $userRepository->findAll();
        $data = $serializer->serialize($user, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }



 
    /**
     * @Route("/", name="user_new", methods={"POST"})
     */
    public function postUserAction(Request $request, ValidatorInterface $validator): Response
    {
        $user = new User();
        $body = $request->getContent();
        $data = json_decode($body, true);
        $form = $this->createForm(UserType::class, $user);
        $form->submit($data);
       // $validator = $this->get('validator');
        $errors = $validator->validate($user);

        if (count($errors) > 0) {
       
            $errorsString = (string) $errors;
    
            return new JsonResponse($errorsString);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('restaurant_index');

}

 

    

}