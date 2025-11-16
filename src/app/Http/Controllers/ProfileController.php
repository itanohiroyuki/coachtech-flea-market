<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $page = $request->query('page', 'sell');
        $profile = $user->profile;
        if ($page === 'sell') {
            $products = Product::where('user_id', $user->id)->get();
        } elseif ($page === 'buy') {
            $products = Product::where('buyer_id', $user->id)->get();
        } else {
            $products = collect();
        }
        return view('profiles.mypage', compact('profile', 'products', 'page'));
    }

    public function getSignUp()
    {
        return view('profiles.setting');
    }

    public function postSignUp(ProfileRequest $request)
    {
        $user = Auth::user();
        $profile_data = new Profile();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $profile_data->image = $path;
        } else {
            $profile_data->image = null;
        }
        $profile_data->name = $request->input('name');
        $profile_data->postal_code = $request->input('postal_code');
        $profile_data->city = $request->input('city');
        $profile_data->building = $request->input('building');
        $profile_data->user_id = $user->id;
        $profile_data->save();
        return redirect('/');
    }

    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile;
        $imagePath = Session::get('image_path');
        return view('profiles.edit', compact('profile', 'user', 'imagePath'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $profile = Profile::firstOrNew(['user_id' => $user->id]);
        $form = $request->except('_token', 'image');
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $form['image'] = $path;
        }
        $profile->update($form);
        return redirect('/mypage');
    }

    public function editAddress($item_id)
    {
        $product = Product::findOrFail($item_id);
        $profile = Auth::user()->profile;
        return view('address_change', compact('product', 'profile'));
    }

    public function updateAddress(AddressRequest $request, $item_id)
    {
        $user = Auth::user();
        $profile = Profile::firstOrNew(['user_id' => $user->id]);
        $profile->postal_code = $request->input('postal_code');
        $profile->city = $request->input('city');
        $profile->building = $request->input('building');
        $profile->save();
        return redirect()->route('purchase', ['item_id' => $item_id]);
    }
}
