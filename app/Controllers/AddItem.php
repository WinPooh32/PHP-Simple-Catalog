<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    Core\Http,
    App\Utils as Utils,
    App\Models\Item,
    App\Models\SearchMap;

class AddItem extends AController {
    public function __construct() {
        
    }
    
    public function Get($request){
        $data = [
            "title" => "Добавление товара - Каталог",
            "content" => (new View("page.add", []))->render()
        ];

        return (new View("layout.catalog", $data))->render();
    }
    
    public function Post($request){
        //тут провери формы на корректность
        $item =  Item::create($request);
               
        $item->name = $request["name"];
        $item->price = $request["price"];
        $item->country = $request["country"];
        $item->manufacturer = $request["manufacturer"];
        $item->expires_at = $request["expires_at"];
        $item->description = $request["description"];
        
        $searchWords = [];
        
        $this->FillSearchMap($item->name, $searchWords);
        $this->FillSearchMap($item->description, $searchWords);
        
        foreach (array_unique($searchWords) as $word) {
            $item->create_search_map(['word' => $word]);
        }
        
        $item->save();
        
        Http::redirect("/details?id=".$item->id);
    }
    
    private function FillSearchMap(&$src, &$dstArray){
        $dstArray = array_merge($dstArray, Utils::stem(mb_strtolower($src)));
    }
}