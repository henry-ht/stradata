<?php

namespace App\Http\Controllers;

use App\Helpers\Similarity;
use App\Http\Requests\GetSimilarityRequest;
use App\Models\Dictionary;
use App\Models\Search;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $similar_text = null;
        $resultsFinal = [];
        $estados        = ['registros encontrados', 'sin coincidencias', 'error del sistema'];
        $numeroEstado   = 0;

        $credentials = $request->only([
            'nombre',
            'porcentaje',
        ]);

        try {
            $words = preg_split('/\s+/', $credentials['nombre'], -1, PREG_SPLIT_NO_EMPTY);
            Dictionary::setComparisonName($credentials['nombre']);
            $dictionaries = Dictionary::all();
            $query = Dictionary::query();

            $results = Dictionary::where(function ($query) use ($words, $credentials) {
                foreach ($words as $word) {
                    $query->orWhere('nombre', 'like', '%' . $word . '%');
                }
            })->get()->sortByDesc(function ($dictionary){
                return $dictionary->similarity;
            });

            if(empty($credentials['porcentaje'])){
                $resultsFinal = $results;
            }else{
                foreach ($results as $key => $dictionary) {
                    if($dictionary->similarity >= $credentials['porcentaje']){
                        $resultsFinal[] = $dictionary;
                    }
                }
            }

            foreach ($dictionaries as $key => $dictionary) {
                $perc = Similarity::get($dictionary->nombre, $credentials['nombre']);
                if ($perc > 65) {
                    $similar_text = $dictionary->nombre;
                    break;
                }
            }

            $data = [
                'similar_text'  => $similar_text,
                'results'       => $resultsFinal,
            ];

            if(count($resultsFinal) == 0){
                $numeroEstado = 1;
            }

        } catch (\Throwable $th) {
            $data = null;
            $numeroEstado = 2;
        }

        Search::create([
            'busqueda'      => $credentials['nombre'],
            'porcentaje'    => $credentials['porcentaje'],
            'estado'        => $estados[$numeroEstado],
            'coincidencias' => json_encode($resultsFinal),
            'user_id'       => Auth::user()->id
        ]);

        return response([
            'data'      => $data,
            'status'    => $status,
            'message'   => $message,
            'notify'    => $notify
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dictionary $dictionary): Response
    {
        //
    }
}
