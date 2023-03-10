<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductAction;
use App\Http\Requests\GetProductsRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Ecommerce\Common\DTOs\Product\ProductData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetProductsRequest $request)
    {
        $products = Product::search(
            $request->getSearchTerm(),
            $request->getSortBy(),
            $request->getSortDirection(),
        );

        return [
            'data' => $products->map->toData(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Ecommerce\Common\DTOs\Product\ProductData $data
     * @param \App\Actions\CreateProductAction $action
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, CreateProductAction $action)
    {
        $data = ProductData::fromArray([
            ...$request->toArray(),
            'category' => [
                'uuid' => $request->categoryId,
            ]
        ]);
        $product = $action->execute($data);
        return response([
            'data' => $product->toData(),
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
