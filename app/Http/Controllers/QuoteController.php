<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Http::timeout(5)->get('https://dummyjson.com/quotes');
        $singlequote = [
            'id' => 1,
            'quote' => 'Your heart is the size of an ocean. Go find yourself in its hidden depths.',
            'author' => 'Rumi',
        ];

        if ($quotes->successful()) {
            $quoteList = $quotes->json()['quotes'] ?? [];
            if (!empty($quoteList)) {
                $singlequote = $quoteList[array_rand($quoteList)];
            }
        }

        return view('welcome', ['quote' => $singlequote]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
