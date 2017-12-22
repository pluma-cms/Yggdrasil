#!/bin/bash

while read
do
  npm run build
done < <(inotifywait -m -e modify "./src/Component.vue")
