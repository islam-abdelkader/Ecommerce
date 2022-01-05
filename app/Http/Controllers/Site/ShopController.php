<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainCategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index(){
        $categories = Category::activeParent()->paginate(PAGINATION_COUNT);
        return view('site.pages.shop.index', get_defined_vars());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request,$slug)
    {
        $category = Category::where(['slug'=>$slug])->select('id','name_'.app()->getLocale().' as name','status','is_parent', 'image', 'banner','slug','parent_id','created_at','updated_at')->firstOrFail();
        // return $sub_categories = $category->getActiveChildrenByParentSlug($slug);
        if ($category->parent) {
            // if Sub Category
            $sub_categories = $category->getActiveChildrenByParentSlug($category->parent->slug);
        } else {
            // if Main Category
            $sub_categories = $category->getActiveChildrenByParentSlug($slug);
        }
        if (request()->has('sort')) {
            switch (request()->get('sort')) {
                case 'low-to-high':
                    $products = $category->products()->with('images')->orderBy('price', 'ASC')->paginate(PAGINATION_COUNT);
                    # code...
                    break;
                case 'high-to-low':
                    # code...
                    $products = $category->products()->with('images')->orderBy('price', 'DESC')->paginate(PAGINATION_COUNT);
                    break;
                default:
                    $products = $category->products()->with('images')->paginate(PAGINATION_COUNT);
                    break;
            }
        } else {

            $products = $category->products()->with('images')->paginate(PAGINATION_COUNT);
        }
        return view('site.pages.shop.products', get_defined_vars());
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function product(Request $request,$slug)
    {
        $product = Product::activeProductBySlug($slug);
        // $reviews = $product->reviews;
        $reviews = $product->reviews->load('user');
        $orders = $product->orders->pluck('user_id')->toArray();
        if($product->status === 0){
            return view('site.pages.shop.show')->with('error','Sorry..! Product unAvailable Now');
        }
        return view('site.pages.shop.show',get_defined_vars());
    }
}