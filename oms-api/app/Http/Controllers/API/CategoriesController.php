<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return parent::resp(true, Category::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
            'title' => 'required|unique:categories,title'
        ]);

        $image = $request->file('image');
        
        $img = Image::make($image);
        $img->resize(512, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg');

        
        $fileName = Str::slug($request->title, '-') . Carbon::now()->format('Ymdhi');
        $filenameWithExt = $fileName . '.' . $image->extension();
        $path = "/categories/{$filenameWithExt}";

        try {
            Category::create([
                'title' => $request->title,
                'image' => $path
            ]);

            Storage::put($path, $img->__toString());

            return parent::resp(true, 'Category Created!', 201);
        } catch (Exception $ex) {
            return parent::resp(false, $ex->getMessage(), 422);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $path = $category->image;
        try {

            if ($request->image != $category->image){
                $image = $request->file('image');
            
                $img = Image::make($image);
                $img->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg');

                
                $fileName = Str::slug($request->title, '-') . Carbon::now()->format('Ymdhi');
                $filenameWithExt = $fileName . '.' . $image->extension();
                $path = "/categories/{$filenameWithExt}";

                Storage::put($path, $img->__toString());
            }
 
        
            $category->update([
                'title' => $request->title,
                'image' => $path
            ]);
            return parent::resp(true, 'Category Updated!', 201);
        } catch (Exception $ex) {
            return parent::resp(false, 'Failed Category Updated!', 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory()
    {
        $category = Category::findOrFail(request()->id);
        try {
            // $file = $category->image;
            // Storage::delete($file);
            $category->delete();
            return parent::resp(true, 'Successfully Deleted', 201);
        } catch (Exception $ex) {
            return parent::resp(false, 'Failed', 422);
        }
    }
}
