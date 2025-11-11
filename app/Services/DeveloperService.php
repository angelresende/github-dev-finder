<?php

namespace App\Services;

class DeveloperService
{
    public function __construct(private GithubService $githubService) {}

    public function getDevelopers(array $filters)
    {
        $data = $this->githubService->searchDevelopers($filters);

        return collect($data)->map(fn($dev) => [
            'name' => $dev['login'],
            'url' => $dev['html_url'],
            'avatar' => $dev['avatar_url'],
            'score' => $dev['score'],
        ]);
    }
}
