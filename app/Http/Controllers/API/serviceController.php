<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Cutting;
use App\District;
use App\Http\Controllers\API\BaseController as BaseController;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Mail\activationmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use App\Icon;
use App\Service;
use App\order;
use App\member;
use App\setting;
use App\weight;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


class serviceController extends BaseController
{
    public function allcat(Request $request)
    {

        $keyword   = $request->keyword;

        $allcat = Category::all();
        if (count($allcat) != 0) {

            return $this->sendResponse('success', $allcat);
        } else {
            $errormessage =  'لا يوجد صالونات متاحة';
            return $this->sendError('success', $errormessage);
        }
    }

    public function allicons(Request $request)
    {

        $keyword   = $request->keyword;

        $allicon = Icon::all();
        if (count($allicon) != 0) {

            return $this->sendResponse('success', $allicon);
        } else {
            $errormessage =  'لا يوجد ايكون متاحة';
            return $this->sendError('success', $errormessage);
        }
    }


    public function showservice(Request $request)
    {
        $showserv = Service::find($request->service_id);
        if ($showserv) {
            $iteminfo     = array();
            $icons        = array();
            $current      = array();

            // $icons = Icon::where('icon_id', $showserv->id)->get();
            // $cuttings = Cutting::all();
            $setting = setting::first();
            if ($request->category_id) {
                // dd($request);
                $cats = Category::where('category_id', $request->category_id)->get();
                $current['categories'] = $cats;
            }
            $current['iteminfo'] = $showserv;
            // $current['icons'] = $icons;
            // $current['cuttings'] = $cuttings;

            return $this->sendResponse('success', $current);
        } else {
            $errormessage =  'الخدمه غير موجود';
            return $this->sendError('success', $errormessage);
        }
    }
}
