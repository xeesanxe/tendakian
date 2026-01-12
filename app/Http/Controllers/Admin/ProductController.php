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
                ->with('error', "Cannot permanently delete product '{$product->name}'. It is referenced in {$orderItemsCount} order(s). You can set the product as inactive or use soft delete instead.");
        }
        
        try {
            // Delete image if exists
            if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            
            // Hard delete (permanent)
            $productName = $product->name;
            $product->forceDelete();
            
            return redirect()->route('admin.products.index')
                ->with('success', "Product '{$productName}' has been permanently deleted!");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    /**
     * Soft delete product (recommended for products with order history)
     */
    public function softDelete($id)
    {
        try {
            $product = Product::findOrFail($id);
            $productName = $product->name;
            
            // Soft delete - keeps data but marks as deleted
            $product->delete();
            
            return redirect()->route('admin.products.index')
                ->with('success', "Product '{$productName}' has been moved to trash. You can restore it later if needed.");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }

    /**
     * Restore soft deleted product
     */
    public function restore($id)
    {
        try {
            $product = Product::withTrashed()->findOrFail($id);
            
            if (!$product->trashed()) {
                return redirect()->route('admin.products.index')
                    ->with('error', 'Product is not deleted.');
            }
            
            $product->restore();
            
            return redirect()->route('admin.products.index')
                ->with('success', "Product '{$product->name}' has been restored successfully!");
                
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Failed to restore product: ' . $e->getMessage());
        }
    }

    /**
     * Show trashed (soft deleted) products
     */
    public function trashed(Request $request)
    {
        $q = $request->query('q');
        
        $query = Product::onlyTrashed();
        
        if ($q) {
            $query->where('name', 'like', '%'.$q.'%')->orWhere('sku','like','%'.$q.'%');
        }
        
        $products = $query->orderBy('deleted_at','desc')->paginate(12);
        
        return view('admin.products.trashed', compact('products','q'));
    }

    /**
     * Bulk delete products
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'delete_type' => 'required|in:soft,hard'
        ]);

        $productIds = $request->product_ids;
        $deleteType = $request->delete_type;
        
        try {
            if ($deleteType === 'hard') {
                // Check if any products are used in orders
                $usedInOrders = \App\Models\OrderItem::whereIn('product_id', $productIds)->exists();
                
                if ($usedInOrders) {
                    return redirect()->back()
                        ->with('error', 'Some products cannot be permanently deleted because they are referenced in orders. Use soft delete instead.');
                }
                
                // Delete images for hard delete
                $products = Product::whereIn('id', $productIds)->get();
                foreach ($products as $product) {
                    if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
                    }
                }
                
                // Hard delete
                $deletedCount = Product::whereIn('id', $productIds)->forceDelete();
                $message = "Successfully permanently deleted {$deletedCount} product(s).";
                
            } else {
                // Soft delete
                $deletedCount = Product::whereIn('id', $productIds)->delete();
                $message = "Successfully moved {$deletedCount} product(s) to trash.";
            }
            
            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete products: ' . $e->getMessage());
        }
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
