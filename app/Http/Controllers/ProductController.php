<?php

namespace App\Http\Controllers;

use App\Actions\CreateProductAction;
use App\Http\Requests\StoreProductRequest;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            [
                'id' => $request->id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category' => [
                    'id' => $request->categoryId,
                    'name' => $request->categoryName,
                ]
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
