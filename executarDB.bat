@echo off

REM Define o diretório base (local do script)
set BASE_DIR=%~dp0

REM Calcula o caminho de volta para o diretório do XAMPP
set XAMPP_DIR=%BASE_DIR%..\..\..\

REM Adiciona o MySQL ao PATH temporariamente
set PATH=%PATH%;%XAMPP_DIR%mysql\bin

REM Iniciar o Apache e MySQL do XAMPP
echo Iniciando Apache...
start "" "%XAMPP_DIR%apache_start.bat"
echo Iniciando MySQL...
start "" "%XAMPP_DIR%mysql_start.bat"

REM Pausa para garantir que os serviços estão rodando
timeout /t 10

REM Definindo o caminho relativo para o arquivo SQL
set SQL_FILE=%BASE_DIR%base1.sql

REM Criar a base de dados e importar o arquivo .sql
echo Criando e importando a base de dados...
mysql -u root --skip-password -e "CREATE DATABASE IF NOT EXISTS base1;"
mysql -u root --skip-password base1 < "%SQL_FILE%"

echo Importação concluída.
pause
