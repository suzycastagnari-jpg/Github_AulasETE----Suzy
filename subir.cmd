@echo off
chcp 65001 >nul
title GitHub - Projeto PHP

:: =====================================================
:: CONFIGURACAO
:: =====================================================

set "PROJETO=Aulagithub_20-08---Suzy"
set "USUARIO=suzycastagnari-jpg"
set "REPOSITORIO=Aulagithub_20-08---Suzy"
set "PASTA=aula6"

:: =====================================================
:: CRIAR README
:: =====================================================

echo Criando README.md...

(
echo # 🐘 %PROJETO%
echo.
echo ## 💻 Projeto PHP salvo em %date% as %time%
echo.
echo Projeto desenvolvido durante as aulas de PHP.
echo.
echo O projeto apresenta conceitos de desenvolvimento web,
echo organizacao de codigo e arquitetura MVC.
echo.
echo ---
echo.
echo ## 📚 Tecnologias utilizadas
echo.
echo - 🐘 PHP
echo - 🗄️ MySQL
echo - 🔗 PDO
echo - 🏗️ MVC
echo - 📦 Composer
echo - 🌐 HTML
echo - 🎨 CSS
echo.
echo ---
echo.
echo ## 📂 Estrutura do projeto
echo.
echo ```text
echo aula6/
echo ├── public/
echo ├── src/
echo │   ├── Config/
echo │   ├── Controller/
echo │   ├── DAO/
echo │   ├── Model/
echo │   └── View/
echo └── vendor/
echo     └── composer/
echo ```
echo.
echo ---
echo.
echo ## 🚀 Objetivo
echo.
echo Desenvolver conhecimentos em PHP,
echo banco de dados MySQL, PDO e arquitetura MVC.
echo.
echo ---
echo.
echo ## 👩‍💻 Desenvolvedora
echo.
echo **Suzy Castagnari**
echo.
echo Projeto academico desenvolvido durante
echo as aulas de Tecnologia da Informacao.
echo.
echo ---
echo.
echo ⭐ Projeto desenvolvido para fins educacionais.
) > README.md

echo README.md criado com sucesso!
echo.

:: =====================================================
:: GIT
:: =====================================================

echo ========================================
echo        CONFIGURANDO REPOSITORIO
echo ========================================
echo.

if not exist ".git" (
    echo Inicializando Git...
    git init
) else (
    echo Git ja inicializado.
)

echo.
echo Adicionando arquivos...
git add . -v

echo.
echo Criando commit...
git commit -m "first commit"

echo.
echo Configurando branch main...
git branch -M main

echo.
echo Verificando repositorio remoto...

git remote get-url origin >nul 2>&1

if errorlevel 1 (
    echo Adicionando repositorio remoto...
    git remote add origin git@github.com:%USUARIO%/%REPOSITORIO%.git
) else (
    echo Repositorio remoto ja configurado.
)

echo.
echo Enviando arquivos para o GitHub...
git push -u origin main

echo.
echo ========================================
echo       CONCLUIDO COM SUCESSO!
echo ========================================
echo.

start https://github.com/suzycastagnari-jpg/Github_AulasETE----Suzy/tree/main

pause