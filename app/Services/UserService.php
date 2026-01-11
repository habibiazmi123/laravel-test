<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\AdminNewUserNotification;
use App\Notifications\UserCreatedNotification;
use App\Services\Contracts\UserServiceInterface;
use App\UserRole;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class UserService implements UserServiceInterface
{
    public function paginate(array $filters): LengthAwarePaginator
    {
        return User::query()
            ->withCount('orders')
            ->where('active', true)
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(
                    fn($query) => $query
                        ->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                );
            })
            ->orderBy($filters['sortBy'] ?? 'created_at', $filters['orderBy'] ?? 'asc')
            ->paginate($filters['limit'] ?? 10);
    }

    public function create(array $data): User
    {
        $user = DB::transaction(
            fn() =>
            User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ])
        );

        $user->notify(new UserCreatedNotification);
        $this->notifyAdminsOfNewUser($user);

        return $user;
    }

    private function notifyAdminsOfNewUser(User $user): void
    {
        $userAdmins = User::whereRole(UserRole::ADMINISTRATOR->value)
            ->whereActive(true)
            ->get();

        Notification::send($userAdmins, new AdminNewUserNotification($user));
    }
}
