<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;

class ReservationTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(
           [\App\Http\Middleware\VerifyCsrfToken::class]
        );
    }

    public function test_reservation_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('reservations.index'));

        $response->assertOk();
    }

    public function test_reservation_can_be_created(): void
    {
        $user = User::factory()->create();
        $table = Table::factory()->create();
    
        $this->actingAs($user);
    
        $reservationTime = now()->addDays(1)->setTime(18, 0);
    
        $response = $this->post(route('reservations.store'), [
            'user_id' => $user->id,
            'table_id' => $table->id,
            'reservation_time' => $reservationTime->format('H:i'),
            'date' => $reservationTime->toDateString(),
        ]);
        
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('reservations.index'));
    
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'table_id' => $table->id,
        ]);
    }
    

    public function test_reservation_can_be_updated(): void
    {
        $user = User::factory()->create();
        $table = Table::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'table_id' => $table->id,
        ]);
    
        $this->actingAs($user);
    
        $newReservationTime = now()->addDays(2)->setTime(19, 0);
    
        $response = $this->patch(route('reservations.update', $reservation->id), [
            'user_id' => $user->id,
            'table_id' => $table->id,
            'reservation_time' => $newReservationTime->format('H:i'),
            'date' => $newReservationTime->toDateString(),
        ]);
    
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('reservations.index'));
    
        $this->assertDatabaseHas('reservations', [
            'id' => $reservation->id,
            'reservation_time' => $newReservationTime,
        ]);
    }

    public function test_reservation_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $table = Table::factory()->create();
        
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'table_id' => $table->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('reservations.destroy', $reservation->id));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('reservations.index'));

        $this->assertDatabaseMissing('reservations', [
            'id' => $reservation->id,
        ]);
    }
}
