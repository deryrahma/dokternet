<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\ArticleCategory;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ArticleCategory::all();
        return view( 'pages.admin.article-category.index', compact( 'data' ) );
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

        return view( 'pages.admin.article-category.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ArticleCategory::create( $request->all() );
        Session::flash( 'success', "Kategori artikel baru berhasil ditambahkan!" );
        return redirect()
               ->route( 'admin.article-category.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data['content'] = ArticleCategory::find( $id );

        return view( 'pages.admin.article-category.edit', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ArticleCategory::find( $id )->update( $request->all() );
        Session::flash( 'success', "Data artikel kategori berhasil diubah!" );
        return redirect()
               ->route( 'admin.article-category.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ArticleCategory::find( $id )->delete();
        Session::flash( 'success', "Data artikel kategori berhasil dihapus!" );
        return redirect()
               ->route( 'admin.article-category.index' );
    }
}
