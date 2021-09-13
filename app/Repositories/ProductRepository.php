<?php
/**
 * Created by PhpStorm.
 * User: packardbell
 * Date: 26/04/2019
 * Time: 11:15
 */

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductRepository extends ResourceRepository
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

}