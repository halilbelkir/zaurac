<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Awards;
use App\Models\Blog;
use App\Models\Media;
use App\Models\Services;
use App\Models\Slider;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator,Session;
use Yajra\DataTables\Facades\DataTables;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Services::all();
        $media    = Media::all();
        $blog     = Blog::all();
        $awards   = Awards::all();
        return view('slider.create',compact('services','media','blog','awards'));
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
                'image'       => 'Resimler',
            );

            $rules = array(
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
            $imageName    = 'slider-'.time().'.'.$image->extension();
            $target_file   = 'images/front/slider';
            $imageName    = $target_file.'/'.$imageName;
            $image->move($target_file,$imageName);

            $slider                = new Slider;
            $slider->text_1        = $request->get('text_1');
            $slider->text_2        = $request->get('text_2');
            $slider->text_3        = $request->get('text_3');
            $slider->button_text   = $request->get('button_text');
            $slider->button_route  = $request->get('button_route');
            $slider->text_type     = $request->get('text_type');
            $slider->image         = $imageName;
            $slider->save();

            Session::flash('message', array('Başarılı!','Slider kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('slider.index');
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
        $slider   = Slider::find($id);
        $services = Services::all();
        $media    = Media::all();
        $blog     = Blog::all();
        $awards   = Awards::all();
        return view('slider.edit',compact('services','media','blog','awards','slider'));
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
            $slider   = Slider::find($id);

            if(empty($slider->image))
            {
                $attribute['image'] = 'Resim';
                $rules['image']     = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024';

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($attribute);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            if ($request->hasFile('image'))
            {
                $image        = $request->file('image');
                $imageName    = 'slider-'.time().'.'.$image->extension();
                $target_file   = 'images/front/slider';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $slider->image = $imageName;
            }

            $slider->text_1        = $request->get('text_1');
            $slider->text_2        = $request->get('text_2');
            $slider->text_3        = $request->get('text_3');
            $slider->button_text   = $request->get('button_text');
            $slider->button_route  = $request->get('button_route');
            $slider->text_type     = $request->get('text_type');
            $slider->save();

            Session::flash('message', array('Başarılı!','Slider kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('slider.index');
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
            $slider = Slider::find($id);
            Helpers::fileDelete($slider->image);
            $slider->delete();

            session()->flash('flash_message', array('Başarılı!','Slider silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('slider.index');
    }

    public function destroyImage($id)
    {
        try
        {
            $slider = Slider::find($id);
            Helpers::fileDelete($slider->image);
            $slider->image    = null;
            $slider->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('slider.edit',$slider->id);
    }

    public function datatable()
    {
        return Datatables::of(Slider::get())
            ->editColumn('created_at', function ($slider) {
                return $slider->updated_at ? with(new Carbon($slider->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($slider) {
                $actions  = '<a  href="'.route('slider.edit',$slider->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$slider->id.'" onclick="return confirm(\'Sliderı silmek istediğinize emin misiniz? \')" href="'.route('slide.destroy',$slider->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Slider::all();

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
