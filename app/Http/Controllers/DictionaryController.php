<?php

namespace App\Http\Controllers;

use App\Helpers\Similarity;
use App\Models\Dictionary;
use App\Http\Requests\StoreDictionaryRequest;
use App\Http\Requests\UpdateDictionaryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $message    = ['message' => [__('Done.')]];
        $status     = 'success';
        $notify     = false;

        $data = Similarity::percentage("henry", "henry");

        return response([
            'data'      => $data,
            'status'    => $status,
            'message'   => $message,
            'notify'    => $notify
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDictionaryRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dictionary $dictionary): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dictionary $dictionary): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDictionaryRequest $request, Dictionary $dictionary): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dictionary $dictionary): RedirectResponse
    {
        //
    }
}
