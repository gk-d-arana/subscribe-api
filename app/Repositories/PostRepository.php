<?php


namespace App\Repositories;

use App\Events\PostAdded;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostRepository implements PostInterface {

    //implement all functions in interface


    public function validate(Request $request)
    {
         //validate request
         $request->validate([
            'title' => 'required',
            'content' => 'required',
            'website_id' => 'required|integer',
        ]);

        //get website
        $website = Website::find($request->website_id);

        //check if website exists
        if (!$website) {
            return response()->json([
                'message' => 'Website not found',
            ], 404);
        }

        return $request->all();
    }

    public function store(array $data)
    {
        $post = Post::create($data);
        //get subscribtions from website and map it into email
        $subscribtions = $post->website->subscribtions;
        $emails = $subscribtions->map(function ($subscribtion) {
            return $subscribtion->email;
        });

        PostAdded::dispatch($post, $emails);
        return;
    }

    public function getAll()
    {
        //
    }

    public function getById($id)
    {
        //
    }

    public function update($id, array $data)
    {
        //
    }

    public function delete($id)
    {
        //
    }



}
