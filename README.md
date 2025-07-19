# 🚀 App Setup Guide

![PHP](https://img.shields.io/badge/php-8.2%2B-blue)
![Laravel](https://img.shields.io/badge/laravel-12.x-red)
![Last Commit](https://img.shields.io/github/last-commit/Nurlan270/fork-feed)
[![wakatime](https://wakatime.com/badge/github/Nurlan270/fork-feed.svg)](https://wakatime.com/badge/github/Nurlan270/fork-feed)

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
```
git clone https://github.com/Nurlan270/fork-feed.git
```

## 2. Install Composer Dependencies
```
composer install
```

## 3. Set Up Environment
```
cp .env.example .env && php artisan key:generate
```

Configure your .env:
- Mailtrap credentials (if SMTP is used)
- Typesense credentials (if Search is used)
- Socialite credentials (if OAuth2 is used)

## 4. Publish Sail Assets
```
php artisan sail:publish
```

## 5. Start Docker (Laravel Sail)
```
./vendor/bin/sail up -d
```

## 6. Install NPM Packages
```
./vendor/bin/sail npm install
```

## 7. Build Assets
```
./vendor/bin/sail npm run build
```

## 8. Create Storage Directories
```
mkdir public/storage ./storage/app/public/avatars/ ./storage/app/public/banners ./storage/app/public/recipe-images
```

## 9. Link Storage
```
./vendor/bin/sail php artisan storage:link
```

## 10. Run Migrations
```
./vendor/bin/sail php artisan migrate --seed
```

---

> #### ⚠️ Note: To ensure that features like chat, email notifications, and full-text search work correctly, you need to run the queue worker. You can start it using the following command:
```
./vendor/bin/sail php artisan queue:work --queue=chats,scout,notifications
```

---

## ⚙️ Optional Configurations

### 1. 📧 Configure Mailtrap for Email Sending (SMTP)

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

### 2. 🔎 Typesense (Full-Text Search)

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

### 3. 🔐 Laravel Socialite (OAuth2)

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

### 4. 📡 Laravel Reverb (Websockets)
 
1. Run the following command to generate Reverb keys:

```
./vendor/bin/sail php artisan reverb:generate
```

2. Build the assets again **(That's Important!)**:

```
./vendor/bin/sail npm run build
```

3. Start the Reverb server:

```
./vendor/bin/sail php artisan reverb:start
```

Then you'll also need to restart queue workers, if they are currently running:
1. Stop the currently running queue workers
2. Re-run queue workers:

```
./vendor/bin/sail php artisan queue:work --queue=chats,scout,notifications
```

> #### ⚠️ Note: If you don't configure these features, certain parts of the app may throw errors or not function as expected
