<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Crypt;

class ProductController extends Controller
{
    //This MEthod Will Show the Products Page
    public function index(){
        $products = Product::orderBy('id','DESC')->get();
        return view('products.list',compact('products'));
    }

    // This Method will go Create a product page 
    public function create(){
        return view('products.create');
    }

     // This Method will go Store a product in the DataBase 
     public function store(Request $request){

        $validated = Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            
            'image'=>"required|image|max:8048",
           
        ]);
        if($validated->fails())
        {  
            
            return redirect()->back()->withErrors($validated);
        }
        
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
       
       
        if($request->has('image')){
            $file_name  = time().mt_rand(0000,9999).'.'.$request->image->extension();
            $request->image->move(public_path('uploads/products'),$file_name);
            $product->image = $file_name;
        }
        $product->save(); 
        if($product)
        {
            return redirect('/')->with('success','product Addedd Successfully');
        }else{
            return redirect()->back()->with('error','product Not Addedd Successfully');
        }
    

     }

     // This Method will go and  Edit a product in the DataBase 
     public function edit($id){

        try{
           
        $data = Product::findorfail(Crypt::decrypt($id));
            if($data)
            {
                return view('products.edit',compact('data'));
            }else{
                return redirect('/')->with('error','Failed to Find data');
            }
            }catch(\Exception $e)
            {
                return redirect('/')->with('error','Something Went wrong Contact Admin'.$e->getMessage());
            }


     }

    //  this function update the data 

     public function update(Request $request)
     {
         // Validate the input data, including the image if present
         $request->validate([
             'id' => 'required|exists:products,id',
             'name' => 'required|string|max:255',
             'price' => 'required|numeric',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'description' => 'required|string|max:1000',
         ]);
 
         // Find the product by id
         $product = Product::find($request->input('id'));
 
         // If the product is not found, return an error response or redirect back
         if (!$product) {
             return redirect()->back()->withErrors(['error' => 'Product not found']);
         }
 
         // Update the product's data
         $product->name = $request->input('name');
         $product->price = $request->input('price');
         $product->description = $request->input('description');
 
         // Handle the image upload if there's an image in the request
         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imageName = time() . '.' . $image->getClientOriginalExtension();
             $request->image->move(public_path('uploads/products'),$imageName);
             $product->image = $imageName;
         }
 
         // Save the updated product data to the database
         $product->save();
 
         // Redirect back with a success message
         return redirect('/')->with('success', 'Product updated successfully');
     }
     // This Method will Delete product in the DataBase 
     public function delet(Request $request){
        

            $id = Crypt::decrypt($request->id);
            $data = Product::where('id',$id)->delete() ;
            if($data){
                echo 'true';
            }else{
                echo 'false';
            }
        

     }

         // Method to fetch and return product details
     // Method to fetch and return product details
     public function show($id)
     {
        
        $product = Product::findorfail(Crypt::decrypt($id));
        dd($product);
         if (!$product) {
             return response()->json(['error' => 'Product not found'], 404);
         }
 
         return response()->json($product);
     }

}
