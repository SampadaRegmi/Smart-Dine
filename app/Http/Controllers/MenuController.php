<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        // Use bootstrap pagination
        Paginator::useBootstrap();
        // Grab menus with the latest and paginate 20 menus
        $menu = Menu::latest()->paginate(20);
        // Return the view for menu index
        return view('Admin.Pages.Menu.index', compact('menu'));
    }

    public function create()
    {
        return view('Admin.Pages.Menu.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'status' => $request->input('status', 0),
            'popular' => $request->input('popular', 0),
        ]);
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'keywords' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,gif', 'max:2048'],
            'price' => ['required', 'numeric'],
            'status' => ['required', 'integer', 'min:0'],
            'popular' => ['required', 'integer', 'min:0'],
            'FoodCategory' => ['required', Rule::in(Menu::FoodCategory)],
            'CourseCategory' => ['required', Rule::in(Menu::CourseCategory)],
        ]);        

        $data = $request->all();

        // Store the image
        $image_title = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgpath = 'upload/menu/';
            $imgname = now()->format('ymdhis') . rand(10000, 99999) . '.' . $img->getClientOriginalExtension();
            $img->move($imgpath, $imgname);
            $image_title = $imgpath . $imgname;
        }

        // Set the image name
        $data['image'] = $image_title;

        // Create data in the table
        Menu::create($data);

        return redirect(route('menu.index'))->with('success', 'Menu Created Successfully!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menuItems = Menu::all();

        return view('Admin.Pages.Menu.edit', compact('menu', 'menuItems'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->merge([
            'status' => $request->input('status', 0),
            'popular' => $request->input('popular', 0),
        ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'keywords' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,gif', 'max:2048'],
            'price' => ['required', 'numeric'],
            'status' => ['required', 'integer', 'min:0'],
            'popular' => ['required', 'integer', 'min:0'],
            'FoodCategory' => ['required', Rule::in(Menu::FoodCategory)],
            'CourseCategory' => ['required', Rule::in(Menu::CourseCategory)],
        ]);
        

        // Set default values for status and popular
        $data = $request->filled('status') ? $request->all() : array_merge($request->all(), ['status' => 0]);
        $data = $request->filled('popular') ? $data : array_merge($data, ['popular' => 0]);

        // Store the image
        $image_title = $menu->image;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgpath = 'upload/menu/';
            $imgname = now()->format('ymdhis') . rand(10000, 99999) . '.' . $img->getClientOriginalExtension();
            $img->move($imgpath, $imgname);
            $image_title = $imgpath . $imgname;
        }

        // Set the image name
        $data['image'] = $image_title;

        // Update data in the table
        $menu->update($data);

        return redirect(route('menu.index'))->with('success', 'Menu Updated Successfully!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return back()->with('success', 'Menu Deleted Successfully!');
    }

    public function category()
    {
        $menuItems = Menu::all(); // Fetch all menu items using the Menu model
        return view('User.Layouts.Menu.category', compact('menuItems'));
    }

    public function showAppetizers()
    {
        $menuItems = Menu::where('CourseCategory', 'appetizers')->get();
        return view('User.Layouts.Menu.appetizers', ['menuItems' => $menuItems]);
    }

    public function showDesserts()
    {
        $menuItems = Menu::where('CourseCategory', 'desserts')->get();
        return view('User.Layouts.Menu.desserts', ['menuItems' => $menuItems]);
    }

    public function showDrinks()
    {
        $menuItems = Menu::where('CourseCategory', 'drinks')->get();
        return view('User.Layouts.Menu.drinks', ['menuItems' => $menuItems]);
    }

    public function showEntree()
    {
        $menuItems = Menu::where('CourseCategory', 'entree')->get();
        return view('User.Layouts.Menu.entree', ['menuItems' => $menuItems]);
    }

    public function showSalads()
    {
        $menuItems = Menu::where('CourseCategory', 'salads')->get();
        return view('User.Layouts.Menu.salads', ['menuItems' => $menuItems]);
    }

    public function showCombos()
    {
        $menuItems = Menu::where('CourseCategory', 'combos')->get();
        return view('User.Layouts.Menu.combos', ['menuItems' => $menuItems]);
    }

    public function showMenu()
    {
        // Retrieve menu items from the database with eager loading of reviews relationship
        $menuItems = Menu::with('reviews')->get();
        
        // Calculate average rating for each menu item
        $menuItems->transform(function ($menuItem) {
            $totalReviews = $menuItem->reviews->count();
            $totalRating = $menuItem->reviews->sum('rating');
            $menuItem->averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
            return $menuItem;
        });

        return view('menu', compact('menuItems'));
    }

    public function search(Request $request)
    {
        $keywords = $request->input('keywords');

        // Use where clause to search for keywords in name or description
        $menuItems = Menu::where('name', 'like', '%' . $keywords . '%')
                        ->orWhere('description', 'like', '%' . $keywords . '%')
                        ->orWhere('CourseCategory', 'like', '%' . $keywords . '%')
                        ->orWhere('FoodCategory', 'like', '%' . $keywords . '%')
                        ->get();

        return view('User.Layouts.Menu.category', compact('menuItems'));
    }

    public function showReviews(Menu $menu)
    {
        // Retrieve the menu item corresponding to the given menu ID
        $menuItem = $menu;

        // Retrieve reviews for the given menu item
        $reviews = $menu->reviews;

        // Pass the menu item and reviews to the view
        return view('orders.readReviews', compact('menuItem', 'reviews'));
    }

}
