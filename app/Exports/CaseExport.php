<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings; // إضافة الواجهة WithHeadings

class CaseExport implements FromCollection, WithTitle, WithHeadings
{
    protected $cases;

    public function __construct($cases)
    {
        $this->cases = $cases;
    }

    // دالة لجلب البيانات للتصدير
    public function collection()
    {
        $exportedCases = new Collection();

        foreach ($this->cases as $case) {
            $exportedCases->push([
                'id' => $case->id,
                'name' => $case->user->name ?? null,
                'phone' => $case->user->phone ?? null,
                'email' => $case->user->email ?? null,
                'city' => $case->user->city ? $case->user->city->nameLang() : null,
                'region' => $case->user->region ? $case->user->region->nameLang() : null,
                'code_name' => $case->details->code_name ?? null,
                'national_number' => $case->details->national_number ?? null,
                'condition' => $case->details->condition ?? null,
                'type_of_aid' => $case->details->type_of_aid ?? null,
                'number_of_peaple' => $case->details->number_of_peaple ?? null,
                'government' => $case->details->government ?? null,
                'city' => $case->details->city ?? null,
                'area' => $case->details->area ?? null,
                'street' => $case->details->street ?? null,
                'district' => $case->details->district ?? null,
                'building' => $case->details->building ?? null,
                'floor' => $case->details->floor ?? null,
                'title' => $case->name ? $case->nameLang() : null,
                'description' =>$case->description ? $case->descriptionLang() : null,
                'category_name' =>$case->category ?  $case->category->nameLang() :  null,
                'priority' => $case->priority ?? null,
                'type' => $case->type ?? null,
                'total_price' => $case->price ?? null,
                'price_raised' => $case->price_raised ?? null,
                'price_needed' => ($case->price - $case->price_raised) ?? null,
                'repeating' => $case->repeating ?? null,
                'next_donation_date' => $case->next_donation_date ?? null,
                'is_event' => $case->is_event ?? null,
                'date_start' => $case->date_start ?? null,
                'date_end' => $case->date_end ?? null,
                'status' => $case->check_status() ?? null,
                'volunteer_name' => $case->volunteer ? $case->volunteer->name : null,
                'volunteer_phone' => $case->volunteer ? $case->volunteer->phone : null,
                'created_at' => $case->created_at ?? null,
                'updated_at' => $case->updated_at ?? null,
            ]);
        }

        return $exportedCases;

    }

    // دالة لتحديد العنوان الذي سيظهر في ملف الـ Excel
    public function title(): string
    {
        return 'Charity Cases'; // العنوان الذي تريد أن يظهر في الورقة
    }

    // دالة لتحديد رأس الجدول
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone',
            'Email',
            'City',
            'Region',
            'Code Name',
            'National Number',
            'Condition',
            'Type of Aid',
            'Number of People',
            'Government',
            'City (Details)',
            'Area',
            'Street',
            'District',
            'Building',
            'Floor',
            'Title',
            'Description',
            'Category Name',
            'Category Description',
            'Priority',
            'Type',
            'Total Price',
            'Price Raised',
            'Price Needed',
            'Repeating',
            'Next Donation Date',
            'Is Event',
            'Start Date',
            'End Date',
            'Status',
            'Volunteer Name',
            'Volunteer Phone',
            'Created At',
            'Updated At',
        ];
    }
}
