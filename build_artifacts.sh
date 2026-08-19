#!/usr/bin/env bash

set -euxo pipefail

DIR=$(dirname "$0")

# Copy library files to assets
mkdir -p "$DIR/assets"
cp "$DIR/node_modules/@privacybydesign/yivi-frontend/dist/yivi.js" "$DIR/assets/yivi.js"

# The per-language build/ tree is obsolete: every demo is served straight from
# demos/<slug>/ and the language comes from the ?lang query parameter. Clean up
# any tree left behind by an older checkout so it cannot be served or shipped.
rm -rf "$DIR/build"
