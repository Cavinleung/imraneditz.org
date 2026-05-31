# Local dev bootstrap (no admin required)
$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)
$Local = Join-Path $Root ".local"
$Php = Join-Path $Local "php\php.exe"
$Composer = Join-Path $Local "bin\composer.phar"
$MariaBase = Join-Path $Local "mariadb\mariadb-10.11.13-winx64"
$MariaIni = Join-Path $Local "mariadb\my.ini"
$DataDir = Join-Path $Local "mariadb\data"

function Ensure-PhpExtensions {
    $ini = Join-Path $Local "php\php.ini"
    if (-not (Test-Path $ini)) {
        Copy-Item (Join-Path $Local "php\php.ini-development") $ini
    }
    $content = Get-Content $ini -Raw
    $content = $content -replace ';extension_dir = "ext"', 'extension_dir = "ext"'
    foreach ($ext in @('curl','fileinfo','gd','mbstring','exif','mysqli','openssl','pdo_mysql','zip','bcmath','intl')) {
        $content = $content -replace ";extension=$ext", "extension=$ext"
    }
    Set-Content -Path $ini -Value $content -Encoding ASCII
}

Write-Host "Configuring PHP extensions..."
Ensure-PhpExtensions

if (-not (Test-Path $DataDir)) {
    New-Item -ItemType Directory -Force -Path $DataDir | Out-Null
}
$mysqlMarker = Join-Path $DataDir "mysql"
if (-not (Test-Path $mysqlMarker)) {
    Write-Host "Initializing MariaDB data directory..."
    & (Join-Path $MariaBase "bin\mysql_install_db.exe") --datadir=$DataDir --default-user --password=
}

Write-Host "Starting MariaDB on port 3307..."
$mysqld = Join-Path $MariaBase "bin\mysqld.exe"
$existing = Get-Process mysqld -ErrorAction SilentlyContinue | Where-Object { $_.Path -like "*imraneditz.org*" }
if (-not $existing) {
    Start-Process -FilePath $mysqld -ArgumentList "--defaults-file=$MariaIni" -WindowStyle Hidden
    Start-Sleep -Seconds 4
}

$mysql = Join-Path $MariaBase "bin\mysql.exe"
& $mysql -uroot -P3307 -e "CREATE DATABASE IF NOT EXISTS imraneditz CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>$null

Write-Host "Importing database schema..."
Get-Content (Join-Path $Root "database\sql\install.sql") -Raw -Encoding UTF8 | & $mysql -uroot -P3307 imraneditz
Get-Content (Join-Path $Root "database\sql\local-seed.sql") -Raw -Encoding UTF8 | & $mysql -uroot -P3307 imraneditz

if (-not (Test-Path (Join-Path $Root ".env"))) {
    Write-Host "Creating .env ..."
    @"
APP_NAME=imraneditz
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=imraneditz
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

DUJIAO_ADMIN_LANGUAGE=zh_CN
ADMIN_ROUTE_PREFIX=admin
ADMIN_HTTPS=false
"@ | Set-Content (Join-Path $Root ".env") -Encoding UTF8
}

Write-Host "Running composer install..."
Push-Location $Root
& $Php $Composer install --no-interaction --prefer-dist --ignore-platform-reqs
if (-not (Select-String -Path (Join-Path $Root ".env") -Pattern '^APP_KEY=base64:' -Quiet)) {
    & $Php artisan key:generate --force
}
if (-not (Test-Path (Join-Path $Root "install.lock"))) {
    New-Item -ItemType File -Path (Join-Path $Root "install.lock") -Force | Out-Null
}
Pop-Location

Write-Host ""
Write-Host "Local environment is ready."
Write-Host "Run: powershell -ExecutionPolicy Bypass -File scripts/dev-start.ps1"
Write-Host "Preview URL: http://127.0.0.1:8000"
