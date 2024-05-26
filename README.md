# Blokkot backend

## How to deploy locally

### Setup

Make sure to install the vendor:

```bash
# composer
composer install

# start docker desktop
```

### Development

To start the development server:

```bash
# terminal
./vendor/bin/sail up
```

## Implemented features
- Validation through Sanctum
  - Register
  - Login
  - Email verification through Mailtrap
  - Password reset
  - Logout
- CRUD operations
  - Fetch a detail
  - Fetch a list (with paging)
  - Add an entry
  - Update an entry
  - Delete an entry
- Multilingual support
  - English
  - Dutch
- Image upload en update

## Not implemented features
## Known bugs

None (locally).
