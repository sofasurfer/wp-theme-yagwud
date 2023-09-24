#!/bin/bash

# Creates a release package
DIR="./_release"
mkdir -p "$DIR"
mkdir -p "$DIR/theme/"

# Update Version
perl -pe '/^Version: / and s/(\d+\.\d+\.\d+\.)(\d+)/$1 . ($2+1)/e' -i style.css

echo "Release Theme";

#Sync files
rsync -va ./acf-json/ ./_release/theme/acf-json/
rsync -va ./components/ ./_release/theme/components/
rsync -va ./languages/ ./_release/theme/languages/
rsync -va ./assets/ ./_release/theme/assets/
rsync -va ./templates/ ./_release/theme/templates/
cp -v ./functions.php ./_release/theme/
cp -v ./index.php ./_release/theme/
cp -v ./screenshot.png ./_release/theme/
cp -v ./style.css ./_release/theme/

# Delete hidden files
find ./_release/theme/ -name '.DS*' -delete

echo "*** Release ***"
rsync -rva ./_release/theme/ vemamuwo@sl1702.web.hostpoint.ch:/home/vemamuwo/www/yagwud.com/content/themes/yagwud/

rm -r "$DIR"

echo "Done";

