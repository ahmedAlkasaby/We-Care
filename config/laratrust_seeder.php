<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
       'admin' => [
           // إدارة المستخدمين والصلاحيات
           'roles'       => 'r,s,t,c,u,d',
           'admins'      => 'r,s,t,c,u,d',

           // إدارة التبرعات والمتبرعين
           'doners'      => 'r,s,t,c,u,d',
           'donations'   => 'r,s,t,c,u,d,co',

           // إدارة الحالات والمساعدات
           'cases'       => 'r,s,t,c,u,d',
           'category_cases' => 'r,s,t,c,u,d',
           'impacts'     => 'r,s,t,c,u,d',

           // إدارة المدفوعات والتحويلات المالية
           'payments'    => 'r,s,t,c,u,d',
           'transfers'   => 'r,s,t,c,u,d',

           // إدارة المتطوعين والعناصر والمشتريات
           'items'       => 'r,s,t,c,u,d',
           'categories'       => 'r,s,t,c,u,d',
           'volunteers'  => 'r,s,t,c,u,d',
           'purchases'   => 'r,s,t,c,u,d',

           // إدارة المناطق الجغرافية
           'cities'      => 'r,s,t,c,u,d',
           'regions'     => 'r,s,t,c,u,d',

           // إدارة المحتوى والموقع
           'sliders'     => 'r,s,t,c,u,d',
           'settings'    => 'r,s,t,c,u,d',
           'pages'       => 'r,s,t,c,u,d',
           'faqs'        => 'r,s,t,c,u,d',
           'messages'    => 'r,s,t,c,u,d',

           // صلاحيات إضافية
           'storage'     => 'r', // الوصول إلى التخزين فقط
           'notifications' => 'r', // عرض الإشعارات فقط
       ],
   ],

   'permissions_map' => [
       'r' => 'index',
       's' => 'show',
       't' => 'toggle',
       'c' => 'store',
       'u' => 'update',
       'd' => 'destroy',
       'co' => 'confirm',
   ],

];
