# Laravel Settings
This package allows you to store some global settings into your app database and load them once you need them in entire app globally.

## Installation

Install my-project with npm

```bash
  composer require moh6mmad/laravel-settings
```
    
## Documentation
You may call set and get functions in several ways. Settings are stored in database as following: 
`settings_group` and `name` and `value`
You need to call both `settings_group` and `name` to access to the `value`

## Usage
Call it via config
```php
config('settings.ui.template.header_title')
```
Call it via its helper
```php
setting('ui.template.header_title')
```
or set a new value for this
Call it via its helper
```php
setting('ui.template.header_title', 'Laravel Setting App')
```
## Feedback

If you have any feedback, please reach out to us at mamm6d@gmail.com


## License

[MIT](https://choosealicense.com/licenses/mit/)

