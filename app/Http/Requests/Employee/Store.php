<?php

namespace App\Http\Requests\Employee;
use App\Models\Employees;
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
    {   //['company_id','first_name','last_name', 'email','phone']
        return [
            'company_id' => 'required',
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'email' => 'email|max:50',
            'phone' => 'max:25',
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
            $employee = Employees::create([
                'company_id' => $this->input('company_id'),
                'first_name' => $this->input('first_name'),
                'last_name' => $this->input('last_name'),
                'email' => $this->input('email'),
                'phone' => $this->input('phone'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception  $e) {
            throw $e;
        }
        if (session()->has('intended_url'))
            return redirect(session('admin::intended_url'))->with('success', 'ID# '.$employee->id.' Employee successfully added.');
        return redirect()->route('admin::employee.index')->with('success', 'ID# '.$employee->id.' Employee successfully added.');

    }

}
