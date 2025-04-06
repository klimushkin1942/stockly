<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function destroy(Image $image): JsonResponse
    {
        ImageService::destroyBatch([$image]);

        return response()->json([
            'message' => 'deleted'
        ], Response::HTTP_OK);
    }
}
