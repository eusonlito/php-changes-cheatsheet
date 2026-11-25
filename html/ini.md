# [Changes to INI file handling in PHP 5.5, 5.4, 5.3](index.md)

# [PHP 5.5](https://php-legacy-docs.zend.com/manual/php5/en/migration55.ini.php)

## Changes to INI file handling

### [Intl](https://php-legacy-docs.zend.com/manual/php5/en/book.intl.html)

The `intl.use_exceptions` configuration directive has been added, which controls the behaviour of intl when global errors occur in conjunction with the already extant `intl.error_level` configuration directive.

### [MySQLnd](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqlnd.html)

The [mysqlnd.sha256_server_public_key](https://php-legacy-docs.zend.com/manual/php5/en/mysqlnd.config.html#ini.mysqlnd.sha256-server-public-key) configuration directive has been added to allow [mysqli](https://php-legacy-docs.zend.com/manual/php5/en/book.mysqli.html) to use the new MySQL authentication protocol.

# [PHP 5.4](https://php-legacy-docs.zend.com/manual/php5/en/migration54.ini.php)

## Changes to INI file handling

The following `php.ini` directives have been removed:

- [register_globals](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-globals) and [register_long_arrays](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.register-long-arrays)
- [magic_quotes_gpc](https://php-legacy-docs.zend.com/manual/php5/en/info.configuration.html#ini.magic-quotes-gpc), [magic_quotes_runtime](https://php-legacy-docs.zend.com/manual/php5/en/info.configuration.html#ini.magic-quotes-runtime), and [magic_quotes_sybase](https://php-legacy-docs.zend.com/manual/php5/en/sybase.configuration.html#ini.magic-quotes-sybase)
- [allow_call_time_pass_reference](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.allow-call-time-pass-reference)
- [define_syslog_variables](https://php-legacy-docs.zend.com/manual/php5/en/network.configuration.html#ini.define-syslog-variables)
- [highlight.bg](https://php-legacy-docs.zend.com/manual/php5/en/misc.configuration.html#ini.syntax-highlighting)
- [session.bug_compat_42](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.bug-compat-42) and [session.bug_compat_warn](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.bug-compat-warn)
- mbstring.script_encoding
- [y2k_compliance](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.y2k-compliance)
- [safe_mode](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode), [safe_mode_gid](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode-gid), [safe_mode_include_dir](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode-include-dir), [safe_mode_exec_dir](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode-exec-dir), [safe_mode_allowed_env_vars](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode-allowed-env-vars), and [safe_mode_protected_env_vars](https://php-legacy-docs.zend.com/manual/php5/en/ini.sect.safe-mode.html#ini.safe-mode-protected-env-vars)

The following `php.ini` directives have been added:

- [cli.pager](https://php-legacy-docs.zend.com/manual/php5/en/readline.configuration.html#ini.cli.pager) and [cli.prompt](https://php-legacy-docs.zend.com/manual/php5/en/readline.configuration.html#ini.cli.prompt) for CLI SAPI using readline in interactive mode.
- [cli_server.color](https://php-legacy-docs.zend.com/manual/php5/en/features.commandline.ini.html#ini.cli-server.color) to enable the built-in development web server to use ANSI color coding in terminal output.
- [max_input_vars](https://php-legacy-docs.zend.com/manual/php5/en/info.configuration.html#ini.max-input-vars) - specifies how many GET/POST/COOKIE input variables may be accepted.
- [zend.multibyte](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.multibyte) - to control the new multibyte support.
- [zend.script_encoding](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.script-encoding) - This value will be used unless a "declare(encoding=...)" directive appears at the top of the script.
- [zend.signal_check](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.signal-check) - to check for replaced signal handlers on shutdown.
- [session.upload_progress.enabled](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.upload-progress.enabled), [session.upload_progress.cleanup](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.upload-progress.cleanup), [session.upload_progress.prefix](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.upload-progress.prefix), [session.upload_progress.name](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.upload-progress.name), [session.upload_progress.freq](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.upload-progress.freq), [session.upload_progress.min_freq](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.upload-progress.min-freq)
- [enable_post_data_reading](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.enable-post-data-reading) - When it's disabled, the POST data is not read (and processed)
- [windows_show_crt_warning](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.windows-show-crt-warning) - This directive shows the Windows CRT warnings when enabled. These warnings were displayed by default until now.

The following `php.ini` directives have been changed:

- [session.entropy_file](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.entropy-file) now defaults to /dev/random or /dev/urandom depending on what has been guessed at compile time.
- [session.entropy_length](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.entropy-length) now defaults to 32.

# [PHP 5.3](https://php-legacy-docs.zend.com/manual/php5/en/migration53.ini.php)

## Changes to INI file handling

PHP 5.3.0 has significantly improved performance and parsing of INI files, and adds several new syntax features.

- The standard `php.ini` files have been re-organized and renamed. `php.ini-development` contains settings recommended for use in development environments. `php.ini-production` contains settings recommended for use in production environments.
- There is now support for two special sections: `[PATH=/opt/httpd/www.example.com/]` and `[HOST=www.example.com]`. Directives set in these sections cannot be overridden by user-defined INI files or at runtime. More information about these sections can be found [here](https://php-legacy-docs.zend.com/manual/php5/en/ini.sections.html).
- [zend_extension_debug](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend-extension-debug), [zend_extension_debug_ts](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend-extension-debug-ts) and [zend_extension_ts](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend-extension-ts) have been removed. Use the [zend_extension](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend-extension) directive to load all Zend Extensions.
- [zend.ze1_compatibility_mode](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.zend.ze1-compatibility-mode) has been removed. If this INI directive is set to On, an **`E_ERROR`** error is emitted at startup.
- It is now possible to use the full path to load modules using the [extension](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.extension) directive.
- `"ini-variables"` can now be used almost anywhere in a `php.ini` file.
- [open_basedir](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.open-basedir) restrictions may now be tighted at runtime, and the directive is now PHP_INI_ALL.
- It is now possible to use alphanumeric or variable indices in INI option arrays.
- [get_cfg_var()](https://php-legacy-docs.zend.com/manual/php5/en/function.get-cfg-var.html) is now able to return "array" INI options.
- Two new mail directives: [mail.add_x_header](https://php-legacy-docs.zend.com/manual/php5/en/mail.configuration.html#ini.mail.add-x-header) and [mail.log](https://php-legacy-docs.zend.com/manual/php5/en/mail.configuration.html#ini.mail.log), have been added.

The following new ini directives have been added:

- `user_ini.filename` and `user_ini.cache_ttl` have been added to control the use of [user INI files](https://php-legacy-docs.zend.com/manual/php5/en/configuration.file.per-user.html).
- [exit_on_timeout](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.exit-on-timeout) has been added to force Apache 1.x children to exit if a PHP execution timeout occurs.
- Added `mbstring.http_output_conv_mimetype`. This directive specifies the regex pattern of content types for which [mb_output_handler()](https://php-legacy-docs.zend.com/manual/php5/en/function.mb-output-handler.html) is activated.
- Added [request_order](https://php-legacy-docs.zend.com/manual/php5/en/ini.core.html#ini.request-order). Allows controlling which external variables will be available in [`$_REQUEST`](https://php-legacy-docs.zend.com/manual/php5/en/reserved.variables.request.html).

The following ini directives have new default values:

- [session.use_only_cookies](https://php-legacy-docs.zend.com/manual/php5/en/session.configuration.html#ini.session.use-only-cookies) is now set to `"1"` (enabled) by default.
- [oci8.default_prefetch](https://php-legacy-docs.zend.com/manual/php5/en/oci8.configuration.html#ini.oci8.default-prefetch) has changed from `"10"` to `"100"`.
