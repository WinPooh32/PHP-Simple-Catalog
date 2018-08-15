<?php

namespace App\Controllers;

use Core\AController,
    Core\View,
    Core\Http,
    App\Models\Item,
    App\Models\SearchMap;

class DestroyItem extends AController {
    public function __construct() {
        
    }
    
    public function Get($request){
        //тут провери формы на корректность
        $id = (int) $request["id"];

        $item = Item::find([$id]);
        
        $words = SearchMap::all(array('conditions' => 'item_id = '.$id));
        
        foreach($words as $word){
            $word->delete();
        }

        
        $item->delete();

        Http::redirect("/");
    }
    
    public function Post($request){        

    }
}