<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $news = News::query()
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return NewsResource::collection($news);
    }

    public function show(string $slug): NewsResource
    {
        $news = News::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return new NewsResource($news);
    }
}