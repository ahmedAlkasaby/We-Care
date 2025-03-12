<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // استدعاء موديل الفئة
use App\Models\CategoryCase;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_cases = [
            [
                'name' => [
                    'en' => 'Orphans Support',
                    'ar' => 'دعم الأيتام',
                ],
                'description' => [
                    'en' => 'Providing financial and educational support for orphans.',
                    'ar' => 'تقديم الدعم المالي والتعليمي للأيتام.',
                ],
                'active' => 1,
            ],
            [
                'name' => [
                    'en' => 'Medical Assistance',
                    'ar' => 'المساعدة الطبية',
                ],
                'description' => [
                    'en' => 'Helping cases with medical expenses and treatments.',
                    'ar' => 'مساعدة الحالات في المصاريف والعلاجات الطبية.',
                ],
                'active' => 1,
            ],
            [
                'name' => [
                    'en' => 'Housing Aid',
                    'ar' => 'مساعدات الإسكان',
                ],
                'description' => [
                    'en' => 'Support for housing and shelter needs.',
                    'ar' => 'دعم احتياجات السكن والمأوى.',
                ],
                'active' => 1,
            ],
            [
                'name' => [
                    'en' => 'Food and Nutrition',
                    'ar' => 'الإطعام والتغذية',
                ],
                'description' => [
                    'en' => 'Providing food supplies and nutritional support.',
                    'ar' => 'توفير الإمدادات الغذائية والدعم الغذائي.',
                ],
                'active' => 1,
            ],
            [
                'name' => [
                    'en' => 'Educational Support',
                    'ar' => 'الدعم التعليمي',
                ],
                'description' => [
                    'en' => 'Assisting students with school supplies and fees.',
                    'ar' => 'مساعدة الطلاب بتوفير مستلزمات الدراسة والمصاريف.',
                ],
                'active' => 1,
            ],
            [
                'name' => [
                    'en' => 'Emergency Relief',
                    'ar' => 'الإغاثة الطارئة',
                ],
                'description' => [
                    'en' => 'Providing assistance during natural disasters or emergencies.',
                    'ar' => 'تقديم المساعدة في الكوارث الطبيعية أو حالات الطوارئ.',
                ],
                'active' => 1,
            ],
        ];

        foreach ($category_cases as $category) {
            CategoryCase::create($category);
        }

    }
}
