<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'status',
        'is_parent',
        'parent_id',
        'image',
        'banner',
        'slug',
    ];


    public function getActive()
    {
        return $this->status == 1 ? 'active': 'in-active';
    }
    public function active()
    {
        return $this->status == 1 ? true: false;
    }
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->select('products.id','name_'.app()->getLocale().' as name','details_'.app()->getLocale().' as details','description_'.app()->getLocale().' as description','status','quantity', 'main_image', 'price','sale_price','sale','products.created_at','products.updated_at');
    }

    // ----------------------------------------------------------
    // ------------------------ FOR ADMIN ------------------------
    // ----------------------------------------------------------
    static function getChildrenByParentId($id){
        return Category::where(['is_parent'=> 0, 'parent_id'=>$id])->get();
    }
    static function isChild($slug){
        return Category::where(['is_parent'=> 0, 'slug'=>$slug])->firstOrFail();
    }
    /*
    static function getChildrenByParentSlug($slug){
        $category = Category::whereSlug($slug)->firstOrFail();
        return Category::where(['slug' => $slug,'is_parent'=> 0, 'parent_id'=>$category->id])->get();
    }
    */

    // ----------------------------------------------------------
    // ------------------------ FOR SITE ------------------------
    // ----------------------------------------------------------

    static function activeParent(){
        return Category::where(['is_parent'=> 1, 'status'=>1])->select('id','name_'.app()->getLocale().' as name','status','is_parent', 'image', 'banner','slug','parent_id','created_at','updated_at');
    }
    static function getActiveChildrenByParentSlug($slug){
        $category = Category::whereSlug($slug)->firstOrFail();
        return Category::where(['is_parent'=> 0,'status' => 1, 'parent_id'=>$category->id])->get();
    }
}
