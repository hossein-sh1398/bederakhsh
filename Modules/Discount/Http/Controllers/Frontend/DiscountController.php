<?php

namespace Modules\Discount\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Discount\Entities\Discount;
use Carbon\Carbon;

class DiscountController extends Controller
{
    public function check(Request $request)
    {
        $request->validate(['code' => 'required | exists:discounts,code']);

        if ( ! auth()->check() ) {
            return redirect()->back()->withErrors(['code' => 'برای اعمال کد تخفیف لطفا وارد سایت شوید.']);
        }
        

        $code = Discount::where([

            ['code', $request->code],
            ['expired_at', '>=', Carbon::now()->toDateString()]

        ])->first();

        if (!$code) {
            return redirect()->back()->withErrors(['code' => 'مهلت استفاده از کد تخفیف شما به اتمام رسیده است.']);
        }

        $user = auth()->user();
        
        if ( $code->users->isNotEmpty() ) {

            if ( ! $code->users->contains($user) ) {

                return redirect()->back()->withErrors(['code' => 'شما مجاز به استفاده از این کد تخفیف نمی باشید.']);
            }
        }
        
        dd('برای این کاربر هم هست');

    }
}
