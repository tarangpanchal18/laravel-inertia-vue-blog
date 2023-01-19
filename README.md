## About Application

A Simple Laravel Application with Vue.JS & Inertia.js. And have used tailwind css.

Some of features are listed as below for this application
- User can login/register with their credentials.
- Dashboard For Logged in User with `Total Active Blog Count` & `Total InActive Blog Count` & Listing of latest blogs
- A random quote Api for show user motivational quote on each refresh
- My Blogs page where Writer/User can Add/Edit/Delete Post
- Homepage Where All Other Users Can view blogs.
- Blog View Counter(to check how many users seen/read blog)

**Note : This is built on docker. so make sure Docker is installed in your system**

## Requirements
| App | Version |
| ------ | ------ |
| Laravel Version | 9.19 |
| Vue Version | 0.11 |
| Tailwind Version | 3.2 |
| Vite Version | 3.0 |
| Docker Version | 20.10 |

## Setup
- First of all go to project directory and perform `docker-compose build`
- `cp .env.example .env`
- Now change `.env` file and db details
- Run `docker-compose up -d --build`
- Run `docker-compose exec app composer install`
- Run `docker-compose exec app php artisan migrate`
- Run `docker-compose exec app npm install`
- Run `docker-compose exec app npm build` or Run `docker-compose exec app npm run dev`
- Run `docker-compose exec app storage:link`
- Now Website can run on `http://localhost:8081/` And PhpMyAdmin Can run on `http://localhost:8085/`
- If port is assigned you can change from `docker-compose.yml` file

## Setup for email functionality
- Make sure you have run `docker-compose exec queue:work` to send emails on registration
- That's it :+1:

If you dont have any idea how to set up the docker or docker is not installed in your system please go through this [link](https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-22-04). You can skip all steps if you dont have idea about docker and directly scroll to `Step 6 — Running the Application with Docker Compose`.

## Contributing

Thank you for considering contributing to the Laravel-inertia-vue-blog ! You can create PR for changes and bugs if you find so.

*Note : Currently In Readme file I've mentioned Docker setup for only **Linux OS**. For Mac & Windows Looking forward for contributors to update Readme File.*
Thanks in advanced !

## Security Vulnerabilities

If you discover a security vulnerability within This Project, please send an e-mail to Tarang Panchal via [tarang.webinfosolutions@gmail.com](mailto:tarang.webinfosolutions@gmail.com). All security vulnerabilities will be promptly addressed.

## License

This is completely open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
Do whatever you want with this app.
