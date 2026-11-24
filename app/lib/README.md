# app/lib — vendored WordPress helper framework

This directory contains the base framework classes the theme builds on: base post
types and taxonomies, REST route/callback base classes, the block registrar, asset
bundling, ACF provider, admin-menu bases, WordPress default/plugin optimizations and a
few helpers.

It is vendored into the theme (not pulled as an external package) so the theme is a
self-contained, handover-ready source tree. The classes live under the
`gradZagrebWeb2024\lib` namespace and are autoloaded via the theme's PSR-4 mapping
(`gradZagrebWeb2024\` -> `app`).

Theme code references these as, for example:

```php
use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\rest\BaseRoute;
use gradZagrebWeb2024\lib\core\ACFProvider;
```

Treat this directory as framework code: extend it from the theme's own `app/` classes
rather than editing it for feature work, so it stays easy to reason about.
