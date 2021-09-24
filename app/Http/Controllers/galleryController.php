<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Gallery;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator,Session;

class galleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
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
                'category_name' => 'Kategori Adı',
                'images'        => 'Resimler',
                'images.*'      => 'Resimler',
            );

            $rules = array(
                'category_name' => 'required',
                'images'        => 'required',
                'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            );


            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            foreach($request->file('images') as $order => $image)
            {
                $imagesArray  = array();
                $imageName    = Helpers::seflink($request->get('category_name')).'-'.$order.'-'.time().'.'.$image->extension();
                $target_file   = 'images/front/gallery';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $imagesArray['image'] = $imageName;
                $images[]             = $imagesArray;
            }

            $gallery                 = new Gallery;
            $gallery->category_name  = $request->get('category_name');
            $gallery->youtube_link   = $request->get('youtube_link');
            $gallery->images         = json_encode($images);

            $gallery->save();

            Session::flash('message', array('Başarılı!','Galeri kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('gallery.index');
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
        $gallery = Gallery::find($id);
        return view('gallery.edit',compact('gallery'));
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
                'category_name' => 'Kategori Adı',
            );

            $rules = array(
                'category_name' => 'required',
            );

            $gallery = Gallery::find($id);
            if(empty($gallery->images) || $request->hasFile('images'))
            {
                $attribute['images']   = 'Resimler';
                $attribute['images.*'] = 'Resimler';
                $rules['images']       = 'required';
                $rules['images.*']     = 'image|mimes:jpeg,png,jpg,gif,svg|max:1024';
            }

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->hasFile('images'))
            {
                $order   = empty($gallery->images) ? 0 : count(json_decode($gallery->images));
                $images  = empty($order) ? array() : json_decode($gallery->images,true);

                foreach($request->file('images') as $image)
                {
                    $imagesArray  = array();
                    $imageName    = Helpers::seflink($request->get('category_name')).'-'.$order.'-'.time().'.'.$image->extension();
                    $target_file   = 'images/front/gallery';
                    $imageName    = $target_file.'/'.$imageName;
                    $image->move($target_file,$imageName);
                    $imagesArray['image'] = $imageName;
                    $images[]             = $imagesArray;
                    $order++;
                }

                $gallery->images      = json_encode($images);
            }

            $gallery->category_name  = $request->get('category_name');
            $gallery->youtube_link   = $request->get('youtube_link');
            $gallery->save();

            Session::flash('message', array('Başarılı!','Galeri kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('gallery.index');
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
            $gallery = Gallery::find($id);
            if (!empty($gallery->images))
            {
                foreach (json_decode($gallery->images) as $order => $image)
                {
                    Helpers::fileDelete($image->image);
                }
            }
            $gallery->delete();

            session()->flash('flash_message', array('Başarılı!','Galeri silindi.', 'success'));
        }
        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }
        return redirect()->route('gallery.index');
    }

    public function destroyImage($id,$order)
    {
        try
        {
            $gallery     = Gallery::find($id);
            $images      = json_decode($gallery->images,true);
            $deleteImage = $images[$order]['image'];
            unset($images[$order]);
            Helpers::fileDelete($deleteImage);
            $gallery->images    = count($images) > 0 ? json_encode($images) : null ;
            $gallery->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('gallery.edit',$gallery->id);
    }

    public function datatable()
    {
        return Datatables::of(Gallery::get())
            ->editColumn('created_at', function ($gallery) {
                return $gallery->updated_at ? with(new Carbon($gallery->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($gallery) {
                $actions  = '<a  href="'.route('gallery.edit',$gallery->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$gallery->id.'" onclick="return confirm(\' '.$gallery->category_name.' isimli galeriyi silmek istediğinize emin misiniz? \')" href="'.route('galleryy.destroy',$gallery->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Gallery::all();

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
