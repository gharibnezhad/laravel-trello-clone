# SMS Module

This module provides an abstraction for sending SMS messages through different SMS providers.

## Current Providers

- Kavenegar
- Log

## Architecture

- Contract-based abstraction
- Laravel Service Container
- Config-driven provider selection
- Exception handling and logging

## Provider Selection

The active SMS provider can be configured through the `.env` file:

SMS_PROVIDER=kavenegar

To use the log provider instead:

SMS_PROVIDER=log

## Testing

The module was tested using Laravel Tinker with the Kavenegar provider.

Example:

$sms = app(\Web\Sms\Contracts\SmsProviderInterface::class);

$result = $sms->send(
    '09XXXXXXXXX',
    'Laravel SMS module test'
);

$result; // true
