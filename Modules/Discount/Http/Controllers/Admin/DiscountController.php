<?php

namespace Modules\Discount\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Discount\Entities\Discount;
use App\User;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $discounts = Discount::latest()->paginate();
        return view('discount::Admin.Discount.all', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('discount::Admin.Discount.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'percent' => 'required|numeric',
            'expired_at' => 'required',
            'users' => 'nullable|array',
            'users.*' => 'nullable|exists:users,id',           
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|exists:categories,id',
            'products' => 'nullable|array',
            'products.*' => 'nullable|exists:products,id'
        ]);

        $discount = new Discount();

        $discount->code = $data['code'];
        $discount->percent = $data['percent'];
        $discount->expired_at = toGregorian($data['expired_at']);

        $discount->save();

        if ( isset($data['users']) ) {
            $discount->users()->attach($data['users']);
        }

        if ( isset($data['products']) ) {
            $discount->products()->attach($data['products']);
        }

        if (isset($data['categories'])) {
            $discount->categories()->attach($data['categories']);
        }
        
        return redirect(route('admin.discount.index'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('discount::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Discount $discount)
    {
        return view('discount::Admin.Discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'code' => 'required',
            'percent' => 'required|numeric',
            'expired_at' => 'required',
            'users' => 'nullable|array',
            'users.*' => 'nullable|exists:users,id', 
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|exists:categories,id',
            'products' => 'nullable|array',
            'products.*' => 'nullable|exists:products,id'

        ]);

        $discount->code = $data['code'];
        $discount->percent = $data['percent'];
        $discount->expired_at = toGregorian($data['expired_at']);

        $discount->user()->associate(User::find($data['user']));

        $discount->update();

        isset($data['users'])
            ? $discount->users()->sync($data['users'])
            : $discount->users()->detach();

        isset($data['products'])
            ? $discount->products()->sync($data['products'])
            : $discount->products()->detach();
        
        isset($data['categories'])
            ? $discount->categories()->sync($data['categories'])
            : $discount->categories()->detach();
            
        
        return redirect(route('admin.discount.edit', $discount->code));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect(route('admin.discount.index'));
    }
}
