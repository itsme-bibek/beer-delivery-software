<?php

namespace App\Http\Controllers\Admin;

use App\Models\Beer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Show the form for creating a new beer.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu()

    {
        $beers = Beer::latest()->get();
        return view('frontend.admin.menu.menu', compact('beers'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'alcohol_percentage' => 'required|numeric|min:0|max:100',
            'origin' => 'required|string|max:255',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::slug($validatedData['name']) . '-' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('beers', $filename, 'public');
                $validatedData['image'] = $path;
            }

            Beer::create($validatedData);

            return redirect()->route('admin.beers.index')
                ->with('success', 'Beer added successfully!');
        } catch (\Exception $e) {
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()->withInput()
                ->with('error', 'Error adding beer: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $beer = Beer::findOrFail($id);

        $rules = [
            'name'               => 'required|string|max:255',
            'category'           => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock'              => 'required|integer|min:0',
            'price'              => 'required|numeric|min:0',
            'alcohol_percentage' => 'required|numeric|min:0|max:100',
            'origin'             => 'required|string|max:255',
            'description'        => 'required|string',
        ];

        $data = $request->validate($rules);

        $beer->fill($data);

        if ($request->hasFile('image')) {
            $beer->image = $request->file('image')->store('beers', 'public');
        }

        $beer->save();

        return redirect()->back()->with('success', 'Beer updated successfully!');
    }







    // public function destroy(Beer $beer)
    // {
    //     try {
    //         // Delete the associated image
    //         if ($beer->image && Storage::disk('public')->exists($beer->image)) {
    //             Storage::disk('public')->delete($beer->image);
    //         }

    //         $beer->delete();

    //         return redirect()->route('admin.beers.index')
    //             ->with('success', 'Beer deleted successfully!');

    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Error deleting beer: ' . $e->getMessage());
    //     }
    // }
}
