# 🚀 App Setup Guide

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL
- Redis (for Sessions / Broadcasting / Queues)
- [Typesense](https://typesense.org/) (for Scout search)
- Docker (via Laravel Sail)

---

## 1. Clone the Repository
`
git clone https://github.com/Nurlan270/fork-feed.git
`

## 2. Install Composer Dependencies
`
composer install
`

## 3. Set Up Environment
`
cp .env.example .env && php artisan key:generate
`

Configure your .env:
- Typesense credentials (if Search is used)
- Socialite credentials (if OAuth2 is used)

## 4. Publish Sail Assets
`
php artisan sail:publish
`

## 5. Start Docker (Laravel Sail)
`
./vendor/bin/sail up -d
`

## 6. Install NPM Packages
`
./vendor/bin/sail npm install
`

## 7. Build Assets
`
./vendor/bin/sail npm run build
`

## 8. Create Storage Directories
`
mkdir public/storage ./storage/app/public/avatars/ ./storage/app/public/banners ./storage/app/public/recipe-images
`

## 9. Link Storage
`
./vendor/bin/sail php artisan storage:link
`

## 10. Run Migrations
`
./vendor/bin/sail php artisan migrate --seed
`

## ⚙️ Optional Configurations

### 📧 Configure Mailtrap for Email Sending (SMTP)
1. Create a Mailtrap Account
   - Go to https://mailtrap.io and sign up (or log in).
   - Create a new Inbox (if not already created).

2. Get SMTP Credentials
   - In your Mailtrap inbox, go to the "SMTP Settings" tab.
   - Choose the "Laravel" integration from the dropdown.
   - Copy the SMTP credentials provided (username, password), other credentials is already set for you.

3. Add the following to your `.env` file:
```env
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
```

### 🔎 Typesense (Full-Text Search)

If you'd like to enable full-text search using Typesense:

1. Sign up at [Typesense Cloud](https://cloud.typesense.org/).
2. Create a new cloud and copy your API key.
3. Add the following to your `.env` file:

```env
TYPESENSE_API_KEY=your-api-key
```

4. Import indexes:
```
./vendor/bin/sail php artisan scout:import "App\Models\User"
./vendor/bin/sail php artisan scout:import "App\Models\Recipe"
./vendor/bin/sail php artisan scout:import "App\Models\Ingredient"
```

### 🔐 Laravel Socialite (OAuth2)

To enable login with Google, GitHub:
1. Register your app with the provider (e.g., Google or GitHub).
2. Add the credentials to your `.env` file:

```env
GITHUB_CLIENT_ID=your-client-id
GITHUB_CLIENT_SECRET=your-client-secret

GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
```

Refer to the guides below for setup help:
- [🔗 GitHub OAuth2 Setup](https://docs.github.com/en/apps/oauth-apps/building-oauth-apps/creating-an-oauth-app)
- [🔗 Google OAuth2 Setup](https://support.google.com/googleapi/answer/6158849?hl=en)


> ⚠️ Note: If you don't configure these features, certain parts of the app may throw errors or not function as expected
