# NutriTrack 🥗📊

A modern full-stack nutrition tracking and health analytics web application built with Laravel and Tailwind CSS.

NutriTrack helps users:
- track daily meals
- monitor calories & macros
- log body weight
- calculate BMI
- analyze nutrition history
- monitor fitness progress

---

# 🚀 Features

## 🔍 Smart Food Search
- USDA FoodData Central API integration
- Real nutrition data
- Fast food search
- Search suggestions
- Exact food prioritization

---

## 🍽️ Meal Tracking
Users can:
- add meals from food search
- manually add custom meals
- categorize meals:
  - breakfast
  - lunch
  - dinner
  - snacks

Stored nutrition:
- calories
- protein
- carbs
- fats

---

## 📊 Nutrition Dashboard

Professional analytics dashboard featuring:

### Daily Nutrition Tracking
- Calories consumed
- Protein intake
- Carb intake
- Fat intake

### Goal Progress
- Dynamic macro progress bars
- Percentage completion tracking

### Body Metrics
- Current weight
- Height
- BMI score
- BMI classification:
  - Underweight
  - Normal
  - Overweight
  - Obese

---

## ⚖️ Weight Logging
Users can:
- log body weight daily
- track progress over time
- maintain historical records

---

## 📚 Nutrition Logs System
Historical tracking system allowing users to:
- select previous dates
- view meals from that day
- view nutrition totals
- view weight history
- monitor long-term progress

---

## 🌙 Modern UI
- Responsive SaaS-style dashboard
- Dark mode support
- Tailwind CSS design system
- Mobile-friendly layout
- Modern analytics cards

---

# 🛠️ Tech Stack

## Backend
- Laravel 12
- PHP 8+
- MySQL

## Frontend
- Blade Templates
- Tailwind CSS
- JavaScript

## APIs
- USDA FoodData Central API

---

# 📂 Project Structure

## Controllers

| Controller | Purpose |
|---|---|
| FoodController | Food search & API integration |
| DashboardController | Dashboard analytics |
| MealController | Store meals |
| LogsController | Historical nutrition logs |
| WeightLogController | Weight tracking |

---

## Models

| Model | Purpose |
|---|---|
| User | Authentication & profile |
| Meal | Meal storage |
| WeightLog | Weight tracking |

---

# 🗄️ Database Tables

| Table | Purpose |
|---|---|
| users | User accounts |
| meals | Nutrition & meals |
| weight_logs | Daily weight logs |
| sessions | Laravel session management |
| migrations | Migration tracking |

---

# ⚙️ Installation

## 1. Clone Repository

```bash
git clone <repo-url>
```

---

## 2. Enter Project

```bash
cd NutriTrack
```

---

## 3. Install Dependencies

```bash
composer install
```

---

## 4. Install Node Modules

```bash
npm install
```

---

## 5. Configure Environment

```bash
cp .env.example .env
```

---

## 6. Generate App Key

```bash
php artisan key:generate
```

---

## 7. Configure Database

Inside `.env`

```env
DB_DATABASE=nutritrack
DB_USERNAME=root
DB_PASSWORD=
```

---

## 8. Add USDA API Key

```env
USDA_API_KEY=your_api_key_here
```

Get API Key:
https://fdc.nal.usda.gov/api-key-signup.html

---

## 9. Run Migrations

```bash
php artisan migrate
```

---

## 10. Start Development Server

```bash
php artisan serve
```

---

## 11. Run Vite

```bash
npm run dev
```

---

# 🔑 Authentication

Laravel Breeze authentication is used.

Features:
- Register
- Login
- Session management
- Protected routes

---

# 📈 BMI Classification

| BMI | Classification |
|---|---|
| < 18.5 | Underweight |
| 18.5 - 24.9 | Normal |
| 25 - 29.9 | Overweight |
| 30+ | Obese |

---

# 🧠 Future Improvements

Planned features:
- AI nutrition recommendations
- Water intake tracking
- Workout tracking
- Meal editing/deleting
- Nutrition charts
- Streak system
- PDF reports
- Favorite foods
- Goal customization
- Weekly/monthly analytics
- Notifications system

---

# 👥 Team Development Notes

## Important Architecture Notes

### Meals are NOT deleted daily
Meals are permanently stored in database.

Dashboard only filters:
```php
whereDate('consumed_at', today())
```

This allows:
- historical analytics
- progress tracking
- future reporting systems

---

## Weight Logs
Weight logs are stored permanently.

Latest weight is used as current dashboard weight.

---

## Dashboard Calculations
Most analytics calculations are handled in:
```text
DashboardController
```

Blade views mainly focus on UI rendering.

---

# 📌 API Notes

USDA API provides:
- food descriptions
- calories
- protein
- carbs
- fats

Images are currently not used due to inconsistent API image support.

---

# 🧪 Testing

Recommended future testing:
- feature tests
- authentication tests
- nutrition calculation tests
- API response validation

---

# 🧑‍💻 Contributors

Built by:
- Sourodip Dey

---

# 📄 License

This project is for educational and portfolio purposes.
