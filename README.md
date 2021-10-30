# Finance

Home app for finance tracking.

## Install

Docker is required to use this app. Install [Docker Desktop](https://www.docker.com/products/docker-desktop) 
and then run in terminal command:
```
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```
When the application is running, open it in the browser on the [localhost](http://localhost).
You can change host in `.env` file or create your own `.env.local` and use another command:
```
docker-compose --env-file .env.local -f docker-compose.yml -f docker-compose.prod.yml up -d
```
