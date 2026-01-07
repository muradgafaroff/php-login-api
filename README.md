# Core PHP Login API

Bu layihə, JSON formatında işləyən, təhlükəsiz giriş (login) sistemini təmin edən bir RESTful API nümunəsidir.

## Xüsusiyyətlər
- **PDO Singleton Pattern**: Verilənlər bazasına təhlükəsiz və tək mərkəzdən qoşulma.
- **Security**: Parollar `BCRYPT` alqoritmi ilə hashlənib və `password_verify` ilə yoxlanılır.
- **Token System**: Uğurlu girişdən sonra 24 saatlıq (Expires at) random token yaradılır və bazaya qeyd olunur.
- **Validation**: Email formatı və boş sahələr üçün yoxlamalar mövcuddur.

## Quraşdırılma
1. `database.sql` faylını MySQL mühitində (phpMyAdmin) icra edərək bazanı və cədvəlləri yaradın.
2. `db.php` faylındakı baza qoşulma məlumatlarını (host, dbname, user, pass) öz mühitinizə uyğunlaşdırın.

## API İstifadəsi
- **URL:** `http://localhost/[LAYİHƏ_QOVLUĞU]/login.php`
- **Method:** `POST`
- **Headers:** `Content-Type: application/json`

### Sorğu (Request Body):
```json
{
    "email": "test@example.com",
    "password": "123456"
}
