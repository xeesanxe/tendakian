<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status', 'active'); // default to active only
        
        $query = Product::query();
        
        if ($q) {
            $query->where('name', 'like', '%'.$q.'%')->orWhere('sku','like','%'.$q.'%');
        }
        
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        } elseif ($status === 'all') {
            // Show all products
        }
        
        $products = $query->orderBy('id','desc')->paginate(12);
        return view('admin.products.index', compact('products','q','status'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle checkbox for is_active
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                
                // Store new image
                $path = $request->file('image')->store('products', 'public');
                $data['image'] = $path;
                
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }

        try {
            $product->update($data);
            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Check if product is used in any order items
        $orderItemsCount = \App\Models\OrderItem::where('product_id', $id)->count();
        
        if ($orderItemsCount > 0) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Cannot delete product. It is referenced in ' . $orderItemsCount . ' order(s). You can set the product as inactive instead.');
        }
        
        // Delete image if exists
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle checkbox for is_active (default to true for new products)
        $data['is_active'] = $request->has('is_active') ? true : true;

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $path = $request->file('image')->store('products', 'public');
                $data['image'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to upload image: ' . $e->getMessage());
            }
        }

        try {
            Product::create($data);
            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();
        
        $status = $product->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.products.index')->with('success', "Product {$status} successfully!");
    }
}
