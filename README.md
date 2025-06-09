# E‑SHOP_DIGITIVA 📦

**Empowering seamless shopping experiences, effortlessly delivered.**

---

## ⚙️ Technologies

- **PHP**, **CSS**, *JavaScript*
- MVC struktura, modulární design

---

## 📋 Obsah

- [Přehled](#-přehled)  
- [Začínáme](#-začínáme)  
  - [Požadavky](#požadavky)  
  - [Instalace](#instalace)  
  - [Použití](#použití)  
  - [Testování](#testování)  
- [Funkce](#-funkce)  
- [Struktura projektu](#-struktura-projektu)  
- [Přispívání](#-přispívání)  
- [Licence](#-licence)  
- [Kontakt](#-kontakt)

---

## 🧐 Přehled

E‑Shop_DIGITIVA je robustní e‑commerce platforma určená k pohodlnému a efektivnímu online nakupování pro zákazníky i administrátory. Je navržena tak, aby poskytovala jednoduché rozhraní, přehledné uživatelské prostředí a snadnou správu.

---

## 🟢 Začínáme

### Požadavky

- PHP 7.4+  
- MySQL (nebo MariaDB)  
- Webový server (Apache/Nginx)  
- Composer

### Instalace

```bash
git clone https://github.com/Mareczech321/E-Shop_DIGITIVA.git
cd E-Shop_DIGITIVA
composer install
```
Nastav konfigurační soubor:

```ini
DB_HOST=localhost
DB_NAME=eshop
DB_USER=root
DB_PASS=heslo
```

Naimportuj databázi z `sql/schema.sql` pomocí phpMyAdmin nebo přes příkazovou řádku:

```bash
mysql -u root -p eshop < sql/schema.sql
```

Spusť lokální PHP server:

```bash
php -S localhost:8000
```

---

### Použití

- **Homepage**: `/`
- **Registrace**: `register.php`
- **Přihlášení**: `login.php`
- **Administrace**: `/admin` (přístupné pouze pro admina)
- **Košík**: `/cart`
- **Produkty**: `/products`
- **Odhlášení**: `logout.php`

---

### Testování

Základní testy můžeš spustit pomocí PHPUnit (pokud je nastaveno):

```bash
./vendor/bin/phpunit tests
```

Případně lze testovat manuálně:

- Registrace nového uživatele
- Přihlášení a ověření přístupů (admin vs. běžný uživatel)
- Přidávání/odebírání produktů do/z košíku
- Vytváření a správa produktů (admin)
- Zabezpečení a validace vstupů

---

## 🎯 Funkce

- ✅ Registrace a přihlášení uživatelů
- ✅ Rozlišení práv (zákazník vs. administrátor)
- ✅ Správa produktů v administračním rozhraní
- ✅ Nákupní košík
- ✅ Jednoduchý a přehledný front-end
- ✅ Bezpečnostní ošetření vstupů (základní validace, session správa)

---

## 📁 Struktura projektu

```plaintext
/
├── admin/         ← administrace (CRUD produktů)
├── cart/          ← správa košíku
├── products/      ← výpis produktů
├── config/        ← databázová konfigurace
├── css/           ← styly
├── img/           ← obrázky produktů/bannery
├── sql/           ← SQL schéma databáze
├── index.php      ← vstupní stránka
├── login.php      ← přihlášení
├── register.php   ← registrace
├── logout.php     ← odhlášení
└── vendor/        ← Composer balíčky
```

---

## 🤝 Přispívání

1. Forkni tento repozitář
2. Vytvoř větev: `feature/novy-feature`
3. Proveď změny a commituj
4. Otevři pull request pro review

---

## 📄 Licence

Projekt je k dispozici pod licencí **MIT**. Podrobnosti najdeš v souboru `LICENSE`.

---

## 📫 Kontakt

Máš dotaz, návrh nebo chceš spolupracovat?

- Vytvoř issue zde na GitHubu
- Nebo mě kontaktuj přes e-mail: `tvůj-email@example.com`
