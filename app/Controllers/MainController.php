<?php

namespace Shoeshop\Controllers;

use Shoeshop\Models\Category;

class MainController extends CoreController {


    function home()
    {
        $categoryModel = new Category();

        $categoryList = $categoryModel->findHomeCategories();


        $viewData = [
            'categories' => $categoryList
        ];

        $this->show('home', $viewData);
    }

    function legalMentions()
    {

        $this->show('legal-mentions');
    }
    
    function pageNotFoundAction(){
        
        header('HTTP/1.0 404 Not found');
        $this->show('err404');
    }


};
