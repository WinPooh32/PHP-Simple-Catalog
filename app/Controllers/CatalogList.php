<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    App\Models\Item;

class CatalogList extends AController {
    public function __construct() {
        
    }
    
    public function Get($request){       
        $data = [
            "title" => "Каталог",
            "content" => (new View("page.list", ["items" => Item::all()]))->render()
        ];

        return (new View("layout.catalog", $data))->render();
    }
    
    public function Post($request){
        
    }
}