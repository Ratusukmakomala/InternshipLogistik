<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KmeanService;
use App\Http\Requests\KmeanRequest;

class KmeanController extends Controller
{
    public function __construct(public KmeanService $kmeanService)
    {

    }

    public function index()
    {
        return view('kmean.form');
    }

    public function result(KmeanRequest $request)
    {
        $numberClusters = (int) $request->clustering_number;
        $maxIterations  = (int) $request->max_iterations;

        $result = $this->kmeanService->kMeansClustering($numberClusters, $maxIterations);
        $clusters = $result['clusters'];
        $centroids = $result['centroids'];
        return view('kmean.result', compact('clusters', 'centroids'));
    }
}
