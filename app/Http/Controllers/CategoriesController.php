<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,Inactive',
        ]);
        $category = Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,Inactive',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $category = Category::findOrFail($id);
             $category->delete();
             return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' =>"Category deleted Sucessfully"
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);


        }
    }

    public function dataTable()
    {
        $categories = Category::where('status' , 'active')->get();
        return DataTables::of($categories)
        ->addColumn('actions', function ($record) {
            $actions = '';
                $actions = '<div class="btn-list">';
                    $actions .= '<a href="'.route('categories.edit', $record->id).'"  data-title="Edit Category" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-danger delete" data-url="' . route('categories.destroy', $record->id) . '" data-method="get" data-table="#categories_datatable">
                                    <span class="fe fe-trash-2"> </span>
                                </button>';

                $actions .= '</div>';
            return $actions;
        })
        ->addColumn('name', function ($record) {
            return $record->name;
        })
        ->addColumn('status', function ($record) {
            return $record->status;
        })
        ->rawColumns(['actions', 'name', 'status'])
        ->addIndexColumn()->make(true);
    }
}
