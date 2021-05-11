install:
	-./bin/console doctrine:database:drop -q -f --env=dev
	./bin/console doctrine:database:create -q --env=dev
	./bin/console doctrine:migrations:diff -q --env=dev
	./bin/console doctrine:migrations:migrate -q --env=dev
	# rm migrations/*
