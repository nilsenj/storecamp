<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data = is_array(config('reviewMsg')) ? config('reviewMsg') : [config('reviewMsg')];
        $message = $data['message'];
        unset($data['message']);

        $product = \App\Core\Models\Product::find(1);
        $user = \App\Core\Models\User::find(2);
        $data['user_id'] = $user->id;
        $feedback = $user->productReview()->create($data);
        $data["subject"] = $product->title;

        $thread = \App\Core\Components\Messenger\Models\Thread::create(
            [
                'product_reviews_id' => $feedback->id,
                'subject' => $data["subject"],
            ]);
        // Message
        \App\Core\Components\Messenger\Models\Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => $user->id,
                'body'      => $message,
            ]
        );

        // Sender
        \App\Core\Components\Messenger\Models\Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => $user->id,
                'last_read' => new \Carbon\Carbon()
            ]
        );
        $roleAdmin = \App\Core\Models\Role::find(1);
        $adminArr = $roleAdmin->getRoleUsers("Admin");

        $thread->addParticipants($adminArr);
    }
}
