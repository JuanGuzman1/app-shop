<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        $images = $product->images->orderBy('featured','desc')->get();
        return view('admin.products.images.index')->with(compact('product','images'));
    }

    public function store(Request $request, $id){
        //guardar la imagen en nuestro proyecto
            $file = $request->file('photo');
            $path = public_path() . '/images/products';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
        //crear 1 reg en BD, product_images
        
        if($moved){
            
        $productImage = new ProductImage();
        $productImage->image = $fileName;
        //$productImage->featured = false;
        $productImage->product_id = $id;
        $productImage->save(); //Insert

        }

        return back();
        
    } 

    public function destroy(Request $request, $id){

        //eliminar el archivo
        $productImage = ProductImage::find($request-> image_id);
        if(substr($productImage->image,0,4) === "http"){
            $deleted = true;
        }else{
            $fullPath = public_path() . '/images/products/' . $productImage->image;
            File::delete($fullPath);
            $deleted = File::delete($fullPath);
        }
        //eliminar el registro en la BD

        if($deleted){
            $productImage->delete();
        }

        return back();

    }


    public function select ($id, $image)
    {
        ProductImage::where('product_id',$id)->update([
            'featured' => false
        ]);

        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();

    }
}
