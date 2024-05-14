<?php

namespace App\Http\Requests\Analysis;

use Illuminate\Foundation\Http\FormRequest;

class AnalysisUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'quantity' => ['required', 'numeric', 'min:1', 'max:10000'],
            'status_id' => ['required', 'exists:analysis_price_statuses,id'],
            'amount' => [
                'required', 'numeric',
                'min:' . config('define.analysis.amount.min'),
                'max:' . config('define.analysis.amount.max')
            ],
            'customer_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là 1 chuỗi ký tự',
            'name.min' => 'Tên phải ít nhất 5 ký tự',
            'quantity.required' => 'Bắt buộc nhập số lượng',
            'quantity.numeric' => 'Số lượng phải là 1 số',
            'quantity.min' => 'Số lượng nhỏ nhất là 1',
            'quantity.max' => 'Số lượng lớn nhất là 10000',
            'amount.required' => 'Bắt buộc nhập thành tiền',
            'amount.numeric' => 'Thành tiền phải là 1 số',
            'amount.min' => 'Thành tiền nhỏ nhất là ' . formatCurrency(config('define.analysis.amount.min')),
            'amount.max' => 'Thành tiền lớn nhất là ' . formatCurrency(config('define.analysis.amount.max')),
            'customer_id.required' => 'Chọn khách hàng',
            'customer_id.exists' => 'Khách hàng không tồn tại',
            'status_id.required' => 'Chọn trạng thái',
            'status_id.exists' => 'Trạng thái không hợp lệ',
        ];
    }
}
