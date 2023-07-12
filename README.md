# Laravel Chat System

[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/alibinsarwar/chat-system/blob/master/LICENSE)
[![Latest Stable Version](https://poser.pugx.org/alibinsarwar/chat-system/v/stable)](https://packagist.org/packages/alibinsarwar/chat-system)
[![Total Downloads](https://poser.pugx.org/alibinsarwar/chat-system/downloads)](https://packagist.org/packages/alibinsarwar/chat-system)
[![Build Status](https://travis-ci.org/alibinsarwar/chat-system.svg?branch=master)](https://travis-ci.org/alibinsarwar/chat-system)

A chat system package for Laravel that enables users to chat with each other using Pusher PHP server.

## Requirements

This package requires the following dependencies:

- User Authentication System ( Breeze , Jetstream , Custom )
- Pusher PHP server
- Pusher API keys and secret keys (obtained from your Pusher account)

## Features

- Communication through private channel
- Support Conversation Between two Users
- Dark Theme for Chat System

## Installation

1. Make sure you have a Pusher keys if you don't have then get them by login to [Pusher Dashboard](https://dashboard.pusher.com/) and then create new APP ,and install [Pusher PHP Server](https://github.com/pusher/pusher-http-php) For authentication I preffer to install [Laravel Breeze](https://github.com/laravel/breeze) package in your Laravel application.

2. Run the following command to install the Laravel Chat System package:

   ```shell
   composer require alisarwar/chat-system:dev-main
   ```

3. This package provide you Event , Controller , Migrations , Models , Views these things create an echo-system to implement chat system in you application

4. Add Routes to your web.php

   ```shell
       Route::get('/message',[MessageController::class , 'message'])->name('message');
       Route::get('/chat/{slug?}',[MessageController::class , 'chat'])->name('chat');
       Route::post('/broadcast', [MessageController::class , 'broadcast'])->name('broadcast');
       Route::post('/receive', [MessageController::class , 'receive'])->name('receive');
       Route::post('/pusher/auth', [MessageController::class , 'auth'])->name('pusher.auth');
   ```

5. Update your .env

   ```shell
       BROADCAST_DRIVER=pusher

       PUSHER_APP_ID={YOUR_PUSHER_APP_ID}
       PUSHER_APP_KEY={YOUR_PUSHER_APP_KEY}
       PUSHER_APP_SECRET={YOUR_PUSHER_APP_SECRET}
       PUSHER_HOST=
       PUSHER_PORT=443
       PUSHER_SCHEME=https
       PUSHER_APP_CLUSTER={YOUR_PUSHER_APP_CLUSTER}
   ```

6. Migrate and Server Your Application

   ```shell
       php artisan migrate
       php artisan serve
   ```

7. Register Users and start conversation between them

## Contributing

Contributions are welcome! If you encounter any issues or have suggestions for improvements, please open an issue or submit a pull request on the [GitHub repository](https://github.com/alibinsarwar/chat-system).
