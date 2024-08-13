### Building a composer package in GitHub Action

## For dev

build
```shell
docker build . --build-arg=PHP_VERSION=8.3.10-1 -t=composer-package-action
```

initialization
```shell
docker run --rm -e GITHUB_WORKSPACE=/usr/bin/app -v .:/usr/bin/app composer-package-action composer install
```

running
```shell
docker run --rm -e GITHUB_WORKSPACE=/usr/bin/app -v .:/usr/bin/app composer-package-action php app.php
```

