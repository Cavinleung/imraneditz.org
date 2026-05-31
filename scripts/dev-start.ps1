# Start local MariaDB + Laravel dev server
$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)
$Local = Join-Path $Root ".local"
$Php = Join-Path $Local "php\php.exe"
$MariaBase = Join-Path $Local "mariadb\mariadb-10.11.13-winx64"
$MariaIni = Join-Path $Local "mariadb\my.ini"
$mysqld = Join-Path $MariaBase "bin\mysqld.exe"

if (-not (Test-Path (Join-Path $Root ".env"))) {
    Write-Host "Run dev-setup first: powershell -ExecutionPolicy Bypass -File scripts/dev-setup.ps1"
    exit 1
}

$existing = Get-Process mysqld -ErrorAction SilentlyContinue | Where-Object { $_.Path -like "*imraneditz.org*" }
if (-not $existing) {
    Write-Host "Starting MariaDB on port 3307..."
    Start-Process -FilePath $mysqld -ArgumentList "--defaults-file=$MariaIni" -WindowStyle Hidden
    Start-Sleep -Seconds 3
}

Write-Host ""
Write-Host "Preview URL: http://127.0.0.1:8000"
Write-Host "Scroll down to the tutorial section on the homepage."
Write-Host "Press Ctrl+C to stop."
Write-Host ""

Push-Location $Root
& $Php artisan serve --host=127.0.0.1 --port=8000
