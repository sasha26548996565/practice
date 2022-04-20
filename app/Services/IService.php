<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

interface IService
{
    public function store(array $data);
    public function update(array $data, $model);
}
