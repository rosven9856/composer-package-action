### Building a composer package in GitHub Action

## For dev

build
```shell
docker build . --build-arg=PHP_VERSION=8.3.6-1 --label=composer-package-action:latest
```

run
```shell
docker run --rm -v .:/usr/bin/app  composer-package-action:latest php app.php
```
