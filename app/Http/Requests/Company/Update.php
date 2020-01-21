<?php

namespace App\Http\Requests\Company;

use App\Mail\Register;
use App\Models\Companies;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Storage,File;
use Illuminate\Foundation\Http\FormRequest;
class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'email|max:100',
            'website' => 'website_url',
            'logo' => 'image|max:1024|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function process($id=null)
    {
        $company = Companies::findOrFail($id);

        $filename = null;
        if($this->file('logo')){

            //DELETING OLD FILE

            if(Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $logo = $this->file('logo');
            $data = getimagesize($logo);
            $width = $data[0];
            $height = $data[1];

            if ($width < 100 || $height < 100) {

                return back()->with('error', 'Image dimension should be greater than 100 x 100.')->withInput();
            }

            $filename = time().'.'. $logo->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('companies', $logo, $filename);
            $filename = 'companies/'.$filename;
        }

        $data['name'] =  $this->input('name');
        $data['email'] =  $this->input('email');
        $data['logo'] =  $filename;
        $data['website'] =  $this->input('website');

        try {
            $company->update($data);
        } catch(\Exception  $e)
        {
            throw $e;
        }
        if (session()->has('intended_url'))
            return redirect(session('intended_url'))->with('success', 'ID# '.$company->id.' Company successfully updated.');
        return redirect()->route('admin::company.index')->with('success', 'ID# '.$company->id.' Company successfully updated.');

    }
}
