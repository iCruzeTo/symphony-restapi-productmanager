<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Form\ProductType;

/**
 * Class ProductsController
 * @package AppBundle\Controller
 *
 * @RouteResource("products")
 */
class ProductsController extends FOSRestController implements ClassResourceInterface
{
  /**
   * Gets an individual Product
   *
   * @param int $id
   * @return mixed
   * @throws \Doctrine\ORM\NoResultException
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
    public function getAction($id)
    {
        $product = $this->getProductRepository()->createFindOneByIdQuery($id)->getSingleResult();
        if ($product === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }
        return $product;
    }

    /**
     * Gets a collection of BlogPosts
     *
     * @return array
     */
    public function cgetAction()
    {
        return $this->getProductRepository()->createFindAllQuery()->getResult();
    }

    public function deleteAction($id){
      /*
      * @var $product Product
      **/
      $product = $this->getProductRepository()->find($id);
      if($product === null){
        return new View(null, Response::HTTP_NOT_FOUND);
      }
      $em = $this->getDoctrine()->getManager();
      $em->remove($product);
      $em->flush();

      return new View(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     * @param int     $id
     * @return View|\Symfony\Component\Form\Form
     */
    public function putAction(Request $request, $id){
      /**
      * @var $product Product
      **/
      $product = $this->getProductRepository()->find($id);

      if($product === null){
        return new View(null, Response::HTTP_NOT_FOUND);
      }

      $form = $this->createForm(ProductType::class, $product, [
        'csrf_protection' => false
      ]);

      $form->submit($request->request->all());

      if(!$form->isValid()){
        return $form;
      }

      $em = $this->getDoctrine()->getManager();
      $em->flush();

      $routeOptions = [
        'id' => $product->getId(),
        '_format' => $request->get('_format')
      ];

      return $this->routeRedirectView('get_products', $routeOptions, Response::HTTP_NO_CONTENT);
    }

    /**
    * @param Request $request
    * @return View|\Symfony\Component\Form\Form
    */
    public function postAction(Request $request)
    {
        $form = $this->createForm(ProductType::class, null, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }
        /**
         * @var $product Product
         */
        $product = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        $routeOptions = [
            'id' => $product->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_products', $routeOptions, Response::HTTP_CREATED);
    }


  /**
  * @return ProductRepository
  */
  private function getProductRepository()
  {
    return $this->get('app.product_entity_repository');
  }
}
