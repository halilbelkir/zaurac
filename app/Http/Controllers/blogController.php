<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Blog;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator,Session;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
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
                'title'       => 'Başlık',
                'content'     => 'İçerik',
                'tag'         => 'Etiket',
                'description' => 'İlk Açıklama',
                'images'      => 'Resimler',
                'images.*'    => 'Resimler',
                'seflink'      => 'Seflink'
            );

            $rules = array(
                'title'       => 'required',
                'content'     => 'required',
                'tag'         => 'required',
                'description' => 'required|max:160',
                'images'      => 'required',
                'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'seflink'      => 'required|unique:blog,seflink',
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
                $imageName    = Helpers::seflink($request->get('title')).'-'.$order.'-'.time().'.'.$image->extension();
                $target_file   = 'images/front/blog';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $imagesArray['image'] = $imageName;
                $images[]             = $imagesArray;
            }

            $blog              = new Blog;
            $blog->title       = $request->get('title');
            $blog->content     = $request->get('content');
            $blog->tag         = $request->get('tag');
            $blog->description = $request->get('description');
            $blog->seflink      = $request->get('seflink');
            $blog->youtube_link = $request->get('youtube_link');
            $blog->images      = json_encode($images);

            $blog->save();

            Session::flash('message', array('Başarılı!','Blog kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('blog.index');
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
        $blog = Blog::find($id);
        return view('blog.edit',compact('blog'));
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
                'seflink'      => 'required|unique:blog,seflink,'.$id,'id',
            );

            $blog = Blog::find($id);

            if(empty($blog->images) || $request->hasFile('images'))
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
                $order   = empty($blog->images) ? 0 : count(json_decode($blog->images));
                $images  = empty($order) ? array() : json_decode($blog->images,true);

                foreach($request->file('images') as $image)
                {
                    $imagesArray  = array();
                    $imageName    = Helpers::seflink($request->get('title')).'-'.$order.'-'.time().'.'.$image->extension();
                    $target_file   = 'images/front/blog';
                    $imageName    = $target_file.'/'.$imageName;
                    $image->move($target_file,$imageName);
                    $imagesArray['image'] = $imageName;
                    $images[]             = $imagesArray;
                    $order++;
                }

                $blog->images      = json_encode($images);
            }

            $blog->title       = $request->get('title');
            $blog->content     = $request->get('content');
            $blog->tag         = $request->get('tag');
            $blog->description = $request->get('description');
            $blog->seflink      = $request->get('seflink');
            $blog->youtube_link = $request->get('youtube_link');
            $blog->save();

            Session::flash('message', array('Başarılı!','Blog kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('blog.index');
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
            $blog = Blog::find($id);
            if (!empty($blog->images))
            {
                foreach (json_decode($blog->images) as $order => $image)
                {
                    Helpers::fileDelete($image->image);
                }
            }
            $blog->delete();

            session()->flash('flash_message', array('Başarılı!','Blog silindi.', 'success'));
        }
        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }
        return redirect()->route('blog.index');
    }

    public function destroyImage($id,$order)
    {
        try
        {
            $blog    = Blog::find($id);
            $images      = json_decode($blog->images,true);
            $deleteImage = $images[$order]['image'];
            unset($images[$order]);
            Helpers::fileDelete($deleteImage);
            $blog->images    = count($images) > 0 ? json_encode($images) : null ;
            $blog->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('blog.edit',$blog->id);
    }

    public function datatable()
    {
        return Datatables::of(Blog::get())
            ->editColumn('created_at', function ($blog) {
                return $blog->updated_at ? with(new Carbon($blog->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($blog) {
                $actions  = '<a  href="'.route('blog.edit',$blog->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$blog->id.'" onclick="return confirm(\' '.$blog->title.' isimli bloğu silmek istediğinize emin misiniz? \')" href="'.route('blogg.destroy',$blog->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Blog::all();

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
