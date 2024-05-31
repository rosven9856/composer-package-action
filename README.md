### Building a composer package in GitHub Action

## For dev

build
```shell
docker build . --build-arg=PHP_VERSION=8.3.7-1 -t=composer-package-action
```

initialization
```shell
docker run --rm -v .:/usr/bin/app composer-package-action composer install
```

running
```shell
docker run --rm -v .:/usr/bin/app composer-package-action
```
