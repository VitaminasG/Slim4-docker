## Docker install on Ubuntu system:

### Code Fixer:
* friendsofphp/php-cs-fixer - [PHPStorm documentation](https://www.jetbrains.com/help/phpstorm/using-php-cs-fixer.html#installing-configuring-php-cs-fixer)

## Important!

### Add Aliases to /etc/hosts:
Add the following lines to `/etc/hosts`:
```console
172.20.120.2 dev.local
```
```console
172.20.120.3 dev.pma.local
```

## Make commands:

### Build and Run:
```console
make up
```

### Shutdown:
```console
make down
```

### SSH connection:
```console
make ssh
```