<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\ExampleNotification;
use Illuminate\Support\Facades\Notification;

class CategoryController extends Controller
{
    //direct Categroy List Page
    public function list() {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
    return view('admin.category.list', compact('categories'));

    }

    public function create(Request $request) {
    $this->validateCategory($request);
        // Create a new category
        Category::create([
            'name'=>$request->categoryName
        ]);
        $token  = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id'    => $chatId,
            'text'       => "📂 New Category Created: *{$request->categoryName}*",
            'parse_mode' => 'Markdown',
        ]);

     Alert::success('Success Title', 'Category created successfully');

        return back();
    }



    //categroy validation
    private function validateCategory($request){
        $request->validate([
        'categoryName'=> 'required|min:3|max:20|unique:categories,name,'.$request->id,
        ],[
            'categoryName.required' => 'Please enter a category name',
            'categoryName.min' => 'Category name must be at least 3 characters',
            'categoryName.max' => 'Category name must not exceed 20 characters',
            'categoryName.unique' => 'This category name already exists',
        ]);
    }

    public function delete($id) {
        // Find the category by ID
   // 1. Find the category
    $category = Category::findOrFail($id); // throws 404 if not found
    $categoryName = $category->name;       // store name before delete

    // 2. Delete it
    $category->delete();

    // 3. Send Telegram notification
    $token  = env('TELEGRAM_BOT_TOKEN');
    $chatId = env('TELEGRAM_CHAT_ID');

    Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
        'chat_id'    => $chatId,
        'text'       => "📂 Category Deleted: *{$categoryName}*",
        'parse_mode' => 'Markdown',
    ]);

    // 4. Flash local success message
    Alert::success('Success', 'Category deleted successfully');

    return back();
    }

    public function edit($id){
        $category=Category::where('id', $id)->first();
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $id){
        $this->validateCategory($request);

        Category::where('id', $id)->update([
            'name' => $request->categoryName
        ]);
        Alert::success('Success Title', 'Category updated successfully');
        return redirect()->route('category#list');
    }
}
