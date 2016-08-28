<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Post;
use App\Services\PostFormFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Shows the list of all the post
     * @return mixed
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest('created_at')->paginate(10);
        return view('admin.post.index')
            ->with(['posts' => $posts, 'categories' => $categories]);
    }


    /**
     * Search the specific post by keyword
     * @param Request $request
     * @return mixed
     */
    public function searchPost(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);
        $categories = Category::all();
        $query = $request['search'];
        $posts = Post::where('title', 'LIKE', '%' . $query . '%')->paginate(500);
        return view('admin.post.index')
            ->with(['posts' => $posts, 'categories' => $categories]);
    }


    /**
     * Fileters the post by cateogry type
     * @param Request $request
     * @return mixed
     */
    public function filterPost(Request $request)
    {

        $this->validate($request, [
            'category_id' => 'required',
            'post_id' => 'integer'
        ]);


        $id = e($request['category_id']);
        $post_id = e($request['post_id']);

        if (!empty($post_id)) {
            $categories = Category::all();
            $posts = Post::where('id', '=', $post_id)->paginate(10);
            return view('admin.post.index')
                ->with(['posts' => $posts, 'categories' => $categories]);


        } else {
            $categories = Category::all();
            $posts = Category::where('id', '=', $id)->first()->posts()->latest('created_at')->paginate(500);
            return view('admin.post.index')
                ->with(['posts' => $posts, 'categories' => $categories]);
        }

    }

    /**
     * Creates post request
     * @return mixed
     */
    public function create()
    {
        $postSerivce = new PostFormFields();
        $data = $postSerivce->getFields();

        return view('admin.post.create', $data);
    }

    /**
     * Stores the post in database
     * @param PostCreateRequest $request
     * @return mixed
     */
    public function store(PostCreateRequest $request)
    {



        if ($post = Auth::user()->posts()->create($request->postFillData())) {


            $post->syncTags($request->get('tags', []));
            $post->syncCategories($request->get('categories', []));

            return redirect()
                ->route('post.index')
                ->withSuccess('New Post Successfully Created.');
        }


    }

    /**
     * Edit the post
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $postSerivce = new PostFormFields($id);
        $data = $postSerivce->getFields();


        return view('admin.post.edit', $data);
    }

    /**
     * Updates the post
     * @param PostUpdateRequest $request
     * @param $id
     * @return mixed
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->syncTags($request->get('tags', []));
        $post->syncCategories($request->get('categories', []));


        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->withSuccess('Post saved.');
        }

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post saved.');
    }

    /**
     * Removes the post from storage
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->categories()->detach();
        $post->delete();

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post deleted.');
    }
}
