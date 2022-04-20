<?php

namespace App\Services;

interface IService
{
    public function store($data);
    public function update($data, $model);
}
