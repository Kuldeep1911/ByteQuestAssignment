<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $product;
    public function __construct(){
        $this->product = new product();
        
    }
    public function index()
    {
        return $this->product->all();
     
    }
    
    public function store(Request $request)
    {
     return $this->product->create($request->all());
    
       
    }
  
    public function show(string $id)
    {
     $product = $this->product->find($id); 
     return $product; 
    }
    public function update(Request $request, string $id)
    {
         $product = $this->product->find($id);
         $product->update($request->all());
         return $product;
    }
    public function destroy(string $id)
    {
        $product = $this->product->find($id);
        
        if (!$product) {
            Log::error("Product not found: ID $id");
            return response()->json(['error' => 'Product not found'], 404);
        }

        $deleted = $product->delete();
        Log::info("Product deleted: ID $id, success: $deleted");
        
        return response()->json(['success' => $deleted]);
    }
}