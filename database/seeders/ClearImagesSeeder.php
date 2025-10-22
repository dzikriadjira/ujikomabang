<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClearImagesSeeder extends Seeder
{
    public function run()
    {
        // Clear gallery images (using empty string instead of null for NOT NULL columns)
        DB::table('galleries')->update([
            'image' => '',
            'thumbnail' => ''
        ]);

        // Clear fasilitas images
        DB::table('fasilitas')->update([
            'image' => ''
        ]);

        // Clear prestasi images
        DB::table('prestasis')->update([
            'image' => ''
        ]);

        // Clear storage directories
        $directories = ['galleries', 'fasilitas', 'prestasi'];
        
        foreach ($directories as $directory) {
            $path = 'public/' . $directory;
            if (Storage::exists($path)) {
                Storage::deleteDirectory($path);
                Storage::makeDirectory($path, 0755, true);
            }
        }

        $this->command->info('All images have been cleared and reset successfully.');
    }
}
