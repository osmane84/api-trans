<?php

namespace App\Controller;

use App\Entity\Moving;
use App\Representation\Movings;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Exception\ResourceValidationException;

class MovingController extends FOSRestController
{

    /**
     * @Rest\Get( path="/movings/{id}", name="moving_item", requirements={ "id"="\d+"})
     * @Rest\View( statusCode=200 )
     */

    public function moving_item( Moving  $moving)
    {
        return $moving;
    }

    /**
     * @Rest\Get("/movings", name="moving_collection")
     * @Rest\QueryParam(
     *     name="keyword",
     *     requirements="[a-zA-Z0-9]",
     *     nullable=true,
     *     description="The keyword to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="ASC|DESC",
     *     default="DESC",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="15",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination offset"
     * )
     * @Rest\View()
    */

    public function moving_collection(ParamFetcherInterface $paramFetcher) 
    { 
        $pager = $this->getDoctrine()->getRepository(Moving::class)->search(
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
            
        );

        return new Movings($pager);

    }


    /**
     * @Rest\Post(path="/movings", name="moving_add")
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("moving", converter="fos_rest.request_body")
     */

     public function moving_add(Moving $moving, ConstraintViolationList $violations )
     {        
        
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($moving);
        $em->flush();

        return $this->view($moving, Response::HTTP_CREATED, ['localtion' => 
        $this->generateUrl('moving_item', ['id' => $moving->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
     }

    /**
     * @Rest\Delete(path="/movings/{id}", name="moving_delelte", requirements = {"id"="\d+"})
     * @Rest\View(StatusCode = 404)
     */

    public function moving_del(Moving  $moving)
    {        
        $this->getDoctrine()->getManager()->remove($moving);
       
        return ;
      
    }

    /**
     * @Rest\Put(path="/movings/{id}", name="moving_update", requirements = {"id"="\d+"})
     * @Rest\View(StatusCode = 200)
     * @ParamConverter("newMoving", converter="fos_rest.request_body")
     */

    public function moving_up( Moving $moving, Moving $newMoving  )
    {        
        
        $moving->setStartAdress($newMoving->getStartAdress());
        $moving->setStartTown($newMoving->getStartTown());
        $moving->setStartZipCode($newMoving->getStartZipCode());
        $moving->setCameAdress($newMoving->getCameAdress());
        $moving->setCameTown($newMoving->getCameTown());
        $moving->setCameZipCode($newMoving->getCameZipCode());
        $moving->setLevel($newMoving->getLevel());
        $moving->setElevator($newMoving->getElevator());
        $moving->setVolume($newMoving->getVolume());
        $moving->setDescription($newMoving->getDescription());
        $moving->setName($newMoving->getName());
        $moving->setEmail($newMoving->getEmail());
        $moving->setPhone($newMoving->getPhone());
        
        $this->getDoctrine()->getManager()->flush();
       
        return $moving;
      
    }
     
}
