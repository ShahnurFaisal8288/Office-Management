<?php

namespace App\Http\Controllers;

use App\Models\PadDesign;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PadDesignController extends Controller
{
    //padDesign
    public function padDesign()
    {
        $data = array();
        $data['active_menu'] = 'padDesign';
        $data['page_title'] = 'Create Pad';
        $padDesign = PadDesign::all();
        return view('backend.padDesign.padDesign', compact('data', 'padDesign'));
    }
    //createPad
    public function createPad()
    {
        $data = array();
        $data['active_menu'] = 'padDesign';
        $data['page_title'] = 'Create Pad';
        return view('backend.padDesign.createPad', compact('data'));
    }
    //storePad
    public function storePad(Request $request)
    {
        $request->validate([
            'padBody' => 'required',
        ]);

        PadDesign::create([
            "padBody" => $request->padBody,
            "title" => $request->title,
        ]);

        return redirect('/padDesign')->with("message", "Pad Design has been created");
    }
    //padPdf
    public function padPdf($id)
    {

        $padDesign = PadDesign::find($id);
        set_time_limit(1000);
        $pdf = Pdf::loadView('backend.padDesign.pafPdf', ['padDesign' => $padDesign]);

        return $pdf->stream('estimate.pdf');
        // return view('backend.padDesign.pafPdf', compact( 'padDesign'));
    }
    //padDesignEdit
    public function padDesignEdit($id)
    {
        $data = array();
        $data['active_menu'] = 'padDesign';
        $data['page_title'] = 'Create Pad';
        $padDesign = PadDesign::find($id);
        return view('backend.padDesign.editPad', compact('data', 'padDesign'));
    }
    //padDesignUpdate
    public function padDesignUpdate(Request $request, $id)
    {
        $padDesign = PadDesign::find($id);
        $padDesign->padBody = $request->padBody;
        $padDesign->title = $request->title;
        $padDesign->save();
        return redirect('/padDesign')->with("message", "Pad Design has been Updated");
    }
    //padDesignDelete
    public function padDesignDelete($id){
        $padDesign = PadDesign::find($id);
        $padDesign->delete();
        return back()->with("message",'Pad Design Deleted Successfully');
    }
}
