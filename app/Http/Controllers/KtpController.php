<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KTP;
use App\Helpers\formatAPI;
use Exception;

class KtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $data = KTP::all();
    
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $penduduk = KTP::create($request->all());
            
            $data = KTP::where('nik', '=',$penduduk->nik)->get();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nik)
    {
        try{
            $data = KTP::where('nik', '=', $nik)->first();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nik)
    {
        try{
            $penduduk = KTP::findOrFail($nik);
            $penduduk->update($request->all());

            $data = Siswa::where('id','=',$penduduk->nik)->get();
            if($data){
                return formatAPI::createAPI(200,'success',$data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed',$error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nik)
    { try{
        $penduduk = KTP::findOrFail($nik);

        $data = $penduduk->delete();
        if($data){
            return formatAPI::createAPI(200,'success',$data);
        }else{
            return formatAPI::createAPI(400,'failed');
        }
    }catch(Exception $error){
        return formatAPI::createAPI(400,'failed',$error);
    }
        
    }
}
