<?php

namespace App\Http\Controllers;

use App\Models\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slug  = Slug::all();
        return response()->json([
            'status' => 200,
            'products' => $slug
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_slug' => 'required',

        ]);
        if ($validator) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $slug = new Slug;
            $slug->name_slug = $request->input('name_slug');

            $slug->save();

            return response()->json([
                'status' => 200,
                'message' => 'Add Success',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Slug $slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slug = Slug::find($id);
        if ($slug) {

            return response()->json([
                'status' => 200,
                'slug' => $slug
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No slug Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_slug' => 'required',

        ]);
        if ($validator) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->getMessageBag(),
            ]);
        } else {
            $slug = Slug::find($id);
            if ($slug) {
                $slug->name_slug = $request->input('name_slug');

                $slug->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Add Success',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Not Found',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slug = Slug::find($id);
        if($slug)
        {
            $slug->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success Delete'
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No Found'
            ]);
        }
    }
}
