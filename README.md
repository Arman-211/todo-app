# ✅ TODO Application

## 📥 Installation

### 1. **Clone the repository**
```sh
git clone https://github.com/yourusername/todo-app.git
cd todo-app
```

### 2. **Run Docker**
```sh
docker compose up -d --build
```

### 3. **Install dependencies**
```sh
docker exec -it todo-app composer install
```

### 4. **Set up Laravel environment**
```sh
docker exec -it todo-app cp .env.example .env
docker exec -it todo-app php artisan key:generate
```

### 5. **Run migrations and seeders**
```sh
docker exec -it todo-app php artisan migrate --seed
```

### 6. **Start the server (if not using Docker)**
```sh
docker exec -it todo-app php artisan serve
```
Now the application is available at:  
🔗 **http://localhost**

---

## ⚙ **Features**
✔️ Create, update, and delete tasks  
✔️ User authentication  
✔️ Admin panel powered by Laravel Backpack  
✔️ Fully containerized with Docker

---

## 🔥 **Project Structure**
```
/todo-app
│── app/                 # Laravel logic (Models, Controllers, Services)
│── bootstrap/           # Initial bootstrapping
│── config/              # Configuration files
│── database/            # Migrations and seeders
│── public/              # Frontend assets
│── resources/           # Views
│── routes/              # API and Web routes
│── storage/             # File storage
│── tests/               # Tests
│── .env                 # Environment settings
│── docker-compose.yml   # Docker configuration
│── Dockerfile           # Docker container setup
│── README.md            # This file 
```

---

## 🔄 **Commit Standard (Conventional Commits)**
Use the following commit format:
```sh
git commit -m "feat(task): add task model and migrations"
git commit -m "fix(auth): fix authentication redirect issue"
git commit -m "docs(readme): update installation instructions"
```
 More details: [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)

---

 **All Set!**
Once you've completed these steps, you will have a fully functional **TODO Application** powered by **Laravel 11**, **Backpack UI**, **Docker**, and **MySQL**, with easy task management. 🚀🔥

💡 **If any issues arise, check logs:**
```sh
docker logs todo-app
docker logs todo-nginx
```


