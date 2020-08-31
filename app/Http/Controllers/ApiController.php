<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTransactions;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ProductId  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDecrease(Request $request, $id)
    {
        if (!Product::where('id', $id)->exists()) {
            return response()->json([
                "message" => "Produto não encontrado."
            ], 404);
        }

        $request->validate([
            'quantity'=>'required|regex:/^-?[0-9]+$/'
        ]); 

        $product = Product::find($id);

        $newQuantity = $product->quantity_available - $request->get('quantity');
        
        if($newQuantity < 0) {            
            return response()->json([
                "message" => "Não existe quantidade disponível para baixa."
            ], 404);
        }

        $product->quantity_available = $newQuantity;
        $product->save();            
        
        $productTransaction = new ProductTransactions([
            'product_id' => $id,
            'quantity' => -$request->get('quantity'),
            'type' => 'API'
        ]);

        $productTransaction->save();
        
        return response()->json([
            'success' => 'Baixa inserida com sucesso'
        ], 200);
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ProductId  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIncrease(Request $request, $id)
    {
        if (!Product::where('id', $id)->exists()) {
            return response()->json([
                "message" => "Produto não encontrado."
            ], 404);
        }

        $request->validate([
            'quantity'=>'required|regex:/^-?[0-9]+$/'
        ]); 

        $product = Product::find($id);
        
        $product->quantity_available += $request->get('quantity');
        $product->save();            
            
        $productTransaction = new ProductTransactions([
            'product_id' => $id,
            'quantity' => $request->get('quantity'),
            'type' => 'Sistema'
        ]);

        $productTransaction->save();
         
        return response()->json([
            'success' => 'Estoque adicionado com sucesso'
        ], 200);
    }

}
