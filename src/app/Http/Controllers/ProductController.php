<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Condition;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Payment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'best');

        if ($tab === 'mylist') {
            if ($user) {
                $products = $user->likedProducts()->get();
            } else {
                $products = collect();
            }
        } else {
            $products = Product::all();
        }

        return view('list', compact('products', 'tab'));
    }



    public function detail($item_id)
    {
        $product = Product::with('comments.user.profile', 'categories', 'condition', 'likedBy')->findOrFail($item_id);
        $categories = Category::all();
        $comments = Comment::with('user.profile')->where('product_id', $item_id)->latest()->get();
        $isLiked = false;
        if (auth()->check()) {
            $isLiked = $product->likedBy()->where('user_id', auth()->id())->exists();
        }
        return view('detail', compact('product', 'categories', 'comments', 'isLiked'));
    }


    public function postComment(CommentRequest $request, $item_id)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $item_id,
            'content' => $request->input('content')
        ]);
        $product = Product::with(['comments.user.profile'])->find($item_id);

        return view('detail', compact('product'));
    }


    public function toggle($item_id)
    {
        $user_id = auth()->id();
        $like = Like::where('user_id', $user_id)
            ->where('product_id', $item_id)
            ->first();
        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $user_id,
                'product_id' => $item_id,
            ]);
        }
        return back();
    }


    public function getPurchase($item_id)
    {
        $product = Product::findOrFail($item_id);
        $payments = Payment::all();
        $profile = Auth::user()->profile;
        return view('purchase', compact('product', 'payments', 'profile'));
    }





    public function postPurchase($item_id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($item_id);
        $product->buyer_id = $user->id;
        $product->status = 'sold';
        $product->save();
        return redirect('/');
    }



    public function getSell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
        // 新しく商品を出すときは、まだ売れていないので：
        // $status = 'available';
    }

    public function postSell(ExhibitionRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = preg_replace('/[^A-Za-z0-9_-]/u', '', $name);
            $filename = $safeName . '.' . $extension;

            $imagePath = $file->storeAs('images', $filename, 'public');
        }
        $product = Product::create([
            'user_id' => Auth::id(),
            'condition_id' => $request->input('condition'),
            'image' => $imagePath,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'brand' => $request->input('brand'),
            'description' => $request->input('description'),
            'status' => 'available',
        ]);
        if ($request->has('product_category')) {
            $product->categories()->attach($request->input('product_category'));
        }
        return redirect('/mypage');
    }
}
