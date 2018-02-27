<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Validator;
use App\Models\Page;
use App\Models\Banner;
use App\Models\BannerSize;
use App\Models\BannerPage;
use Illuminate\Http\Request;
use App\Models\PageBannerSize;
use Stripe\{Charge, Customer};

class BannerController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth:web,local');
	}

    public function getBanners()
    {
    	$local = Auth::guard('local')->user();
        $user = $local ? $local : Auth::user();

        return view('pages.profile.banners.index', compact('user', 'pages', 'bannerSizes'));
    }

    public function getCreateBanners()
    {
        $local = Auth::guard('local')->user();
        $user = $local ? $local : Auth::user();
        $pages = Page::with('banner_sizes')->get();
        $bannerSizes = BannerSize::with('pages')->get();
        $perTimeColumns = array_slice(DB::getSchemaBuilder()->getColumnListing('page_banner_size'), 3, 6);

        return view('pages.profile.banners.create', compact('user', 'pages', 'bannerSizes', 'perTimeColumns'));
    }

    public function postBanners(Request $request)
    {
        $local = Auth::guard('local')->user();
        $user = $local ? $local : Auth::user();

        $data = getBannerTotalAmountAndDataToSync($request);
        $total = $data['total'];

        $field = '';
        foreach ($request->all() as $field => $value) {
            if (strpos($field, 'price_per') !== false) {
                $field = $field;
                break;
            }
        }


        $validator = Validator::make($request->all(), [
            'price_per_week' => 'required_without:price_per_month',
            'price_per_month' => 'required_without:price_per_week',
            'banner_description' => 'required',
            'banner_photo' => 'required',
            'banner_url' => 'required',
        ]);

        if ($validator->passes()) {

            $banner = new Banner;
            $banner->banner_total_amount = $total;
            $banner->banner_url = $request->banner_url;
            $banner->banner_photo = $request->banner_photo;
            $banner->save();

            foreach ($data['syncedData'] as $pageId => $sizes) {
                foreach ($sizes as $size) {
                    $bannerPage = new BannerPage;
                    $bannerPage->banner_id = $banner->id;
                    $bannerPage->page_id = $pageId;
                    $bannerPage->banner_size_id = $size['banner_size_id'];
                    $bannerPage->save();
                }
            }

            $user->banners()->save($banner);

            try {
                $customer = null;
            
                if ($user->stripe_last4_digits) {
                    $customer = Customer::retrieve($user->stripe_id);
                }

                if (!$customer) {
                    $customer = Customer::create([
                        "email" => request('stripeEmail'),
                        "source" => request('stripeToken'),
                    ]);
                    $user->stripe_id = $customer->id;
                    $user->save();
                }

                Charge::create([
                    'customer' => $user->stripe_id,
                    'amount' => $total * 100,
                    'currency' => 'chf',
                ]);
            } catch (\Exception $e) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => $e->getMessage()
                    ], 422);
                }

                return redirect()->back()->withErrors(['stripe_error' => $e->getMessage()]);
            }

            Session::flash('success', __('messages.banner_requested_success'));

            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->getMessageBag()
                ]);
            }

            if ($local) {
            	return redirect()->route('local_banners', ['username' => $user->username]);
            } else {
            	return redirect()->route('private_banners', ['private_id' => $user->id]);
            }

        } else {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($validator->getMessageBag());
        }
    }
}
