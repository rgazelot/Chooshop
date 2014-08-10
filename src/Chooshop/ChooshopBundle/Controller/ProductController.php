<?php

namespace Chooshop\ChooshopBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController,
    FOS\RestBundle\Controller\Annotations\RouteResource;

use JMS\Serializer\SerializationContext;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Chooshop\ChooshopBundle\DTO\ProductTransfer,
    Chooshop\ChooshopBundle\Form\ProductType;

class ProductController extends FOSRestController
{
    public function getProductAction($id)
    {
        $product = $this->get('chooshop.product')->get($id);

        $view = $this->view($product, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(['product_details']));

        return $view;
    }

    public function getProductsAction()
    {
        $products = $this->get('chooshop.product')->all();

        $view = $this->view($products, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(['product_list']));

        return $view;
    }

    public function postProductsAction(Request $request)
    {
        $productTransfer = new ProductTransfer;

        $form = $this->createForm(new ProductType, $productTransfer);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $this->view($form, 400);
        }

        $product = $this->get('chooshop.product')->create($productTransfer, $this->getUser());

        $view = $this->view($product, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(['product_details']));

        return $view;
    }

    public function putProductAction(Request $request, $id)
    {
        $productApi = $this->get('chooshop.product');
        $product = $productApi->get($id);

        $productTransfer = new ProductTransfer;

        $form = $this->createForm(new ProductType, $productTransfer);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $this->view($form, 400);
        }

        $this->get('chooshop.product')->edit($product, $productTransfer);

        $view = $this->view($product, 200);
        $view->setSerializationContext(SerializationContext::create()->setGroups(['product_details']));

        return $view;
    }

    public function deleteProductAction($id)
    {
        $productApi = $this->get('chooshop.product');
        $product = $productApi->get($id);
        $productApi->delete($product);
    }
}
