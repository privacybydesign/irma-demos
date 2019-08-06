#!/usr/bin/env bash

set -euxo pipefail

DIR=$(dirname "$0")

# Copy library files to assets
mkdir -p "$DIR/assets"
cp "$DIR/node_modules/jquery/dist/jquery.min.js" "$DIR/assets/jquery.min.js"
cp "$DIR/node_modules/bootstrap/dist/css/bootstrap.min.css" "$DIR/assets/bootstrap.min.css"
cp "$DIR/node_modules/@privacybydesign/irmajs/dist/irma.js" "$DIR/assets/irma.js"

rm -rf "$DIR/build"

for lang in 'nl' 'en'; do
  # Copy demos in the right language
  mkdir -p "$DIR/build/$lang"

  for f in "$DIR"/*/; do
    if echo "$f" | grep -q '/build/\|/vendor/\|/assets/\|node_modules'; then
      continue
    fi

    demoname=$(echo "$f" | cut -d'/' -f 2)
    demodir="$DIR/build/$lang/$demoname"
    cp -r "$f" "$demodir"
    mv "$demodir/index.$lang.html" "$demodir/index.html"

    # Delete files in other language
    find "$demodir" -type f -not -name "*.$lang.*" -a -name '*.*.*' -exec rm {} \;
  done

  cp -r "$DIR/assets" "$DIR/build/$lang/assets"
  cp -r "$DIR/vendor" "$DIR/build/$lang/vendor"
done

# Delete potential empty directories
find "$DIR/build" -type d -exec rmdir {} + 2>/dev/null
