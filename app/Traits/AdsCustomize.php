<?php

namespace App\Traits;

use App\Helpers\ApiResponse;
use App\Http\Resources\AdResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait AdsCustomize
{
    public function customizeAdsPagination($ads)
    {
        if (count($ads) > 0) {

            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination links' => [
                        'current page' => $ads->currentPage(),
                        'per page' => $ads->perPage(),
                        'total' => $ads->total(),
                        'links' => [
                            'first' => $ads->url(1),
                            'last' => $ads->url($ads->lastPage()),
                        ]
                    ]
                ];
            } else {
                $data = AdResource::collection($ads);
            }

            return ApiResponse::sendResponse(
                200,
                'Ads Retrieved Successfully',
                $data
            );

        }

        return ApiResponse::sendResponse(
            200,
            'ads Not Found',
            []);
    }
}
