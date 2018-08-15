<?php

namespace App\Models;

use ActiveRecord\Model;

// Read this:
// http://phpactiverecord.org/projects/main/wiki/Quick_Start
// http://phpactiverecord.org/projects/main/wiki/Validations

class Item extends Model{
    static $validates_presence_of = [
        "name",
        "price"
    ];
    
    static $has_many = [
        ["search_map", 'class_name' => 'SearchMap']
    ];
}