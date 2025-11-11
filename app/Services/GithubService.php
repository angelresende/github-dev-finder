<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GithubService
{
    public function searchDevelopers(array $filters): array
    {
        $query = collect($filters)
            ->map(fn($value, $key) => "{$key}:{$value}")
            ->join('+');

        $response = Http::get("https://api.github.com/search/users?q={$query}");

        return $response->json('items') ?? [];
    }
}
