<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function paginate(array $filters): LengthAwarePaginator;

    public function create(array $data): User;
}
