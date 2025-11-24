<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Turf;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $password = Hash::make('password123');

        $admin = User::create([
            'name' => 'Platform Admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'address' => 'Admin Office',
            'password' => $password,
            'role' => 'admin',
            'status' => 'active',
        ]);

        $owner = User::create([
            'name' => 'Owner Test',
            'email' => 'owner@example.com',
            'phone' => '9876543210',
            'address' => 'Owner Address',
            'password' => $password,
            'role' => 'owner',
            'status' => 'active',
        ]);

        $user = User::create([
            'name' => 'User Test',
            'email' => 'user@example.com',
            'phone' => '5554443333',
            'address' => 'User Address',
            'password' => $password,
            'role' => 'user',
            'status' => 'active',
        ]);

        $turf = Turf::create([
            'owner_id' => $owner->id,
            'category_id' => null,
            'name' => 'Green Valley Football Turf',
            'slug' => Str::slug('Green Valley Football Turf'),
            'sport_type' => 'football',
            'location' => 'Green Valley Sports Complex',
            'city' => 'Mumbai',
            'description' => 'Premium football turf with flood lights and changing rooms.',
            'base_price' => 1200,
            'image_url' => 'https://images.unsplash.com/photo-1607414721186-5309963d7b52?auto=format&fit=crop&w=800',
            'status' => 'active',
        ]);

        $slots = collect();

        foreach (range(0, 2) as $dayOffset) {
            $date = now()->addDays($dayOffset)->toDateString();
            $slots->push(Slot::create([
                'turf_id' => $turf->id,
                'date' => $date,
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'price' => 1200,
                'status' => 'available',
            ]));

            $slots->push(Slot::create([
                'turf_id' => $turf->id,
                'date' => $date,
                'start_time' => '19:00:00',
                'end_time' => '20:00:00',
                'price' => 1300,
                'status' => 'available',
            ]));
        }

        $firstSlot = $slots->first();
        $firstSlot->update(['status' => 'booked']);

        $booking = Booking::create([
            'user_id' => $user->id,
            'turf_id' => $turf->id,
            'slot_id' => $firstSlot->id,
            'total_amount' => $firstSlot->price,
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        UserNotification::create([
            'user_id' => $user->id,
            'message' => 'Your booking for Green Valley Football Turf is confirmed.',
            'type' => 'booking',
            'status' => 'unread',
        ]);

        UserNotification::create([
            'user_id' => $owner->id,
            'message' => "{$user->name} booked Green Valley Football Turf on {$firstSlot->date}.",
            'type' => 'booking',
            'status' => 'unread',
        ]);
    }
}
