<?php namespace MVP\WulingEPP\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use MVP\WulingEPP\Models\Banner;
use Illuminate\Http\Request;

class Banners extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return View::make('mvp.wulingepp::banners.index', ['banners' => $banners]);
    }

    public function create()
    {
        return View::make('mvp.wulingepp::banners.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'link' => 'required|url',
            'image' => 'required|image',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $banner = new Banner;
        $banner->link = $validatedData['link'];
        $banner->image_path = $request->file('image')->store('banners', 'public');
        $banner->order = $validatedData['order'];
        $banner->is_active = $request->has('is_active');
        $banner->save();

        return redirect()->route('mvp.wulingepp.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return View::make('mvp.wulingepp::banners.edit', ['banner' => $banner]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'link' => 'required|url',
            'image' => 'image',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $banner = Banner::findOrFail($id);
        $banner->link = $validatedData['link'];
        if ($request->hasFile('image')) {
            $banner->image_path = $request->file('image')->store('banners', 'public');
        }
        $banner->order = $validatedData['order'];
        $banner->is_active = $request->has('is_active');
        $banner->save();

        return redirect()->route('mvp.wulingepp.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('mvp.wulingepp.banners.index')->with('success', 'Banner deleted successfully.');
    }
}