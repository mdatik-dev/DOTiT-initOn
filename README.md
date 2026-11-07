# DOTiT Limited website

The original landing page has been moved into Laravel Blade without changing its layout or animation styling. The site uses MySQL for its services, editable website text, admin accounts, and contact form inquiries.

## Requirements

- PHP 8.2+
- Composer
- MySQL 8+ (XAMPP MySQL is supported)

## Local setup

1. Create a MySQL database named `dotit` in phpMyAdmin (or use another name and update `.env`).
2. From this project directory, run:

   ```powershell
   Copy-Item .env.example .env
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan admin:create
   php artisan serve
   ```

3. For XAMPP Apache, start Apache and MySQL in the XAMPP Control Panel, then open `http://localhost/DOTiT/`. The project-root `.htaccess` and `index.php` serve Laravel internally, so `/public` is not part of the site URL. The admin login is at `http://localhost/DOTiT/admin/login`.

Alternatively, run `php artisan serve` and open `http://127.0.0.1:8000`.

The `admin:create` command asks for an administrator name, email, and a password of at least 12 characters. No default administrator credentials are included.

## Admin features

- Redesigned dashboard with service and inquiry counts, quick actions, and a saved dark/light theme toggle.
- Edit the landing page's hero, about, services, partner, and contact text.
- Create, edit, publish, reorder, feature, or delete services.
- Create, edit, publish, reorder, and delete team profiles, including profile photos and downloadable PDF CVs.
- Review and delete website contact submissions.

## Website pages

- `/` — Home (includes the complete original landing page).
- `/about` — About DOTiT.
- `/services` — Services.
- `/initon` — initOn digital marketing partner.
- `/process` — How we work.
- `/contact` — Contact form and business details.
- `/team` — Our Team directory; each published member has a CV-style profile page.

The project root includes an Apache `.htaccess` and a small `index.php` front controller. In XAMPP, open `http://localhost/DOTiT/`; the app serves Laravel from `public/` internally, so the URL does not need `/public`. Keep `mod_rewrite` enabled and `AllowOverride All` on the project directory. When deploying, upload the complete Laravel project (including `vendor/`), configure `.env`, and make sure Apache rewrite rules are enabled. If the hosting provider allows it, configure the domain's document root to this project's `public/` directory; that is Laravel's recommended production setup. Otherwise, the included root front controller and rewrite rules can serve the site without exposing a directory listing.

## Notes

- Contact submissions are validated, stored in the `contact_messages` table, and protected by Laravel CSRF middleware and request throttling.
- The database is configured through `.env`; `.env.example` contains the XAMPP MySQL defaults.
- Public assets and the original website JavaScript are in `public/assets`, `public/css`, and `public/js`.
- Team photos and CVs are stored on Laravel's public disk. Run `php artisan storage:link` after setup/deployment so uploaded files are visible from the website.
- A fresh seeded database includes four clearly labeled fictional sample team profiles. Replace them with verified team details in Admin → Our Team; the sample labels can be removed there before publishing real profiles.
