<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator,Session;

class teamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
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
                'ad'       => 'Ad',
                'unvan'    => 'Ünvan',
                'aciklama' => 'Açıklama',
                'content'  => 'İçeri',
                'tag'      => 'Etiket',
                'seflink'   => 'Seflink',
                'resim'    => 'Resim',
            );

            $rules = array(
                'ad'       => 'required',
                'unvan'    => 'required',
                'aciklama' => 'required',
                'content'  => 'required',
                'tag'      => 'required',
                'seflink'   => 'required|unique:team,seflink',
                'resim'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            );


            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $image          = $request->file('resim');
            $imageName      = Helpers::seflink($request->get('ad')).'_'.time().'.'.$image->extension();
            $target_file     = 'images/front/team';
            $imageName      = $target_file.'/'.$imageName;
            $image->move($target_file,$imageName);

            $team           = new Team;
            $team->ad       = $request->get('ad');
            $team->unvan    = $request->get('unvan');
            $team->aciklama = $request->get('aciklama');
            $team->content  = $request->get('content');
            $team->tag      = $request->get('tag');
            $team->seflink   = $request->get('seflink');
            $team->resim    = $imageName;

            $team->save();

            Session::flash('message', array('Başarılı!','Kişi kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('team.index');
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
        $team = Team::find($id);
        return view('team.edit',compact('team'));
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
                'ad'       => 'Ad',
                'unvan'    => 'Ünvan',
                'aciklama' => 'Açıklama',
                'content'  => 'İçerik',
                'tag'      => 'Etiket',
                'seflink'   => 'Seflink',
            );

            $rules = array(
                'ad'       => 'required',
                'unvan'    => 'required',
                'aciklama' => 'required',
                'content'  => 'required',
                'tag'      => 'required',
                'seflink'   => 'required|unique:team,seflink,'.$id,'id',
            );

            $team = Team::find($id);
            if(empty($team->resim))
            {
                $attribute['resim'] = 'Resim';
                $rules['resim']     = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024';
            }

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if(empty($team->resim))
            {
                $image          = $request->file('resim');
                $imageName      = Helpers::seflink($request->get('ad')).'_'.time().'.'.$image->extension();
                $target_file     = 'images/front/team';
                $imageName      = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $team->resim    = $imageName;
            }

            $team->ad       = $request->get('ad');
            $team->unvan    = $request->get('unvan');
            $team->aciklama = $request->get('aciklama');
            $team->content  = $request->get('content');
            $team->tag      = $request->get('tag');
            $team->seflink   = $request->get('seflink');
            $team->save();

            Session::flash('message', array('Başarılı!','Kişi kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('team.index');
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
            $team = Team::find($id);
            Helpers::fileDelete($team->resim);
            $team->delete();

            session()->flash('flash_message', array('Başarılı!','Kişi silindi.', 'success'));
        }
        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }
        return redirect()->route('team.index');
    }

    public function destroyImage($id)
    {
        try
        {
            $team = Team::find($id);
            Helpers::fileDelete($team->resim);
            $team->resim    = null;
            $team->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('team.edit',$team->id);
    }

    public function datatable()
    {
        return Datatables::of(Team::get())
            ->editColumn('created_at', function ($team) {
                return $team->updated_at ? with(new Carbon($team->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($team) {
                $actions  = '<a  href="'.route('team.edit',$team->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$team->id.'" onclick="return confirm(\' '.$team->ad.' isimli kişiyi silmek istediğinize emin misiniz? \')" href="'.route('teamm.destroy',$team->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Team::all();

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
