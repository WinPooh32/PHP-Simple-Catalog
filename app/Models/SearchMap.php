<?php

namespace App\Models;

use ActiveRecord\Model;

class SearchMap extends Model {
    static $validates_presence_of = [
        "word"
    ];
}