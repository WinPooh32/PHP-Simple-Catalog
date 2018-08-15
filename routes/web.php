<?php 

use Core\Router;

Router::Get('/404', App\Controllers\NotFound::class);
Router::Get('/', App\Controllers\CatalogList::class);
Router::Get('/info', App\Controllers\Info::class);
Router::Get('/details', App\Controllers\Details::class);

Router::Get('/add', App\Controllers\AddItem::class);
Router::Post('/add', App\Controllers\AddItem::class);

Router::Get('/edit', App\Controllers\EditItem::class);
Router::Post('/edit', App\Controllers\EditItem::class);

Router::Get('/delete', App\Controllers\DestroyItem::class);

Router::Get('/search', App\Controllers\SearchItem::class);