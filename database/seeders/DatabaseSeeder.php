<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SectionSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(KitchenSeeder::class);
        $this->call(MethodSeeder::class);
        $this->call(CookSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(PortionSeeder::class);
        $this->call(NormSeeder::class);
        $this->call(RedirectSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(CalcColumnSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AdSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(CalcSeeder::class);
        $this->call(MineralColumnSeeder::class);
        $this->call(MineralSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(HeadingSeeder::class);
        User::factory()->create([
            'name' => 'nurik',
            'email' => 'nurik@mail.ru',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        \App\Models\User::factory(1000)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
