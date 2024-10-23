@echo off
REM Defina o caminho para o php.ini
set "phpIni=C:\xampp\php\php.ini"

REM Habilitar extensões necessárias no php.ini
powershell -Command "(gc %phpIni%) -replace ';extension=intl', 'extension=intl' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=fileinfo', 'extension=fileinfo' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=mbstring', 'extension=mbstring' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=openssl', 'extension=openssl' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=pdo_mysql', 'extension=pdo_mysql' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=zip', 'extension=zip' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=curl', 'extension=curl' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=xml', 'extension=xml' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=soap', 'extension=soap' | Out-File %phpIni% -Encoding UTF8"
powershell -Command "(gc %phpIni%) -replace ';extension=gd', 'extension=gd' | Out-File %phpIni% -Encoding UTF8"

echo Extensões habilitadas com sucesso no php.ini!
echo Reinicie o Apache para aplicar as alterações.
pause
