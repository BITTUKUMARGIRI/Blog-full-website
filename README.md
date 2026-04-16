# Blog – Full Website (Laravel)

A simple full‑stack blog website built with **Laravel**. Admins can create, edit, and delete posts, while regular users can view all posts. Each post is owned by the admin who created it, so one admin cannot edit another admin’s post.

---

## 🧩 Features

- User registration and login (Laravel default auth).
- Admin‑only post creation, editing, and deletion.
- Post ownership protection:  
  - Admins can **only edit/delete their own posts**.
- Clean, modern “paper‑style” create‑post form.
- Laravel sessions and Blade for dynamic UI.

---

## 🛠️ Tech Stack

- **Backend**: Laravel
- **Database**: MySQL
- **Frontend**: Blade templates, HTML, CSS (no JavaScript framework)
- **Auth**: Laravel Breeze / Laravel default auth (email + password)

---

## 📦 How to Run Locally

1. Clone the repository:
   ```bash
   git clone https://github.com/BITTUKUMARGIRI/Blog-full-website.git
   cd Blog-full-website
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate the app key:
   ```bash
   php artisan key:generate
   ```

5. Configure your database in `.env` (MySQL, default ports assumed):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=blog
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Create the database `blog` in MySQL, then run migrations:
   ```bash
   php artisan migrate
   ```

7. Create a super‑admin or user account (if seed is not present, use Laravel default register/login).

8. Start the development server:
   ```bash
   php artisan serve
   ```

9. Open in your browser:
   - `http://localhost:8000` (or `127.0.0.1:8000`)

---

## 🔐 Admin Post Ownership

- Each post stores the `user_id` of the admin who created it.
- In the Blade views, the **Edit** link is only shown if:
  ```blade
  auth()->id() == $post->user_id
  ```
- The backend also checks ownership in controllers so even if the URL is guessed, only the owner can edit/delete a post.

---

## 📂 Project Structure (Simplified)

- `app/Models/Post.php` – Post model with `user_id` relationship.
- `resources/views/` – Blade views:
  - `login.blade.php`, `register.blade.php`
  - `create.blade.php`, `edit.blade.php`, `read.blade.php`, `FullPost.blade.php`
- `routes/web.php` – All routes for login, register, and post actions.

---

## 📄 License

This project is private for demonstration and learning purposes. You may reuse ideas and code for your own learning, but avoid copying structure verbatim in production projects without modification.
