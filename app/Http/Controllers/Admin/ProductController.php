<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\ProductGroup\ProductGroupResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $products = ProductResource::collection($products)->resolve();

        return inertia('Admin/Product/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $productGroups = ProductGroupResource::collection(ProductGroup::all())->resolve();

        return inertia('Admin/Product/Create', compact('categories', 'productGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $product = ProductService::store($data);

        return ProductResource::make($product)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = ProductResource::make($product)->resolve();

        return inertia('Admin/Product/Show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = ProductResource::make($product)->resolve();

        return inertia('Admin/Product/Edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product = ProductService::update($product, $data);

        return ProductResource::make($product)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
