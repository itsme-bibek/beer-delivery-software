<?php

namespace App\Http\Controllers\Admin;

use App\Models\Beer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class BeerController extends Controller
{
    public function index()
    {
        $beers = Beer::all();
        return view('frontend.admin.menu.menu', compact('beers'));
    }

    public function create()
    {
        return view('admin.beers.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'               => 'required|string|max:255',
            'category'           => 'required|string|max:255',
            'image'              => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'stock'              => 'required|integer|min:0',
            'price'              => 'required|numeric|min:0',
            'alcohol_percentage' => 'required|numeric|min:0|max:100',
            'origin'             => 'required|string|max:255',
            'description'        => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There was a problem while storing the data.');
        }

        $data = $validator->validated();

        // Create Beer object
        $beer = new Beer();
        $beer->name               = $data['name'];
        $beer->category           = $data['category'];
        $beer->stock              = $data['stock'];
        $beer->price              = $data['price'];
        $beer->alcohol_percentage = $data['alcohol_percentage'];
        $beer->origin             = $data['origin'];
        $beer->description        = $data['description'];

        if ($request->hasFile('image')) {
            $beer->image = $request->file('image')->store('beers', 'public');
        }

        $beer->save();

        return redirect()->route('admin.menu')->with('success', 'Beer added successfully!');
    }



    public function edit(Beer $beer)
    {
        return view('frontend.admin.menu.editmenu', compact('beer'));
    }

    public function update(Request $request, Beer $beer)
    {
        $rules = [
            'name'               => 'required|string|max:255',
            'category'           => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional on update
            'stock'              => 'required|integer|min:0',
            'price'              => 'required|numeric|min:0',
            'alcohol_percentage' => 'required|numeric|min:0|max:100',
            'origin'             => 'required|string|max:255',
            'description'        => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There was a problem while updating the data.');
        }

        $data = $validator->validated();

        // Update Beer object
        $beer->name               = $data['name'];
        $beer->category           = $data['category'];
        $beer->stock              = $data['stock'];
        $beer->price              = $data['price'];
        $beer->alcohol_percentage = $data['alcohol_percentage'];
        $beer->origin             = $data['origin'];
        $beer->description        = $data['description'];

        // Handle new image if uploaded
        if ($request->hasFile('image')) {
            // Optional: delete old image
            if ($beer->image && Storage::disk('public')->exists($beer->image)) {
                Storage::disk('public')->delete($beer->image);
            }
            $beer->image = $request->file('image')->store('beers', 'public');
        }

        $beer->save();

        return redirect()->route('admin.menu')->with('success', 'Beer updated successfully!');
    }


    public function destroy(Beer $beer)
    {
        $beer->delete();
        return redirect()->route('admin.menu')->with('success', 'Beer deleted successfully!');
    }
}
