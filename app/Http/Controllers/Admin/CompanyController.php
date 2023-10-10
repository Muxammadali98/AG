<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Image;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function index(){
        $companies = Company::all();
        return view('admin.company.index',compact('companies'));
    }

    function create() {
        return view('admin.company.create');
    }

    function store(Request $request) {
        $this->validate($request,[
            'title'=>'required|unique:companies,title',
            'address'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
            'images[]'=>'array',
        ],[
            'title.required'=>'Tashkilot nomini kiritish majburiy',
            'title.unique'=>'Ushbu tashkilot nomini allaqachon yaratilgan',
            'address.required'=>"Manzil kiritish majburiy",
            'longitude.required'=>"Uzunlik kiritish majburiy",
            'latitude.required'=>"Kenglik kiritish majburiy",
        ]);
        $company = Company::create($request->all());
        if(isset($request->images)){

            foreach($request->images as $image){

                $imageName = time().'.'.$image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                Image::create(['image'=>$imageName, 'company_id'=>$company->id]);
            }

        }




        return redirect()->route('company.index');
    }

    function show($id) {
        Image::where('id',$id)->delete();
        return back();
    }

    function edit($id) {
        $company = Company::find($id);
        return view('admin.company.show',compact('company'));
    }

    function update(Request $request, $id) {


        $company = Company::find($id);
        $company->timestamps = false;
        $company->update($request->all());

        if(isset($request->images)){

            foreach($request->images as $image){

                $imageName = time().'.'.$image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                Image::create(['image'=>$imageName, 'company_id'=>$company->id]);
            }

        }

        return redirect()->route('company.index');

    }

    function destroy($id) {

        Image::where('company_id',$id)->delete();
        Company::destroy($id);

        return redirect()->route('company.index');
    }
}
