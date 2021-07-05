<?php

// include car_dumper plugin
use Symfony\Component\VarDumper\VarDumper;


// plus besoin de 'require' chaque fichier car intégré dans l'autoloader grâce au NameSpace
// // require les fichiers controller
// require __DIR__. "/../app/Controllers/CoreController.php";
// require __DIR__ . "/../app/Controllers/MainController.php";
// require __DIR__ . "/../app/Controllers/CatalogController.php";

// require __DIR__. "/../app/Models/CoreModel.php";
// require __DIR__ . "/../app/Models/Type.php";
// require __DIR__ . "/../app/Models/Brand.php";
// require __DIR__ . "/../app/Models/Category.php";
// require __DIR__ . "/../app/Models/Product.php";
// require __DIR__ . "/../app/Utils/Database.php";

//! require les dépendances composer
require __DIR__ . "/../vendor/autoload.php";


/*
function classNotFoundCallback($notFoundClassName){
  // cette fonction qui est appellée quand une classe est manquante
  // va recevoir le nom de la classe manquante !
  dump($notFoundClassName);
  if(strpos($notFoundClassName, 'Controller') !== false){
    require __DIR__ . '/../app/Controllers/' . $notFoundClassName . '.php';
  }
  //! ATTENTION NE MARQCHE PAS CAR TOUS LES MODELS
  //! N'ONT PAS LE MOT "Model"  dans leur nom
  if(strpos($notFoundClassName, 'Model') !== false){
    require __DIR__ . '/../app/Controllers/' . $notFoundClassName . '.php';
  }
}
// ici grâce a spl_autoload_register j'indique le nom de la fonction
// à appeller SI je ne trouve pas de classe
spl_autoload_register('classNotFoundCallback');
*/


// instancie un objet grâce à la classe AloRouter
$router = new AltoRouter();

if(array_key_exists('BASE_URI', $_SERVER)){
    // on fournit à Altorouter le partie de l'URL à ne pas prendre en compte pour faire la comparaison entre l'url courant
    $router->setBasePath($_SERVER['BASE_URI']);
} else {
    $_SERVER['BASE_URI'] = '';
}

// route home
$router->map(
    'GET', //methode HTTP qui est autorisé
    '/', // URL à laquelle cette route réagit
    [ // target : ce tblo stock les noms de la méthode et du controller qui vont se déclencher pour réagir à cette 
        'controller' => 'MainController',
        'action' => 'home'
    ],
    'home' // nom de la route (arbitraire)
);


// route mentions légales
$router->map(
    'GET', 
    '/legal-mentions', 
    [ 
        'controller' => 'MainController',
        'action' => 'legalMentions'
    ],
    'legal-mentions' 
);

// route categorie
$router->map(
    'GET', 
    '/catalog/category/[i:id]', 
    [ 
        'controller' => 'CatalogController',
        'action' => 'category'
    ],
    'catalog-category' 
);

// route categorie filter
$router->map(
    'GET', 
    '/catalog/category/[i:id]/[:action]', 
    [ 
        'controller' => 'CatalogController',
        'action' => 'orderCategory'
    ],
    'catalog-category-sort' 
);



// route type
$router->map(
    'GET', 
    '/catalog/type/[i:id]', 
    [ 
        'controller' => 'CatalogController',
        'action' => 'type'
    ],
    'type' 
);

// route marque
$router->map(
    'GET',
    '/catalog/brand/[i:id]', 
    [ 
        'controller' => 'CatalogController',
        'action' => 'brand'
    ],
    'brand' 
);

// route produits
$router->map(
    'GET', 
    '/catalog/product/[i:id]', 
    [  
        'controller' => 'CatalogController',
        'action' => 'product'
    ],
    'product' 
);



// début du dispatcher
// on utilise une méthode 'magique' qui va nous permetre 
// - de véfifier que la route demandé existe bien
// - si la route existe alors récupère toutes les infos de la route
// - la route n'existe pas alors revoie 'false' 
$match = $router->match();

$params = null;

if ($match) {
    // display page
    $controllerToUse = '\Shoeshop\Controllers\\' . $match['target']['controller'];
    $methodToUse = $match['target']['action'];
    $params = $match['params'];

} else {
    // display 404
    $controllerToUse = '\Shoeshop\Controllers\\' . 'MainController';
    $methodToUse = 'pageNotFoundAction';

}

$controller = new $controllerToUse();
$controller->$methodToUse($params);

