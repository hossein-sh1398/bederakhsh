<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function form()
    {
    	return view('form_upload');
    }

    public function upload(Request $request)
    {
		// Storage::disk('public')->putFile('Madar', $request->file);

		// $fileName = $request->file->getClientOriginalName();
		// $fileName = Str::random(20) . '_' . $fileName;   	
		// Storage::disk('public')->putFileAs('Madar', $request->file, $fileName);

		// return $request->file->store('Madar', 'public');   	
		//return $request->file->storeAs('Madar',$request->file->getClientOriginalName());   	
    }

    public function down($file)
    {
    	return Storage::download('files/'. $file);
    	//return Storage::download('app/Madar/RLENmiikBTdHJzmSKVYruwOLostndM76SQlRQV9z.jpeg');
    }
}
