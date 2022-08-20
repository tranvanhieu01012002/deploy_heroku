<?php

namespace App\Http\Controllers;

use Google\Service\Fitness\Session as FitnessSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
class CheckFeeController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        $response = Http::withHeaders([
            "token" => "eb38f755-0a99-11ed-ad26-3a4226f77ff0"
        ])->get("https://online-gateway.ghn.vn/shiip/public-api/master-data/province")->json();

        if ($request->query('province')) {

            $id = $request->query('province');

            $idDistrict = $request->query('district');
            $responseDistrict = Http::withHeaders([
                "token" => "eb38f755-0a99-11ed-ad26-3a4226f77ff0"
            ])->get("https://online-gateway.ghn.vn/shiip/public-api/master-data/district", ['province_id' => $id])->json();


            if ($request->query('district')) {


                $responseWard = Http::withHeaders([
                    "token" => "eb38f755-0a99-11ed-ad26-3a4226f77ff0"
                ])->get("https://online-gateway.ghn.vn/shiip/public-api/master-data/ward", ['district_id'=> $idDistrict])->json();

                return response()->json(['status'=>200, 'data'=> $responseWard]);
            } else {
                return response()->json(['status'=>200, 'data'=> $responseDistrict]);
            }
        };
        return response()->json(['status'=>200, 'data'=> $response]);
    }
    public function calculateFee(Request $request)
    {
        # code...
        $id_district = $request->input('district');
        $quantity = $request->input('quantity');
        $id_shop =  3119781;
        $from = 3286;
        $weight  = 500;
        $height = $width = $length = 25;
        if ($id_district && $quantity !== 0) {
            $responsePP = Http::withHeaders([
                "token" => "eb38f755-0a99-11ed-ad26-3a4226f77ff0"
            ])->get(
                "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services",
                [
                    'shop_id' => $id_shop,
                    'from_district' => $from,
                    'to_district' => $id_district
                ]
            )->json();
            $fee = Http::withHeaders([
                "token" => "eb38f755-0a99-11ed-ad26-3a4226f77ff0"
            ])->get(
                "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee",

                array(
                    'service_id' => $responsePP['data'][0]["service_id"],
                    'insurance_value' => 500000,
                    'coupon' => NULL,
                    'from_district_id' => $from,
                    'to_district_id' => $id_district,
                    'to_ward_code' => $request->input('ward'),
                    'height' => $height * $quantity,
                    'length' => $height,
                    'weight' => $weight * $quantity,
                    'width' => $height,
                )
            )->json();
            return response()->json(["data"=>$fee]);
        }
    }

}
