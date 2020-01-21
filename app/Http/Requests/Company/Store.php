<?php

namespace App\Http\Requests\Company;
use App\Mail\Register;
use Storage,Mail;
use App\Models\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'image' => 'image|max:1024',
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function process()
    {

        try {
            $filename = null;
            if($this->file('logo')){
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

            $company = Companies::create([
                'name' => $this->input('name'),
                'email' => $this->input('email'),
                'logo' => $filename,
                'website' => $this->input('website'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Mail::to( $this->input('email') )->send(new Register($company));
        } catch (\Exception  $e) {
            throw $e;
        }
        if (session()->has('intended_url'))
            return redirect(session('admin::intended_url'))->with('success', 'ID# '.$company->id.' Company successfully added.');
        return redirect()->route('admin::company.index')->with('success', 'ID# '.$company->id.' Company successfully added.');

    }

}
