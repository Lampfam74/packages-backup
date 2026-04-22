Voici ton **README.md en pur Markdown (propre, prêt Packagist / GitHub)** 👇
# Laravel Backup Manager

A simple and powerful Laravel package to automate full project backups.

It allows you to backup:

- 🗄 Database (MySQL / PostgreSQL)
- 📁 Laravel application files
- 💾 Storage folder
- ⚙️ .env file
- 📦 Automatic ZIP compression
- ⏰ Scheduler support

---

# 🚀 Features

- Full database backup (MySQL / PostgreSQL)
- Backup of Laravel project files
- Secure `.env` backup
- ZIP compression support
- Artisan command integration
- Scheduler (cron ready)
- Lightweight & fast

---

# 📥 Installation

Install via Composer:

```bash
composer require lampdevs/backup
````

---

# ⚙️ Publish Configuration

```bash
php artisan vendor:publish --tag=backup-config
```

---

# 🧠 Usage

Run backup manually:

```bash
php artisan lamp:backup
```

---

# ⏰ Scheduler (Automatic Backup)

Add this to `app/Console/Kernel.php`:

```php
protected function schedule($schedule)
{
    $schedule->command('lamp:backup')->daily();
}
```

---

# 📁 Backup Output

Backups are stored in:

```text
storage/app/backups/
```

Example:

```text
backup-2026-04-22-120000.zip
```

Inside ZIP:

```text
database.sql
.env
storage/
app/
```

---

# ⚙️ Configuration

File: `config/backup.php`

```php
return [
    'path' => storage_path('app/backups'),
    'database' => true,
    'files' => true,
    'zip' => true,
    'keep_days' => 7,
];
```

---

# 🔐 Security Notes

* Never expose `.env`
* Use scheduler in production
* Store backups outside public directory
* Protect backup folder with server rules

---

# 🧪 Requirements

* PHP >= 8.2
* Laravel >= 10
* ZipArchive enabled
* mysqldump / pg_dump available

---

# 🛠 Example Command

```bash
php artisan lamp:backup
```

Output:

```text
Backup started...
Database backed up
Storage backed up
ZIP created
Backup completed successfully
```

---

# 📌 Roadmap

* Cloud storage (AWS S3 / Google Drive)
* Backup encryption
* Restore command
* Web dashboard UI
* Email / Slack notifications

---

# 🤝 Author

**LampDevs**
ERP & DevSecOps Solutions

---

# 📄 License

MIT License

```

---

Si tu veux, je peux maintenant te faire :

👉 Packagist-ready GitHub repo structure  
👉 ServiceProvider + auto-discovery clean  
👉 Restore system (`php artisan lamp:restore`)  
👉 Cloud backup (S3 / FTP / Google Drive)

Dis juste : **“upgrade package pro”** 🚀
```
