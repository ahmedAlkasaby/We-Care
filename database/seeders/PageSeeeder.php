<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => ['en' => 'Privacy Policy', 'ar' => 'سياسة الخصوصية'],
                'description' => [
                    'en' => '<h1>Privacy Policy</h1><p>Your privacy is important to us. This policy explains how we collect, use, and protect your information.</p><h2>Information Collection</h2><p>We collect information from you when you use our services, including your name, email address, and any other details you provide.</p><h2>Use of Information</h2><p>Your information helps us improve our services and communicate with you effectively.</p>',
                    'ar' => '<h1>سياسة الخصوصية</h1><p>خصوصيتك مهمة بالنسبة لنا. تشرح هذه السياسة كيف نجمع ونستخدم ونحمي معلوماتك.</p><h2>جمع المعلومات</h2><p>نجمع المعلومات منك عندما تستخدم خدماتنا، بما في ذلك اسمك، عنوان بريدك الإلكتروني، وأي تفاصيل أخرى تقدمها.</p><h2>استخدام المعلومات</h2><p>تساعدنا معلوماتك في تحسين خدماتنا والتواصل معك بشكل فعال.</p>'
                ],
                'active'=>1
            ],
            [
                'name' => ['en' => 'Terms and Conditions', 'ar' => 'الشروط والأحكام'],
                'description' => [
                    'en' => '<h1>Terms and Conditions</h1><p>Welcome to our website. By accessing our site, you agree to comply with these terms.</p><h2>Use of the Site</h2><p>You may not use the site for any illegal or unauthorized purpose.</p><h2>Limitation of Liability</h2><p>We are not liable for any damages arising from your use of the site.</p>',
                    'ar' => '<h1>الشروط والأحكام</h1><p>مرحبًا بك في موقعنا. من خلال الوصول إلى موقعنا، فإنك توافق على الالتزام بهذه الشروط.</p><h2>استخدام الموقع</h2><p>لا يجوز لك استخدام الموقع لأي غرض غير قانوني أو غير مصرح به.</p><h2>تحديد المسؤولية</h2><p>نحن غير مسؤولين عن أي أضرار تنشأ عن استخدامك للموقع.</p>'
                ],
                'active'=>1
            ],
            [
                'name' => ['en' => 'Help', 'ar' => 'المساعدة'],
                'description' => [
                    'en' => '<h1>Help</h1><p>If you need assistance, please refer to our FAQ section or contact our support team.</p><h2>Frequently Asked Questions</h2><p>Here you can find answers to common questions.</p><h2>Contact Support</h2><p>You can reach our support team via email at support@example.com.</p>',
                    'ar' => '<h1>المساعدة</h1><p>إذا كنت بحاجة إلى مساعدة، يرجى الرجوع إلى قسم الأسئلة الشائعة أو الاتصال بفريق الدعم لدينا.</p><h2>الأسئلة الشائعة</h2><p>هنا يمكنك العثور على إجابات للأسئلة الشائعة.</p><h2>الاتصال بالدعم</h2><p>يمكنك التواصل مع فريق الدعم عبر البريد الإلكتروني على support@example.com.</p>'
                ],
                'active'=>1
            ],
            [
                'name' => ['en' => 'About', 'ar' => 'حول'],
                'description' => [
                    'en' => '<h1>About Us</h1><p>We are dedicated to providing the best service possible. Our team is committed to ensuring customer satisfaction.</p><h2>Our Mission</h2><p>To deliver high-quality products and services that meet the needs of our customers.</p><h2>Our Vision</h2><p>To be a leader in our industry and a trusted partner for our clients.</p>',
                    'ar' => '<h1>حول</h1><p>نحن ملتزمون بتقديم أفضل خدمة ممكنة. فريقنا ملتزم بضمان رضا العملاء.</p><h2>مهمتنا</h2><p>تقديم منتجات وخدمات عالية الجودة تلبي احتياجات عملائنا.</p><h2>رؤيتنا</h2><p>أن نكون رائدين في صناعتنا وشريك موثوق لعملائنا.</p>'
                ],
                'active'=>1
            ],
            // jhdsj
            // يمكنك إضافة المزيد من الصفحات هنا
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
