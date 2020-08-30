<?php

namespace App\Http\Controllers;

use App\Product;
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
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {                
                return back()->withErrors('Já existe um produto com o mesmo SKU'); 
            }
        }
          
        return redirect('/')->with('success', 'Produto criado com sucesso.'); 
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity_available'=>'required|regex:/^-?[0-9]+$/'
        ]); 

        $product = Product::find($id);
        
        if($product->quantity_available >= $request->get('quantity_available')) {
            $product->quantity_available -= $request->get('quantity_available');
            $product->save();
        } else {
            return back()->withErrors('Não existe quantidade disponível para baixa.'); 
        }      
      

        return redirect('/')->with('success', 'Baixa inserida com sucesso');
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
