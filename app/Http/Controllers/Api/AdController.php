<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Traits\AdsCustomize;
use Illuminate\Http\Request;

class AdController extends Controller
{
    use AdsCustomize;

    public function index()
    {
        $ads = Ad::latest()->paginate(10);


        return $this->customizeAdsPagination($ads);
    }

    public function latest()
    {
        $ads = Ad::latest()->take(5)->get();
        if (count($ads) > 0) {
            return ApiResponse::sendResponse(
                200,
                'Ads Retrieved Successfully',
                AdResource::collection($ads)
            );
        }
        return ApiResponse::sendResponse(
            200,
            'ads Not Found',
            []);

    }

    public function domain($domain_id)
    {
        $ads = Ad::where('domain_id', $domain_id)->latest()->paginate(10);

        return $this->customizeAdsPagination($ads);
    }


    public function search(Request $request)
    {

        $word = $request->has('search') ? $request->input('search') : null;
        $ads = Ad::when($word != null, function ($query) use ($word) {
            $query->where('title', 'like', '%' . $word . '%');
        })->latest()->paginate(10);
        return $this->customizeAdsPagination($ads);
    }

    public function create(AdRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $record = Ad::create($data);
        if ($record) {
            return ApiResponse::sendResponse(201, 'Your Ad Created Successfully', new AdResource($record));

        }
    }

    public function update(AdUpdateRequest $request)
    {

        $ad = Ad::findOrFail($request->ad_id);


        if ($ad->user_id != $request->user()->id) {
            return ApiResponse::sendResponse(403, 'Unauthorized', []);
        }
        $data = $request->validated();
        $record = $ad->update($data);

        if ($record) {
            return ApiResponse::sendResponse(201, 'Your Ad Updated Successfully', new AdResource($ad));

        }
    }
}
