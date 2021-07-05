<?php 

namespace Shoeshop\Controllers;

use Shoeshop\Models\Brand;
use Shoeshop\Models\Type;
use PDO;

class CoreController {

    protected function show($viewName, $viewData = [])
    {
        global $router;

        $brandModel = new Brand();
        $footerFiveBrands = $brandModel->findFooterFive();

        $typeModel = new Type();
        $footerFiveTypes = $typeModel->findFooterFive();


        $viewData['currentPage'] = $viewName;

        extract($viewData); 

        $serverDir = $_SERVER['BASE_URI'];
        $assetsFolder = $serverDir . "/assets";
        $baseUri = $_SERVER['BASE_URI'] . "/";
        require __DIR__ . '/../views/header.tpl.php';
        require __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require __DIR__ . '/../views/footer.tpl.php';
    }
    

} 