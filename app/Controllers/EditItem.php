<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    Core\Http,
    App\Utils as Utils,
    App\Models\Item,
    App\Models\SearchMap;

class EditItem extends AController {
    public function __construct() {
        
    }
    
    public function Get($request){
        if(!isset($request["id"])){
            Http::redirect("/");
            return;
        }
        
        $id = (int)$request["id"];      
        $item =  Item::find([$id]);
        
        $data = [
            "title" => "Редактирование - Каталог",
            "content" => (new View("page.edit", [
                "item" => $item, 
                "expires"=> $this->dateToHtml($item->expires_at)
            ]))->render()
        ];

        return (new View("layout.catalog", $data))->render();
    }
    
    public function Post($request){        
        //тут провери формы на корректность
        $id = (int)$request["id"];

        $item =  Item::find([$id]);
               
        $item->name = $request["name"];
        $item->price = $request["price"];
        $item->country = $request["country"];
        $item->manufacturer = $request["manufacturer"];
        $item->expires_at = $request["expires_at"];
        $item->description = $request["description"];
        
        { //Сначала удаляем все слова
            $words = SearchMap::all(array('conditions' => 'item_id = '.$id));

            foreach($words as $word){
                $word->delete();
            }
        }
        
        foreach(Utils::stem($request["description"]) as $word){
            $item->create_search_map(['word' => $word]);
        }
        
        $item->save();
        
        Http::redirect("/details?id=".$id);
    }
    
    private function dateToHtml($date){
        return date("Y-m-j", strtotime($date));
    }
}