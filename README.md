1. Clone repository

```bash
git clone https://github.com/zafki3l/Educational-Institution-Accreditation-v2.git
cd Educational-Institution-Accreditation-v2
```

2. Copy .env file

```bash
cp .env.example .env
```

3. Setup enviroment variables
```bash
MYSQL_HOST='db' # Docker service name
MYSQL_USER='user' # Your user
MYSQL_PASSWORD='secret' # Your password
MYSQL_DATABASE='educational_institution_accreditation' # Your database
MYSQL_PORT=3306 # Your port

MONGO_PORT=27017 # Default MongoDB port
DOCKER_GID=1000 # Run `id -g` to get your group id
DOCKER_UID=1000 # Run `id -u` to get your user id
```

4. Docker compose up
```bash
docker compose up -d --build
```

5. Install packages
```bash
docker compose exec app sh
composer install
```

6. Run migrate to create database
```bash
docker compose exec app sh
composer migrate
```