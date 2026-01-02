<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@dp3.com',
            'password' => bcrypt('password'),
            'gid' => 1,
            'aktif' => 1,
        ]);

        Group::factory()->create([
            'nama' => 'Super Admin',
            'lsakses' => '{"menu":"{\"user\":[\"_index\",\"_store\",\"_update\",\"_destroy\"],\"group\":[\"_index\",\"_store\",\"_update\",\"_destroy\"],\"menu\":[\"_index\",\"_store\",\"_update\",\"_destroy\"]}","kontenakses":"{\"bn\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"],\"b\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"],\"ag\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"],\"h\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"],\"k\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"],\"l\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"],\"sm\":[\"_index\",\"_store\",\"_update\",\"_destroy\",\"_publikasi\"]}"}',
        ]);
    }
}
