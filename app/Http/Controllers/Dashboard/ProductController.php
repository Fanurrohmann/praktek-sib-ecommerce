<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Requests\Dashboard\Product\StoreRequest;
use App\Models\Category;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setTitle('Products');
        
        $this->addBreadcrumb('Dashboard', route('dashboard.index'));
        $this->addBreadcrumb('Products');

        $this->data['products'] = Product::with('category')->get();
        $this->data['categories'] = Category::all();


        Product::where(['category_id' => 1])->get();
        // nike -> sepatu
        // adidas -> sepatu
        // mils -> sepatu

        Product::with('category');
        // nike, 25, categori_id,
            // -> kategori -> sepatu, slug
        // adidas, 25, categori_id,
            // -> kategori -> sepatu
        // mils, 25, categori_id,
            // -> kategori -> sepatu
        // tesla, v1, categori_id,
            // -> kategori -> mobil
        // tesla, v2, categori_id,

        return view('dashboard.product.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $validated = $request->validated();
            
            Product::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully',
            ])->setStatusCode(Response::HTTP_CREATED);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create product',
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully',
            ])->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product',
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
