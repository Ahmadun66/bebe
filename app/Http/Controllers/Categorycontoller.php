<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\Request;

class Categorycontoller extends Controller
{

    public function index()
    {
        $category = Category::all();
        return response()->json([
            'status'=>200,
            'category'=>$category,
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if($category)
        {
            return response()->json([
                'status'=>200,
                'category'=>$category
            ]);
        }
        else {
            return response()->json([
                'status'=>404,
                'message'=>'Object not found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required|max:191',
            'slug' => 'required|max:191',
            'name' => 'required|max:191',

    ]);
    if($validator->fails())
    {
        return response()->json([
            'status' => 400,
            'errors' => $validator->getMessageBag()
        ]);
    }
    else {
        $category = Category::find($id);
        if($category)
        {
            $category->name = $request->input('name');
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => 'Succes Updatee'
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ]);
        }
  }    

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'required|max:191',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        }
        else {
            $category = new Category;
                $category->name = $request->input('name');
                $category->save();

        return response()->json([
            'status' => 200,
            'message' => 'Succes Added'
        ]);
        }
    }

    public function destroy ($id)
    {
        $category = Category::find($id);
        if($category)
        {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success Delete'
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No Category Found'
            ]);
        }
    }

    public function allcategory()
    {
        $category = Category::where('status','0')->get();
        return response()->json([
            'status'=>200,
            'category'=>$category,
        ]);
    }

    public function getbyslug($id)
    {
        $category = Category::where('slug', $id)->get();
        if($category)
        {
            $category->delete();
            return response()->json([
                'status' => 200,
                'category' => $category
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No Category Found'
            ]);
        }
    }
}
