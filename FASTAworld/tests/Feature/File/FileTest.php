<?php

namespace Tests\Feature\File;

use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): User{
        return User::factory()->create();
    }

    private function uploadTestFile(User $user): File{
        Storage::fake('public');
        $fileContent = ">Test_sequence\nATCGATCG";

        $file = UploadedFile::fake()->createWithContent('test.fasta', $fileContent);
        
        $this->actingAs($user)->post('/files/upload',[
            'file' => $file,
            'name' => 'test_file',
            'sequence_type'=>'rna',
        ])->assertRedirect(route('files'))
        ->assertSessionHas('success', 'File uploaded successfully!');

        $savedFile = File::where('filename', 'test.fasta')->first();
        $this->assertNotNull($savedFile, 'The file doesnt exist');

        return $savedFile;
    }
    public function test_upload_page_can_be_rendered(): void{
        $user = $this->createUser();
        $this->actingAs($user)->get('/upload')
        ->assertStatus(200);
    }

    public function test_database_page_can_be_rendered(): void{
        $user = $this->createUser();
        $this->actingAs($user)->get('/files')
        ->assertStatus(200);
    }

    public function test_file_page_can_be_rendered(): void{
        $user = $this->createUser();
        $file = $this->uploadTestFile($user);

        $this->actingAs($user)->get("/files/{$file->id}/analyze")
            ->assertSessionHas('success', 'File analyzed successfully.');

        $this->actingAs($user)->get("/files/{$file->id}")
            ->assertStatus(200);
        
    }
    public function test_file_can_be_analyzed(): void{
        $user = $this->createUser();
        $file = $this->uploadTestFile($user);

        $this->actingAs($user)->get("/files/{$file->id}/analyze")
        ->assertSessionHas('success', 'File analyzed successfully.');
    }

    public function test_user_can_upload_file(): void{
        $user = $this->createUser();
        $file = $this->uploadTestFile($user);

        Storage::disk('public')->exists('uploads/' . $file);
        $this->assertDatabaseHas('files', [
            'name' => 'test_file',
            'filename' => 'test.fasta',
            'type' => 'rna',
            'user_id' => $user->id,
        ]);
    }

    
    public function test_user_can_edit_file(): void{
        $user = $this->createUser();
        $file = $this->uploadTestFile($user);

        $response = $this->actingAs($user)->put('/files/'.$file->id.'/update',[
            'filename' => 'new_test_file',
            'sequence_type' => 'dna',
        ]);

        $response->assertRedirect(route('files'));
        $this->assertDatabaseHas('files', [
            'id' => $file->id,
            'name' => 'new_test_file',
            'type' => 'dna',
        ]);
    }

    public function test_user_can_delete_file():void{
        $user = $this->createUser();
        $file = $this->uploadTestFile($user);

        $response = $this->actingAs($user)->delete('/files/'.$file->id);

        $response->assertSessionHas('success', 'File deleted successfully!');
    }
}
