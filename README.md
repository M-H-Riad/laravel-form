# Laravel Form Builder (mhriad/laravel-form)

A lightweight, drop-in Form Builder for Laravel 10 & 11 — a safe, minimal replacement for the LaravelCollective Form:: API.
It provides common Form:: helpers (open, close, text, email, password, textarea, select, checkbox, radio, file, submit, etc.) so you can keep your existing Blade views without rewriting forms.

## What does this package do?

This package implements a small, focused Form Builder that:

- Recreates the most commonly used features of LaravelCollective\Form using the same facade/API style (Form::...) so existing Blade templates continue working.
- Automatically handles CSRF tokens, HTTP method spoofing (PUT/PATCH/DELETE), and multipart/form-data for file uploads.
- Supports:
  - Basic inputs: text, email, number, password, hidden
  - textarea, file
  - select (arrays & collections)
  - checkbox, radio
  - submit, reset
- Provides old() value handling, simple model binding via Form::model(), and safe HtmlString output.
- Helps large projects upgrade Laravel versions (10/11) without rewriting forms.

## Benefits of using this package

- Zero view changes — keep using Form::open, Form::text, etc.
- Laravel 10/11 compatible — works with modern PHP versions.
- Lightweight & dependency-free.
- Secure — auto-escapes values & inserts CSRF/method fields.
- Extendable — easy to customize.
- Safe migration path for legacy projects.

## Installation

Requirements:
- PHP ≥ 8.1
- Laravel 10 or 11

Install:
composer require mhriad/laravel-form

Clear caches:
composer dump-autoload
php artisan optimize:clear

## Usage Examples

### Simple form
- {!! Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

- {!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}

- {!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}

- {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}

- {!! Form::select('plan_id', \App\Models\SubscriptionsPlan::pluck('name','id'), null, ['class' => 'form-control select2']) !!}

- {!! Form::file('avatar') !!}

- {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

- {!! Form::close() !!}

### Model binding
Controller:
$user = User::find(1);
return view('users.edit', compact('user'));

Blade:
{!! Form::model($user) !!}
{!! Form::text('name') !!}
{!! Form::email('email') !!}
{!! Form::close() !!}

## API Reference

Form::open()
Form::close()
Form::model()
Form::text()
Form::email()
Form::password()
Form::hidden()
Form::file()
Form::textarea()
Form::select()
Form::checkbox()
Form::radio()
Form::submit()
Form::reset()

## License

MIT License.

## Author

M H Riad — https://github.com/mhriad

Next version planned: label(), selectRange(), selectYear(), date(), macros, etc.
