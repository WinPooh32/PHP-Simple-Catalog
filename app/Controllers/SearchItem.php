<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    App\Models\Item,
    App as App;

class SearchItem extends AController {
    public function __construct() {
        
    }
    
    public function Get($request){
        $search_data = [];        
        $query = mb_strtolower($request["query"]);
        
        if(isset($query)){
            $cond =  ['word in (?)', App\Utils::stem($query)];
            
            $items = Item::find("all", [
                'joins' => ['search_map'],
                'group' => 'name',
                'conditions' => $cond
            ]);
            
            $search_data = [
                "items" => $items,
                "query" => $query
            ];
        }
        
        $data = [
            "title" => "Поиск - Каталог",
            "content" => (new View("page.search", $search_data))->render()
        ];

        return (new View("layout.catalog", $data))->render();
    }
    
    public function Post($request){
        
    }
}