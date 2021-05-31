#!/bin/sh
# build .zip

rm -rf build/*
cp docs/paper.pdf elaborato.pdf
zip -qr elaborato_Pietro_Jomini_5AROB.zip code docs scripts resources elaborato.pdf
mv elaborato_Pietro_Jomini_5AROB.zip build
rm elaborato.pdf
