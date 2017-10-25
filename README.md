# Slim Framework 3 fastcgi_finish_request benchmark

In order to fake actions after fastcgi_finish_request a configurable `sleep` has been added

* Browser response time is measured in FF Web Developer Tools
* Total execution time is collected from in-app `microtime` (saved into `log/app.log`)

## Start container

```
docker-compose up
```

### No post send actions

#### Without fastcgi_finish_request

```
http://localhost/
```

* Response is sent to browser in 5ms
* Total execution time is 4ms

#### WITH fastcgi_finish_request

```
http://localhost/?fastcgi=1
```

* Response is sent to browser in 5ms
* Total execution time is 4ms

### Post send actions

#### Without fastcgi_finish_request

```
http://localhost/?sleep=5
```

* Response is sent to browser in 5007ms
* Total execution time is 5004ms

#### Request WITH fastcgi_finish_request

```
http://localhost/?fastcgi=1&sleep=5"
```

* Response is sent to browser in 4ms
* Total execution time is 5004ms
