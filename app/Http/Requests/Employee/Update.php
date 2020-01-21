<?php

namespace App\Http\Requests\Employee;

use App\Mail\Register;
use App\Models\Employee;
use App\Models\Employees;
use Illuminate\Support\Facades\DB;
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
            'company_id' => 'required',
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'email' => 'email|max:50',
            'phone' => 'max:25',
        ];
    }

    public function process($id=null)
    {
        $employee = Employees::findOrFail($id);

        $data['company_id'] =  $this->input('company_id');
        $data['first_name'] =  $this->input('first_name');
        $data['last_name'] =  $this->input('last_name');
        $data['email'] =  $this->input('email');
        $data['phone'] =  $this->input('phone');
        $data['updated_at'] =  date('Y-m-d H:i:s');

        try {
            $employee->update($data);
        } catch(\Exception  $e)
        {
            throw $e;
        }
        if (session()->has('intended_url'))
            return redirect(session('intended_url'))->with('success', 'ID# '.$employee->id.' Employee successfully updated.');
        return redirect()->route('admin::employee.index')->with('success', 'ID# '.$employee->id.' Employee successfully updated.');

    }
}
