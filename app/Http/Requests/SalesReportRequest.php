<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesReportRequest extends FormRequest
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
            'report_number' => 'required',
            'grp_code' => 'required',
            'adult_count' => 'required',
            'children_count' => 'required',
            'tour_agent_id' => 'required',
            'tour_guide_id' => 'required',
            'tc_name' => 'required',
            'total_sales' => 'required',
            'total_agent_sales' => 'required',
            'total_commission' => 'required',
            'gst' => 'required',
            'grand_total_commission' => 'required',
            'guide_incentive' => 'required',
            'delivery' => 'required',
            'service' => 'required',
            'total' => 'required',
            'selected_products' => 'array',
            'sales_commissions' => 'array',
        ];
    }
}