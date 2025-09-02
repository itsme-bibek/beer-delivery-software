<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        
        if (!$user) {
            return;
        }

        // Create some test messages with admin replies
        $messages = [
            [
                'user_id' => $user->id,
                'order_group' => 'ORD-001',
                'subject' => 'Order Status Inquiry',
                'message' => 'Hi, I would like to know the status of my order ORD-001. When will it be delivered?',
                'status' => 'replied',
                'admin_reply' => 'Hello! Your order ORD-001 is currently being processed and will be delivered within 2-3 business days. We will send you a notification once it\'s shipped.',
                'replied_at' => now()->subDays(1),
            ],
            [
                'user_id' => $user->id,
                'order_group' => 'ORD-002',
                'subject' => 'Change Delivery Address',
                'message' => 'I need to change the delivery address for my order ORD-002. The new address is 123 New Street, City.',
                'status' => 'replied',
                'admin_reply' => 'Thank you for the update. I have updated your delivery address for order ORD-002. The order will be delivered to the new address.',
                'replied_at' => now()->subHours(6),
            ],
            [
                'user_id' => $user->id,
                'order_group' => 'ORD-003',
                'subject' => 'Product Quality Issue',
                'message' => 'I received my order but one of the bottles was damaged. Can you help me with a replacement?',
                'status' => 'read',
                'admin_reply' => null,
                'replied_at' => null,
            ],
            [
                'user_id' => $user->id,
                'order_group' => 'ORD-004',
                'subject' => 'Bulk Order Request',
                'message' => 'I want to place a bulk order for 50 bottles. Do you offer any discounts for bulk orders?',
                'status' => 'unread',
                'admin_reply' => null,
                'replied_at' => null,
            ],
        ];

        foreach ($messages as $messageData) {
            Message::create($messageData);
        }
    }
}
