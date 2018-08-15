<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    App\Models\Item,
    App\Models\SearchMap;

class DefaultController extends AController {
    public function __construct() {    
    }

    public function Get($request){
        $money = "54";
        if(isset($request["money"])){
            $money = $request["money"];
        }
        
        $data = [
            "title" => "Hello, web!",
            "content" => (new View("default",  ["money" => $money]))->render()
        ];

        return (new View("layout.default", $data))->render();
    }
    
    public function Post($request){
        
    }
}