<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTransactions;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'sku'=>'required',
            'quantity_available'=>'required|regex:/^-?[0-9]+$/'
        ]); 
        try {
            $product = new Product([
                'name' => $request->get('name'),
                'sku' => $request->get('sku'),
                'description' => $request->get('description'),
                'quantity_available' => $request->get('quantity_available')
            ]);
            
            $product->save();

            return redirect('/')->with('success', 'Produto criado com sucesso.'); 
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {                
                return back()->withErrors('Já existe um produto com o mesmo SKU'); 
            }
        }
          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for decrease the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function decrease($id)
    {
        $product = Product::find($id);
        return view('decrease', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateDecrease(Request $request, $id)
    {
        $request->validate([
            'quantity_available'=>'required|regex:/^-?[0-9]+$/'
        ]); 

        $product = Product::find($id);

        $newQuantity = $product->quantity_available - $request->get('quantity_available');
        
        if($newQuantity >= 0) {
            $product->quantity_available = $newQuantity;
            $product->save();            
            
            $productTransaction = new ProductTransactions([
                'product_id' => $id,
                'quantity' => -$request->get('quantity_available'),
                'type' => 'Sistema'
            ]);

            $productTransaction->save();
            
            if($newQuantity < 100) {  
                return redirect('/')->with(array(
                    'success' => 'Baixa inserida com sucesso',
                    'alert' => 'O produto ficou com um estoque baixo (Menor do que 100 unidades)'
                ));                  
            }      
           
            return redirect('/')->with('success', 'Baixa inserida com sucesso');
        } else {
            return back()->withErrors('Não existe quantidade disponível para baixa.'); 
        }    
        
    }

      /**
     * Show the form for increase the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function increase($id)
    {
        $product = Product::find($id);
        return view('increase', compact('product'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateIncrease(Request $request, $id)
    {
        $request->validate([
            'quantity_available'=>'required|regex:/^-?[0-9]+$/'
        ]); 

        $product = Product::find($id);
        
        $product->quantity_available += $request->get('quantity_available');
        $product->save();            
            
        $productTransaction = new ProductTransactions([
            'product_id' => $id,
            'quantity' => $request->get('quantity_available'),
            'type' => 'Sistema'
        ]);

        $productTransaction->save();
         
        return redirect('/')->with('success', 'Estoque adicionado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete(); // Easy right?
 
        return redirect('/')->with('success', 'Produto removido com sucesso.'); 
    }
}
