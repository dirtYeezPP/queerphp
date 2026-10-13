<?php 

require_once 'router.php'; 
require_once 'source/connect.php'; 
require_once 'source/helpers.php'; 
global $pdo; 

App::get("/", function(){

}); 

App::post("/", function() use($pdo) {



}); 

App::delete("/", function(){

}); 

App::patch("/", function(){

}); 

// Auth 

App::get("/auth", function(){

});

App::post("/auth/register", function(){

}); 

App::post("/auth/login", function(){

}); 
