<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Session;
use App\Article;
use App\ArticleCategory;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::with( 'article_category' )->get();
        return view( 'pages.admin.article.index', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['content'] = null;
        $data['article_category'] = ArticleCategory::lists( 'name', 'id' );

        return view( 'pages.admin.article.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $data = [];

        $data['article_category_id'] = $request->get( 'article_category_id' );
        $data['title'] = $request->get( 'title' );
        $data['description'] = $request->get( 'description' );

        if ( $request->file( 'image' ) != null ) {
            if ( !( $request->file( 'image' )->isValid() ) ) {
                Session::flash( 'warning', "Gambar tidak berhasil disimpan!" );
                return redirect()
                       ->back()
                       ->withInput();
            }
            $data['image'] = time() . '.' . $request->file( 'image' )->getClientOriginalExtension();
            $request->file( 'image' )->move( 'img/article', $data['image'] );
        }

        Article::create( $data );
        Session::flash( 'success', "Artikel baru berhasil disimpan!" );
        return redirect()
               ->route( 'admin.article.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['content'] = Article::with( 'article_category' )
                                  ->where( 'id', $id )
                                  ->first();

        return view( 'pages.admin.article.show', compact( 'data' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['content'] = Article::find( $id );
        $data['article_category'] = ArticleCategory::lists( 'name', 'id' );

        return view( 'pages.admin.article.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $data = [];
        $article = Article::find( $id );

        $data['article_category_id'] = $request->get( 'article_category_id' );
        $data['title'] = $request->get( 'title' );
        $data['description'] = $request->get( 'description' );

        if ( $request->file( 'image' ) != null ) {
            if ( !( $request->file( 'image' )->isValid() ) ) {
                Session::flash( 'warning', "Gambar tidak berhasil disimpan!" );
                return redirect()
                       ->back()
                       ->withInput();
            }
            else if ( $article->image != null && file_exists( 'img/article/'.$article->image ) ) {
                unlink( 'img/article/'.$article->image );
                $data['image'] = time() . '.' . $request->file( 'image' )->getClientOriginalExtension();
                $request->file( 'image' )->move( 'img/article', $data['image'] );
            }
        }

        $article->update( $data );
        Session::flash( 'success', "Artikel baru berhasil disunting!" );
        return redirect()
               ->route( 'admin.article.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find( $id );

        if ( $article->image ) {
            unlink( 'img/article/'.$article->image );
        }
        $article->delete();

        Session::flash( 'success', "Data kiriman artikel dihapus!" );
        return redirect()
               ->route( 'admin.article.index' );
    }
}
