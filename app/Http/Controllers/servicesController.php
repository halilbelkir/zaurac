<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Services;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator,Session;
use Yajra\DataTables\Facades\DataTables;

class servicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
                'seflink'      => 'required|unique:services,seflink',
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
                $target_file   = 'images/front/services';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $imagesArray['image'] = $imageName;
                $images[]             = $imagesArray;
            }

            $services              = new Services;
            $services->title       = $request->get('title');
            $services->content     = $request->get('content');
            $services->tag         = $request->get('tag');
            $services->description = $request->get('description');
            $services->seflink      = $request->get('seflink');
            $services->images      = json_encode($images);

            $services->save();

            Session::flash('message', array('Başarılı!','Hizmet kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $services = Services::find($id);
            $services->homepage = $services->homepage == 0 ? 1 : 0;
            $services->save();

            session()->flash('flash_message', array('Başarılı!','Anasayfa aktif edildi.', 'success'));
        }
        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }

        return redirect()->route('services.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Services::find($id);
        return view('services.edit',compact('services'));
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
                'seflink'      => 'required|unique:services,seflink,'.$id,'id',
            );

            $services = Services::find($id);
            if(empty($services->images) || $request->hasFile('images'))
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
                $order   = empty($services->images) ? 0 : count(json_decode($services->images));
                $images  = empty($order) ? array() : json_decode($services->images,true);

                foreach($request->file('images') as $image)
                {
                    $imagesArray  = array();
                    $imageName    = Helpers::seflink($request->get('title')).'-'.$order.'-'.time().'.'.$image->extension();
                    $target_file   = 'images/front/services';
                    $imageName    = $target_file.'/'.$imageName;
                    $image->move($target_file,$imageName);
                    $imagesArray['image'] = $imageName;
                    $images[]             = $imagesArray;
                    $order++;
                }

                $services->images      = json_encode($images);
            }

            $services->title       = $request->get('title');
            $services->content     = $request->get('content');
            $services->tag         = $request->get('tag');
            $services->description = $request->get('description');
            $services->save();

            Session::flash('message', array('Başarılı!','Hizmet kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('services.index');
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
            $services = Services::find($id);
            if (!empty($services->images))
            {
                foreach (json_decode($services->images) as $order => $image)
                {
                    Helpers::fileDelete($image->image);
                }
            }
            $services->delete();

            session()->flash('flash_message', array('Başarılı!','Hizmet silindi.', 'success'));
        }
        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }
        return redirect()->route('services.index');
    }

    public function destroyImage($id,$order)
    {
        try
        {
            $services    = Services::find($id);
            $images      = json_decode($services->images,true);
            $deleteImage = $images[$order]['image'];
            unset($images[$order]);
            Helpers::fileDelete($deleteImage);
            $services->images    = count($images) > 0 ? json_encode($images) : null ;
            $services->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('services.edit',$services->id);
    }

    public function datatable()
    {
        return Datatables::of(Services::get())
            ->editColumn('created_at', function ($services) {
                return $services->updated_at ? with(new Carbon($services->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($services) {
                $star     = $services->homepage == 0 ? 'star_border' : 'star';
                $color    = $services->homepage == 0 ? 'purple' : 'green';
                $actions  = '<a href="'.route('services.show',$services->id).'" class="inline-flex items-center px-1 py-1 bg-'.$color.'-800 hover:bg-'.$color.'-700 active:bg-'.$color.'-900 focus:border-'.$color.'-900 focus:ring-'.$color.'-300 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest  hover:text-white focus:outline-none  focus:ring  disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">'.$star.'</span></a>';
                $actions .= '<a href="'.route('services.edit',$services->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$services->id.'" onclick="return confirm(\' '.$services->title.' isimli hizmeti silmek istediğinize emin misiniz? \')" href="'.route('service.destroy',$services->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Services::all();

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
