<?php

namespace App\Http\Controllers;

use App\Data;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $client       = new Client();
        $request      = $client->get('https://portal.edcd.gov.np/rest/api/fetch?filter=casesBetween&type=dayByDay&sDate=2020-01-01&eDate=2020-12-24&disease=COVID-19', ['verify' => false]);
        $response     = $request->getBody();
        $decoded_info = json_decode($response);
		dd($decoded_info);
        Data::truncate();
        foreach ($decoded_info as $all_info) {
            $new_row = new Data;
            if (isset($all_info->Province)) {
                $new_row->province = $all_info->Province;
            }
            if (isset($all_info->District)) {

                $new_row->district = $all_info->District;
            }
            if (isset($all_info->Sex)) {

                $new_row->sex = $all_info->Sex;
            }
            if (isset($all_info->Age)) {
                $new_row->age = $all_info->Age;
            }
            if (isset($all_info->Period)) {
                $new_row->date = $all_info->Period;
            }
            if (isset($all_info->Value)) {
                $new_row->value = $all_info->Value;
            }
            $new_row->save();

        }
		dd('Saved');
    }

    public function storeGenderAndValue()
    {
        // $data = Data::pluck('district')->get();
        $data = Data::select('date')->orderby('date','desc')->distinct()->get()->pluck('date');
        dd($data);
    }
}
