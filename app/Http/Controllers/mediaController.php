<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Media;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator,Session;

class mediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $attribute = array(
                'link'        => 'Link',
                'image'       => 'Resimler',
            );

            $rules = array(
                'link'        => 'required|url',
                'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            );


            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $image        = $request->file('image');
            $imageName    = 'media-'.time().'.'.$image->extension();
            $target_file   = 'images/front/media';
            $imageName    = $target_file.'/'.$imageName;
            $image->move($target_file,$imageName);

            $media              = new Media;
            $media->link        = $request->get('link');
            $media->image       = $imageName;
            $media->save();

            Session::flash('message', array('Başarılı!','Basında Biz kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('media.index');
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
        $media = Media::find($id);
        return view('media.edit',compact('media'));
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
                'link' => 'Link',
            );

            $rules = array(
                'link' => 'required|url',
            );

            $media  = Media::find($id);

            if(empty($media->image))
            {
                $attribute['image'] = 'Resim';
                $rules['image']     = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024';
            }

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if(empty($media->image))
            {
                $image        = $request->file('image');
                $imageName    = 'media-'.time().'.'.$image->extension();
                $target_file   = 'images/front/media';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $media->image    = $imageName;
            }

            $media->link  = $request->get('link');
            $media->save();

            Session::flash('message', array('Başarılı!','Basında Biz kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('media.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $media = Media::find($id);
            Helpers::fileDelete($media->image);
            $media->delete();

            session()->flash('flash_message', array('Başarılı!','Basında Biz silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('media.index');
    }

    public function destroyImage($id)
    {
        try
        {
            $media = Media::find($id);
            Helpers::fileDelete($media->image);
            $media->image    = null;
            $media->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('media.edit',$media->id);
    }

    public function datatable()
    {
        return Datatables::of(Media::get())
            ->editColumn('created_at', function ($media) {
                return $media->updated_at ? with(new Carbon($media->updated_at))->format('d-m-Y') : '';
            })
            ->editColumn('image', function ($media) {
                return '<img class="rounded-full h-20 w-20 object-cover" src="'.asset($media->image).'">';
            })
            ->editColumn('link', function ($media) {
                return '<a class="text-red-500 hover:text-red-800" href="'.$media->link.'" target="_blank"> Link </a>';
            })
            ->addColumn('actions', function ($media) {
                $actions  = '<a  href="'.route('media.edit',$media->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$media->id.'" onclick="return confirm(\' '.$media->title.' isimli Basında Bizi silmek istediğinize emin misiniz? \')" href="'.route('mediaa.destroy',$media->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions','image','link'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Media::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }

        return response()->json([
            'result' => 1,
        ]);
    }
}
