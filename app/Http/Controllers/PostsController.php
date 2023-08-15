<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => $validator->errors()->first(),
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            );
        }
        try {
            DB::beginTransaction();
            $imagePath = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public'); // Store image in the 'public' disk under 'images' directory
            }
            Post::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'status' => $request->status,
                'slug' => Str::slug($request->title),
                'content' => strip_tags($request->content),
                'path' =>$imagePath,
            ]);
            db::commit();
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'Post created Successfully',
                ],
                JsonResponse::HTTP_OK,
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
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
        $post = Post::findOrFail($id);
        return view('backend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => $validator->errors()->first(),
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            );
        }
        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => strip_tags($request->content),
            ]);
            db::commit();
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'Post updated Successfully',
                ],
                JsonResponse::HTTP_OK,
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'Post deleted Successfully',
                ],
                JsonResponse::HTTP_OK,
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function postDataTable(Request $request)
    {
        $postsQuery = Post::with('category');

        if ($request->search) {
            $postsQuery->where(function ($query) use ($request) {
                $query
                    ->where('title', 'like', '%' . $request->search . '%')
                    // ->orWhere('slug', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $postsQuery->where('status', $request->status);
        }

        $posts = $postsQuery->get();
        return DataTables::of($posts)
            ->addColumn('actions', function ($record) {
                $actions = '';
                $actions = '<div class="btn-list">';
                $actions .=
                    '<a href="' .
                    route('posts.edit', $record->id) .
                    '"  data-title="Edit Post" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </a>';
                $actions .=
                    '<button type="button" class="btn btn-sm btn-danger delete" data-url="' .
                    route('posts.destroy', $record->id) .
                    '" data-method="get" data-table="#posts_datatable">
                                    <span class="fe fe-trash-2"> </span>
                                </button>';

                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('category', function ($record) {
                return $record->category->name;
            })
            ->addColumn('title', function ($record) {
                return $record->title;
            })
            ->rawColumns(['actions', 'category', 'title'])
            ->addIndexColumn()
            ->make(true);
    }
}
