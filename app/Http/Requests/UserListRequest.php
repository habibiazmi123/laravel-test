<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:10|max:50',
            'sortBy' => 'nullable|in:name,email,created_at',
            'orderBy' => 'nullable|in:asc,desc'
        ];
    }

    public function search(): ?string
    {
        return $this->get('search');
    }

    public function limit(): int
    {
        return $this->get('limit', 10);
    }

    public function sortBy(): string
    {
        return $this->get('sortBy', 'created_at');
    }

    public function orderBy(): string
    {
        return $this->get('orderBy', 'asc');
    }
}
