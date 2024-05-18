#!/bin/bash

# Ensure mkcert is installed
if ! command -v mkcert &> /dev/null; then
    echo "mkcert could not be found, installing it..."
    brew install mkcert
    brew install nss  # Only if using Firefox
fi

# Create and install a local CA
echo "Creating and installing local CA..."
mkcert -install

# Generate certificates for kinkforme.ddev.site
echo "Generating certificates for kinkforme.ddev.site..."
mkcert kinkforme.ddev.site "*.kinkforme.ddev.site" localhost 127.0.0.1 ::1

# Move certificates to .ddev directory
echo "Moving certificates to .ddev directory..."
cp "$(mkcert -CAROOT)/kinkforme.ddev.site+4.pem" .ddev/kinkforme.ddev.site.crt
cp "$(mkcert -CAROOT)/kinkforme.ddev.site+4-key.pem" .ddev/kinkforme.ddev.site.key

echo "mkcert setup and DDEV configuration complete!"
