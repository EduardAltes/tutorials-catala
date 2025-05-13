# Tutorials amb Català - Projecte Laravel

Aquest projecte té com a objectiu desenvolupar una pàgina web on els usuaris poden accedir a tutorials de reparació de dispositius electrònics, com mòbils i càmeres de fotografia, en català. Es fa servir el framework **Laravel** i es realitza una integració amb l'API de **iFixit** per importar i traduir els tutorials.

## ✨ Característiques

* Importació automàtica de tutorials des de la API de iFixit
* Traducció automàtica al català amb Google Translate
* Sistema de categories
* Visualització de passos
* SEO amigable (sitemap, robots.txt, meta tags Open Graph)
* Integració amb Google Analytics i Search Console

## ⚡ Requisits previs

* PHP 8.1+
* Composer
* MySQL o SQLite
* Node.js i NPM

## 📅 Instal·lació

```bash
git clone https://github.com/EduardAltes/tutorials-catala.git
cd tutorials-catala
composer install
cp .env.example .env
php artisan key:generate
```

Configura la base de dades al `.env`:

```
DB_DATABASE=tutorials
DB_USERNAME=root
DB_PASSWORD=
```

Després:

```bash
php artisan migrate
php artisan serve
```

## 🌐 Com importar tutorials

```bash
php artisan tutorials:import {guideId}
```

Substitueix `{guideId}` per l'ID del tutorial a iFixit (p. ex. `1220`).

## 🔍 SEO i rendiment

* S'ha afegit un `sitemap.xml` automàtic
* Fitxer `robots.txt` amb domini configurat via `APP_URL`
* Optimització d'imatges i càrrega

Integració de Google Analytics i Google Search Console per analitzar el trànsit i l'impacte del SEO.
```
GA_MEASUREMENT_ID=G-XXXXXXXXXX
GOOGLE_VERIFICATION_CODE=
```

## ⚖ Llicència

Aquest projecte està sota la llicència [MIT](LICENSE).

---

Fet amb ❤️ per Eduard Altés Xifré.
