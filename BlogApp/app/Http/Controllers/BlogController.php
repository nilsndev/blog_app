<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function getAllBlogs(){
        $blogs = Blog::all();

        return response([
            'message' => "Blogs founded",
            'blogs' => $blogs
        ]);
    }
    public function getAllBlogsByUID($uId){
        $blogs = Blog::where('userID', $uId)->get();

        return response([
            'message' => "Blogs founded",
            'blogs' => $blogs
        ]);
    }
    public function addBlog(Request $request){
        try {
            $blog = Blog::create([
                'userID' => $request->input("userID"),
                'titel' => $request->input("titel"),
                'blogContent' => $request->input("blogContent")
            ]);
            return response([
                'message' => "Blog added Successfully",
                'Blog' => $blog
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response([
                'message' => 'Failed to add blog: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function updateABlog(Request $request){
        $blog = Blog::where('id',$request->input("id"))->first();
        if($blog){
            $blog->userID = $request->input("userID");
            $blog->titel = $request->input("titel");
            $blog->blogContent = $request->input("blogContent");
            $blog->save();
            return response([
                'message' => "Blog added Successfully",
                'Blog' => $blog
            ], Response::HTTP_CREATED);
        }
        else{
            return response([
                'message' => "Blog not found"
            ], Response::HTTP_NOT_FOUND);
        }

    }
    public function delete($id){
        Blog::where('id', $id)->delete();
        return response([
            'message' => 'Blog Deleted',
        ]);
    }

    public function getOneBlog($id){
        $blog = Blog::where('id',$id)->first();
        return response([
            'message' => 'Blog founded',
            'blog' => $blog,
        ]);
    }

}
