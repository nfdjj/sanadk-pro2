# Sandak Pro

Laravel application for the Sandak Pro Arabic/English labor services site.

## Deploy on Railway

The repository includes `railway.json`. Railway detects the Laravel app, builds frontend assets, runs database migrations, and seeds the initial site content on deployment.

1. Create a Railway project and deploy this GitHub repository from the `main` branch.
2. Add a Railway MySQL service and name it `MySQL`.
3. Add these variables to the Laravel service:

   ```text
   APP_NAME=Sandak Pro
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=<generate with: php artisan key:generate --show>
   APP_URL=<your Railway public URL>
   LOG_CHANNEL=stderr
   DB_CONNECTION=mysql
   DB_HOST=${{MySQL.MYSQLHOST}}
   DB_PORT=${{MySQL.MYSQLPORT}}
   DB_DATABASE=${{MySQL.MYSQLDATABASE}}
   DB_USERNAME=${{MySQL.MYSQLUSER}}
   DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
   ADMIN_NAME=<your admin name>
   ADMIN_EMAIL=<your admin email>
   ADMIN_PASSWORD=<unique password of at least 12 characters>
   ```

4. Generate a public domain in the Laravel service's Railway settings and set `APP_URL` to that HTTPS URL.
5. Sign in at `/admin-secure/login`. The first admin is created during deployment, and public admin registration closes once that account exists. Remove `ADMIN_PASSWORD` from Railway variables after the first successful deployment.
6. Open the Railway domain to verify the deployed site. GitHub Pages cannot run this PHP/Laravel application.

For uploaded images to survive redeploys, attach a Railway volume to `/app/public/uploads`. Keep `APP_DEBUG` disabled and never commit `.env` or production credentials.

## Local development

Install PHP dependencies with `composer install`, JavaScript dependencies with `npm ci`, and build frontend assets with `npm run build`. Configure the database in `.env`, then run `php artisan migrate` and start the app with `php artisan serve`.
