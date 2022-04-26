<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface IService
{
    public function store(array $data): void;
    public function update(array $data, User|Model $user): void;
}
