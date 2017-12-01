<?php

namespace App\Repositories\Contracts;

interface ProductRepository
{
    //
    
    public function getAll();
    public function getById($id);
    public function createProduct(array $attibute,$name,$idcat,$file);
}
