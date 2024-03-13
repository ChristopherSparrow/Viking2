<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;


class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function edit($newsId)
    {
        $news = News::findOrFail($newsId);
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, $newsId)
    {
        $news = News::findOrFail($newsId);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        $news->update($request->all());

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($newsId)
    {
        $news = News::findOrFail($newsId);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
