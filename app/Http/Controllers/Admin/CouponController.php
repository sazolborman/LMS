<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        // Get the number of items per page (default to 10 if not provided)
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');

        $query = Coupon::query();

        // search filter
        if ($search) {
            $query->where('code', 'LIKE', "%$search%");
        }

        $show_data['coupons'] = $query->orderBy('id', 'DESC')->paginate($perPage)->appends(request()->query());
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return view('admin.coupons.data_container', $show_data)->render();
        }

        return view('admin::coupons.index', $show_data);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'discount_percentage' => 'required|numeric',
            'expiry_date' => 'required',

        ]);

        if (Coupon::where('code', $request->code)->count() > 0) {
            return redirect(route('admin.coupon'))->with('error', 'There cannot be more than one coupon with the same code. Please change your coupon code');
        }

        $data['code'] = $request->code;
        $data['discount_percentage'] = $request->discount_percentage;
        $data['expiry_date'] = strtotime($request->expiry_date);
        $data['status'] = 1;

        Coupon::insert($data);
        return redirect()->back()->with('success', translate('Added successfully'));
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'discount_percentage' => 'required|numeric',
            'expiry_date' => 'required',

        ]);

        if (Coupon::where('code', $request->code)->where('id', '!=', $request->id)->count() > 0) {
            return redirect(route('admin.coupon'))->with('error', 'There cannot be more than one coupon with the same code. Please change your coupon code');
        }

        $data['code'] = $request->code;
        $data['discount_percentage'] = $request->discount_percentage;
        $data['expiry_date'] = strtotime($request->expiry_date);
        $data['status'] = 1;

        Coupon::where('id', $request->id)->update($data);
        return redirect()->back()->with('success', translate('Update successfully'));
    }

    public function status($id)
    {
        $query = Coupon::where('id', $id);
        if ($query->first()->status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $query->update($data);
        return redirect()->back()->with('success', translate('Update successfully'));
    }
    public function delete($id)
    {
        $query = Coupon::where('id', $id);
        $query->delete();
        return redirect()->back()->with('success', translate('Delete successfully'));
    }
}
