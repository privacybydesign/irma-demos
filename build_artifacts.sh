#!/usr/bin/env bash

set -euxo pipefail

DIR=$(dirname "$0")

# Copy library files to assets, where the Go build embeds them
mkdir -p "$DIR/assets"
cp "$DIR/node_modules/@privacybydesign/yivi-frontend/dist/yivi.js" "$DIR/assets/yivi.js"
