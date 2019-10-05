<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesReportListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'report_number' => $this->report_number,
            'tour_agent' => $this->tourAgent->name,
            'tour_guide' => $this->tourGuide->name,
            'total_agent_sales' => $this->total_agent_sales,
            'total_commissions' => $this->total_commissions,
            'tour_date' => $this->tour_date
        ];
    }
}
