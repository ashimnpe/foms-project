<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return parent::resp(true, Category::with('products')->get(), 200);
    }

    public function getAllProducts()
    {
        $products = Product::with('category')->get();
        return parent::resp(true, $products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products,title',
            'category_id' => 'required',
            'price' => 'required|numeric'
        ]);

        $image = $request->file('image');

        $img = Image::make($image);
        $img->resize(512, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg');


        $fileName = Str::slug($request->title, '-') . Carbon::now()->format('Ymdhi');
        $filenameWithExt = $fileName . '.' . $image->extension();
        $path = "/products/{$filenameWithExt}";

        try {
            Product::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'image' => $path
            ]);

            Storage::put($path, $img->__toString());

            return parent::resp(true, 'Product Created!', 201);
        } catch (Exception $ex) {
            return parent::resp(false, $ex->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $path = $product->image;
        try {
            if ($request->image != $product->image) {
                $image = $request->file('image');

                $img = Image::make($image);
                $img->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');


                $fileName = Str::slug($request->title, '-') . Carbon::now()->format('Ymdhi');
                $filenameWithExt = $fileName . '.' . $image->extension();
                $path = "/products/{$filenameWithExt}";

                Storage::put($path, $img->__toString());
            }


            $product->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'image' => $path
            ]);
            return parent::resp(true, 'Product Updated!', 201);
        } catch (Exception $ex) {
            return parent::resp(false, 'Failed Product Updated!', 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct()
    {
        $product = Product::findOrFail(request()->id);
        try {
            $product->delete();
            return parent::resp(true, 'Successfully Deleted', 201);
        } catch (Exception $ex) {
            return parent::resp(false, 'Failed', 422);
        }
    }
}