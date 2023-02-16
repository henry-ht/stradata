<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $message    = ['message' => [__('Done.')]];
        $status     = 'success';
        $notify     = false;

        $data = Search::where('user_id', Auth::user()->id)->get();

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
    public function show(Search $search): Response
    {
        $message    = ['message' => [__('Done.')]];
        $status     = 'success';
        $notify     = false;

        $data = $search;

        return response([
            'data'      => $data,
            'status'    => $status,
            'message'   => $message,
            'notify'    => $notify
        ],200);
    }
}
