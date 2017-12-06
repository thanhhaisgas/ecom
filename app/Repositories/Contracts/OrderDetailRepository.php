<?php

namespace App\Repositories\Contracts;

interface OrderDetailRepository
{
    //
    public function getAllOrderDetail();
    public function getByIdOrderDetail($id);
    public function createOrderDetail($object);
}
