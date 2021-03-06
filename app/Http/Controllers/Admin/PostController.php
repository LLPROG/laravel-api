<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
    // validation with function
    private function validator($model) {
        return [

            'category_id'   => 'required|exists:App\Category,id',
            'title'         => 'required|min:3|max:100',
            'content'       => 'required',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model),
            ],
            'tags'          => 'exists:App\tag,id'
        ];
    }

    // function to shwo just personal id post
    public function myindex(Request $request) {

        $posts = Post::where('user_id', Auth::user()->id)
            ->where('id', '>', 0);
        $categories = Category::all();

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        if ($request->title) {
            $posts->where('title', 'LIKE', "%$request->title%");
        }

        $posts = $posts->paginate(20);

        return view('admin.posts.index', [
            'posts' => $posts,
            'categories'  => $categories,
            'request' => $request
        ]);
    }

    public function index(Request $request) {

        $posts = Post::where('id', '>', 0);

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        if ($request->title) {
            $posts->where('title', 'LIKE', "%$request->title%");
        }

        $posts = $posts->paginate(20);

        $categories = Category::all();

        return view('admin.posts.index', [
            'posts' => $posts,
            'categories'  => $categories,
            'request' => $request
        ]);
    }

    public function create() {
        $categories = Category::all();
        $tags = Tag::all();
        // dd($categories);
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(Request $request) {

        //validazione
        $request->validate($this->validator(null));

        $data = $request->all();

        $img_path = Storage::put('uploads', $data['post_image']);

        $formData = [
            'user_id' => Auth::user()->id,
            'post_image'  => $img_path
        ] + $data;


        preg_match_all('/#(\S*)\b/', $formData['content'], $tags_from_content);

        $tagIds = [];

        foreach ($tags_from_content[1] as $tag) {

            Tag::create([
                'name'  => $tag,
                'slug'  => Str::slug($tag)
            ]);

            $tagIds[] = $newTag->id;
        }

        $formData['tags'] = $tagIds;

        $post = Post::create($formData);

        $post->tags()->attach($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function show(Post $post) {

        return view('admin.posts.show', [
            'post' => $post,
            'pageTitle' => $post->title,
        ]);
    }

    public function edit(Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = tag::all();


        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);

    }

    public function update(Request $request, Post $post) {

        if (Auth::user()->id === $post->user_id) {


            $request->validate($this->validator($post->id));

            $formData = $request->all();

            if (array_key_exists('post_image', $formData)) {
                Storage::delete($post->post_image);

                // fino a qua non da errore
                $img_path = Storage::put('uploads', $formData['post_image']);

                // qua da errore

                $data = [
                    'post_image'  => $img_path
                ] + $formData;
            }

            // prendiamo i nuovi valori
            $post->update($data);

            $post->tags()->sync($formData['tags']);

            return redirect()->route('admin.posts.show', $post->slug);
        } abourt(404);
    }

    public function destroy(Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();

        $post->delete();

        return redirect()->back();
    }
}
