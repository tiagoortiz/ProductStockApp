<?php

namespace App\Http\Controllers;

use App\ProductTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = array();

        $transactions = DB::table('product_Transactions')
            ->leftJoin('products', 'product_transactions.product_id', '=', 'products.id')
            ->select('products.sku', 'products.name', 'product_transactions.quantity', 'product_transactions.type')
            ->whereDate('product_transactions.created_at', '=', date('Y-m-d'))   
            ->get();

        $data['transactions'] = $transactions;

        $lowStockProducts = DB::table('products')
        ->select('sku', 'name', 'quantity_available')    
        ->where('quantity_available', '<', 100)
        ->get();

        $data['lowStockProducts'] = $lowStockProducts;
        
        return view('transactions_index', compact('data'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductTransactions  $productTransactions
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTransactions $productTransactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductTransactions  $productTransactions
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTransactions $productTransactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductTransactions  $productTransactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTransactions $productTransactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductTransactions  $productTransactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTransactions $productTransactions)
    {
        //
    }
}
