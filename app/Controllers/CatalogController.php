<?php

namespace Shoeshop\Controllers;

use Shoeshop\Models\Category;
use Shoeshop\Models\Product;
use Shoeshop\Models\Brand;
use Shoeshop\Models\Type;
use Shoeshop\Controllers;

class CatalogController extends CoreController {

  
    function category($params)
    {
        
        $categoryModel = new Category();

        $allCategories = $categoryModel->findAll();

        $oneCategory = $categoryModel->find($params['id']);

        if(!$oneCategory){
            $this->show('err404');
        }


        $productModel = new Product();
        $products = $productModel->findAllByCategory($params['id']);

        $viewData = [
            'categoryId' => $params['id'],
            'category' => $oneCategory,
            'products' => $products,
            'url' => $_SERVER['BASE_URI'] . "/"
        ];

        $this->show('category', $viewData);
    }

    function type($params)
    {   
        $typeModel = new Type();

        $allTypes = $typeModel->findAll();

        $oneType = $typeModel->find($params['id']);

        $productModel = new Product();
        $products = $productModel->findAllByType($params['id']);

        $viewData = [
            'typeId' => $params['id'],
            'type' => $oneType,
            'products' => $products,
            'url' => $_SERVER['BASE_URI']
        ];

        $this->show('type', $viewData);
    }

    function brand($params)
    {

        $brandModel = new Brand();
        $brand = $brandModel->find($params['id']);

        $productModel = new Product();
        $brandProducts = $productModel->findAllByBrand($params['id']);

        $viewData = [
            'brandId' => $params['id'],
            'brand' => $brand,
            'products' => $brandProducts,
            'url' => $_SERVER['BASE_URI']
        ];

        $this->show('brand', $viewData);
    }

    function product($params)
    {
        $productModel = new product();

        $product = $productModel->find($params['id']);

        $brandModel = new Brand();
        $productBrandId = $product->getBrandId();
        $productBrand = $brandModel->find($productBrandId);
        $product->setBrand($productBrand->getName());

        $categoryModel = new Category();
        $productCategoryId = $product->getCategoryId();
        $productCategory = $categoryModel->find($productCategoryId);
        $product->setCategory($productCategory->getName());

        $typeModel = new Type();
        $productTypeId = $product->getTypeId();
        $productType = $typeModel->find($productTypeId);
        $product->setType($productType->getName());

        $viewData = [
            'productId' => $params['id'],
            'product' => $product,
            'url' => $_SERVER['BASE_URI'] . "/"
        ];

        

        $this->show('product', $viewData);
    }

    function orderCategory($params) {

        $filterOptions = [
            "orderby_0" => "id",
            "orderby_1" => "name",
            "orderby_2" => "rate",
            "orderby_3" => "price"
            
        ];

        $categoryModel = new Category();

        $allCategories = $categoryModel->findAll();

        $oneCategory = $categoryModel->find($params['id']);

        $productModel = new Product();
        $products = $productModel->findAllByCategory($params['id'], $filterOptions[$params["action"]]);

        $viewData = [
            'categoryId' => $params['id'],
            'category' => $oneCategory,
            'products' => $products,
            'url' => $_SERVER['BASE_URI'] . "/"
        ];

        $this->show('category', $viewData);
    }


};