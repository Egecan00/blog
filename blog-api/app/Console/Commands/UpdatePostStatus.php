<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class UpdatePostStatus extends Command
{
    protected $signature = 'posts:update-status';
    protected $description = 'Yazıların aktif/pasif durumunu günceller';

    public function handle()
    {
       
        Post::where('publish_at', '<=', now())
            ->where('expire_at', '>', now())
            ->where('status', false)
            ->update(['status' => true]);

        Post::where('expire_at', '<=', now())
            ->where('status', true)
            ->update(['status' => false]);

        $this->info('Yazı durumları başarıyla güncellendi.');
    }
}