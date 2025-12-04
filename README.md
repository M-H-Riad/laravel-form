Laravel Form Builder (mhriad/laravel-form)

A lightweight, drop-in Form Builder for Laravel 10 & 11 — a safe, minimal replacement for LaravelCollective Form:: API.
It provides common Form:: helpers (open, close, text, email, password, textarea, select, checkbox, radio, file, submit, etc.) so you can keep your existing Blade views without rewriting forms.

— What does this package do?

This package implements a small, focused Form Builder that:

Recreates the most commonly used features of LaravelCollective\Form with the same facade/API style (Form::...) so you do not have to change your Blade templates.

Handles CSRF tokens, HTTP method spoofing (PUT/PATCH/DELETE), and multipart/form-data automatically.

Supports:

Basic inputs (text, email, number, password, hidden)

textarea, file

select (including collections / arrays)

checkbox and radio

submit and reset

Old input (old()), simple model binding (via Form::model()), and basic attribute building.

Returns Illuminate\Support\HtmlString so Blade renders the HTML safely.

Purpose: let large Laravel projects that rely heavily on Form:: keep working while upgrading Laravel versions (10/11) without massive view rewrites.

— Benefit of using this package

Zero view changes: Keep your current Blade views (Form::open, Form::text, etc.) — no manual conversions required.

Laravel 10/11 compatible: Works on modern PHP/Laravel stacks (PHP ≥ 8.1, Laravel 10/11).

Lightweight & dependency-free: No external packages required; minimal surface area.

Secure by default: Escapes attributes and values; automatically inserts CSRF and method fields.

Extendable: Easily add extra helpers (labels, select ranges, macros) by editing FormBuilder or adding service provider boot logic.

Safe migration path: Ideal for teams that can't afford a large view rewrite but still want to upgrade the framework.

— Installation process
Requirements

PHP ^8.1

Laravel ^10.0 || ^11.0

Installation

Install using Composer (from Packagist or GitHub):

# Packagist (preferred when published)
composer require mhriad/laravel-form



Clear caches (after install)
composer dump-autoload
php artisan optimize:clear

Basic usage examples

These examples assume the Form facade is available (Form::open, Form::text, etc.).

Simple form
{!! Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First name']) !!}
    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last name']) !!}
    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
    {!! Form::select('plan_id', \App\Models\SubscriptionsPlan::pluck('name','id'), null, ['class' => 'form-control select2']) !!}
    {!! Form::file('avatar', ['class' => 'form-control-file']) !!}
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

Model binding
{{-- Controller --}}
$user = User::find(1);
return view('users.edit', compact('user'));

{{-- Blade --}}
{!! Form::model($user) !!}

{!! Form::text('name') !!}
{!! Form::email('email') !!}

{!! Form::close() !!}


Form::model($model) sets an internal model used to pre-fill fields. You may call Form::model(null) to clear it.

Using in Tinker
php artisan tinker
>>> echo Form::open(['route' => 'home', 'method' => 'post']);
>>> echo Form::text('name', 'Riad', ['class' => 'form-control']);
>>> echo Form::close();


You should see proper HTML including CSRF token and method field where applicable.

API Reference (available methods)

The package ships the following commonly used methods:

Form::open(array $options = []) — open a form. Options: route, url, method, id, class, files (bool), enctype.

Form::close() — close a form.

Form::model($model) — bind a model to the builder instance.

Form::text($name, $value = null, $attributes = [])

Form::email($name, $value = null, $attributes = [])

Form::password($name, $attributes = [])

Form::hidden($name, $value = null, $attributes = [])

Form::file($name, $attributes = [])

Form::textarea($name, $value = null, $attributes = [])

Form::select($name, array|Collection $list = [], $selected = null, $attributes = [])

Form::checkbox($name, $value = 1, $checked = null, $attributes = [])

Form::radio($name, $value = null, $checked = null, $attributes = [])

Form::submit($value = 'Submit', $attributes = [])

Form::reset($value = 'Reset', $attributes = [])

All methods return an HtmlString (safe for Blade {!! !!} usage) and escape attributes/values.

License

MIT License — see LICENSE file.

Changelog / Versioning

Follow SemVer. Tag releases for stable versions 1.0.0

Authors & Maintainers

M-H-Riad / GitHub — laravel-form

Next version:

Supports for - label, selectRange, selectYear, selectMonth, date, etc.
