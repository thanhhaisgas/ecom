<?php

namespace App\Repositories\Contracts;

interface CheckoutRepository
{
    //
    public function getAllOrder();
    public function getByIdOrder($id);
    public function createOrder(array $order);
}
