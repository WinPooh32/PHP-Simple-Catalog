<?php 
namespace App;

class Utils{
    public static function stem($description){
        $stemmer = new \NXP\Stemmer();

        $stemmed = [];
        foreach (explode(' ', $description) as $word) {
            $stemmed[] = $stemmer->getWordBase($word);
        }
        
        return array_unique($stemmed);
    }    
}

