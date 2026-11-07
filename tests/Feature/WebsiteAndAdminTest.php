<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WebsiteAndAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_active_services_and_saved_content(): void
    {
        SiteSetting::query()->create(['key' => 'hero_line_1', 'value' => 'A saved headline']);
        Service::query()->create([
            'name' => 'Published service',
            'description' => 'Visible service description',
            'icon' => 'fa-solid fa-code',
            'link_label' => 'Discuss',
            'is_active' => true,
            'sort_order' => 1,
        ]);
        Service::query()->create([
            'name' => 'Hidden service',
            'description' => 'Not visible',
            'icon' => 'fa-solid fa-code',
            'link_label' => 'Discuss',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('A saved headline')
            ->assertSee('Published service')
            ->assertDontSee('Hidden service')
            ->assertSee('contact-form');
    }

    public function test_each_website_section_has_its_own_page(): void
    {
        $pages = [
            'about' => 'ABOUT DOTiT',
            'services' => 'WHAT WE DO',
            'initon' => 'DIGITAL MARKETING PARTNER',
            'process' => 'HOW WE WORK',
            'contact' => 'Have a project',
        ];

        foreach ($pages as $slug => $content) {
            $this->get(route('pages.show', $slug))
                ->assertOk()
                ->assertSee($content)
                ->assertSee(route('pages.show', $slug === 'contact' ? 'about' : 'contact'));
        }

        $this->get('/not-a-page')->assertNotFound();
    }

    public function test_each_page_includes_shared_reveal_animation_script(): void
    {
        foreach (['home', 'about', 'services', 'initon', 'process', 'contact', 'team'] as $page) {
            $url = match ($page) {
                'home' => route('home'),
                'team' => route('team.index'),
                default => route('pages.show', $page),
            };

            $this->get($url)
                ->assertOk()
                ->assertSee('js/script.js')
                ->assertSee('css/site.css');
        }
    }

    public function test_contact_form_spans_below_the_contact_details_and_logo(): void
    {
        $this->get(route('pages.show', 'contact'))
            ->assertOk()
            ->assertSee('class="contact-top-row"', false)
            ->assertSee('class="contact-form contact-form-full reveal"', false)
            ->assertSee('class="contact-form-fields"', false)
            ->assertSee('class="contact-form-footer"', false);
    }

    public function test_team_directory_is_separate_and_only_shows_published_members(): void
    {
        TeamMember::query()->create([
            'name' => 'Published Team Member',
            'slug' => 'published-team-member',
            'role' => 'Product Designer',
            'short_bio' => 'Designing clear, useful digital experiences.',
            'is_active' => true,
        ]);
        TeamMember::query()->create([
            'name' => 'Hidden Team Member',
            'slug' => 'hidden-team-member',
            'role' => 'Developer',
            'short_bio' => 'A hidden team profile.',
            'is_active' => false,
        ]);

        $this->get(route('team.index'))
            ->assertOk()
            ->assertSee('Published Team Member')
            ->assertDontSee('Hidden Team Member')
            ->assertSee('Our Team');

        $this->get(route('home'))->assertDontSee('Published Team Member');
        $this->get(route('team.show', 'hidden-team-member'))->assertNotFound();
    }

    public function test_database_seeder_adds_labeled_sample_team_profiles_only_once(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('team_members', 4);
        $this->assertDatabaseHas('team_members', [
            'slug' => 'sample-member-01',
            'is_sample' => true,
        ]);
        $this->get(route('team.index'))
            ->assertOk()
            ->assertSee('Sample Member 01')
            ->assertSee('SAMPLE PROFILE');
        $this->get(route('team.show', 'sample-member-01'))
            ->assertOk()
            ->assertSee('Fictional sample profile.');
    }

    public function test_team_profile_shows_resume_information_and_cv_download_link(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('team/cvs/profile.pdf', '%PDF-1.4 example');
        $teamMember = TeamMember::query()->create([
            'name' => 'Experienced Developer',
            'slug' => 'experienced-developer',
            'role' => 'Software Engineer',
            'short_bio' => 'Builds reliable web applications.',
            'biography' => 'A detailed professional biography.',
            'skills' => 'Laravel, PHP, MySQL',
            'experience' => 'Software Engineer, DOTiT, 2024-present',
            'education' => 'BSc in Computer Science',
            'certifications' => 'Cloud certification',
            'languages' => 'Bangla, English',
            'cv_file_path' => 'team/cvs/profile.pdf',
            'is_active' => true,
        ]);

        $this->get(route('team.show', $teamMember))
            ->assertOk()
            ->assertSee('Download CV')
            ->assertSee('A detailed professional biography.')
            ->assertSee('Laravel')
            ->assertSee('Software Engineer, DOTiT, 2024-present')
            ->assertSee('BSc in Computer Science')
            ->assertSee(asset('storage/team/cvs/profile.pdf'));
    }

    public function test_contact_form_stores_a_valid_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Example Client',
            'email' => 'client@example.com',
            'phone' => '+880123456789',
            'service' => 'Website Development',
            'message' => 'Please contact me about a new website.',
            'return_to' => 'home',
        ]);

        $response->assertRedirect(route('home').'#contact-form');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Example Client',
            'email' => 'client@example.com',
            'service' => 'Website Development',
        ]);
    }

    public function test_contact_form_returns_the_user_to_the_contact_page_when_submitted_there(): void
    {
        $this->post(route('contact.store'), [
            'name' => 'Contact Page Client',
            'email' => 'contact-page@example.com',
            'message' => 'I am using the dedicated contact page.',
            'return_to' => 'contact',
        ])->assertRedirect(route('pages.show', 'contact').'#contact-form');
    }

    public function test_admin_routes_require_an_admin_account(): void
    {
        $this->get(route('admin.login'))->assertOk();
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create(['is_admin' => false]))
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_sign_in_with_valid_credentials(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'correct-horse-battery',
            'is_admin' => true,
        ]);

        $this->post(route('admin.login.store'), [
            'email' => 'admin@example.com',
            'password' => 'correct-horse-battery',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_login_shows_remember_option_and_password_visibility_control(): void
    {
        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('name="remember"', false)
            ->assertSee('aria-label="Show password"', false)
            ->assertSee('admin-login.js');
    }

    public function test_admin_dashboard_has_a_persistent_theme_toggle(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]))
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('admin-theme-toggle', false)
            ->assertSee('admin-theme.js');
    }

    public function test_admin_can_update_content_and_manage_services(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $settings = SiteSetting::defaults();
        $settings['hero_line_1'] = 'Managed by admin';

        $this->put(route('admin.settings.update'), ['settings' => $settings])
            ->assertRedirect();
        $this->assertDatabaseHas('site_settings', [
            'key' => 'hero_line_1',
            'value' => 'Managed by admin',
        ]);

        $this->post(route('admin.services.store'), [
            'name' => 'Admin-created service',
            'description' => 'Created from the dashboard.',
            'icon' => 'fa-solid fa-code',
            'link_label' => 'Discuss',
            'sort_order' => 1,
            'is_active' => '1',
            'is_featured' => '0',
        ])->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseHas('services', [
            'name' => 'Admin-created service',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_create_update_and_delete_team_profiles_with_uploaded_files(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $this->post(route('admin.team.store'), [
            'name' => 'Ayesha Rahman',
            'role' => 'Product Designer',
            'short_bio' => 'Creates accessible digital products.',
            'biography' => 'An experienced product designer.',
            'email' => 'ayesha@example.com',
            'skills' => 'UI Design, Figma',
            'experience' => 'Product Designer at DOTiT',
            'education' => 'BSc in Design',
            'sort_order' => 1,
            'is_active' => '1',
            'profile_photo' => UploadedFile::fake()->createWithContent(
                'ayesha.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAADUlEQVR4nGP4z8AAAAMBAQDJ/pLvAAAAAElFTkSuQmCC'),
            ),
            'cv_file' => UploadedFile::fake()->createWithContent('ayesha-cv.pdf', "%PDF-1.4\nSample CV"),
        ])->assertRedirect(route('admin.team.index'));

        $teamMember = TeamMember::query()->firstOrFail();
        $this->assertSame('ayesha-rahman', $teamMember->slug);
        $this->assertNotNull($teamMember->profile_photo_path);
        $this->assertNotNull($teamMember->cv_file_path);
        Storage::disk('public')->assertExists($teamMember->profile_photo_path);
        Storage::disk('public')->assertExists($teamMember->cv_file_path);

        $this->put(route('admin.team.update', $teamMember), [
            'name' => 'Ayesha Rahman',
            'role' => 'Senior Product Designer',
            'short_bio' => 'Creates thoughtful, accessible digital products.',
            'slug' => '',
            'sort_order' => 2,
            'is_active' => '1',
        ])->assertRedirect(route('admin.team.index'));

        $this->assertDatabaseHas('team_members', [
            'id' => $teamMember->id,
            'role' => 'Senior Product Designer',
            'slug' => 'ayesha-rahman',
            'sort_order' => 2,
        ]);

        $this->delete(route('admin.team.destroy', $teamMember))
            ->assertRedirect(route('admin.team.index'));

        $this->assertDatabaseMissing('team_members', ['id' => $teamMember->id]);
        Storage::disk('public')->assertMissing($teamMember->profile_photo_path);
        Storage::disk('public')->assertMissing($teamMember->cv_file_path);
    }

    public function test_admin_can_review_contact_messages(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $message = ContactMessage::query()->create([
            'name' => 'Review Client',
            'email' => 'review@example.com',
            'message' => 'A sample inquiry.',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.messages.show', $message))
            ->assertOk()
            ->assertSee('A sample inquiry.');

        $this->assertNotNull($message->fresh()->read_at);
    }
}
