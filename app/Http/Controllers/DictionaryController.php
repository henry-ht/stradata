<?php

namespace App\Http\Controllers;

use App\Helpers\Similarity;
use App\Http\Requests\GetSimilarityRequest;
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
    public function index(GetSimilarityRequest $request): Response
    {
        $message    = ['message' => [__('Done.')]];
        $status     = 'success';
        $notify     = false;

        $credentials = $request->only([
            'nombre',
            'porcentaje',
        ]);

        $words = preg_split('/\s+/', $credentials['nombre'], -1, PREG_SPLIT_NO_EMPTY);
        Dictionary::setComparisonName($credentials['nombre']);
        $query = Dictionary::query();

        // $results = Dictionary::where(function ($query) use ($words, $credentials) {
        //     foreach ($words as $word) {
        //         $query->orWhere('nombre', 'like', '%' . $word . '%');
        //     }
        // })->get()->sortByDesc(function ($dictionary){
        //     return $dictionary->similarity;
        // });

        // $results = Dictionary::where(function ($query) use ($words, $credentials) {
        //     foreach ($words as $word) {
        //         $query->whereRaw('levenshtein('.$word.', `nombre`) BETWEEN 0 AND 1');
        //     }
        // })->get()->sortByDesc(function ($dictionary){
        //     return $dictionary->similarity;
        // });

        $data= similar_text("juan perez", "juan peres", $perc);

        $data = $perc;



        // $data = array_filter($results, function ($var) use($credentials) {
        //     return ($var['similarity'] >= $credentials['porcentaje']);
        // });

        // $data = $credentials['nombre'];

        // $credentials;

        // $data = Similarity::percentage("Juan Pablo Suarez Medina", "Juan macias");

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
