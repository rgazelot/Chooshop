<?php

namespace Chooshop\ChooshopBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RouteResource;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Chooshop\ChooshopBundle\DTO\ProductTransfer,
    Chooshop\ChooshopBundle\Form\ProductType;

class ProductController extends Controller
{
    public function getProductAction($id)
    {
        $product = $this->get('chooshop.product')->get($id, $this->getUser()->getHouse());

        return $this->view($product, 200, [], ['product_details']);
    }

    public function getProductsAction()
    {
        $products = $this->get('chooshop.product')->all($this->getUser()->getHouse());

        return $this->view($products, 200, [], ['product_list']);
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

        return $this->view($product, 200, [], ['product_details']);
    }

    public function putProductAction(Request $request, $id)
    {
        $product = $this->get('chooshop.product')->get($id);

        $productTransfer = new ProductTransfer;

        $form = $this->createForm(new ProductType, $productTransfer);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $this->view($form, 400);
        }

        $this->get('chooshop.product')->edit($product, $productTransfer);

        return $this->view($product, 200, [], ['product_details']);
    }

    public function deleteProductAction($id)
    {
        $product = $this->get('chooshop.product')->get($id);
        $this->get('chooshop.product')->delete($product);
    }
}
