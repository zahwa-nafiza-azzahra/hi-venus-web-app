<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\FieldType;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingSlot;
use App\Services\BookingConflictService;
use App\Services\RefundCalculationService;
use App\Services\SlotPricingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'user']);
        $this->fieldType = FieldType::create(['name' => 'Badminton']);
        $this->field = Field::create([
            'field_type_id' => $this->fieldType->id,
            'name' => 'Court 1',
            'price_offpeak' => 50000,
            'price_peak' => 75000,
            'is_active' => true,
        ]);
    }

    /** @test */
    public function a_user_can_create_a_booking_successfully()
    {
        $this->actingAs($this->user);

        $date = now()->addDays(2)->format('Y-m-d');
        $response = $this->post(route('bookings.store'), [
            'field_id' => $this->field->id,
            'booking_date' => $date,
            'slot_hours' => [8, 9] // 08:00 - 10:00
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'field_id' => $this->field->id,
            'user_id' => $this->user->id,
            'duration_hours' => 2
        ]);
        $this->assertDatabaseCount('booking_slots', 2);
    }

    /** @test */
    public function it_prevents_double_booking_of_the_same_slot()
    {
        $this->actingAs($this->user);
        $date = now()->addDays(2)->format('Y-m-d');

        // First booking
        Booking::factory()->create([
            'field_id' => $this->field->id,
            'booking_date' => $date,
        ])->slots()->create([
            'field_id' => $this->field->id,
            'slot_date' => $date,
            'slot_hour' => 10,
            'price' => 50000
        ]);

        // Try second booking on same slot
        $response = $this->from(route('bookings.create', ['field_id' => $this->field->id]))
            ->post(route('bookings.store'), [
                'field_id' => $this->field->id,
                'booking_date' => $date,
                'slot_hours' => [10]
            ]);

        $response->assertSessionHasErrors('slot_hours');
        $this->assertDatabaseCount('booking_slots', 1);
    }

    /** @test */
    public function it_calculates_refund_correctly_based_on_time_policy()
    {
        $refundService = new RefundCalculationService();

        // 1. More than 24 hours (100% refund)
        $booking100 = new Booking();
        $booking100->total_price = 100000;
        $booking100->booking_date = now()->addDays(2);
        $booking100->start_time = '10:00:00';
        
        $res100 = $refundService->calculate($booking100);
        $this->assertEquals(100000, $res100['amount']);
        $this->assertEquals(1.0, $res100['rate']);

        // 2. Between 12-24 hours (50% refund)
        $booking50 = new Booking();
        $booking50->total_price = 100000;
        $booking50->booking_date = now()->addHours(15);
        $booking50->start_time = now()->addHours(15)->format('H:00:00');

        $res50 = $refundService->calculate($booking50);
        $this->assertEquals(50000, $res50['amount']);
        $this->assertEquals(0.5, $res50['rate']);

        // 3. Less than 12 hours (0% refund)
        $booking0 = new Booking();
        $booking0->total_price = 100000;
        $booking0->booking_date = now()->addHours(5);
        $booking0->start_time = now()->addHours(5)->format('H:00:00');

        $res0 = $refundService->calculate($booking0);
        $this->assertEquals(0, $res0['amount']);
        $this->assertEquals(0.0, $res0['rate']);
    }
}
