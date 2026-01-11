<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserListRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\Contracts\UserServiceInterface;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Resources\Json\JsonResource;

#[Group('Users')]
class UserControllerAPI extends Controller
{
    public function __construct(private UserServiceInterface $userService) {}

    /**
     * Get list of users.
     */
    public function index(UserListRequest $request)
    {
        $users = $this->userService->paginate([
            'search' => $request->search(),
            'sortBy' => $request->sortBy(),
            'orderBy' => $request->orderBy(),
            'limit' => $request->limit()
        ]);

        return new UserCollection($users);
    }

    /**
     * Create a new user.
     */
    public function store(StoreUserRequest $request): JsonResource
    {
        $user = $this->userService->create($request->validated());

        return (new UserResource($user));
    }
}
