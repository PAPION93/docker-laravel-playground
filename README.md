# Docker Laravel Playground

## Docker

로드밸런싱
`docker-compose scale db=1 laravel=3 nginx=1`

## LOCUST 스트레스 테스트

[참고 자료](https://bcho.tistory.com/1369)  
`locust -f .\locustfile.py --port 8080`

## Laravel

### [artisan command](https://github.com/PAPION93/TIL/blob/master/Laravel/artisan_command.md)

### Pusher 

1. `composer require pusher/pusher-php-server "~4.0"`
2. `php artisan make:event MyEvent`
3. `npm install --save laravel-echo pusher-js`

### Redis