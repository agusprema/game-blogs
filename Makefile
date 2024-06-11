serve:
	php -S localhost:8000 -t public

migrate:
	php db/migration.php

seed:
	php db/seed.php