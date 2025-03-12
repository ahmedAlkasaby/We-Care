<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'John Doe',
                'phone' => '123-456-7890',
                'email' => 'john.doe@example.com',
                'message' => 'Hello, I have a question about your services.',
                'read' => 0,
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '098-765-4321',
                'email' => 'jane.smith@example.com',
                'message' => 'I would like to know more about your organization.',
                'read' => 0,
            ],
            // Add more messages as needed
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}
