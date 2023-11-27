<?php



namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // Add this line
use App\Models\User; // Assuming User is also in App\Models
use Illuminate\Support\Facades\Hash; // For Hash::make

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::where('name', 'admin')->first();

        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Fintan Gallagher';
        $admin->email = 'fintan@larafest.ie';
        $admin->password = Hash::make('password');
        $admin->save();

        $admin->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@larafest.ie';
        $user->password = Hash::make('password');
        $user->save();

        $user->roles()->attach($role_user);


    }
}
