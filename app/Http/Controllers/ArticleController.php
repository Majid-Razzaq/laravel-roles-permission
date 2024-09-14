<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {           
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10); // this latest method will fetch data as orderby created_at desc
        return view('articles.list',[
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:5',
            'author' => 'required|min:3',
        ]);
        
        if($validator->fails()){
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }

        $article = new Article();
        $article->title = $request->title;
        $article->text = $request->text;
        $article->author = $request->author;
        $article->save();

        return redirect()->route('articles.index')->with('success','Article added successfully.');

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
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit',[
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:5',
            'author' => 'required|min:3',
        ]);

        if($validator->passes()){
            $article->title = $request->title;
            $article->author = $request->author;
            $article->text = $request->text;
            $article->save();

            Session()->flash('success','Article updated successfully.');
            return redirect()->route('articles.index');
        }else{
            return redirect()->route('articles.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $article = Article::find($id);

        if($article == null){
            Session()->flash('error','Article not found');
            return response()->json([
                'status' => false,
            ]);
        }

        $article->delete();

        Session()->flash('success','Article deleted successfully');
        return response()->json([
            'status' => true,
        ]);
    }
}
