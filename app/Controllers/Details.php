<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    App\Models\Item;

class Details extends AController {
    public function __construct() {
        
    }
    
    public function Get($request){
        //тут проверки
        $id = (int)$request["id"];      
        $item =  Item::find([$id]);
        
        $data = [
            "title" => "Информация о товаре - Каталог",
            "content" => (new View("page.details", [
                "item" => $item, 
                "expires" => $this->dateToViewHtml($item->expires_at)
            ]))->render()
        ];

        return (new View("layout.catalog", $data))->render();
    }
    
    public function Post($request){
        
    }
    
    private function dateToViewHtml($date){
        if(!isset($date)){
            return "";
        }
        return date("j.m.Y", strtotime($date));
    }
}