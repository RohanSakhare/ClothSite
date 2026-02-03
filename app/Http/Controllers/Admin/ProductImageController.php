<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    //
    public function destroy(Request $request, ProductImage $image)
    {
        // delete image file
        Storage::disk('public')->delete($image->image);

        // delete DB record
        $image->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Image deleted successfully');
    }

    public function reorderImages(Request $request)
    {
        foreach ($request->order as $item) {
            ProductImage::where('id', $item['id'])
                ->update(['position' => $item['position']]);
        }

        return response()->json(['success' => true]);
    }
}
