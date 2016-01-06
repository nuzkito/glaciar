<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $truncate = [
        'users',
        'courses',
        'course_user',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        $this->truncateTables($this->truncate);
        $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        $this->checkForeignKeys(false);

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->checkForeignKeys(true);
    }

    protected function checkForeignKeys($check)
    {
        $check = $check ? '1' : '0';
        DB::statement("SET FOREIGN_KEY_CHECKS = $check;");
    }
}
