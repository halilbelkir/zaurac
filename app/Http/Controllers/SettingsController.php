<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Validator,Session;
class SettingsController extends Controller
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
        $settings = Settings::find($id);
        return view('settings.edit',compact('settings'));
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
                'title'           => 'Site Başlık',
                'telefon'         => 'Telefon',
                'email'           => 'E-Mail',
                'adres'           => 'Adres',
                'hakkimizda'      => 'Hakkimizda',
                'facebook'        => 'Facebook',
                'instagram'       => 'Instagram',
                'tag'             => 'Etiket',
                'description'     => 'Site Açıklama',
                'recipient_email' => 'Alıcı E-mail',
            );

            $rules = array(
                'title'           => 'required',
                'telefon'         => 'required',
                'adres'           => 'required',
                'email'           => 'required|email',
                'hakkimizda'      => 'required',
                'facebook'        => 'nullable|url',
                'instagram'       => 'nullable|url',
                'linkedin'        => 'nullable|url',
                'tag'             => 'required',
                'recipient_email' => 'required|email',
                'description'     => 'required|max:160',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $settings                   = Settings::find($id);
            $settings->telefon          = $request->get('telefon');
            $settings->email            = $request->get('email');
            $settings->adres            = $request->get('adres');
            $settings->hakkimizda       = $request->get('hakkimizda');
            $settings->facebook         = $request->get('facebook');
            $settings->instagram        = $request->get('instagram');
            $settings->linkedin         = $request->get('linkedin');
            $settings->title            = $request->get('title');
            $settings->tag              = $request->get('tag');
            $settings->description      = $request->get('description');
            $settings->recipient_email  = $request->get('recipient_email');
            $settings->fax              = $request->get('fax');
            $settings->save();

            Session::flash('message', array('Başarılı!','Ayarlar kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('settings.edit',1);
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
}
