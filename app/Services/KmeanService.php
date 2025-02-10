<?php

namespace App\Services;

use App\Services\Transaction\ReportService;

class KmeanService
{
    public function __construct(public ReportService $reportService)
    {

    }

    public function kMeansClustering($numberClusters = 5, $maxIterations = 100)
    {
        $data = $this->dataCleaning();

        $k = $numberClusters; // Number of clusters

        $result = $this->kMeans($data, $k, $maxIterations);

        return $result;
    }

    private function dataCleaning()
    {
        $originalData = $this->reportService->findAllInArray();

        /**
         * Converting data to the format that can be used by K-means algorithm
         * If delivery_type is 'cod', then it will be converted to 1, otherwise 0
         * If sla_status is 1, then it will be converted to 1, otherwise 0
        */
        $data = array_map(function($item) {
            $deliveryType = $item->delivery_type === 'cod' ? 1 : 0;
            $slaStatus = $item->sla_status === 1 ? 1 : 0;
            $shippingForm = $this->convertShippingForm($item->shipping_form);
            $kindOfDelivery = $item->kind_delivery === 'document' ? 0 : 1;
            return [
                $deliveryType,
                $slaStatus,
                $shippingForm,
                $item->weight,
                $item->volume,
                $item->base_price,
                $item->sla_id,
                $kindOfDelivery,
            ];
        }, $originalData);

        return $data;
    }

    private function convertShippingForm($shippingForm)
    {
        $result = null;
        switch ($shippingForm) {
            case 'letter':
                $result = 0;
                break;
            case 'envelope':
                $result = 1;
                break;
            case 'parcel':
                $result = 2;
                break;
            case 'box':
                $result = 3;
                break;
            case 'crate':
                $result = 4;
                break;
            case 'pallet':
                $result = 5;
                break;
            case 'electronic':
                $result = 6;
                break;
            default:
                $result = 7;
                break;
        }

        return $result;
    }

    private function kMeans(array $data, int $k, int $maxIterations)
    {
        $centroids = array_slice($data, 0, $k);
        $iterations = 0;
        $clusters = [];

        do {
            $iterations++;
            $newClusters = [];

            foreach ($data as $point) {
                $distances = array_map(fn($centroid) => $this->euclideanDistance($point, $centroid), $centroids);
                $closestCentroid = array_keys($distances, min($distances))[0];
                $newClusters[$closestCentroid][] = $point;
            }

            $newCentroids = [];
            foreach ($newClusters as $clusterPoints) {
                $newCentroids[] = $this->calculateCentroid($clusterPoints);
            }

            $converged = $centroids === $newCentroids;
            $centroids = $newCentroids;
            $clusters = $newClusters;

        } while (!$converged && $iterations < $maxIterations);

        return [
            'iterations' => $iterations,
            'clusters' => $clusters,
            'centroids' => $centroids,
        ];
    }

    private function euclideanDistance(array $point1, array $point2)
    {
        return sqrt(array_sum(array_map(fn($a, $b) => ($a - $b) ** 2, $point1, $point2)));
    }

    private function calculateCentroid(array $points)
    {
        $numPoints = count($points);
        $sums = array_reduce($points, function ($carry, $point) {
            foreach ($point as $i => $value) {
                $carry[$i] = ($carry[$i] ?? 0) + $value;
            }
            return $carry;
        }, []);

        return array_map(fn($sum) => $sum / $numPoints, $sums);
    }
}
