<?php

namespace Tests\Feature;

use App\Models\SafeExam;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SafeExamControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $usuario = null;

    private $required = [
        'classroom' => 'word',
        'url' => 'url',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->usuario = User::factory()->create();
    }

    public function testIndex()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->create([
            'user_id' => $this->usuario,
        ]);

        // When
        $response = $this->get(route('safe_exams.index'));

        // Then
        $response->assertSuccessful()->assertSee($safe_exam->classroom);
    }

    public function testNotAuthNotIndex()
    {
        // Auth
        // Given
        // When
        $response = $this->get(route('safe_exams.index'));

        // Then
        $response->assertRedirect(route('login'));
    }

    public function testCreate()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        // When
        $response = $this->get(route('safe_exams.create'));

        // Then
        $response->assertSuccessful()->assertSeeInOrder([__('New classroom'), __('Save')]);
    }

    public function testNotAuthNotCreate()
    {
        // Auth
        // Given
        // When
        $response = $this->get(route('safe_exams.create'));

        // Then
        $response->assertRedirect(route('login'));
    }

    public function testStore()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->make();
        $total = SafeExam::all()->count();

        // When
        $this->post(route('safe_exams.store'), $safe_exam->toArray());

        // Then
        $this->assertCount($total + 1, SafeExam::all());
    }

    public function testNotAuthNotStore()
    {
        // Auth
        // Given
        $safe_exam = SafeExam::factory()->make();

        // When
        $response = $this->post(route('safe_exams.store'), $safe_exam->toArray());

        // Then
        $response->assertRedirect(route('login'));
    }

    public function testStoreUntestedRequiredFields()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $empty = new SafeExam();
        foreach ($this->required as $field => $faker) {
            $empty->$field = fake()->$faker();
        }

        // When
        $response = $this->post(route('safe_exams.store'), $empty->toArray());

        // Then
        $response->assertSessionHasNoErrors();
    }

    private function storeRequires(string $field)
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->make([$field => null]);

        // When
        $response = $this->post(route('safe_exams.store'), $safe_exam->toArray());

        // Then
        $response->assertSessionHasErrors($field);
    }

    public function testStoreTestingNotRequiredFields()
    {
        foreach ($this->required as $field => $faker) {
            $this->storeRequires($field);
        }
    }

    public function testEdit()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->create();

        // When
        $response = $this->get(route('safe_exams.edit', $safe_exam), $safe_exam->toArray());

        // Then
        $response->assertSuccessful()->assertSeeInOrder([$safe_exam->classroom, __('Save')]);
    }

    public function testNotAuthNotEdit()
    {
        // Auth
        // Given
        $safe_exam = SafeExam::factory()->create();

        // When
        $response = $this->get(route('safe_exams.edit', $safe_exam), $safe_exam->toArray());

        // Then
        $response->assertRedirect(route('login'));
    }

    public function testUpdate()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->create();
        $safe_exam->classroom = fake()->word();

        // When
        $this->put(route('safe_exams.update', $safe_exam), $safe_exam->toArray());

        // Then
        $this->assertDatabaseHas('safe_exams', ['id' => $safe_exam->id, 'classroom' => $safe_exam->classroom]);
    }

    public function testNotAuthNotUpdate()
    {
        // Auth
        // Given
        $safe_exam = SafeExam::factory()->create();
        $safe_exam->classroom = fake()->word();

        // When
        $response = $this->put(route('safe_exams.update', $safe_exam), $safe_exam->toArray());

        // Then
        $response->assertRedirect(route('login'));
    }

    public function testUpdateUntestedRequiredFields()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->create();
        $empty = new SafeExam();
        foreach ($this->required as $field => $faker) {
            $empty->$field = fake()->$faker();
        }

        // When
        $response = $this->put(route('safe_exams.update', $safe_exam), $empty->toArray());

        // Then
        $response->assertSessionHasNoErrors();
    }

    private function updateRequires(string $field)
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->create();
        $safe_exam->$field = null;

        // When
        $response = $this->put(route('safe_exams.update', $safe_exam), $safe_exam->toArray());

        // Then
        $response->assertSessionHasErrors($field);
    }

    public function testUpdateTestingNotRequiredFields()
    {
        foreach ($this->required as $field => $faker) {
            $this->updateRequires($field);
        }
    }

    public function testDelete()
    {
        // Auth
        $this->actingAs($this->usuario);

        // Given
        $safe_exam = SafeExam::factory()->create();

        // When
        $this->delete(route('safe_exams.destroy', $safe_exam));

        // Then
        $this->assertDatabaseMissing('safe_exams', $safe_exam->toArray());
    }

    public function testNotAuthNotDelete()
    {
        // Auth
        // Given
        $safe_exam = SafeExam::factory()->create();

        // When
        $response = $this->delete(route('safe_exams.destroy', $safe_exam));

        // Then
        $response->assertRedirect(route('login'));
    }
}
