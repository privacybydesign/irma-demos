#!/usr/bin/env bash

set -euxo pipefail

DIR=$(dirname "$0")

# Copy library files to assets
mkdir -p "$DIR/assets"
cp "$DIR/node_modules/jquery/dist/jquery.min.js" "$DIR/assets/jquery.min.js"
cp "$DIR/node_modules/bootstrap/dist/css/bootstrap.min.css" "$DIR/assets/bootstrap.min.css"
cp "$DIR/node_modules/bootstrap/dist/js/bootstrap.min.js" "$DIR/assets/bootstrap.min.js"
cp "$DIR/node_modules/@privacybydesign/yivi-frontend/dist/yivi.js" "$DIR/assets/yivi.js"

rm -rf "$DIR/build"

for lang in 'nl' 'en'; do
  # Copy demos in the right language directory
  mkdir -p "$DIR/build/$lang"

  for f in "$DIR"/demos/*/; do
    if echo "$f" | grep -q '/build/\|/vendor/\|/assets/\|node_modules/\|/data'; then
      continue
    fi

    demoname=$(echo "$f" | cut -d'/' -f 3)
    # Retrieve demo name in the particular language
    source ./demos/"$demoname"/name.sh
    eval translateddemoname=\$$lang
    demodir="$DIR/build/$lang/$translateddemoname"
    cp -r "$f" "$demodir"

    # Rename to index.html
    mv "$demodir/index.$lang.html" "$demodir/index.html"

    # Delete files in other languages
    find "$demodir" -type f -not -name "*.$lang.*" -a -name '*.*.*' -delete
  done

  cp -r "$DIR/vendor" "$DIR/build/$lang/vendor"
  cp -r "$DIR/assets" "$DIR/build/$lang/assets"
  cp "$DIR/config.php" "$DIR/build/$lang/config.php"
  cp "$DIR/start_session.php" "$DIR/build/$lang/start_session.php"
  cp "$DIR/get_session_request.php" "$DIR/build/$lang/get_session_request.php"
  cp "$DIR/start_session.js" "$DIR/build/$lang/start_session.js"
done

# Delete potential empty directories
find "$DIR/build" -type d -empty -delete
# Delete shell files
find "$DIR/build" -name "*.sh" -delete
