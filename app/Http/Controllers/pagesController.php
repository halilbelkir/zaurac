<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Pages;
use Illuminate\Http\Request;
use Validator,Session;

class pagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $pages = Pages::find($id);
        return view('pages.edit',compact('pages'));
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
        try
        {
            $attribute = array(
                'title'       => 'Başlık',
                'content'     => 'İçerik',
                'tag'         => 'Etiket',
                'description' => 'İlk Açıklama',
                'seflink'      => 'Seflink'
            );

            $rules = array(
                'title'       => 'required',
                'content'     => 'required',
                'tag'         => 'required',
                'description' => 'required|max:160',
                'seflink'      => 'required|unique:pages,seflink,'.$id,'id',
            );

            $pages = Pages::find($id);
            if (empty($pages->image))
            {
                $attribute['image']   = 'Resim';
                $rules['image']      = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024';
            }

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }



            if ($request->hasFile('image'))
            {
                $image        = $request->file('image');
                $imageName    = Helpers::seflink($request->get('title')).'-'.time().'.'.$image->extension();
                $target_file   = 'images/front/pages';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $pages->image  = $imageName;
            }

            $pages->title       = $request->get('title');
            $pages->content     = $request->get('content');
            $pages->tag         = $request->get('tag');
            $pages->description = $request->get('description');
            $pages->seflink      = $request->get('seflink');
            $pages->youtube_link = $request->get('youtube_link');
            $pages->save();

            Session::flash('message', array('Başarılı!',$request->get('title').' kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('pages.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroyImage($id)
    {
        try
        {
            $pages = Pages::find($id);
            Helpers::fileDelete($pages->image);
            $pages->image = null;
            $pages->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('pages.edit',$pages->id);
    }
}
