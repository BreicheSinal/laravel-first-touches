# Laravel News Website API

## About Laravel
Laravel is a web application framework with expressive, elegant syntax. 

## Description
A backend API for a news website built with Laravel. It allows administrators to manage news posts, restrict content by age, and handle user-submitted articles. Supports file attachments for both news and articles.

## Features
- **Admin Features:**
  - Post, edit, and delete news articles(with attachments).
  - Restrict news based on age.

- **User Features:**
  - View available news.
  - Post articles related to news (with attachments).

## API Endpoints

- **Admin Routes:**
    | Method | Endpoint                            | Description                      |
    |--------|-------------------------------------|----------------------------------|
    | POST   | /api/admin/news/{admin_id}          | Create a news post               |
    | PUT    | /api/admin/news/{admin_id}/{id}     | Update a news post               |
    | DELETE | /api/admin/news/{admin_id}/{id}     | Delete a news post               |

- **User Routes:**
    | Method | Endpoint                            | Description                      |
    |--------|-------------------------------------|----------------------------------|
    | GET    | /api/news                           | Get all news                     |
    | POST   | /api/users/news/{user_id}/{news_id} | Post an article linked to news   |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
